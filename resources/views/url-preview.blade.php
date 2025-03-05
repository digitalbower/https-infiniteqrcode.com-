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
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
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
    let city = "Unknown";
    let country = "Unknown";
    let fingerprint = "Unknown";
  
    // Get fingerprint first
    (async () => {
      const fp = await FingerprintJS.load();
      const result = await fp.get();
      fingerprint = result.visitorId; // Unique fingerprint
    })();
  
    // Geolocation logic
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        async (position) => {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;
  
          try {
            const cityCountry = await getCityCountry(latitude, longitude);
            city = cityCountry?.city || "Unknown";
            country = cityCountry?.country || "Unknown";
          } catch (error) {
            console.error("Geolocation fetch error:", error);
          }
          sendDataToPHP(city, country, fingerprint); // Send data once everything is set
        },
        (error) => {
          console.error("Geolocation error:", error);
          sendDataToPHP(city, country, fingerprint); // Even if geolocation fails, send fingerprint
        }
      );
    } else {
      console.error("Geolocation not supported by this browser.");
      sendDataToPHP(city, country, fingerprint);
    }
  
    // Geocode city and country using Google Maps API
    async function getCityCountry(lat, lng) {
      const geocoder = new google.maps.Geocoder();
      const location = { lat, lng };
  
      return new Promise((resolve, reject) => {
        geocoder.geocode({ location }, (results, status) => {
          if (status === "OK" && results[0]) {
            let city = null,
              country = null;
            results[0].address_components.forEach((component) => {
              if (
                component.types.includes("locality") ||
                component.types.includes("administrative_area_level_1")
              ) {
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
  
    // Send data to Laravel
    async function sendDataToPHP(city, country, fingerprint) {
      try {
        const response = await $.ajax({
          url: "{{route('country-statistics')}}",
          method: "POST",
          data: {
            code: "{{$qrCode->code}}",
            city: city,
            country: country,
            fingerprint: fingerprint,
            "_token": "{{ csrf_token() }}",
            ip: "{{ request()->ip() }}",
            session_id: "{{ session()->getId() }}",
          },
        });
        console.log("Data sent:", response);
      } catch (error) {
        console.error("Error sending data to PHP:", error);
      }
    }
  });
   </script>
    
</body>
</html>
