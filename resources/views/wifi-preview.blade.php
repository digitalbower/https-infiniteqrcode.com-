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
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#connect').click(function () {
        const ssid = $("#ssid").val();
        const password = $("#password").val();
        const encryption = $("#encryption").val() || "WPA2";
        let wifiDetails = `SSID: ${ssid}\nPassword: ${password || "No Password"}\nSecurity: ${encryption}`;
        const os = getOS();

        if (os === 'Windows') {
            // Windows batch file
            let batFile = `
              @echo off
              echo Creating WiFi profile for SSID: ${ssid}
              (
              echo ^<WLANProfile xmlns="http://www.microsoft.com/networking/WLAN/profile/v1"^>
              echo   ^<name^>${ssid}^</name^>
              echo   ^<SSIDConfig^>
              echo     ^<SSID^>
              echo       ^<name^>${ssid}^</name^>
              echo     ^</SSID^>
              echo   ^</SSIDConfig^>
              echo   ^<connectionType^>ESS^</connectionType^>
              echo   ^<connectionMode^>auto^</connectionMode^>
              echo   ^<MSM^>
              echo     ^<security^>
              echo       ^<authEncryption^>
              echo         ^<authentication^>WPA2PSK^</authentication^>
              echo         ^<encryption^>AES^</encryption^>
              echo         ^<useOneX^>false^</useOneX^>
              echo       ^</authEncryption^>
              echo       ^<sharedKey^>
              echo         ^<keyType^>passPhrase^</keyType^>
              echo         ^<protected^>false^</protected^>
              echo         ^<keyMaterial^>${password}^</keyMaterial^>
              echo       ^</sharedKey^>
              echo     ^</security^>
              echo   ^</MSM^>
              echo ^</WLANProfile^>
              ) > WiFi_Profile.xml

              netsh wlan add profile filename="WiFi_Profile.xml"
              netsh wlan connect name="${ssid}"
              pause
              `;

            let blob = new Blob([batFile], { type: "text/plain" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Connect_WiFi.bat";
            link.click();
        } else if (os === 'Mac') {
          // Mac WiFi config
          let mobileConfig = `<?xml version="1.0" encoding="UTF-8"?>
          <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
          <plist version="1.0">
              <dict>
                  <key>PayloadContent</key>
                  <array>
                      <dict>
                          <key>SSID_STR</key>
                          <string>${ssid}</string>
                          <key>HIDDEN_NETWORK</key>
                          <false/>
                          <key>AutoJoin</key>
                          <true/>
                          <key>EncryptionType</key>
                          <string>${encryption}</string>
                          <key>Password</key>
                          <string>${password}</string>
                          <key>PayloadType</key>
                          <string>com.apple.wifi.managed</string>
                          <key>PayloadVersion</key>
                          <integer>1</integer>
                          <key>PayloadIdentifier</key>
                          <string>com.example.wifi.${ssid}</string>
                          <key>PayloadUUID</key>
                          <string>${crypto.randomUUID()}</string>
                          <key>PayloadDisplayName</key>
                          <string>${ssid} WiFi Configuration</string>
                          <key>PayloadOrganization</key>
                          <string>Your Organization</string>
                      </dict>
                  </array>
                  <key>PayloadType</key>
                  <string>Configuration</string>
                  <key>PayloadVersion</key>
                  <integer>1</integer>
                  <key>PayloadIdentifier</key>
                  <string>com.example.wifi.${ssid}.root</string>
                  <key>PayloadUUID</key>
                  <string>${crypto.randomUUID()}</string>
                  <key>PayloadDisplayName</key>
                  <string>${ssid} WiFi Profile</string>
                  <key>PayloadOrganization</key>
                  <string>Your Organization</string>
              </dict>
          </plist>`;

          let blob = new Blob([mobileConfig], { type: "application/x-apple-aspen-config" });
          let link = document.createElement("a");
          link.href = URL.createObjectURL(blob);
          link.download = `${ssid}_WiFi_Config.mobileconfig`;
          link.click();
        } else if (os === "Android") {
          // Try to use the Android intent to trigger WiFi connection
          window.location.href = `wifi://${ssid}?password=${password}&encryption=${encryption}`;
          let blob = new Blob([wifiDetails], { type: "text/plain" });
          let link = document.createElement("a");
          link.href = URL.createObjectURL(blob);
          link.download = "WiFi_Credentials.txt";
          link.click();
          alert(`Please check your WiFi settings and connect to "${ssid}". and paste the password manually, the password is in the downloded file`);
        } else if (os === "iOS") {
          let mobileConfig = `<?xml version="1.0" encoding="UTF-8"?>
          <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
            <plist version="1.0">
                <dict>
                    <key>PayloadContent</key>
                    <array>
                        <dict>
                            <key>SSID_STR</key>
                            <string>${ssid}</string>
                            <key>HIDDEN_NETWORK</key>
                            <false/>
                            <key>AutoJoin</key>
                            <true/>
                            <key>EncryptionType</key>
                            <string>${encryption}</string>
                            <key>Password</key>
                            <string>${password}</string>
                            <key>PayloadType</key>
                            <string>com.apple.wifi.managed</string>
                            <key>PayloadVersion</key>
                            <integer>1</integer>
                            <key>PayloadIdentifier</key>
                            <string>com.example.wifi.${ssid}</string>
                            <key>PayloadUUID</key>
                            <string>${crypto.randomUUID()}</string>
                            <key>PayloadDisplayName</key>
                            <string>${ssid} WiFi Configuration</string>
                        </dict>
                    </array>
                    <key>PayloadType</key>
                    <string>Configuration</string>
                    <key>PayloadVersion</key>
                    <integer>1</integer>
                    <key>PayloadIdentifier</key>
                    <string>com.example.wifi.${ssid}.root</string>
                    <key>PayloadUUID</key>
                    <string>${crypto.randomUUID()}</string>
                    <key>PayloadDisplayName</key>
                    <string>${ssid} WiFi Profile</string>
                    <key>PayloadOrganization</key>
                    <string>Your Organization</string>
                </dict>
            </plist>`;

          let blob = new Blob([mobileConfig], { type: "application/x-apple-aspen-config" });
          let link = document.createElement("a");
          link.href = URL.createObjectURL(blob);
          link.download = `${ssid}_WiFi_Config.mobileconfig`;
          link.click();
        }
        else {
              alert("Unsupported OS. Please manually connect to the WiFi.");
        }
       
    });
  });

    function getOS() {
        const userAgent = window.navigator.userAgent || window.navigator.vendor || window.opera;

        if (/windows phone/i.test(userAgent)) {
            return "Windows";
        }
        if (/android/i.test(userAgent)) {
            return "Android";
        }
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }
        if (/Macintosh|Mac OS X/.test(userAgent)) {
            return "Mac";
        }
        if (/Windows NT/.test(userAgent)) {
            return "Windows";
        }
        return "Unknown";
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