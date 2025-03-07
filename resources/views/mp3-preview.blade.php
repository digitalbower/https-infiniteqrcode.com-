<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mp3 Preview</title>
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
  <div class="w-full p-4 absolute h-full text-white flex justify-center items-center">
    <div class="w-full max-w-md text-white p-6 h-screen lg:py-20">
      <!-- Vinyl Record -->
      <div class="relative w-48 h-48 mx-auto">
        <div class="absolute inset-0 rounded-full border-2 border-white">
          <div class="absolute inset-2 rounded-full bg-zinc-800">
            <div class="absolute inset-[40%] rounded-full bg-red-500"></div>
          </div>
        </div>
      </div>

      <!-- Song Info -->
      <div class="text-center space-y-1 mt-5">
        <h2 class="text-lg font-medium">{{$qrCode->qrtext}}</h2>
       
      </div>
      <div id="audio-container" class="mt-6 hidden">
        <audio id="audio-player" class="w-full rounded-lg">
            <source id="audioSource" src="{{ asset('storage/'.$qrCode->mp3path)}}">
            Your browser does not support the audio tag.
        </audio>
    </div>
      <!-- Progress Bar -->
      <div class="space-y-2">
        <input id="progress-bar" type="range" class="w-full h-1 bg-zinc-700 rounded-lg appearance-none cursor-pointer" min="0" max="100" value="0">
        <div class="flex justify-between text-gray-400 text-sm mt-2">
        <span id="current-time">00:00</span>
        <span id="duration">00:00</span>
    </div>
      </div>

      <!-- Controls -->
      <div class="flex items-center justify-between mt-4">
      
        <button id="audio-play-button" class="text-zinc-400 hover:text-white">
          <i class="fas fa-play text-xl"></i>
        </button>
        
        <button id="audio-pause-button" class="w-12 h-12 rounded-full border-2 border-white text-white flex items-center justify-center hover:bg-white hover:text-black">
          <i  id="play-button" class="fas fa-play text-xl"></i>
          <i  id="pause-button" class="fas fa-pause text-xl hidden"></i>
        </button>
      
        <button id="audio-reset-button" class="text-zinc-400 hover:text-white">
          <i class="fas fa-sync-alt text-lg"></i>
        </button>
      </div>

      <!-- Volume and Edit -->
      <div class="flex items-center mt-10 justify-between">
        <button id="audio-volume-button" class="text-zinc-400 hover:text-white">
          <i class="fas fa-volume-up text-lg"></i>
          <input type="range" id="volumeControl"  min="0" max="100" value="50">
        </button>
        <button class="text-zinc-400 hover:text-white">
          <i class="fas fa-pen text-lg"></i>
        </button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
    // Get references to the elements
    const audioPlayButton = document.getElementById('audio-play-button');
    const audioPauseButton = document.getElementById('audio-pause-button');
    const audioResetButton = document.getElementById('audio-reset-button');
    const audioVolumebutton = document.getElementById('audio-volume-button');
    const audioPlayer = document.getElementById('audio-player');
    const audioContainer = document.getElementById('audio-container');
    const playButton = document.getElementById('play-button');
    const pauseButton = document.getElementById('pause-button');
    const volume = document.getElementById('volume');
    let volumeControl = document.getElementById("volumeControl");
    const progressBar = document.getElementById('progress-bar');
    const currentTimeElement = document.getElementById('current-time');
    const durationElement = document.getElementById('duration');
    audioPlayer.volume = 0.5;
    volumeControl.value = 50; 
    // Play audio
    audioPlayButton.addEventListener('click', () => {
      audioContainer.classList.remove('hidden');
      audioPlayer.play();
      playButton.classList.add('hidden');
      pauseButton.classList.remove('hidden');
    });

    // Pause audio
    audioPauseButton.addEventListener('click', () => {
      audioPlayer.pause();
      playButton.classList.remove('hidden');
      pauseButton.classList.add('hidden');
    });

    // Reset audio
    audioResetButton.addEventListener('click', () => {
      audioPlayer.pause();
      audioPlayer.currentTime = 0;
      progressBar.value = 0;
      updateCurrentTime();
    });

    // Update progress bar as audio plays
    audioPlayer.addEventListener('timeupdate', () => {
      const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
      progressBar.value = progress;
      updateCurrentTime();
    });

    // Update duration once audio metadata is loaded
    audioPlayer.addEventListener('loadedmetadata', () => {
      durationElement.textContent = formatTime(audioPlayer.duration);
    });

    // Seek audio when progress bar is changed
    progressBar.addEventListener('input', () => {
      const seekTime = (progressBar.value / 100) * audioPlayer.duration;
      audioPlayer.currentTime = seekTime;
    });
    volumeControl.addEventListener("input", function () {
        let volumeValue = parseFloat(this.value) / 100; // Convert 0-100 to 0-1
        if (!isNaN(volumeValue)) { // Ensure it's a valid number
          audioPlayer.volume = volumeValue;
        }
    });
    // Helper to format time in MM:SS
    function formatTime(seconds) {
      const mins = Math.floor(seconds / 60);
      const secs = Math.floor(seconds % 60);
      return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
      // Update current time display
      function updateCurrentTime() {
      currentTimeElement.textContent = formatTime(audioPlayer.currentTime);
    }
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