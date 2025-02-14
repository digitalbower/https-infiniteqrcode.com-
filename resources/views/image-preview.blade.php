<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Preview</title>
  <link rel="shortcut icon" href="{{asset('images/indexfav.png')}}" type="image/x-icon">
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    @keyframes rise {
      0% {
        bottom: -100px;
        transform: translateX(0);
      }
      50% {
        transform: translateX(100px);
      }
      100% {
        bottom: 1080px;
        transform: translateX(-200px);
      }
    }

    .animate-rise {
      animation: rise infinite ease-in;
    }
  </style>
</head>
<body class="bg-zinc-900 flex justify-center items-center min-h-screen font-poppins">

  <!-- Animation Background -->
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-gray-100">
    <!-- Animated Circles -->
    <div class="absolute bottom-[-100px] w-10 h-10 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 10%; animation-duration: 8s;"></div>
    <div class="absolute bottom-[-100px] w-5 h-5 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 20%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-12 h-12 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 35%; animation-duration: 7s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-20 h-20 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 50%; animation-duration: 11s;"></div>
    <div class="absolute bottom-[-100px] w-9 h-9 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 55%; animation-duration: 6s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-11 h-11 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 65%; animation-duration: 8s; animation-delay: 3s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 70%; animation-duration: 12s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-6 h-6 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 80%; animation-duration: 6s; animation-delay: 2s;"></div>
  </section>

  <!-- Form Card -->
  <div class="w-full p-4 absolute h-full text-white flex justify-center items-center">
  <div class="container max-w-md h-full mx-auto">
    <img 
    src="{{asset('storage/'.$qrCode->imagepath)}}" 
    class="w-full  h-full">
  </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $(document).ready(function() {
     if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(async (position) => {
         const latitude = position.coords.latitude;
         const longitude = position.coords.longitude;
         
         try {
           const cityCountry = await getCityCountry(latitude, longitude);
           const city = cityCountry?.city || "Unknown";
           const country = cityCountry?.country || "Unknown";
           
           console.log("City:", city);
           console.log("Country:", country);
   
           // Send data to PHP if both city and country are found
           await sendDataToPHP(city, country);
            // Redirect after 2 seconds
         } catch (error) {
           console.error("Error:", error);
         }
       },async (error) => {
         console.error("Geolocation error:", error);
         await sendDataToPHP("Unknown", "Unknown");
       });
     } else {
       console.error("Geolocation not supported by this browser.");
     }
     async function getCityCountry(lat, lng) {
       const geocoder = new google.maps.Geocoder();
       const location = { lat, lng };
       
       return new Promise((resolve, reject) => {
         geocoder.geocode({ location }, (results, status) => {
           if (status === 'OK' && results[0]) {
             let city = null, country = null;
             results[0].address_components.forEach(component => {
               if (component.types.includes("locality") || component.types.includes("administrative_area_level_1")) {
                 city = component.long_name;
               }
               if (component.types.includes("country")) {
                 country = component.long_name;
               }
             });
             resolve({ city, country });
           } else {
             reject("Geocode failed");
           }
         });
       });
     }
     async function sendDataToPHP(city, country) {
     try {
       const response = await $.ajax({
         url: "{{route('country-statistics')}}",
         method: "POST",
         data: {
           code: "{{$qrCode->code}}",  // Output PHP variable
           city: city,
           country: country,
           "_token": "{{ csrf_token() }}",
         }
       });
       return response;  // Return the response if needed
     } catch (error) {
       console.error("Error sending data to PHP:", error);
       throw error;  // Throw the error for handling later if necessary
     }
   }
    });
     </script>
</body>
</html>

     
