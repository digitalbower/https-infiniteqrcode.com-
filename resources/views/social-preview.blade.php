<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Media Preview</title>
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

    /* Hide scrollbar */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
  </style>
</head>
<body class="bg-gray-700 flex justify-center items-center min-h-screen font-poppins">

  <!-- Animation Background -->
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden ">
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
  <div class="w-full absolute h-full text-white flex justify-center items-center">
      <div class="w-full relative mt-12 max-w-md">
   
        <div class="absolute -top-6 left-1/2 -translate-x-1/2 transform">
            <div class="bg-[#FF8A7B] text-black px-6 py-2 rounded shadow relative font-serif">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                </div>
                Follow Me
            </div>
        </div>
        <div class="pt-10 text-center">
            <h2 class="text-white text-center font-bold text-xl sm:text-xl font-serif tracking-wider">
                FOLLOW ME ON SOCIAL MEDIA
            </h2>
        </div>
        <div class="p-6 flex justify-center items-center">
            @if($qrCode->fburl)
            <button id="facebook"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-facebook-f w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->fbtext}}</p>
            </button>
            @elseif($qrCode->yturl)
            <button id="youtube"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-youtube w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->ybtext}}</p>
            </button>
            @elseif($qrCode->whurl)
            <button id="whatsapp"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-whatsapp w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->whtext}}</p>
            </button>
            @elseif($qrCode->insurl)
            <button id="instagram"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-instagram w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->instext}}</p>
            </button>
            @elseif($qrCode->wchurl)
            <button id="wechat"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-weixin w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->wchtext}}</p>
            </button>
            @elseif($qrCode->tikurl)
            <button id="ticktock"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-tiktok w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->tiktext}}</p>
            </button>
            @elseif($qrCode->dyurl)
            <button id="douyin"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-snapchat-ghost w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->dytext}}</p>
            </button>
            @elseif($qrCode->telurl)
            <button id="telegram"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-telegram-plane w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->teltext}}</p>
            </button>
            @elseif($qrCode->snpurl)
            <button id="snapchat"
                class="w-full max-w-xs bg-white hover:bg-gray-100 text-gray-600 rounded-md font-serif flex items-center gap-2 justify-center px-4 py-2">
                <i class="fab fa-snapchat-ghost w-5 h-5"></i>
                <p class="text-sm">{{$qrCode->snptext}}</p>
            </button>
            @endif
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
     $(document).ready(function () {
        $("#facebook").on("click", function () {
            let fburl = @json($qrCode->fburl);
            window.location.href =fburl;
        });
        $("#youtube").on("click", function () {
            let yturl = @json($qrCode->yturl);
            window.location.href =yturl;
        });
        $("#whatsapp").on("click", function () {
            let whurl = @json($qrCode->whurl);
            window.location.href =whurl;
        });
        $("#instagram").on("click", function () {
            let insurl = @json($qrCode->insurl);
            window.location.href =insurl;
        });
        $("#wechat").on("click", function () {
            let wchurl = @json($qrCode->wchurl);
            window.location.href =wchurl;
        });
        $("#ticktock").on("click", function () {
            let tikurl = @json($qrCode->tikurl);
            window.location.href =tikurl;
        });
        $("#douyin").on("click", function () {
            let dyurl = @json($qrCode->dyurl);
            window.location.href =dyurl;
        });
        $("#telegram").on("click", function () {
            let telurl = @json($qrCode->telurl);
            window.location.href =telurl;
        });
        $("#snapchat").on("click", function () {
            let snpurl = @json($qrCode->snpurl);
            window.location.href =snpurl;
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