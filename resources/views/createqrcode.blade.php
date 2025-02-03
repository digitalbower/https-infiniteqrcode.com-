@extends('layouts.layout')
@section('title', 'Create Qr Codes')
@section('content')
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
  
  
@endsection
 