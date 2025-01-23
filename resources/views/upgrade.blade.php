
         
         

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet">
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
  </head>

  <body class="bg-background text-white font-sans">

    <div class="flex flex-col h-screen">

      <header
      class="bg-gradient-to-l lg:hidden from-[#5f72ab36] bg-opecity-40 to-white text-white p-4 flex justify-between items-center">
      <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
      <button id="menu-toggle"
        class="text-white focus:outline-none lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <!-- Tabs (Visible on Desktop) -->
      <nav class="hidden lg:flex space-x-6">
        <button class="text-white hover:text-primary">Dashboard</button>
        <a href="/Profile.html"> <button
            class="text-white hover:text-primary">Profile</button></a>
        <button class="text-white hover:text-primary">QR Code
          Generator</button>
        <button class="text-white hover:text-primary">Yields</button>
      </nav>
    </header>

    <!-- Sidebar (Hidden on Mobile) -->
    <aside id="sidebar"
      class="fixed overflow-y-auto pb-50 top-0 shad left-0 w-10/12 lg:w-64 h-screen  bg-gradient-to-t from-[#1F2937] from-50% to-white text-white p-4 z-50 transition-all transform -translate-x-full lg:translate-x-0 lg:block">
      <div class="flex justify-between items-center py-2 mb-8">
        <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
      </div>

      <div class="text-center mb-8">
        <div class="w-16 h-16 mx-auto relative mb-2 rounded-full bg-gray-500">
          <img src="/download.jpeg" alt="User Profile"
            class="w-full h-full object-cover rounded-full" />
          <div
            class="absolute -bottom-1 -left-3 bg-white flex items-center p-3 w-8 h-8 rounded-full justify-center">
            <i class="fas fa-edit text-[#6c8ef6] text-xl mx-auto "></i>
          </div>
        </div>
        <p class="font-semibold">Esther Howard</p>
      </div>

      <nav class="flex-1 px py-6">
        <ul class="space-y-2">
          <!-- Dashboard -->
          <li>
            <a href="/"
              class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="/Choose-QR-Code.html"
              class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-tachometer-alt mr-3"></i> Choose QR Code
            </a>
          </li>
          <li>
            <a href="/Profile.html" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-user mr-3"></i> Profile
            </a>
          </li>
          
          <!-- Profile -->
         
          <!-- QR Code Generator -->
          <li>
            <button
              class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-qrcode mr-3"></i> Analytics
            </button>
          </li>
          <!-- Dropdown Menu -->
          <li class="relative group">
            <button
              class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700"
              onclick="toggleDropdown(this)">
              <i class="fas fa-qrcode mr-3"></i> Create QR Code
              <i class="fas fa-chevron-down ml-auto"></i>
            </button>
            <div
              class=" left-0 h-full hidden mt-1 w-full bg-gray-800 rounded shadow-md dropdown-items">
              <ul class="divide-y divide-gray-700">
                <!-- Dropdown Items with Font Awesome Icons -->
                <li><a href="/Url.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-link mr-2"></i> URL</a></li>
                <li><a href="/vcard.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-address-card mr-2"></i> vCard</a></li>
                <li><a href="/text.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-font mr-2"></i> Text</a></li>
                <li><a href="/emailform.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-envelope mr-2"></i> Email</a></li>
                <li><a href="/sms.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-sms mr-2"></i> SMS</a></li>
                <li><a href="/wifi.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-wifi mr-2"></i> Wi-Fi</a></li>
                <li><a href="/Bitcoin.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-btc mr-2"></i> Bitcoin</a></li>
                <li><a href="/Twitter.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fab fa-twitter mr-2"></i> Twitter</a></li>
                <li><a href="/Epc.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-cogs mr-2"></i> EPC</a></li>
                <li><a href="/Pdf.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-file-pdf mr-2"></i> PDF</a></li>
                <li><a href="/mp3.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-headphones-alt mr-2"></i> MP3</a></li>
                <li><a href="/image.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-image mr-2"></i> Images</a></li>
                <li><a href="/video.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-video mr-2"></i> Video</a></li>
                <li><a href="/app-store.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-store mr-2"></i> App Stores</a></li>
                <li><a href="/Url.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-sync-alt mr-2"></i> Dynamic URL</a></li>
                <li><a href="/facebook.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fab fa-facebook mr-2"></i> Facebook</a></li>
                <li><a href="/Instagram.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fab fa-instagram mr-2"></i>Instagram</a></li>

                <li><a href="/Event.html"
                    class="block px-4 py-2 hover:bg-gray-700"><i
                      class="fas fa-calendar-alt mr-2"></i> Event</a></li>
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
            <button
              class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
              <i class="fas fa-chart-line mr-3"></i> Yields
            </button>
          </li>
          <li class="mx-0 pt-4">
            <button
              class="bg-[#6c8ef6] flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-[#6c8ef6] transition duration-300">
              <i class="fas fa-arrow-up mr-2"></i> Upgrade
            </button>
          </li>
          <li class="mx-0 pt-4">
            <button
              class="bg-[#F5A623] flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-[#F5A623] transition duration-300">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
          </li>
        </ul>
      </nav>

    </aside>

      <!-- Main Content Area -->
      <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">

        <script>
          // JavaScript for dynamic plan selection
          function selectPlan(plan) {
            const plans = document.querySelectorAll('.plan-details');
            plans.forEach((el) => el.classList.add('hidden'));
            document.getElementById(plan).classList.remove('hidden');
            
            // Update button styles based on selected plan
            const buttons = document.querySelectorAll('.plan-button');
            buttons.forEach(button => button.classList.remove('border-blue-500', 'text-blue-500', 'font-medium'));
            const selectedButton = document.querySelector(`#${plan}-button`);
            selectedButton.classList.add('border-blue-500', 'text-blue-500', 'font-medium');
            
            // Update the payment section based on the selected plan
            updatePaymentDetails(plan);
          }
    
          // Update Payment details based on the selected plan
          function updatePaymentDetails(plan) {
            const monthlyCost = {
              basic: 10,
              pro: 20,
              expert: 30
            };
            const yearlyCost = {
              basic: 100,
              pro: 200,
              expert: 300
            };
    
            // Update the cost display
            const monthlyElement = document.querySelector("#monthly-cost");
            const yearlyElement = document.querySelector("#yearly-cost");
            const monthlyButton = document.querySelector("#monthly-button");
            const yearlyButton = document.querySelector("#yearly-button");
    
            monthlyElement.textContent = `$${monthlyCost[plan]}/month`;
            yearlyElement.textContent = `$${yearlyCost[plan]}/year`;
    
            // Set the default selected billing type
            monthlyButton.checked = true;
          }
    
          // Initialize with Basic plan details
          document.addEventListener("DOMContentLoaded", () => {
            selectPlan('basic');
          });
        </script>
     
        <div class="lg:grid lg:grid-cols-12 gap-0">
          <!-- Left Sidebar with Plan Selection -->
          <div class="col-span-5 border-r border-[#374151]  bg-background lg:h-screen top-0 lg:sticky">
            <div class="mb-8 pt-3 flex justify-center space-x-4 border-b">
              <button id="basic-button" onclick="selectPlan('basic')" class="plan-button border-b-2 px-4 py-2 border-transparent text-gray-100">
                Basic
              </button>
              <button id="pro-button" onclick="selectPlan('pro')" class="plan-button border-b-2 px-4 py-2 border-transparent text-gray-100">
                Pro
              </button>
              <button id="expert-button" onclick="selectPlan('expert')" class="plan-button border-b-2 px-4 py-2 border-transparent text-gray-100">
                Expert
              </button>
            </div>
    
            <!-- Plan Details -->
            <div class="lg:w-10/12 p-4 shadow-md mx-auto mb-5 text-black">
              <div id="basic" class="plan-details relative">
                <div class="rounded-xl bg-white p-6  shadow-sm">
                  <button class="mb-2  text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold">currently</button>
                  <h2 class="mb-2 text-2xl font-bold">Basic</h2>
                  <p class="mb-2 text-gray-900">For individuals starting their design journey.</p>
                  <div class="mb-2 text-3xl font-bold">
                    $10<span class="text-sm text-gray-900">/month</span>
                  </div>
                  <ul class="mb-2 space-y-4">
                    <li><i class="fas fa-check text-teal-500"></i> Kitti AI (20 credits/day)</li>
                    <li><i class="fas fa-check text-teal-500"></i> 5 projects</li>
                    <li><i class="fas fa-check text-teal-500"></i> 10GB Upload space</li>
                    <li><i class="fas fa-check text-teal-500"></i> Limited vector exports</li>
                    <li><i class="fas fa-check text-teal-500"></i> Basic templates</li>
                  </ul>
                  <button class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg  py-3 font-medium text-white bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                    Select Plan <i class="fas fa-arrow-right"></i>
                  </button>
                </div>
    
              </div>
    
              <div id="pro" class="plan-details hidden">
                <div class="rounded-xl border bg-white p-6 shadow-sm ring-2 ring-blue-500">
                  <h2 class="mb-2 text-2xl font-bold">Pro</h2>
                  <p class="mb-2 text-gray-900">For growing teams with advanced needs.</p>
                  <div class="mb-2 text-3xl font-bold">
                    $20<span class="text-sm text-gray-900">/month</span>
                  </div>
                  <ul class="mb-2 space-y-4">
                    <li><i class="fas fa-check text-teal-500"></i> Kitti AI (50 credits/day)</li>
                    <li><i class="fas fa-check text-teal-500"></i> 20 projects</li>
                    <li><i class="fas fa-check text-teal-500"></i> 50GB Upload space</li>
                  </ul>
                  <button class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg py-3 font-medium text-white  bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                    Select Plan <i class="fas fa-arrow-right"></i>
                  </button>
                </div>
              </div>
    
              <div id="expert" class="plan-details hidden">
                <div class="rounded-xl border bg-white p-6 shadow-sm ring-2 ring-blue-500">
                  <h2 class="mb-2 text-2xl font-bold">Expert</h2>
                  <p class="mb-2 text-gray-900">For professionals that need stunning designs without limitations.</p>
                  <div class="mb-2 text-3xl font-bold">
                    $30<span class="text-sm text-gray-900">/month</span>
                  </div>
                  <ul class="mb-2 space-y-4">
                    <li><i class="fas fa-check text-teal-500"></i> Kitti AI (80 credits/day)</li>
                    <li><i class="fas fa-check text-teal-500"></i> Unlimited projects</li>
                    <li><i class="fas fa-check text-teal-500"></i> 100GB Upload space</li>
                  </ul>
                  <button class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg  py-3 font-medium text-white  bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                    Select Plan <i class="fas fa-arrow-right"></i>
                  </button>
                </div>
              </div>
             
            </div>
         <dev>
             <div class="mt-6 py-5 px-10 lg:absolute   bottom-4  flex items-center w-full justify-between text-sm text-gray-100">
              <a>
               <Link href="#" class="flex items-center gap-1 hover:text-blue-500 transition duration-200">
    
                 Help
               </Link>
              </a>
              <a>
               <Link href="#" class="hover:text-blue-500 transition duration-200">
                 Compare Plans
               </Link>
              </a>
             </div>
         </dev>
          </div>
    
          <!-- Right Side (Plan Details and Payment Options) -->
          <div class="col-span-7 px-4">
            <div class="max-w-4xl mx-auto p-6 bg-white mt-10 shadow-lg rounded-xl">
                <!-- Header -->
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Upgrade to Expert Plan</h2>
        
                <!-- Payment Options Section: Left & Right Split -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Left Side: Yearly Payment Option -->
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                        <div class="text-lg font-semibold text-gray-800">Pay Yearly - Save 30%</div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-xl font-semibold text-gray-900">$24/month</span>
                            <span class="text-sm text-gray-600">Billed annually</span>
                        </div>
                        <label class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                            <input type="radio" name="billing" class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500" />
                            <span class="text-sm text-gray-700">Select Yearly</span>
                        </label>
                    </div>
        
                    <!-- Right Side: Monthly Payment Option -->
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                        <div class="text-lg font-semibold text-gray-800">Pay Monthly</div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-xl font-semibold text-gray-900">$30/month</span>
                            <span class="text-sm text-gray-600">Billed monthly</span>
                        </div>
                        <label class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                            <input type="radio" name="billing" class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500" defaultChecked />
                            <span class="text-sm text-gray-700">Select Monthly</span>
                        </label>
                    </div>
                </div>
        
                <!-- User Information Section -->
                <div class="mt-3 space-y-3">
                    <!-- User Name Field -->
                  
        
                    <!-- Credit Card Info Section -->
                    <div class="mt-3">
                        <label for="creditCard" class="text-lg font-semibold text-gray-800">Credit Card Information</label>
                        <input type="text" id="creditCard" class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Card Number" required />
                    </div>
        
                    <!-- Expiry Date and CVV -->
                    <div class="mt-3 flex space-x-3">
                        <input type="text" id="expiryDate" class="w-1/2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="MM/YY" required />
                        <input type="text" id="cvv" class="w-1/2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="CVV" required />
                    </div>
                </div>
        
                <!-- Plan Details Section: Left & Right -->
                <div class="mt-3 space-y-3">
                    <div class="mt-3 border-t pt-4">
                        <div class="mb-1 flex items-center justify-between text-lg font-semibold">
                            <span class="text-gray-600">Type Plan</span>
                            <span class="text-base font-semibold text-gray-900">Included</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-gray-900">$30.00</span>
                            </div>
                        </div>
                    </div>
        
                    <div class="mt-3 border-t pt-4">
                        <div class="mb-1 flex items-center justify-between text-lg font-semibold">
                            <span class="text-gray-600">Kitti Credits</span>
                            <span class="text-lg font-semibold text-gray-900">Included</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-100">
                            <div class="flex w-full items-center gap-2">
                                <p class="text-gray-600 block text-base w-full font-semibold">100 credits/month</p>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Payment Summary Section -->
                <div class="mt-3 border-t pt-4">
                    <div class="mb-4 flex items-center justify-between text-lg font-semibold">
                        <span class="text-gray-600">Payment due today, January 20, 2023</span>
                        <span class="text-xl font-bold text-gray-900">$30.00</span>
                    </div>
                    <div class="flex text-gray-800 items-center justify-between text-sm text-gray-100">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-800">Credit Card</span>
                        </div>
                        <span>Visa •••• 4242</span>
                    </div>
                </div>
        
                <!-- Action Button -->
                <button class="mt-3 w-full rounded-lg bg-[#6c8ef6]  bg-opacity-80 hover:bg-opacity-100 py-3 text-white text-lg font-semibold transition duration-300">
                    Confirm Change
                </button>
            </div>
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

  </body>

</html>


  