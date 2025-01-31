<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
   <script>
    const toggleButton = document.getElementById('toggle-btn');
    const chevronIcon = document.getElementById('chevron-icon');

    toggleButton.addEventListener('click', () => {
      // Toggle the rotation class
      chevronIcon.classList.toggle('rotate-180');
      chevronIcon.classList.toggle('rotate-0');
    });
  </script>
  <style>
    .qr-button:hover i{
      color: #fff;
    }
    .qr-button:hover span{
      color: #fff;
    }
  </style>
</head>

<body class="bg-background text-white font-sans">

  <div class="flex flex-col h-screen">

    <!-- Header with Hamburger Menu -->
    <header class="bg-gradient-to-b lg:hidden from-[#5f72ab36] bg-opecity-40 to-white text-white p-4 flex justify-between items-center">
     <a href="/">
       <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
     </a>
      <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <!-- Tabs (Visible on Desktop) -->
      <nav class="hidden lg:flex space-x-6">
        <button class="text-white hover:text-primary">Dashboard</button>
      <a href="/Profile.html">  <button class="text-white hover:text-primary">Profile</button></a>
        <button class="text-white hover:text-primary">QR Code Generator</button>
        <button class="text-white hover:text-primary">Yields</button>
      </nav>
    </header>

    <!-- Sidebar (Hidden on Mobile) -->
    <aside id="sidebar" class="fixed overflow-y-auto pb-50 top-0 shad left-0 w-10/12 lg:w-64 h-screen  bg-gradient-to-t from-[#1F2937] from-50% to-white text-white p-4 z-50 transition-all transform -translate-x-full lg:translate-x-0 lg:block">
      <div class="flex justify-between items-center py-2 mb-8">
       <a href="/">
         <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
       </a>
      </div>

      <div class="text-center mb-8">
        <div class="w-16 h-16 mx-auto relative mb-2 rounded-full bg-gray-500">
          <img src="/download.jpeg" alt="User Profile" class="w-full h-full object-cover rounded-full" />
          <i class="fas fa-edit text-white text-2xl ml-2 absolute -bottom-1 -left-3"></i>
        </div>
        <p class="font-semibold">Esther Howard</p>
      </div>

      <nav class="flex-1 px py-6">
        <ul class="space-y-2">
          <!-- Dashboard -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </button>
          </li>

              <!-- QR Code Generator -->
              <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-qrcode mr-3"></i> QR Code Generator
            </button>
          </li>
          <!-- Profile -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-user mr-3"></i> Profile
            </button>
          </li>
      
          <!-- Dropdown Menu -->
          <li class="relative group">
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-qrcode mr-3"></i> Analytics
              
            </button>
           
          </li>


          <li class="relative group">
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-qrcode mr-3"></i> Subscription
              
            </button>
           
          </li>
          
          
      
          
          <!-- Yields -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-chart-line mr-3"></i> MY QR Codes 
            </button>
          </li>
        </ul>
      </nav>

      <ul class="">
        <li class="mx-4 pt-4">
          <button class="bg-[#6c8ef6] flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-[#6c8ef6] transition duration-300">
            <i class="fas fa-arrow-up mr-2"></i> Upgrade
          </button>
        </li>
        <li class="mx-4 pt-4">
          <button class="bg-[#F5A623] flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-[#F5A623] transition duration-300">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </li>
      </ul>
    </aside>

    <!-- Main Content Area -->
   
  
    <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">
      <div class="max-w-7xl mx-auto ">
        <div class="flex-1 w-full  lg:px-12">
          <div class="container text-center mx-auto pt-1 lg:px-12">
            <h1
              class="text-xl md:text-4xl text-center font-extrabold text-center mb-4 md:mb-10 text-white border-[#F5A623] border-b-4 pb-3 inline-block">
              Create Your QR Code
            </h1>
          </div>

          <div class="flex justify-center mb-3 md:mb-8 space-x-4">
            <!-- Step indicators -->
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#F5A623] bg-opacity-90 shadow-md transition duration-300">
              <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
              </svg>
            </div>
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">
              2</div>
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">
              3</div>
          </div>
          <!-- Tabs for Static and Dynamic -->
          <input type="hidden" name="qroption" id="qroption" class="text-gray-600" value="Static">
          <div class="sm:grid grid-cols-12 gap-x-4">
            <div class="lg:col-span-9 sm:col-span-7  ">
              <div class="flex mb-2 pb-2 justify-center md:justify-start">
                <!-- Input field to store the selected option -->
                <!-- Static Tab -->
                <div id="static-toggle"
                  class="tab-button px-4 py-2 cursor-pointer text-white hover:font-semibold transition-all duration-300 focus:outline-none active-tab">
                  <i class="fas fa-cogs"></i>
                  Static
                </div>

                <!-- Dynamic Tab -->
                <div id="dynamic-toggle"
                  class="tab-button px-4 py-2 cursor-pointer text-white hover:font-semibold transition-all duration-300 focus:outline-none">
                  <i class="fas fa-sync-alt"></i>
                  Dynamic
                </div>
              </div>
              <div id="static-content" class="tab-content hfidden p-4 bg-white rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6"
                  id="static-gridContainer">
                  <!-- URL -->
                  <!-- Email -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-envelope text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Email</span>
                  </button>

                  <!-- SMS -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-comment text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">SMS</span>
                  </button>

                  <!-- Wi-Fi -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-wifi text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Wi-Fi</span>
                  </button>

                  <!-- Bitcoin -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-brands fa-bitcoin text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Bitcoin</span>
                  </button>

                  <!-- Twitter 
              <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                <i class="fa-brands fa-twitter text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Twitter</span>
              </button> -->

                  <!-- EPC -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-euro-sign text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">EPC</span>
                  </button> -->

                  <!-- PDF -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-file-pdf text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">PDF</span>
                  </button>

                  <!-- MP3 -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-music text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">MP3</span>
                  </button>

                  <!-- Images -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-image text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Images</span>
                  </button>

                  <!-- Video -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Video</span>
                  </button>

                  <!-- App Stores -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">App Stores</span>
                  </button>

                  <!-- Dynamic URL -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-link-slash text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">URL</span>
                  </button>

                  <!-- Facebook 
              <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                <i class="fa-brands fa-facebook text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Facebook</span>
              </button> -->

                  <!-- vCard Plus -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-address-card text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">vcard</span>
                  </button>


                  <!--Instagram -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-share-nodes text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Social Media</span>
                  </button>

                  <!-- Coupon -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-ticket text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Coupon</span> 
                  </button> -->

                  <!-- Business -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-briefcase text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Business</span>
                  </button> -->

                  <!-- Feedback -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-comments text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Feedback</span>
                  </button> -->

                  <!-- Rating -->
                  <!--  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-star text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Rating</span>
                  </button> -->

                  <!-- Event -->
                  <!--   <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-calendar text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Event</span>
                  </button> -->
                </div>
                <div class="flex justify-between mt-8">
                  <button class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 "
                    disabled>Previous</button>
                  <span id="message"
                    class=" text-red-900 items-center"></span>
                  <button id="nextButton"
                    class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Next</button>
                </div>
              </div>
              <!-- Dynamic Content -->
              <div id="dynamic-content" class="tab-content hidden p-4 bg-white rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6" id="gridContainer">
                  <!-- URL -->
                  <!-- Email -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-envelope text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Email</span>
                  </button>

                  <!-- SMS -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-comment text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">SMS</span>
                  </button>

                  <!-- Wi-Fi -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-wifi text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Wi-Fi</span>
                  </button>

                  <!-- Bitcoin -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-brands fa-bitcoin text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Bitcoin</span>
                  </button>

                  <!-- Twitter 
              <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                <i class="fa-brands fa-twitter text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Twitter</span>
              </button> -->

                  <!-- EPC -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-euro-sign text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">EPC</span>
                  </button> -->

                  <!-- PDF -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-file-pdf text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">PDF</span>
                  </button>

                  <!-- MP3 -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-music text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">MP3</span>
                  </button>

                  <!-- Images -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-image text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Images</span>
                  </button>

                  <!-- Video -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Video</span>
                  </button>

                  <!-- App Stores -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">App Stores</span>
                  </button>

                  <!-- Dynamic URL -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-link-slash text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Dynamic URL</span>
                  </button>

                  <!-- Facebook 
              <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                <i class="fa-brands fa-facebook text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Facebook</span>
              </button> -->
                  <!-- vCard Plus -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-address-card text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">vcard</span>
                  </button>

                  <!--Instagram -->
                  <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-share-nodes text-2xl mb-1 text-gray-700"></i>
                    <br /><span class="text-sm font-semibold text-gray-900">Social Media</span>
                  </button>

                  <!-- Coupon -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-ticket text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Coupon</span>
                  </button> -->



                  <!-- Business -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-briefcase text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Business</span>
                  </button> -->

                  <!-- Feedback -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-comments text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Feedback</span>
                  </button> -->

                  <!-- Rating -->
                  <!-- <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-star text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Rating</span>
                  </button> -->

                  <!-- Event -->
                  <!--   <button class="qr-button p-3 rounded-md hover:bg-[#F5A623] relative">
                    <i class="fa-solid fa-calendar text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Event</span>
                  </button> -->

                </div>
                <div class="flex justify-between mt-8">
                  <button class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 "
                    disabled>Previous</button>
                  <span id="message"
                    class=" text-red-900 items-center"></span>

                  <button id="dnextButton" 
                    class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Next</button>
                </div>
              </div>
            </div>
            <div class="lg:col-span-3 sm:col-span-5 lg:mt-0 mt-10">
              <div class="relative w-full sm:w-72 bg-white rounded-3xl shadow-xl overflow-hidden">
                <div
                  class="bg-gray-800 relative w-full max-w-sm mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
                  <!-- Top Indicator -->
                  <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-700 rounded"></div>

                  <!-- Content -->

                  <div class="max-w-sm absolute h-full bg-gray-700 text-white  rounded-lg shadow-lg overflow-hidden">
                    <!-- Profile Header -->

                    <div class="relative block">
                      <!-- Progress bar -->
                      <div class="progress w-full  absolute top-0">
                        <div class="loading-bar bg-gray-300 animate-pulse"></div>
                      </div>
                      <div class="absolute top-0 left-0 right-0 bg-black h-10 rounded-t-xl">
                        <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mt-2"></div>
                      </div>
                      <!-- Placeholder -->
                      <div id="smartphonePlaceholder" class="placeholder cartoon  ratchet bg-gray-200">
                        <img id="cartoonImage" alt="Cartoon QR code character" class="img" src="{{ asset('demoimg/cartoon.png') }}"
                          style="height: 100%; width: 100%; object-fit: contain; padding: 48px 15px;">
                      </div>

                      <!-- Loading video -->
                      <!--  <div class="loading-video hidden  text-center mt-4">
                        <div></div>
                        <div class="progress w-full h-2 bg-gray-200 rounded mt-2">
                          <div class="loading-bar bg-blue-500 h-full animate-pulse"></div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <!-- Bottom Indicator -->
                  <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-900 rounded-full"></div>
                </div>
                <!-- Mobile Frame -->


                <div class="overflow-hidden rounded-3xl border border-gray-300">
                  <div class="w-full  mx-auto">

                    <!-- Content Wrapper -->


                  </div>
                </div>

                <!-- Bottom of mobile frame (optional, like a home button) -->
                <div
                  class="absolute bottom-0 left-0 right-0 bg-gray-100 h-16 rounded-b-xl flex justify-center items-center">
                  <div class="w-10 h-10 bg-gray-600 rounded-full"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- QR Options Grid -->
          <!-- Navigation Buttons -->

        </div>
      </div>

    </main>
  

  </div>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    // Toggle Sidebar on Mobile
    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
   // Get references to the buttons and content elements
   const staticButton = document.getElementById('static-toggle');
   const dynamicButton = document.getElementById('dynamic-toggle');
   const staticContent = document.getElementById('static-content');
   const dynamicContent = document.getElementById('dynamic-content');

   // Ensure static content is visible on page load by adding 'active' class
   staticButton.classList.add('text-[#F5A623]');
   staticContent.classList.remove('hidden');

   // Event listener for static toggle button
   staticButton.addEventListener('click', () => {
     staticButton.classList.add('text-[#F5A623]', 'border-b-2', 'border-blue-500');
     dynamicButton.classList.remove('text-[#F5A623]', 'border-b-2', 'border-blue-500');

     staticContent.classList.remove('hidden');
     dynamicContent.classList.add('hidden');
   });

   // Event listener for dynamic toggle button
   dynamicButton.addEventListener('click', () => {
     dynamicButton.classList.add('text-[#F5A623]', 'border-b-2', 'border-blue-500');
     staticButton.classList.remove('text-[#F5A623]', 'border-b-2', 'border-blue-500');

     dynamicContent.classList.remove('hidden');
     staticContent.classList.add('hidden');
   });
 </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
   $(document).ready(function() {
     var count = "";
     if (count >= '5') {
       Swal.fire({
         title: 'Please upgrade to proceed',
         text: 'QRCode creation for the free version Exceeds limit',
         icon: 'error',
         dangerMode: true,
         confirmButtonText: 'Upgrade',
         allowOutsideClick: false, // Disable closing on outside click
         allowEscapeKey: false, // Disable closing with Escape key
       }).then((result) => {
         if (result.isConfirmed) {
           // Redirect to another file location
           window.location.href = 'upgrade'; // Replace with your target location
         }
       });
     }
     // When the Static tab is clicked
     $('#static-toggle').click(function() {
       $('#qroption').val('Static'); // Set the value of the input to "Static"
       $('#static-toggle').addClass('active-tab'); // Make the Static tab active
       $('#dynamic-toggle').removeClass('active-tab'); // Remove active class from Dynamic tab
     });
     // When the Dynamic tab is clicked
     $('#dynamic-toggle').click(function() {
       var bcount = "";
       if (bcount >= '10') {
         $("#dnextButton").prop("disabled", true);
         Swal.fire({
           title: 'Please upgrade to proceed',
           text: 'Dynamic QRCode creation for your Plan Exceeds limit',
           icon: 'error',
           dangerMode: true,
           confirmButtonText: 'Upgrade',
           allowOutsideClick: true, // Disable closing on outside click
           allowEscapeKey: true, // Disable closing with Escape key
         }).then((result) => {
           if (result.isConfirmed) {
             // Redirect to another file location
             window.location.href = 'upgrade'; // Replace with your target location
           }
         });
       } else {
         $('#qroption').val('Dynamic'); // Set the value of the input to "Dynamic"
         $('#dynamic-toggle').addClass('active-tab'); // Make the Dynamic tab active
         $('#static-toggle').removeClass('active-tab'); // Remove active class from Static tab
         $("#dnextButton").prop("disabled", false);
       }
     });
   });
 </script>
 <script>
   document.addEventListener('DOMContentLoaded', () => {
     const grid = document.getElementById('gridContainer');

     // Shuffle the grid items alphabetically
     function sortGridAlphabetically() {
       const items = Array.from(grid.children);

       // Sort items alphabetically based on the span's text content
       const sortedItems = items.sort((a, b) => {
         const textA = a.querySelector('span').textContent.trim().toLowerCase();
         const textB = b.querySelector('span').textContent.trim().toLowerCase();
         return textA.localeCompare(textB);
       });

       const shuffledItems = items.sort(() => Math.random() - 0.5);
       // Clear the grid and append sorted items
       grid.innerHTML = '';
       sortedItems.forEach(item => grid.appendChild(item));
     }

     // Trigger sorting on page load or via some event (optional)
     //sortGridAlphabetically(); // Call this function to shuffle on demand
   });

   $(document).ready(function() {
     let targetUrl = ''; // Variable to store the URL
     $('.tick-symbol').remove();
     // Attach click event to all buttons inside the grid
     $('#gridContainer .qr-button').on('click', function() {
       // Get the button name from the span text
       //const buttonName = $(this).find('span').text().trim().toLowerCase();
       const buttonName = $(this).find('span').text().trim().toLowerCase().replace(/[^a-z0-9-]/g, '-');
       // Construct the target URL
       targetUrl = `${buttonName}.php`;

       // Optionally, highlight the selected button (for visual feedback)
       $('#gridContainer .qr-button').removeClass('border-2 border-gray-700'); // Reset others
       $(this).addClass('border-2 border-gray-700'); // Highlight selected
       $(this).addClass('relative');
       // Remove existing tick symbols from all buttons
       $('#gridContainer .tick-symbol').remove();
       // Append the tick symbol to the clicked button
       if (!$(this).find('.tick-symbol').length) {
         $(this).append(`<span class="tick-symbol absolute top-[3px] right-[2px] bg-gray-700 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
             ✔
           </span>`);
       }

       const img = new Image();
       img.src = 'demoimg/' + buttonName.trim() + '.png';
       img.onload = function() {
         $('.cartoon').find('.img').prop('src', img.src).css({
           height: '500px',
           width: '300px'
         });
       };
     });

     $('#static-gridContainer .qr-button').on('click', function() {
       // Get the button name from the span text
       const buttonName = $(this).find('span').text().trim().toLowerCase().replace(/[^a-z0-9-]/g, '-');
       // Construct the target URL
       targetUrl = `${buttonName}`;

       // Optionally, highlight the selected button (for visual feedback)
       $('#static-gridContainer .qr-button').removeClass('border-2 border-gray-700'); // Reset others
       $(this).addClass('border-2 border-gray-700'); // Highlight selected
       $(this).addClass('relative');
       // Remove existing tick symbols from all buttons
       $('#static-gridContainer .tick-symbol').remove();
       // Append the tick symbol to the clicked button
       if (!$(this).find('.tick-symbol').length) {
         $(this).append(`<span class="tick-symbol absolute top-[3px] right-[2px] bg-gray-700 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
             ✔
           </span>`);
       }
       const img = new Image();
       img.src = 'demoimg/' + buttonName.trim() + '.png';
       img.onload = function() {
         $('.cartoon').find('.img').prop('src', img.src).css({
           height: '500px',
           width: '300px'
         });
       };

     });


     // Event listener for the Next button
     $('#nextButton').on('click', function() {

       if (targetUrl) {
         // Redirect to the stored URL
         var option = $("#qroption").val();

         window.location.href = targetUrl + "?option=" + option;
       } else {
         alert('Please select an option first!');
       }
     });
     $('#dnextButton').on('click', function() {

       if (targetUrl) {
         // Redirect to the stored URL
         var option = $("#qroption").val();

         window.location.href = targetUrl + "?option=" + option;
       } else {
         alert('Please select an option first!');
       }
     });
   });
 </script>
</body>

</html>
