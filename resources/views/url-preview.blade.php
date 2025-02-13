<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Url Loader</title>
  <link rel="shortcut icon" href="{{asset('images/indexfav.png')}}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 p-0 bg-indigo-900">

  <!-- Full Page Loader -->
  <div class="fixed inset-0 bg-gray-900 flex items-center justify-center z-50">
    <div class="flex flex-col items-center">
      <!-- Loader Spinner -->
      <div 
        class="w-[50px] h-[50px] rounded-full border-4 border-indigo-400 border-t-transparent animate-spin"
      ></div>
      <!-- Loading Text -->
      <p class="pt-4 text-lg font-semibold text-indigo-200">Loading...</p>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        setTimeout(function() {
            window.location.href = "{{ $qrCode->qrurl }}"; // Redirect to the final page
        }, 2000); // Wait for 2 seconds before redirecting
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
