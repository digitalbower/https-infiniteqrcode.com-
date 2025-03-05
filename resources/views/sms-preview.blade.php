<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMS Preview</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="{{asset('images/indexfav.png')}}" type="image/x-icon">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4A90E2',
            secondary: '#50E3C2',
            accent: '#F5A623',
            background: '#1F2937',
            card: '#374151',
          },
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
          },
        }
      }
    }
  </script>
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
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-[#ddd1ca]">
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
   <div class="w-full p-4 absolute h-full text-white overflow-hidden flex justify-center items-center">
    <!-- SMS Box -->
    <div class="border w-full relative max-w-xl h-auto min-h-[400px] max-h-[400px] pt-3 mt-10 text-card-foreground shadow-sm bg-white rounded-3xl"
      data-v0-t="card">
      <div class="p-4">
        <div class="flex flex-col gap-4">
          <!-- Recipient Information -->
          <div class="flex items-center gap-2">
            <span class="text-neutral-600">To:</span>
            <span class="bg-[#e8e0d9] text-[#8b7b71] px-4 py-1 rounded-full text-sm mobile1">{{$qrCode->countrycode}}{{$qrCode->phonenumber}}</span>
          </div>
          <hr class="bg-[#d3a58as]"/>
          <!-- Message Content -->
          <p class="text-neutral-800 text-base leading-relaxed smsarea">
            {{$qrCode->qrsms}}
          </p>
        </div>
      </div>
      <!-- Action Button -->
      <div class="mt-4 flex justify-center bottom-4 absolute w-full px-4 text-center ">
        <a id="smsLink" href="#" target="_blank" class="bg-[#d3a58a] w-full text-white  text-center flex justify-center text-sm px-4 py-2 rounded-lg flex items-center" >
          SEND
        </a>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
    $(document).ready(function() {
        const phone = $(".mobile1").text().trim(); // Ensure there’s no extra whitespace
        const message = $(".smsarea").text().trim(); // Same for the message

        if (phone && message) {
            // Properly encode the phone number and message
            const smsLink = `sms:${encodeURIComponent(phone)}?body=${encodeURIComponent(message)}`;
            console.log(smsLink); // For debugging
            $('#smsLink').attr('href', smsLink);
        }
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