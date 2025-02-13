<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitcoin Preview </title>
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
  <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-white">
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
    <div class="absolute bottom-[-100px] w-4 h-4 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 70%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 25%; animation-duration: 10s; animation-delay: 4s;"></div>
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
    <div class="absolute bottom-[-100px] w-4 h-4 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 70%; animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute bottom-[-100px] w-24 h-24 bg-gray-200 rounded-full opacity-50 animate-rise"
      style="left: 25%; animation-duration: 10s; animation-delay: 4s;"></div>
  </section>

  <!-- Form Card -->
  <div class="w-full p-4 absolute h-full text-white overflow-hidden flex justify-center items-center">
    <!-- SMS Box -->
    <div class="bg-card text-card-foreground shadow-sm w-full max-w-md border-2 border-[#B8A88A] rounded-[32px]" data-v0-t="card">
        <div class="flex flex-col p-6 space-y-6">
            <h3 class="tracking-tight text-4xl font-normal text-center text-[#696969]">CRYPTO</h3>
            <div class="h-px bg-[#B8A88A]"></div>
        </div>
        <div class="p-6 pt-0 space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#696969]">CURRENCY</label>
                <input id="currency" class="flex w-full border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-[#B8A88A] rounded-full h-12 text-black" readonly="" value="{{$qrCode->currency}}">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#696969]">QUANTITY</label>
                <input id="quantity" class="flex w-full border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-[#B8A88A] rounded-full h-12 text-black" value="{{$qrCode->quantity}}">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#696969]">RECEIVER ADDRESS</label>
                <div class="relative">
                    <input id="address" class="flex w-full border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-[#B8A88A] rounded-full h-12 pr-10 text-black" value="{{$qrCode->btcaddr}}">
                    <button id="addressbtn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:text-accent-foreground h-10 w-10 absolute right-2 top-1/2 -translate-y-1/2 hover:bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy h-5 w-5 text-[#B8A88A]">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                        </svg><span class="sr-only">Copy address</span>
                    </button>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#696969]">NETWORK</label>
                <input id="network" class="flex w-full border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-[#B8A88A] rounded-full h-12 text-black" readonly="" value="{{$qrCode->btcnetwrk}}">
            </div>
            <button id="download" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 px-4 py-2 w-full rounded-full h-12 mt-8 bg-white hover:bg-gray-100 text-black border border-[#B8A88A]">DOWNLOAD</button>
        </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARhjyvEiWO7IGFHvXP_0g7fQiyTEELJI0"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $("#download").click(function () {
                let address = $("#address").val();
                let quantity = $("#quantity").val();
                let network = $("#network").val();
                
                // Construct Bitcoin URI format
                let btcText = `BTC Address: ${address}\r\nBTC Quantity: ${quantity}\r\nBTC Network: ${network}`;

                // Copy to clipboard
                navigator.clipboard.writeText(btcText).then(function () {
                    alert("Copied to clipboard");
                }).catch(function (error) {
                    console.error("Failed to copy:", err);
                });
            });
            $("#addressbtn").click(function () {
                let address = $("#address").val();
                // Construct Bitcoin URI format
                let btcText = `BTC Address: ${address}\r\n`;

                // Copy to clipboard
                navigator.clipboard.writeText(btcText).then(function () {
                    alert("Copied to clipboard");
                }).catch(function (error) {
                    console.error("Failed to copy:", err);
                });
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
