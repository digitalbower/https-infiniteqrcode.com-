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
          <!-- Profile -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-user mr-3"></i> Profile
            </button>
          </li>
          <!-- QR Code Generator -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-qrcode mr-3"></i> QR Code Generator
            </button>
          </li>
          <!-- Dropdown Menu -->
          <li class="relative group">
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700" onclick="toggleDropdown(this)">
              <i class="fas fa-qrcode mr-3"></i> Create QR Code
              <i class="fas fa-chevron-down ml-auto"></i>
            </button>
            <div class="absolute left-0 hidden mt-1 w-56 bg-gray-800 rounded shadow-md dropdown-items">
              <ul class="divide-y divide-gray-700">
                <!-- Dropdown Items with Font Awesome Icons -->
                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-link mr-2"></i> URL</a></li>
                <li><a href="/vcard.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-address-card mr-2"></i> vCard</a></li>
                <li><a href="/text.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-font mr-2"></i> Text</a></li>
                <li><a href="/emailform.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-envelope mr-2"></i> Email</a></li>
                <li><a href="/sms.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-sms mr-2"></i> SMS</a></li>
                <li><a href="/wifi.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-wifi mr-2"></i> Wi-Fi</a></li>
                <li><a href="/Bitcoin.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-btc mr-2"></i> Bitcoin</a></li>
                <li><a href="/Twitter.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fab fa-twitter mr-2"></i> Twitter</a></li>
                <li><a href="/Epc.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-cogs mr-2"></i> EPC</a></li>
                <li><a href="/Pdf.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-file-pdf mr-2"></i> PDF</a></li>
                <li><a href="/mp3.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-headphones-alt mr-2"></i> MP3</a></li>
                <li><a href="/image.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-image mr-2"></i> Images</a></li>
                <li><a href="/video.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-video mr-2"></i> Video</a></li>
                <li><a href="/app-store.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-store mr-2"></i> App Stores</a></li>
                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-sync-alt mr-2"></i> Dynamic URL</a></li>
                <li><a href="/facebook.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fab fa-facebook mr-2"></i> Facebook</a></li>
                <li><a href="/Instagram.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fab fa-instagram mr-2"></i>Instagram</a></li>
                <li><a href="/Coupon" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-tag mr-2"></i> Coupon</a></li>
                <li><a href="vCardPlus" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-address-card mr-2"></i> vCard Plus</a></li>
                <li><a href="/Business" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-briefcase mr-2"></i> Business</a></li>
                <li><a href="/Feedback" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-comment mr-2"></i> Feedback</a></li>
                <li><a href="/Rating" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-star mr-2"></i> Rating</a></li>
                <li><a href="/Event.html" class="block px-4 py-2 hover:bg-gray-700"><i class="fas fa-calendar-alt mr-2"></i> Event</a></li>
              </ul>
              
            </div>
          </li>
          
          <script>
            function toggleDropdown(button) {
              const dropdown = button.nextElementSibling; // Get the dropdown menu
              dropdown.classList.toggle('hidden'); // Toggle visibility
              const icon = button.querySelector('i.fas.fa-chevron-down');
              if (dropdown.classList.contains('hidden')) {
                icon.classList.replace('fa-chevron-up', 'fa-chevron-down'); // Change to down icon
              } else {
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up'); // Change to up icon
              }
            }
          </script>
          
          <!-- Yields -->
          <li>
            <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-chart-line mr-3"></i> Yields
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
    <div class="max-w-7xl mx-auto p-6">
      <div class="flex-1 w-full p-4 lg:px-12">
        <div class="container text-center mx-auto pt-12 lg:px-12">
          <h1 class="text-4xl text-center font-extrabold text-center mb-10 text-white border-[#F5A623] border-b-4 pb-3 inline-block">
            Create Your QR Code
          </h1>
        </div>
  
        <div class="flex justify-center mb-8 space-x-4">
          <!-- Step indicators -->
          <div class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#F5A623] bg-opacity-90 shadow-md transition duration-300">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
          </div>
          <div class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">2</div>
          <div class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">3</div>
        </div>
  
        <!-- Tabs for Static and Dynamic -->
        <div class="flex mb-2  pb-2">
          <!-- Static Tab -->
          <div id="static-toggle" class="tab-button px-4 py-2 cursor-pointer text-white hover:font-semibold transition-all duration-300 focus:outline-none active-tab">Static</div>
          
          <!-- Dynamic Tab -->
          <div id="dynamic-toggle" class="tab-button px-4 py-2 cursor-pointer text-white hover:font-semibold transition-all duration-300 focus:outline-none">Dynamic</div>
        </div>
        <div id="static-content" class="tab-content hfidden p-4 bg-white rounded-lg">
        
           
              <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                <!-- URL -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-link text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">URL</span>
                </button>
          
                <!-- vCard -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-address-card text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">vCard</span>
                </button>
          
                <!-- Text -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-file-lines text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Text</span>
                </button>
          
                <!-- Email -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-envelope text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Email</span>
                </button>
          
                <!-- SMS -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-comment text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">SMS</span>
                </button>
          
                <!-- Wi-Fi -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-wifi text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Wi-Fi</span>
                </button>
          
                <!-- Bitcoin -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-brands fa-bitcoin text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Bitcoin</span>
                </button>
          
                <!-- Twitter -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-brands fa-twitter text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Twitter</span>
                </button>
          
                <!-- EPC -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-euro-sign text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">EPC</span>
                </button>
          
                <!-- PDF -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-file-pdf text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">PDF</span>
                </button>
          
                <!-- MP3 -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-music text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">MP3</span>
                </button>
          
                <!-- Images -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-image text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Images</span>
                </button>
          
                <!-- Video -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Video</span>
                </button>
          
                <!-- App Stores -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">App Stores</span>
                </button>
          
                <!-- Dynamic URL -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-link-slash text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Dynamic URL</span>
                </button>
          
                <!-- Facebook -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-brands fa-facebook text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Facebook</span>
                </button>
          
                <!--Instagram -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-share-nodes text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Social Media</span>
                </button>
          
                <!-- Coupon -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-ticket text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Coupon</span>
                </button>
          
                <!-- vCard Plus -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-address-card text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">vCard Plus</span>
                </button>
          
                <!-- Business -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-briefcase text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Business</span>
                </button>
          
                <!-- Feedback -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-comments text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Feedback</span>
                </button>
          
                <!-- Rating -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-star text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Rating</span>
                </button>
          
                <!-- Event -->
                <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                    <i class="fa-solid fa-calendar text-2xl mb-1 text-gray-700"></i>
                    <br/><span class="text-sm font-semibold text-gray-900">Event</span>
                </button>
            </div>
            
            
           
         
        </div>
        
        <!-- Dynamic Content -->
        <div id="dynamic-content" class="tab-content hidden p-4 bg-white rounded-lg">
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            <!-- URL -->
           
      
            <!-- Email -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-envelope text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Email</span>
            </button>
      
            <!-- SMS -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-comment text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">SMS</span>
            </button>
      
            <!-- Wi-Fi -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-wifi text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Wi-Fi</span>
            </button>
      
            <!-- Bitcoin -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-brands fa-bitcoin text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Bitcoin</span>
            </button>
      
            <!-- Twitter -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-brands fa-twitter text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Twitter</span>
            </button>
      
            <!-- EPC -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-euro-sign text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">EPC</span>
            </button>
      
            <!-- PDF -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-file-pdf text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">PDF</span>
            </button>
      
            <!-- MP3 -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-music text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">MP3</span>
            </button>
      
            <!-- Images -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-image text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Images</span>
            </button>
      
            <!-- Video -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Video</span>
            </button>
      
            <!-- App Stores -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-play text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">App Stores</span>
            </button>
      
            <!-- Dynamic URL -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-link-slash text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Dynamic URL</span>
            </button>
      
            <!-- Facebook -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-brands fa-facebook text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Facebook</span>
            </button>
      
            <!--Instagram -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-share-nodes text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Social Media</span>
            </button>
      
            <!-- Coupon -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-ticket text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Coupon</span>
            </button>
      
            <!-- vCard Plus -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-address-card text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">vCard Plus</span>
            </button>
      
            <!-- Business -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-briefcase text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Business</span>
            </button>
      
            <!-- Feedback -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-comments text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Feedback</span>
            </button>
      
            <!-- Rating -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-star text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Rating</span>
            </button>
      
            <!-- Event -->
            <button class="qr-button p-3 rounded-md hover:bg-[#F5A623]">
                <i class="fa-solid fa-calendar text-2xl mb-1 text-gray-700"></i>
                <br/><span class="text-sm font-semibold text-gray-900">Event</span>
            </button>
        </div>
        </div>
        <!-- QR Options Grid -->
       
  
        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-8">
          <button class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">Previous</button>
          <button class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Next</button>
        </div>
      </div>
    </div>
  
    <script>
      // Get references to the buttons and content elements
      const staticButton = document.getElementById('static-toggle');
      const dynamicButton = document.getElementById('dynamic-toggle');
      const staticContent = document.getElementById('static-content');
      const dynamicContent = document.getElementById('dynamic-content');
      
      // Ensure static content is visible on page load by adding 'active' class
      staticButton.classList.add('text-blue-500');
      staticContent.classList.remove('hidden');
      
      // Event listener for static toggle button
      staticButton.addEventListener('click', () => {
        staticButton.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
        dynamicButton.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500');
        
        staticContent.classList.remove('hidden');
        dynamicContent.classList.add('hidden');
      });
    
      // Event listener for dynamic toggle button
      dynamicButton.addEventListener('click', () => {
        dynamicButton.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
        staticButton.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500');
        
        dynamicContent.classList.remove('hidden');
        staticContent.classList.add('hidden');
      });
    </script>
    
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

</body>

</html>
