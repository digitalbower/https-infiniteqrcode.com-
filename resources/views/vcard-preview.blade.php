<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vcard Preview</title>
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
  <div class="w-full p-4 absolute h-full text-white flex justify-center items-center">
    <div class="w-full max-w-md  border-0  pb-10 ">
      <div class="relative">
        <!-- Background Shape -->
        <div class="absolute inset-0">
          <div class="w-3/4 h-48 bg-[#008B9E] rounded-r-full"></div>
          <!-- Dots Pattern -->
          <div class="absolute top-0 right-0 w-24 h-24 opacity-50">
            <div class="grid grid-cols-4 gap-4">
              <div class="w-1.5 h-1.5 bg-[#008B9E]/40 rounded-full"></div>
              <div class="w-1.5 h-1.5 bg-[#008B9E]/40 rounded-full"></div>
              <div class="w-1.5 h-1.5 bg-[#008B9E]/40 rounded-full"></div>
              <div class="w-1.5 h-1.5 bg-[#008B9E]/40 rounded-full"></div>
            </div>
          </div>
        </div>
  
        <!-- Profile Image -->
        <div class="relative flex justify-center py-8">
          <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden">
            <img src="{{ $qrCode->contactimg && Storage::disk('public')->exists($qrCode->contactimg) ? asset('storage/'.$qrCode->contactimg) : asset('images/download.jpeg') }}" alt="Profile" class="w-full h-full object-cover">
          </div>
        </div>
      </div>
   
      <!-- Name and Title -->
      <div class="text-center space-y-1 mb-2 mt-1">
        <h1 class="text-[#FFB95C] text-2xl font-bold tracking-wider font-poppins">{{ strtoupper($qrCode->first_name . ' ' . $qrCode->last_name) }}</h1>
        <p class="text-white text-sm tracking-widest font-light font-poppins">{{$qrCode->company}}</p>
      </div>
  
      <!-- Contact Form -->
      <div class="grid grid-cols-2 gap-x-8 gap-y-4 px-4 pb-4">
        <!-- First Name -->
        <div class="flex flex-col">
          <label for="first_name" class="text-sm text-white mb-1">First Name</label>
          <input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{$qrCode->first_name}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Last Name -->
        <div class="flex flex-col">
          <label for="last_name" class="text-sm text-white mb-1">Last Name</label>
          <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{$qrCode->last_name}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Phone Number -->
        <div class="flex flex-col">
          <label for="mobile" class="text-sm text-white mb-1">Phone Number</label>
          <input type="tel" id="mobile" name="mobile" placeholder="Phone Number" value="{{$qrCode->mobile}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Email -->
        <div class="flex flex-col">
          <label for="email" class="text-sm text-white mb-1">Email</label>
          <input type="email" id="email" name="email" placeholder="Email" value="{{$qrCode->email}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Company -->
        <div class="flex flex-col">
          <label for="company" class="text-sm text-white mb-1">Company</label>
          <input type="text" id="company" name="company" placeholder="Company" value="{{$qrCode->company}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Address -->
        <div class="flex flex-col">
          <label for="street" class="text-sm text-white mb-1">Address</label>
          <input type="text" id="street" name="street" placeholder="Address" value="{{$qrCode->street}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Website -->
        <div class="flex flex-col">
          <label for="website" class="text-sm text-white mb-1">Website</label>
          <input type="url" id="website" name="website" placeholder="Website" value="{{$qrCode->website}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- City -->
        <div class="flex flex-col">
          <label for="city" class="text-sm text-white mb-1">City</label>
          <input type="text" id="city" name="city" placeholder="City" value="{{$qrCode->city}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- State -->
        <div class="flex flex-col">
          <label for="state" class="text-sm text-white mb-1">State</label>
          <input type="text" id="state" name="state" placeholder="State" value="{{$qrCode->state}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- ZIP Code -->
        <div class="flex flex-col">
          <label for="zip" class="text-sm text-white mb-1">ZIP Code</label>
          <input type="text" id="zip" name="zip" placeholder="ZIP Code" value="{{$qrCode->zip}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      
        <!-- Country -->
        <div class="flex flex-col">
          <label for="country" class="text-sm text-white mb-1">Country</label>
          <input type="text" id="country" name="country" placeholder="Country" value="{{$qrCode->country}}"
            class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm lg:text-base rounded-md px-2">
        </div>
      </div>
      <button id="add-contact"
      class="w-full bg-[#FFB95C] hover:bg-[#FFB95C]/90 text-zinc-900 font-semibold text-base h-10 rounded-md mt-2">
      Add to contact
    </button>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $("#add-contact").on("click", function () {
            window.location.href = "{{route('download-vcard',$qrCode->code)}}";
        });
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

     

 
