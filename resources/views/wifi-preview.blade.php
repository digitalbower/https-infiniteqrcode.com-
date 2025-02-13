<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wifi Preview</title>
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

<body class="flex justify-center items-center min-h-screen font-poppins bg-cover bg-center">
  <!-- Animation Background -->
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-gray-300">
    <!-- Animated Circles -->
    <div class="absolute bottom-[-100px] w-10 h-10 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 10%; animation-duration: 8s;"></div>
    <div class="absolute bottom-[-100px] w-5 h-5 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 20%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-12 h-12 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 35%; animation-duration: 7s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-20 h-20 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 50%; animation-duration: 11s;"></div>
    <div class="absolute bottom-[-100px] w-9 h-9 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 55%; animation-duration: 6s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-11 h-11 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 65%; animation-duration: 8s; animation-delay: 3s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 70%; animation-duration: 12s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-6 h-6 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 80%; animation-duration: 6s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-4 h-4 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 70%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-100 rounded-full opacity-50 animate-rise"
      style="left: 25%; animation-duration: 10s; animation-delay: 4s;"></div>
  </section>

  <!-- Form Card -->
  <div class="w-full p-4 absolute h-full text-white overflow-hidden flex justify-center items-center">
    <!-- SMS Box -->
    <div class="w-full p-4  max-w-md h-full absolute h-full text-white  overflow-hidden">
      <!-- Profile Header -->
      <div class="w-full px-4 mt-4 max-w-xl text-center space-y-4">
        <div class="flex justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="lucide lucide-wifi w-12 h-12 text-gray-800">
            <path d="M12 20h.01"></path>
            <path d="M2 8.82a15 15 0 0 1 20 0"></path>
            <path d="M5 12.859a10 10 0 0 1 14 0"></path>
            <path d="M8.5 16.429a5 5 0 0 1 7 0"></path>
          </svg></div>
        <h1 class="text-4xl font-bold text-gray-800">WIFI</h1>
        <p class="text-gray-800 text-sm lg:text-lg">Network</p><input
          class="flex h-10 rounded-md border border-input px-3 py-2 text-sm lg:text-lg ring-offset-background file:border-0 file:bg-transparent file:text-sm lg:text-lg file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-none text-black w-full my-1"
          type="text" id="ssid" value="{{$qrCode->ssid}}">
        <p class="text-gray-800 text-sm lg:text-lg">Password</p><input
          class="flex h-10 rounded-md border border-input px-3 py-2 text-sm lg:text-lg ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-none text-black w-full my-1"
          type="password" id="password" value="{{$qrCode->password}}">
          <input type="hidden" id="encryption" value="{{$qrCode->enctype}}">
          <button id="connect"
          class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 h-11 rounded-md px-8 w-full bg-zinc-700 hover:bg-zinc-600 text-white text-base">CONNECT
          NOW</button>
        <div class="flex justify-center mt-6">
          <div class="flex -space-x-4">
            <div class="w-12 h-12 bg-purple-500 rounded-full"></div>
            <div class="w-12 h-12 bg-pink-500 rounded-full"></div>
            <div class="w-12 h-12 bg-gray-800 rounded-full"></div>
          </div>
        </div>
      </div>

      <!-- Contact Information -->

    </div>
  </div>
 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX1r_54BQXiGiu-6YOITWJ4UR3NAqbUyM"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#connect').click(function () {
          const ssid = $("#ssid").val();
          const encryption = $("#encryption").val();
          const password = $("#password").val(); 
      
          let wifiDetails = `SSID: ${ssid}\nPassword: ${password || "No Password"}\nSecurity: ${encryption}`;
          let blob = new Blob([wifiDetails], { type: "text/plain" });
          let link = document.createElement("a");
          link.href = URL.createObjectURL(blob);
          link.download = "WiFi_Credentials.txt";
          link.click();

          // Alternative: Copy WiFi details to clipboard
          navigator.clipboard.writeText(wifiDetails).then(() => {
              alert("WiFi details copied! Paste them in your WiFi settings.");
          }).catch(err => {
              console.error("Failed to copy:", err);
          });
        });
    });
   </script> 
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
