<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Preview</title>
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
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-[#ddd1ca]">
    <!-- Animated Circles -->
    <div class="absolute bottom-[-100px] w-10 h-10 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 10%; animation-duration: 8s;"></div>
    <div class="absolute bottom-[-100px] w-5 h-5 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 20%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-12 h-12 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 35%; animation-duration: 7s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-20 h-20 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 50%; animation-duration: 11s;"></div>
    <div class="absolute bottom-[-100px] w-9 h-9 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 55%; animation-duration: 6s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-11 h-11 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 65%; animation-duration: 8s; animation-delay: 3s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 70%; animation-duration: 12s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-6 h-6 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 80%; animation-duration: 6s; animation-delay: 2s;"></div>
    <div class="absolute bottom-[-100px] w-4 h-4 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 70%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 25%; animation-duration: 10s; animation-delay: 4s;"></div>
  </section>

  <!-- Form Card -->
  <div class="relative z-10 w-full max-w-xl p-6 bg-white rounded-lg shadow-xl">
    <!-- Form Header -->
    <h2 class="text-xl font-semibold text-gray-700 text-center">Message Details</h2>
    <!-- Recipient Details -->
    <div class="mt-4 space-y-3">
      <div class="flex items-center">
        <span class="text-sm font-medium text-gray-600">To:</span>
        <span class="ml-2 text-sm bg-gray-100 px-3 py-1 rounded-md" id="pemail">{{$qrCode->email}}</span>
      </div>
      <div class="flex items-center border-t border-b py-2">
        <span class="text-sm font-medium text-gray-600">Subject:</span>
        <span class="ml-2 text-sm font-medium text-gray-700" id="psubject">{{$qrCode->subject}}</span>
      </div>
    </div>

    <!-- Message Body -->
    <div class="mt-4 text-sm text-gray-700">
      <p class="mt-2 text-gray-600" id="pmessage">{{$qrCode->message}}
      </p>
    </div>

    <!-- Send Button -->
    <button id="sendEmail" class="mt-6 w-full bg-[#d3a58a] text-white py-2 rounded-md shadow-md hover:bg-blue-500 hover:shadow-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300">
      SEND
    </button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
          $('#sendEmail').click(function () {
                let email = $("#pemail").text();
                let subject = encodeURIComponent($("#psubject").text());
                let message = encodeURIComponent($("#pmessage").text());

                let mailtoLink = `mailto:${email}?subject=${subject}&body=${message}`;
                window.location.href = mailtoLink; // Opens email app
            });
     });
    
   </script> 
 <script>
  $(document).ready(function() {
    let city = "Unknown";
    let country = "Unknown";
    let fingerprint = "Unknown";
    
    // Initialize fingerprint
    (async () => {
      const fp = await FingerprintJS.load();
      const result = await fp.get();
      fingerprint = result.visitorId;

      // Trigger geolocation after fingerprint
      getLocation();
    })();

    // Get user's location
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          async (position) => {
            const { latitude, longitude, accuracy } = position.coords;
            console.log("Latitude:", latitude, "Longitude:", longitude, "Accuracy:", accuracy);

            try {
              const cityCountry = await getCityCountry(latitude, longitude);
              city = cityCountry?.city || "Unknown";
              country = cityCountry?.country || "Unknown";
            } catch (error) {
              console.error("Error fetching city/country:", error);
            }
            sendDataToPHP(city, country, fingerprint);
          },
          (error) => {
            console.error("Geolocation error:", error.message);
            sendDataToPHP(city, country, fingerprint); // Still send fingerprint even without location
          },
          {
            enableHighAccuracy: true, // Use GPS for better accuracy
            timeout: 15000, // Wait up to 15 seconds
            maximumAge: 0 // Force fresh data, avoid cache
          }
        );
      } else {
        console.error("Geolocation not supported by this browser.");
        sendDataToPHP(city, country, fingerprint);
      }
    }

    // Google Maps reverse geocoding (lat, lng -> city, country)
    async function getCityCountry(lat, lng) {
      const geocoder = new google.maps.Geocoder();
      const location = { lat, lng };

      return new Promise((resolve, reject) => {
        geocoder.geocode({ location }, (results, status) => {
          console.log("Geocoder response:", results, "Status:", status);
          if (status === "OK" && results[0]) {
            let city = "Unknown";
            let country = "Unknown";

            results[0].address_components.forEach((component) => {
              if (component.types.includes("locality") || component.types.includes("administrative_area_level_1")) {
                city = component.long_name;
              }
              if (component.types.includes("country")) {
                country = component.long_name;
              }
            });

            resolve({ city, country });
          } else {
            reject("Geocode failed: " + status);
          }
        });
      });
    }

    // Send data to Laravel backend
    async function sendDataToPHP(city, country, fingerprint) {
      try {
        const response = await $.ajax({
          url: "{{ route('country-statistics') }}",
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
        console.log("Data sent to Laravel:", response);
      } catch (error) {
        console.error("Failed to send data:", error);
      }
    }
  });
</script>
</body>

</html>