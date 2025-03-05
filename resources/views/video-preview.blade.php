<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Preview</title>
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
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-gray-700">
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
    <div class="relative w-full max-w-4xl bg-gray-800 rounded-xl overflow-hidden shadow-xl">

      <!-- Timer -->
      <div class="absolute top-0 right-0 p-4 text-gray-200 bg-black bg-opacity-40 rounded-l-lg text-sm font-medium">
        <span id="timer">00:00</span>
      </div>
  
      <!-- Video Container -->
      <div class="relative w-full h-[60vh] bg-gray-700 flex justify-center items-center">
        {{-- <video class="w-full h-full object-cover rounded-xl" id="videoPlayer" src="your-video.mp4" controls></video> --}}
        <video id="videoPlayer" controls
          class="w-full h-full object-cover rounded-xl">
          <source id="video-source"
          src="{{ Storage::disk('public')->exists($qrCode->videopath) ? asset('storage/'.$qrCode->videopath) : 'https://videos.pexels.com/video-files/3209663/3209663-uhd_2560_1440_25fps.mp4' }}">
          Your browser does not support the video tag.
        </video>
        
        
        <!-- Play Button (Center) -->
        <button id="playPauseBtn" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 hover:bg-green-600 p-5 rounded-full text-white transition-all duration-300 shadow-lg focus:outline-none">
          <i class="fas fa-play text-3xl"></i>
        </button>
      </div>
  
      <!-- Bottom Playback Controls (Backward, Play/Pause, Forward, Share) -->
      <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-6 px-6 text-white">
        <button class="p-4 rounded-full hover:bg-gray-700 transition-all duration-300">
          <i class="fas fa-backward"></i>
        </button>
        <button id="playPauseBtnBottom" class="p-4 rounded-full hover:bg-gray-700 transition-all duration-300">
          <i class="fas fa-play text-xl"></i>
        </button>
        <button class="p-4 rounded-full hover:bg-gray-700 transition-all duration-300">
          <i class="fas fa-forward"></i>
        </button>
        <button class="p-4 rounded-full hover:bg-gray-700 transition-all duration-300">
          <i class="fas fa-share-alt"></i>
        </button>
      </div>
  
    </div>
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      // Play/Pause functionality
      const playPauseBtn = document.getElementById('playPauseBtn');
      const playPauseBtnBottom = document.getElementById('playPauseBtnBottom');
      const videoPlayer = document.getElementById('videoPlayer');
  
      playPauseBtn.addEventListener('click', togglePlayPause);
      playPauseBtnBottom.addEventListener('click', togglePlayPause);
  
      function togglePlayPause() {
        if (videoPlayer.paused) {
          videoPlayer.play();
          playPauseBtn.innerHTML = '<i class="fas fa-pause text-3xl"></i>';
          playPauseBtnBottom.innerHTML = '<i class="fas fa-pause text-xl"></i>';
        } else {
          videoPlayer.pause();
          playPauseBtn.innerHTML = '<i class="fas fa-play text-3xl"></i>';
          playPauseBtnBottom.innerHTML = '<i class="fas fa-play text-xl"></i>';
        }
      }
  
      // Timer functionality
     
    </script>
  </div>
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

     
