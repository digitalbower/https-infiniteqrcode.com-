<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Infinite QR Codes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="{{asset('images/indexfav.png')}}" type="image/x-icon">
  <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"
    rel="stylesheet" />
  <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css"
    rel="stylesheet" />
  <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
  <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body,
    a,
    p {
      font-family: 'Poppins', sans-serif !important;
    }

    /* For Chrome, Safari, Edge, and Opera */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* For Firefox */
    input[type="number"] {
      -moz-appearance: textfield;
    }

    .owl-dots {
      text-align: center;
    }

    .owl-dots button.owl-dot.active span,
    .owl-dots button.owl-dot:hover span {
      background-color: #00b8cbb5;
      border-radius: 50%;
      height: 12px;
      width: 12px;
      position: absolute;
      top: 1px;
      left: 1px;
    }

    .owl-dots button.owl-dot {
      border: 1px solid gray;
      margin: 10px;
      background: white;
      border-radius: 50%;
      height: 16px;
      width: 16px;
      position: relative;
    }

    .owl-prev {
      position: absolute;
      left: 4px;
      top: 45%;
      width: 30px;
      height: 30px;
      background: #00b8cbb5 !important;
      color: #fff !important;
      border-radius: 100%;
    }

    .owl-next {
      position: absolute;
      right: 4px;
      top: 45%;
      width: 30px;
      height: 30px;
      background: #00b8cbb5 !important;
      color: #fff !important;
      border-radius: 100%;
    }

    @keyframes fade-in {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .fade-in {
      animation: fade-in 1s ease-in-out;
    }

    .float {
      animation: float 3s ease-in-out infinite;
    }

    /* Container max-width for desktop views */
    .container {
      max-width: 1920px;
    }

    .fade-in {
      animation: fadeIn 0.5s ease-in-out forwards;
    }

    .gradient-btn {
      background: linear-gradient(to right, #00b4d8, #7209b7);
    }

    .card-hover {
      transition: transform 0.3s ease-in-out;
    }

    .card-hover:hover {
      transform: translateY(-10px);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .button-hover:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .card {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    /* Animations */
    .fade-in {
      animation: fadeIn 0.3s ease-in-out forwards;
    }

    .scale-up {
      animation: scaleUp 0.3s ease-in-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes scaleUp {
      from {
        transform: scale(0.9);
      }

      to {
        transform: scale(1);
      }
    }

    @keyframes fade-in {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    /* Fade-in Animation */
    .fade-in {
      animation: fade-in 1s ease-in-out forwards;
    }

    /* Floating Animation */
    .float {
      animation: float 3s ease-in-out infinite;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes float {
      0% {
        transform: translateY(0);
      }

      100% {
        transform: translateY(-10px);
      }
    }

    /* Overlay for mobile menu */
    .menu-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 50;
    }

    /* Show overlay when menu is open */
    .menu-overlay.show {
      display: block;
    }
  </style>
</head>

<body class="bg-white relative text-black">
  <!-- Navigation Bar -->
  <header class="border-b sticky top-0 bg-white z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:max-w-screen-xl">
      <div class="flex h-16 items-center justify-between lg:h-20">
        <!-- Left section - Phone number -->
        <div class="hidden lg: gap-2 text-black">
          <i class="fas fa-phone text-red-500 animate-pulse"></i>
          <span class="text-sm">+1 800 603 6035</span>
        </div>

        <!-- Mobile menu button -->
        <button id="menuToggle" class="lg:hidden focus:outline-none">
          <i class="fas fa-bars h-6 w-6 text-black hover:text-red-500 transition-colors duration-300"></i>
        </button>

        <!-- Logo -->
        <div class="flex justify-center w-full items-center">
          <a href="#" class="flex items-center gap-2 ">
            <img src="{{asset('images/indexfav.png')}}" class="w-[200px]" />
          </a>
        </div>

      
       <!-- Right section - Icons -->
<div class="flex items-center gap-4">

<div class="relative inline-block text-left">
  <!-- Dropdown Button -->
  @auth
      <button id="userDropdownButton"
      class="w-full bg-[#00b8cbb5] flex justify-center gap-x-2 items-center text-white py-3 px-3 lg:text-base text-sm lg:px-6 rounded-lg font-semibold hover:bg-[#0097a5] transition-colors duration-300"
      onclick="toggleDropdown('userDropdown')">
      <i class="fas fa-user-circle text-2xl text-white"></i>
      <span class="font-semibold">{{ auth()->user()->firstname }}</span>
      <i id="userDropdownArrow"
        class="fas fa-chevron-down text-sm text-white transform transition-transform duration-200"></i>
    </button>
  @endauth
    
 @guest
  <a href="{{ route('signin') }}"><i class="fas fa-user text-black"></i></a>
 @endguest

  <!-- Dropdown Menu -->
  <div id="userDropdown"
    class="absolute right-0 mt-2 w-56 bg-white border border-gray-300 rounded-lg shadow-lg divide-y divide-gray-200 hidden">
    <a href="{{ route('dashboard') }}"
      class="flex items-center gap-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
      <i class="fa-solid fa-house text-blue-500"></i>
      Dashboard
    </a>

    <a href="{{ route('auth.logout') }}"
      class="flex items-center gap-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
      <i class="fas fa-sign-out-alt text-red-500"></i>
      Logout
    </a>
  </div>
</div>


<!-- JavaScript -->
<script>
function toggleDropdown(dropdownId) {
  const dropdown = document.getElementById(dropdownId);
  const arrow = document.getElementById(`${dropdownId}Arrow`);
  dropdown.classList.toggle("hidden");
  dropdown.classList.toggle("block");
  if (arrow) arrow.classList.toggle("rotate-180");
}

// Close dropdown when clicking outside
document.addEventListener("click", function(event) {
  const dropdown = document.getElementById("userDropdown");
  const button = document.getElementById("userDropdownButton");

  if (!dropdown.contains(event.target) && !button.contains(event.target)) {
    dropdown.classList.add("hidden");
    dropdown.classList.remove("block");
    const arrow = document.getElementById("userDropdownArrow");
    if (arrow) arrow.classList.remove("rotate-180");
  }
});
</script>

</div>
</div>

      <!-- Desktop Navigation -->
      <nav class="hidden lg:block">
        <ul class="flex justify-center space-x-8 py-4">
          <li>
            <a href="home" class="text-sm font-medium hover:text-red-500 transition-colors">HOME</a>
          </li>
          <li>
            <a href="#specialoffers" class="text-sm font-medium hover:text-red-500 transition-colors">SPECIAL OFFERS</a>
          </li>
          <li>
            <a href="#features" class="text-sm font-medium hover:text-red-500 transition-colors">FEATURES</a>
          </li>
          <li>
            <a href="#pricing" class="text-sm font-medium hover:text-red-500 transition-colors">PRICING</a>
          </li>
          <li>
            <a href="#benifts" class="text-sm font-medium hover:text-red-500 transition-colors">BENIFITS</a>
          </li>
          <li>
            <a href="#faqs" class="text-sm font-medium hover:text-red-500 transition-colors">FAQS</a>
          </li>
          <li>
            <a href="#contactus" class="text-sm font-medium hover:text-red-500 transition-colors">CONTACT US</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Mobile Menu Overlay -->
  <div id="menuOverlay" class="menu-overlay"></div>

  <!-- Mobile Menu -->
  <div class="fixed inset-0 z-50 hidden lg:hidden fade-in" id="mobileMenu">
    <div class="relative flex h-full w-full flex-col items-center bg-white p-8">
      <button id="menuClose" class="absolute top-4 right-4 text-black hover:text-red-500 focus:outline-none">
        <i class="fas fa-times text-2xl"></i>
      </button>
      <nav class="flex flex-col items-center gap-6 mt-12 text-lg font-semibold text-black">
        <a href="home" class="hover:text-red-500">HOME</a>
        <a href="#specialoffers" class="hover:text-red-500">SPECIAL OFFERS</a>
        <a href="#features" class="hover:text-red-500">FEATURES</a>
        <a href="#pricing" class="hover:text-red-500">PRICING</a>
        <a href="#benifts" class="hover:text-red-500">BENIFITS</a>
        <a href="#faqs" class="hover:text-red-500">FAQS</a>
        <a href="#contactus" class="hover:text-red-500">CONTACTUS</a>
      </nav>
    </div>
  </div>

  <section class="relative overflow-hidden bg-gradient-to-b from-[#00b8cbb5] to-white py-12 sm:py-16 md:py-20 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:max-w-screen-xl">
      <div class="grid gap-12 sm md:gap-16 lg:grid-cols-2 lg:items-center lg:gap-24">
        <!-- Left Column: Text Content -->
        <div class="space-y-6 md:space-y-2 order-2 lg:order-1 fade-in">
          <h1 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-[#1B2937] tracking-tight lg:leading-tight">
            Empower Your Business with Infinite QR Codes!
          </h1>
          <p class="text-base sm:text-lg leading-relaxed text-[#1B2937] opacity-80">
            Simplify your business operations with a subscription to Infinite QR Code. Whether you're managing
            inventory, sharing contactless menus, or promoting your brand, our platform offers endless possibilities for
            creating and customizing QR codes tailored to your needs. Start your free trial today and unlock the power
            of infinite possibilities!
          </p>
          <div class="pt-5">
            <button onclick="location.href='sign'"
              class="inline-flex items-center lg:w-auto w-full text-center justify-center px-6 sm:px-8 py-3 bg-[#FFD700] text-[#1B2937] font-semibold rounded-md shadow-md hover:bg-[#C0C9D0] transition duration-200 focus:ring-4 focus:ring-[#FFD700]/50">
              Start Your Free Trial
              <i class="fas fa-arrow-right ml-2"></i>
            </button>
          </div>

          <!-- Features List with Icons -->
          <div class="pt-5 sm:pt-12 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-2 gap-6 sm:gap-8">
            <div class="text-center">
              <i
                class="fas fa-infinity text-xl sm:text-2xl bg-[#97d4e9] rounded-full p-3 text-[#171d2b] mb-1 sm:mb-2"></i>
              <p class="text-sm sm:text-lg font-medium text-[#1B2937]">
                Unlimited QR Code Creation
              </p>
            </div>
            <div class="text-center">
              <i
                class="fas fa-shield-alt text-xl sm:text-2xl bg-[#97d4e9] rounded-full p-3 text-[#171d2b] mb-1 sm:mb-2"></i>
              <p class="text-sm sm:text-lg font-medium text-[#1B2937]">
                Customizable Designs
              </p>
            </div>
            <div class="text-center">
              <i
                class="fas fa-chart-line text-xl sm:text-2xl bg-[#97d4e9] rounded-full p-3 text-[#171d2b] mb-1 sm:mb-2"></i>
              <p class="text-sm sm:text-lg font-medium text-[#1B2937]">
                Real-Time Analytics
              </p>
            </div>
            <div class="text-center">
              <i
                class="fas fa-headset text-xl sm:text-2xl bg-[#97d4e9] rounded-full p-3 text-[#171d2b] mb-1 sm:mb-2"></i>
              <p class="text-sm sm:text-lg font-medium text-[#1B2937]">
                24/7 Support
              </p>
            </div>
          </div>
        </div>

        <!-- Right Column: Image with Floating and Background Effect -->
        <div class="relative order-1 lg:order-2 flex justify-center lg:justify-end mt-5 lg:mt-0">
          <div class="relative w-full sm:w-full lg:max-w-lg">
            <img src="img/hero.png" alt="CBD Oil Products" class="w-full  object-cover" />

            <!-- Decorative Accent Circles -->
            <div
              class="absolute top-1/3 -right-8 sm:-right-16 h-40 w-40 sm:h-80 sm:w-80 bg-[#8EC3E6]/20 rounded-full blur-lg">
            </div>
            <div
              class="absolute bottom-0 -left-1/4 sm:-left-1/2 top-20 h-24 w-1/3 sm:h-48 sm:w-1/2 bg-[#8EC3E6]/20 rounded-full blur-lg">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="specialoffers"
    class="container mx-auto px-4 py-12 sm:py-16 md:py-20 lg:py-24 sm:px-6 lg:max-w-screen-xl">
    <div class="grid gap-8 lg:grid-cols-2 lg:gap-12">
      <!-- Left Column - Image Content -->
      <div class="relative flex items-center order-1 lg:order-1 justify-center lg:justify-start fade-in">
        <div class="w-full sm:w-full lg:max-w-full">
          <img src="img/offer.png" alt="CBD Facial Serum Products"
            class="h-full w-full object-cover rounded-lg transition-transform duration-300 transform hover:scale-105" />
          <!-- Decorative background elements -->
        </div>
      </div>

      <!-- Right Column - Text Content -->
      <div class="flex flex-col justify-center order-2 lg:order-2 mt-8 lg:mt-0">
        <h2
          class="text-2xl sm:text-3xl lg:text-4xl mb-4 sm:mb-5 font-extrabold text-[#1B2937] tracking-tight lg:leading-tight">
          New Year Offer: Unlock Infinite QR Codes Now!
        </h2>
        <p class="mb-6 sm:mb-8 text-base sm:text-lg text-gray-700 fade-in">
          Celebrate the New Year with our exclusive offer! For the next 30 days only, get access to our premium QR code
          subscription at a special discounted price. Create, customize, and manage unlimited QR codes effortlessly.
          Start the year smart with dynamic QR solutions!

        </p>

        <!-- Countdown Timer -->
        <div class="grid grid-cols-2 gap-4 mb-6 sm:mb-8 fade-in md:grid-cols-4 countdown-box">
          <div
            class="card flex flex-col items-center justify-center p-4 border-2 border-[#D4AF37]/20 rounded-lg shadow-lg">
            <span class="text-2xl sm:text-3xl font-bold text-[#171d2b]">30</span>
            <span class="text-xs sm:text-sm text-gray-600">Days</span>
          </div>
          <div
            class="card flex flex-col items-center justify-center p-4 border-2 border-[#D4AF37]/20 rounded-lg shadow-lg">
            <span class="text-2xl sm:text-3xl font-bold text-[#171d2b]">00</span>
            <span class="text-xs sm:text-sm text-gray-600">Hours</span>
          </div>
          <div
            class="card flex flex-col items-center justify-center p-4 border-2 border-[#D4AF37]/20 rounded-lg shadow-lg">
            <span class="text-2xl sm:text-3xl font-bold text-[#171d2b]">00</span>
            <span class="text-xs sm:text-sm text-gray-600">Minutes</span>
          </div>
          <div
            class="card flex flex-col items-center justify-center p-4 border-2 border-[#D4AF37]/20 rounded-lg shadow-lg">
            <span class="text-2xl sm:text-3xl font-bold text-[#171d2b]">00</span>
            <span class="text-xs sm:text-sm text-gray-600">Seconds</span>
          </div>
        </div>





        <!-- Shop Now Button -->
        <button onclick="location.href='sign'"
          class="inline-flex items-center px-6 justify-center text-center sm:px-8 py-3 bg-[#FFD700] text-[#1B2937] font-semibold rounded-md shadow-md hover:bg-[#C0C9D0] transition duration-200 focus:ring-4 focus:ring-[#FFD700]/50">
          Claim Your Offer Now
          <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </button>
      </div>
    </div>
  </section>
  <section class="bg-gradient-to-t from-[#00b8cbb5] to-white" id="features">
    <div class="container mx-auto px-4 py-12 sm:py-16 md:py-20 lg:py-24 sm:px-6 lg:max-w-screen-xl">
      <!-- Header -->
      <div class="text-center mb-16">
        <p class="text-[#FFD700] font-medium mb-2 transform hover:scale-105 transition-transform duration-300">
          EXPLORE THE AWESOME
        </p>
        <h2
          class="text-4xl font-bold text-[#1B2937] text-black mb-4 transform hover:scale-105 transition-transform duration-300">
          Product Feature
        </h2>
      </div>

      <!-- Features Grid -->
      <div class="relative mx-auto">
        <!-- Center Image -->

        <!-- Features Layout -->
        <div class="grid grid-cols-1 items-center md:grid-cols-12 gap-8 relative">
          <!-- Left Column Features -->
          <div class="lg:col-span-4 col-span-1 md:col-span-6 lg:order-1 order-2 space-y-6">
            <!-- Firsted Reply -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-end text-left md:text-right transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
                <div class="w-full order-2 md:order-1">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Unlimited QR Codes
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Generate and manage unlimited QR codes with ease, all in one platform.
                  </p>
                </div>
                <div class="order-1 md:order-2">
                  <div class="w-14 h-14 bg-[#97d4e9]  rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <!-- Battery Life -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-end text-left md:text-right transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
                <div class="w-full order-2 md:order-1">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Customizable Designs
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Personalize your QR codes with colors, logos, and styles that match your brand.
                  </p>
                </div>
                <div class="order-1 md:order-2">
                <div class="w-14 h-14 bg-[#97d4e9]  rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                </div>
                </div>
              </div>
            </div>

            <!-- Personal Assistant -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-end text-left md:text-right transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
                <div class="w-full order-2 md:order-1">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Dynamic QR Codes
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Update QR code content anytime without needing to regenerate or reprint.
                  </p>
                </div>
                <div class="order-1 md:order-2">
                <div class="w-14 h-14 bg-[#97d4e9]  rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                  </svg>
                </div>
                </div>
              </div>
            </div>

            <!-- Anti Glare -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-end text-left md:text-right transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
                <div class="w-full order-2 md:order-1">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Real-Time Analytics
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Track scans, locations, and devices in real-time to measure performance.
                  </p>
                </div>
                <div class="order-1 md:order-2">
                <div class="w-14 h-14 bg-[#97d4e9]  rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="lg:col-span-4 col-span-1 md:col-span-12 lg:order-2 order-1 space-y-6">
            <img src="img/feature.png" alt="Product" class=" w-full mx-auto lg:transform z-10 float-animation" />
          </div>
          <!-- Right Column Features -->
          <div class="lg:col-span-4 col-span-1 md:col-span-6 lg:order-3 order-3 space-y-6">
            <!-- Fitness Tracking -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-start transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
              <div class="">
                <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                </div>
                </div>
                <div class="w-full">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Scheduled QR Code Activation
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Set activation and expiration dates for your QR codes to control when they go live.

                  </p>
                </div>
              </div>
            </div>

            <!-- Manage Calls -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-start transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
                <div>
                <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                </div>
                </div>
                <div class="w-full">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Instant QR Code Previews
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    View real-time previews of your QR codes as you design and customize them
                  </p>
                </div>
              </div>
            </div>

            <!-- App Launch -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-start transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
              <div>
                <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                  </svg>
                </div>
                </div>
                <div class="w-full">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Advanced Security
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Secure your QR codes with password protection and expiry dates.
                  </p>
                </div>
              </div>
            </div>

            <!-- Music Control -->
            <div
              class="flex flex-col bg-white rounded-xl p-6 items-start transform hover:scale-105 transition-transform duration-300">
              <div class="flex items-center gap-4 mb-2">
              <div>
                <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center">
                  <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                  </svg>
                </div>
                </div>
                <div class="w-full">
                  <h3 class="font-semibold text-base mb-1 text-black line-clamp-2">
                    Mobile-Friendly Management
                  </h3>
                  <p class="text-gray-700 text-sm line-clamp-3 ">
                    Easily manage and update your QR codes on the go with a fully responsive dashboard.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="pricing" class="container px-4 mx-auto py-12 sm:py-16 md:py-20 lg:py-24 sm:px-6 lg:max-w-screen-xl">
    <div>
      <!-- Header -->
      <div class="text-center mb-12">
        <div class="flex items-center justify-center gap-2 mb-4">
          <svg class="w-7 h-7 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-[#FFD700] font-semibold">Our Best Pricing</span>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 mb-4">
          Choose the Perfect Plan for Your Needs

        </h2>
        <p class="text-gray-600 font-semibold mb-8">
          Pay annually and save 2 extra months with a special discount!
        </p>

        <!-- Toggle Switch -->
        <div class="flex items-center justify-center gap-4 mb-12">
          <span class="text-gray-600">Monthly</span>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" id="toggleSwitch" class="sr-only peer" onclick="togglePricing()" />
            <div
              class="w-14 h-7 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-[#FF3366]-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#00b8cbb5]">
            </div>
          </label>
          <span class="text-gray-600">Yearly</span>
          <span
            class="ml-2 inline-flex items-center rounded-full bg-[#00b8cbb5] bg-opacity-10 px-4 py-1 text-base font-bold text-[#FFD700]">Save
            25%</span>
        </div>
      </div>

      <!-- Pricing Cards -->
      <div class="lg:grid grid-cols-1 space-y-4 md:space-y-0  md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Boost Plan -->
        <div
          class="bg-white rounded-2xl border-2 border-[#00b8cbb5] p-8 shadow-lg transition-all duration-300 hover:shadow-2xl">
          <span class="inline-block bg-[#00b8cbb5] text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Starter
            Package</span>
          <div class="mb-6">
            <div class="flex items-baseline">
              <span class="text-3xl font-semibold text-gray-500">$</span>
              <span id="boostPrice" class="text-5xl font-bold text-gray-900">9</span>
              <span id="boostDiscount" class="text-xl font-semibold text-gray-400 line-through ml-2">$12</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mt-4">
              Ideal for Startups
            </h3>
            <p class="text-gray-600 mt-2">
              Start your QR code journey with essential features and limited dynamic code access.

            </p>
            <!-- Features with tick icon -->
            <ul class="mt-4 space-y-2 text-gray-700">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Static QR Codes

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                10 Dynamic QR Codes

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                5000 Scans per month

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Customizable QR Code Designs

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Scheduled QR Code Activation


              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                QR Code Expiry



              </li>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Mobile-Friendly Dashboard




              </li>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Basic QR Code Analytics



              </li>
            </ul>
          </div>
          <button onclick="location.href='sign'"
            class="w-full bg-[#00b8cbb5] text-white py-3 px-3 lg:text-base text-sm lg:px-6 rounded-lg font-semibold hover:bg-[#0097a5] transition-colors duration-300">
            Start Your 7 - days Free Trial

          </button>
        </div>

        <!-- Pro Plan -->
        <div
          class="bg-white rounded-2xl border-2 border-[#00b8cbb5] p-8 shadow-lg transition-all duration-300 hover:shadow-2xl">
          <div class="flex justify-between mb-4 items-center">
            <span
              class="w-auto hover:bg-[#00b8cbb5] text-white py-1 px-3 rounded-lg font-semibold bg-[#FFD700] transition-colors duration-300">Professional
              Package</span>
          </div>
          <div class="mb-6">
            <div class="flex items-baseline">
              <span class="text-3xl font-semibold text-gray-500">$</span>
              <span id="proPrice" class="text-5xl font-bold text-gray-900">21</span>
              <span id="proDiscount" class="text-xl font-semibold text-gray-400 line-through ml-2">$28</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mt-4">
              Most Popular
            </h3>
            <p class="text-gray-600 mt-2">
              Unlock more dynamic QR codes and higher scan limits, ideal for expanding businesses.

            </p>
            <!-- Features with tick icon -->
            <ul class="mt-4 space-y-2 text-gray-700">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Static QR Codes
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Dynamic QR Codes
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                20,000 Scans per month
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Customizable Designs with Branding
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Scheduled Activation and Expiry

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Bulk QR Code Generation

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                QR Code Analytics
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Mobile-Friendly Dashboard

              </li>
            </ul>
          </div>
          <button onclick="location.href='sign'"
            class="w-full bg-[#00b8cbb5] text-white py-3 px-3 lg:text-base text-sm lg:px-6 rounded-lg font-semibold hover:bg-[#0097a5] transition-colors duration-300">
            Start Your 7 - days Free Trial

          </button>
        </div>

        <!-- Ultimate Plan -->
        <div
          class="bg-white rounded-2xl border-2 border-[#00b8cbb5] p-8 shadow-lg transition-all duration-300 hover:shadow-2xl">
          <span
            class="inline-block bg-[#00b8cbb5] text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Business
            Package</span>
          <div class="mb-6">
            <div class="flex items-baseline">
              <span class="text-3xl font-semibold text-gray-500">$</span>
              <span id="ultimatePrice" class="text-5xl font-bold text-gray-900">45</span>
              <span id="ultimateDiscount" class="text-xl font-semibold text-gray-400 line-through ml-2">$60</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mt-4">
              For Large Scale Use
            </h3>
            <p class="text-gray-600 mt-2">
              Get ultimate flexibility with unlimited dynamic codes, higher scans & detailed analytics.
            </p>
            <!-- Features with tick icon -->
            <ul class="mt-4 space-y-2 text-gray-700">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Static QR Codes
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Dynamic QR Codes
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Unlimited Scans per month
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Complete Custom Branding Options
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Scheduled Activation and Expiry
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Bulk QR Code Upload and Generation

              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                QR Code Analytics Report
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                </svg>
                Advanced Analytics
              </li>
            </ul>
          </div>
          <button onclick="location.href='sign'"
            class="w-full bg-[#00b8cbb5] text-white py-3 px-3 lg:text-base text-sm lg:px-6 rounded-lg font-semibold hover:bg-[#0097a5] transition-colors duration-300">
            Start Your 7 - days Free Trial
          </button>
        </div>
      </div>
    </div>
  </section>
  <script>
    function togglePricing() {
      const boostPrice = document.getElementById("boostPrice");
      const proPrice = document.getElementById("proPrice");
      const ultimatePrice = document.getElementById("ultimatePrice");

      //discount price ids
      const boostDiscount = document.getElementById("boostDiscount");
      const proDiscount = document.getElementById("proDiscount");
      const ultimateDiscount = document.getElementById("ultimateDiscount");



      if (document.getElementById("toggleSwitch").checked) {
        boostPrice.innerText = "90";
        proPrice.innerText = "210";
        ultimatePrice.innerText = "450";

        //discount price yearly
        boostDiscount.innerText = "120";
        proDiscount.innerText = "280";
        ultimateDiscount.innerText = "600";
      } else {
        boostPrice.innerText = "9";
        proPrice.innerText = "21";
        ultimatePrice.innerText = "45";

        //discount price monlthly
        boostDiscount.innerText = "12";
        proDiscount.innerText = "28";
        ultimateDiscount.innerText = "60";
      }
    }
  </script>
  <script>
    $(document).ready(function () {
      $(".owl-carousel").owlCarousel({
        items: 1, // Number of items to show
        nav: true,
        dots: true,
        loop: true, // Infinite looping
        margin: 10, // Space between items
        autoplay: false, // Auto slide transition
        autoplayTimeout: 3000, // Transition delay
        responsive: {
          0: {
            items: 1
          }, // Show 1 item on small screens
          768: {
            items: 2
          }, // 2 items on medium screens
          1024: {
            items: 3,
            autoplay: false
          }, // 3 items on larger screens
        },
      });
    });
  </script>
  <section class="bg-gradient-to-b from-[#00b8cbb5] to-white">
    <div id="benifts" class="container px-4 mx-auto py-12 sm:py-16 md:py-20 lg:py-24 sm:px-6 lg:max-w-screen-xl">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4"><!--THE BENEFITS --> Unlock the Power of QR Codes</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Enhance customer engagement, streamline processes, and track valuable insights with the versatility of QR
          codes.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- GPS Tracking -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Easy to Use
          </h3>
          <p class="text-gray-600">
            QR codes can be scanned instantly with a smartphone camera, making them highly user-friendly and accessible.
          </p>
        </div>

        <!-- Heartbeat Analysis -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Contactless Interaction
          </h3>
          <p class="text-gray-600">
            QR codes provide a contactless way to share information, reducing physical interactions and promoting
            safety.
          </p>
        </div>

        <!-- Security First -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Trackable Insights
          </h3>
          <p class="text-gray-600">
            With dynamic QR codes, you can track scan data such as location, time, and device type, providing valuable
            marketing insights.
          </p>
        </div>

        <!-- Innovative Idea -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Customizable Design
          </h3>
          <p class="text-gray-600">
            QR codes can be personalized with logos, colors, and branding, making them visually appealing and aligned
            with your brand.
          </p>
        </div>

        <!-- Save Your Bills -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Cost-Effective
          </h3>
          <p class="text-gray-600">
            Creating and distributing QR codes is inexpensive, offering a low-cost solution for marketing and customer
            engagement.
          </p>
        </div>

        <!-- Proven Technology -->
        <div class="hover-scale p-6 rounded-xl bg-white shadow-lg">
          <div class="w-14 h-14 bg-[#97d4e9] rounded-full flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-[#171d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">
            Versatile Applications </h3>
          <p class="text-gray-600">
            QR codes can be used in various industries for purposes like product tracking, event tickets, payments,
            promotional campaigns, and more.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gradient-to-t from-[#00b8cbb5] to-white" id="faqs">
    <div class="container px-4 mx-auto py-12 sm:py-16 md:py-20 lg:py-24 sm:px-6 lg:max-w-screen-xl">
      <!-- FAQ Section -->
      <div class="grid grid-cols-1 items-center md:grid-cols-2 lg:grid-cols-2 gap-6">
        <div class="mt-0">
          <div class="flex items-center justify-start gap-2 mb-4">
            <span class="text-[#black] font-semibold">Need Help?</span>
          </div>

          <div class="space-y-6 fade-in">
            <h1 class="text-3xl lg:text-5xl font-extrabold text-[#1B2937] tracking-tight lg:leading-tight">
              Frequently Asked Questions
            </h1>
            <p class="text-lg leading-relaxed text-[#1B2937] opacity-80">
              Find answers to common questions about our QR code subscription service. Get all the information you need
              about pricing, features, and subscription options.
            </p>
            <!--  <button
              class="inline-flex items-center px-8 py-3 bg-[#FFD700] text-[#1B2937] font-semibold rounded-md shadow-md hover:bg-[#C0C9D0] transition duration-200 focus:ring-4 focus:ring-[#FFD700]/50">
              Shop Now
              <i class="fas fa-arrow-right ml-2"></i>
            </button> -->

            <!-- Features List with Icons -->
          </div>
        </div>
        <div class="space-y-4">
          <div class="border-b bg-white px-4 rounded-md">
            <button
              class="flex justify-between items-center w-full py-4 text-left text-gray-800 font-semibold faq-button">
              <span>Do I need a subscription to use the service?</span>
              <span class="transform transition-transform duration-300" data-rotation="0"><i
                  class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="hidden faq-answer text-gray-600 pb-5">
              Yes, we offer various subscription plans that provide access to different features, including static and
              dynamic QR codes, customization options, and analytics.
            </div>
          </div>
          <div class="border-b bg-white px-4 rounded-md">
            <button
              class="flex justify-between items-center w-full py-4 text-left text-gray-800 font-semibold faq-button">
              <span>Can I cancel my subscription at any time?</span>
              <span class="transform transition-transform duration-300" data-rotation="0"><i
                  class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="hidden faq-answer text-gray-600 pb-5">
              Yes, you can cancel your subscription at any time. There are no long-term commitments, and you'll retain
              access to your plan until the end of your billing cycle.
            </div>
          </div>
          <div class="border-b bg-white px-4 rounded-md">
            <button
              class="flex justify-between items-center w-full py-4 text-left text-gray-800 font-semibold faq-button">
              <span>Can I upgrade my subscription anytime?</span>
              <span class="transform transition-transform duration-300" data-rotation="0"><i
                  class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="hidden faq-answer text-gray-600 pb-5">
              Yes, during the upgrade process, you can choose to upgrade immediately or at the end of your billing
              cycle.
            </div>
          </div>
          <div class="border-b bg-white px-4 rounded-md">
            <button
              class="flex justify-between items-center w-full py-4 text-left text-gray-800 font-semibold faq-button">
              <span>Is there a free trial available?</span>
              <span class="transform transition-transform duration-300" data-rotation="0"><i
                  class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="hidden faq-answer text-gray-600 pb-5">
              Yes, we offer a free trial for you to explore our platform and create a limited number of QR codes before
              committing to a subscription.
            </div>
          </div>
          <div class="border-b bg-white px-4 rounded-md">
            <button
              class="flex justify-between items-center w-full py-4 text-left text-gray-800 font-semibold faq-button">
              <span>How many scans are allowed per QR code in the free trial?</span>
              <span class="transform transition-transform duration-300" data-rotation="0"><i
                  class="fa-solid fa-chevron-down"></i></span>
            </button>
            <div class="hidden faq-answer text-gray-600 pb-5">
              Each QR code allows a maximum of 10 scans. If you need more scans, you can upgrade your plan to access
              additional features.
            </div>
          </div>
          <!-- Add more FAQ items as needed -->
        </div>


      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".faq-button").on("click", function () {
        const $button = $(this); // The clicked button
        const $answer = $button.next(".faq-answer"); // The related answer
        const $icon = $button.find("[data-rotation]"); // The icon within the button
        const $allAnswers = $(".faq-answer"); // All answers
        const $allIcons = $("[data-rotation]"); // All icons

        // Close all other answers and reset their icons
        $allAnswers.not($answer).slideUp(300); // Slide up all except the clicked one
        $allIcons.not($icon).css("transform", "rotate(0deg)"); // Reset all icons

        // Toggle the clicked answer and rotate its icon
        $answer.slideToggle(300); // Slide toggle the current answer
        const isHidden = $answer.is(":hidden");
        $icon.css("transform", isHidden ? "rotate(0deg)" : "rotate(180deg)");
      });
    });


    function rtoggleFAQ(button) {
      const parentContainer = button.closest(".space-y-4"); // Get the container holding all FAQ items
      const allAnswers = parentContainer.querySelectorAll(".hidden"); // Select all hidden answers within the container
      const allIcons = parentContainer.querySelectorAll("[data-rotation]"); // Select all icons within the container
      const answer = button.nextElementSibling; // Get the answer related to the clicked button
      const icon = button.querySelector("[data-rotation]"); // Get the icon for the clicked button

      // Close all other answers and reset their icons
      allAnswers.forEach((ans) => {
        if (ans !== answer) ans.classList.add("hidden"); // Keep other answers closed
      });
      allIcons.forEach((ico) => {
        if (ico !== icon) ico.style.transform = "rotate(0deg)"; // Reset icons to initial state
      });

      // Toggle the visibility of the clicked answer
      answer.classList.toggle("hidden");

      // Rotate the icon for the clicked answer
      const rotation = answer.classList.contains("hidden") ? "0" : "180";
      icon.style.transform = `rotate(${rotation}deg)`;
    }


    function wtoggleFAQ(button) {
      const answer = button.nextElementSibling;
      const icon = button.querySelector("span[data-rotation]");

      // Toggle visibility of answer
      answer.classList.toggle("hidden");

      // Rotate icon
      const rotation = answer.classList.contains("hidden") ? "0" : "180";
      icon.style.transform = `rotate(${rotation}deg)`;
    }
  </script>
  <!-- Make sure to include Font Awesome in your HTML -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <section class="bg-white" id="contactus">
    <div class="container mx-auto px-4 py-16 sm:py-20 md:py-24 lg:py-28">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Contact Form -->
        <div>
          <h2 class="text-4xl font-extrabold text-gray-900 mb-6">
            We’re Here to Help
          </h2>
          <form class="space-y-6" id="contact_form" method="post" onsubmit="return false">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <input type="text" name="name" id="name" required placeholder="Full name"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
              <input type="email" name="email" id="email" required placeholder="Email Address"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>
            <div class="flex gap-4">
              <select
                class="w-1/3 px-3 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                name="countrycode" id="countrycode" readonly>
                <option value="+1">🇺🇸 USA (+1)</option>
                <option value="+91">🇮🇳 India (+91)</option>
                <option value="+44">🇬🇧 UK (+44)</option>
                <option value="+1">🇨🇦 Canada (+1)</option>
                <option value="+61">🇦🇺 Australia (+61)</option>
                <option value="+49">🇩🇪 Germany (+49)</option>
                <option value="+33">🇫🇷 France (+33)</option>
                <option value="+81">🇯🇵 Japan (+81)</option>
                <option value="+55">🇧🇷 Brazil (+55)</option>
                <option value="+971">🇦🇪 UAE (+971)</option>
                <option value="+966">🇸🇦 SA (+966)</option>
              </select>
              <input type="number" max="999999999999" name="phone" id="phone" required placeholder="Phone"
                class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>
            <textarea rows="4" placeholder="Message" name="message" id="message" required
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            <button type="submit"
              class="bg-[#00b8cbb5] w-full text-center text-white font-medium px-8 py-3 rounded-lg hover:bg-[#0097a5] transition-colors duration-300">
              SEND MESSAGE
            </button>
          </form>
        </div>

        <!-- Contact Information -->
        <div>

          <div class="space-y-8 rounded-lg p-6 bg-gradient-to-b from-[#00b8cbb5] to-white shadow-lg">
            <!-- Address Section -->
            <div class="flex items-start space-x-4">
              <div class="text-[#000] mt-1">
                <i class="fas fa-map-marker-alt text-lg"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">ADDRESS</h3>
                <p class="text-black text-lg">
                  2047 Cyrus Viaduct East<br />Jadynchester
                </p>
              </div>
            </div>

            <!-- Email Section -->
            <div class="flex items-start space-x-4">
              <div class="text-[#000] mt-1">
                <i class="fas fa-envelope text-lg"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">EMAIL</h3>
                <p class="text-black text-lg">
                  info@construct.com<br />support@construct.com
                </p>
              </div>
            </div>

            <!-- Phone Section -->
            <div class="flex items-start space-x-4">
              <div class="text-[#000] mt-1">
                <i class="fas fa-phone-alt text-lg"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">PHONE</h3>
                <p class="text-black text-lg">
                  1-313-845-3395<br />1-469-970-2609
                </p>
              </div>
            </div>

            <!-- Social Media Section -->
            <div class="flex space-x-4 pt-6">
              <a href="#"
                class="w-14 h-14 bg-[#00b8cb] rounded-full flex items-center justify-center text-white hover:bg-[#0097a5] transition-colors duration-300">
                <i class="fab fa-facebook-f text-xl"></i>
              </a>
              <a href="#"
                class="w-14 h-14 bg-[#00b8cb] rounded-full flex items-center justify-center text-white hover:bg-[#0097a5] transition-colors duration-300">
                <i class="fab fa-twitter text-xl"></i>
              </a>
              <a href="#"
                class="w-14 h-14 bg-[#00b8cb] rounded-full flex items-center justify-center text-white hover:bg-[#0097a5] transition-colors duration-300">
                <i class="fab fa-instagram text-xl"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <script>
    function toggleFAQ(button) {
      const answer = button.nextElementSibling;
      const icon = button.querySelector("span[data-rotation]");

      // Toggle visibility of answer
      answer.classList.toggle("hidden");

      // Rotate icon
      const rotation = answer.classList.contains("hidden") ? "0" : "180";
      icon.style.transform = `rotate(${rotation}deg)`;
    }
  </script>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white">
    <div class="container mx-auto py-1 sm:py-1 md:py-2 lg:py-2 sm:px-6 lg:max-w-screen-xl ">
      <div class="flex justify-center flex-wrap gap-5 space-x-8 mb-8 hidden">

      </div>
      <div class="text-center text-sm text-gray-400">
        © Copyright 2024. All Rights Reserved
      </div>
    </div>
  </footer>
  <a href="#"
    class="fixed bottom-4 right-4 bg-[#FFD700] text-[#1B2937] p-3 rounded-full shadow-lg hover:bg-[#C0C9D0] transition-all duration-300"
    aria-label="Scroll to top">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
      stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
    </svg>
  </a>
  <a href="#"
    class="fixed bottom-4 right-4 bg-[#FFD700] text-[#1B2937] p-3 rounded-full shadow-lg hover:bg-[#C0C9D0] transition-all duration-300"
    aria-label="Scroll to top">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
      stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
    </svg>
  </a>
  <script>
    document.querySelector('a[href="#"]').addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  </script>
  <script>
    // Countdown Timer Logic (optional)
    /*  const countdownBoxes = document.querySelectorAll(".card span:first-child"); // Selects the span with the number in each card
      let timeLeft = {
        days: 30,
        hours: 15,
        minutes: 28,
        seconds: 54,
      };
  
      setInterval(() => {
        if (timeLeft.seconds > 0) {
          timeLeft.seconds--;
        } else if (timeLeft.minutes > 0) {
          timeLeft.minutes--;
          timeLeft.seconds = 59;
        } else if (timeLeft.hours > 0) {
          timeLeft.hours--;
          timeLeft.minutes = 59;
          timeLeft.seconds = 59;
        } else if (timeLeft.days > 0) {
          timeLeft.days--;
          timeLeft.hours = 23;
          timeLeft.minutes = 59;
          timeLeft.seconds = 59;
        }
  
        const values = [
          String(timeLeft.days).padStart(2, "0"),
          String(timeLeft.hours).padStart(2, "0"),
          String(timeLeft.minutes).padStart(2, "0"),
          String(timeLeft.seconds).padStart(2, "0"),
        ];
  
        countdownBoxes.forEach((box, index) => {
          box.textContent = values[index]; // Update the text of each countdown number
        });
      }, 1000); */

    document.addEventListener("DOMContentLoaded", () => {
      // Define the start and end dates
      const startDate = new Date("12/27/2024").getTime();
      const endDate = new Date("01/31/2025 23:59:59").getTime();

      const updateCountdown = () => {
        const currentTime = new Date().getTime();

        if (currentTime < startDate) {
          document.querySelector(".countdown-box").innerHTML =
            "<p class='text-center text-blue-500'>Countdown hasn't started yet</p>";
          return;
        }

        const timeLeft = endDate - currentTime;

        if (timeLeft <= 0) {
          // If the countdown has ended
          document.querySelector(".countdown-box").innerHTML =
            "<p class='text-center text-red-500'>Countdown Complete</p>";
          return;
        }

        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
          (timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Update the DOM
        document.querySelectorAll(".countdown-box .card span:first-child")[0].textContent = days;
        document.querySelectorAll(".countdown-box .card span:first-child")[1].textContent = hours;
        document.querySelectorAll(".countdown-box .card span:first-child")[2].textContent = minutes;
        document.querySelectorAll(".countdown-box .card span:first-child")[3].textContent = seconds;
      };

      // Initial call
      updateCountdown();

      // Update every second
      setInterval(updateCountdown, 1000);
    });
  </script>



  </script>
  <script>
    const menuToggle = document.getElementById("menuToggle");
    const menuOverlay = document.getElementById("menuOverlay");
    const mobileMenu = document.getElementById("mobileMenu");
    const menuClose = document.getElementById("menuClose");

    menuToggle.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
      menuOverlay.classList.toggle("show");
    });

    menuClose.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    });

    menuOverlay.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    });
    const menuLinks = document.querySelectorAll("#mobileMenu nav a");
    menuLinks.forEach(link => {
      link.addEventListener("click", closeMobileMenu);
    });

    function closeMobileMenu() {
      const mobileMenu = document.getElementById("mobileMenu");
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    }

  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $("#contact_form").on('submit', function () {
        $("#loadingIndicator").removeClass('hidden');
        $.ajax({
          method: "POST",
          url: "qrbackend/savecontact.php",
          data: $("#contact_form").serialize(),
          success: function (response) {
            if (response == 1) {
              $(".success").text('Enquiry Added Successfully').addClass('text-green-500');
              setTimeout(function () {
                // Send a request to clear session data after 5 seconds
                location.reload();
              }, 3000);

            } else {
              $(".success").text('contact admin');
            }
          },
          complete: function (data) {
            $("#loadingIndicator").addClass('hidden');
          }
        });
      })

    })
  </script>



</body>

</html>