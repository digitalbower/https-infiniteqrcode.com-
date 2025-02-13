<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App Preview</title>
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
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-gray-800">
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
    <div class="w-full h-full px-0">
      <div class="relative h-full  overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 md:w-32 md:h-32">
          <div class="w-full h-full bg-[#E5855E] rounded-bl-[100%]"></div>
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center  px-4 py-12">
          <h1 class="text-xl md:text-2xl font-bold text-white text-center mb-5">DOWNLOAD<br>OUR APP NOW
          </h1>
          <div class="flex flex-col gap-4 w-full max-w-md mx-auto">
            <!-- iOS Button -->
            @if($qrCode->appurl)
            <button id="ios" class="flex items-center justify-center gap-3 bg-white text-black rounded-full px-6 py-3 w-full">
              <div class="w-8 h-8 flex items-center justify-center">
                <svg viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor">
                  <path
                    d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z">
                  </path>
                </svg>
              </div>
              <div class="flex flex-col items-start">
                <span class="text-xs">Download on the</span>
                <span class="text-sm font-semibold">App Store</span>
              </div>
            </button>
            @elseif($qrCode->playstoreurl)
            <!-- Android Button -->
            <button id="android" class="flex items-center justify-center gap-3 bg-white text-black rounded-full px-6 py-3 w-full">
              <div class="w-8 h-8 flex items-center justify-center">
                <svg viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor">
                  <path
                    d="M12 2C10.95 2 10 2.95 10 4H14C14 2.95 13.05 2 12 2M7.34 4.16L5.76 2.59L4.59 3.76L6.16 5.34C6.6 5.12 7.05 4.94 7.5 4.82V4.16M16.5 4.82C16.95 4.94 17.4 5.12 17.84 5.34L19.41 3.76L18.24 2.59L16.66 4.16V4.82M18 10V19C18 20.1 17.1 21 16 21H8C6.9 21 6 20.1 6 19V10H18M15.5 12.5C15.5 11.67 14.83 11 14 11C13.17 11 12.5 11.67 12.5 12.5C12.5 13.33 13.17 14 14 14C14.83 14 15.5 13.33 15.5 12.5M9.5 12.5C9.5 11.67 8.83 11 8 11C7.17 11 6.5 11.67 6.5 12.5C6.5 13.33 7.17 14 8 14C8.83 14 9.5 13.33 9.5 12.5Z">
                  </path>
                </svg>
              </div>
              <div class="flex flex-col items-start">
                <span class="text-xs">Get it on</span>
                <span class="text-sm font-semibold">Google Play</span>
              </div>
            </button>
            @elseif($qrCode->windowsurl)
            <!-- Windows Button -->
            <button id="windows" class="flex items-center justify-center gap-3 bg-white text-black rounded-full px-6 py-3 w-full">
              <div class="w-8 h-8 flex items-center justify-center">
                <svg viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor">
                  <path d="M2,3V21L10,19V5M22,5V19H12V5"></path>
                </svg>
              </div>
              <div class="flex flex-col items-start">
                <span class="text-xs">Download for</span>
                <span class="text-sm font-semibold">Windows</span>
              </div>
            </button>
            @elseif($qrCode->Huawei)
            <!-- Huawei Button -->
            <button id="huawei" class="flex items-center justify-center gap-3 bg-white text-black rounded-full px-6 py-3 w-full">
              <div class="w-8 h-8 flex items-center justify-center">
                <svg viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor">
                  <path
                    d="M12,2A10,10 0 1,1 2,12A10,10 0 0,1 12,2M9,12A3,3 0 1,0 12,9A3,3 0 0,0 9,12M15,12A3,3 0 1,0 18,9A3,3 0 0,0 15,12Z">
                  </path>
                </svg>
              </div>
              <div class="flex flex-col items-start">
                <span class="text-xs">Available on</span>
                <span class="text-sm font-semibold">Huawei AppGallery</span>
              </div>
            </button>
            @endif
          </div>
  
          <div class="absolute bottom-4 left-1/2 -translate-x-1/2">
            <p class="text-white text-sm pt-4">infiniteqrcode.com</p>
          </div>
        </div>
        <div class="absolute bottom-0 left-0 w-32 h-32 md:w-32 md:h-32">
          <div class="w-full h-full bg-[#E5855E] rounded-tr-[100%]"></div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
     $(document).ready(function () {
        $("#ios").on("click", function () {
            let appUrl = @json($qrCode->appurl);
            window.location.href =appUrl;
        });
        $("#android").on("click", function () {
            let andriodUrl = @json($qrCode->playstoreurl);
            window.location.href = andriodUrl;
        });
        $("#windows").on("click", function () {
            let windowUrl = @json($qrCode->windowsurl);
            window.location.href = windowUrl;
        });
        $("#huawei").on("click", function () {
            let huaweiUrl = @json($qrCode->Huawei);
            window.location.href = huaweiUrl;
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

     

  