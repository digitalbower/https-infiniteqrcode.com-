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
</head>

<body class="bg-background text-white font-sans">

    <div class="flex flex-col h-screen">

        <header
            class="bg-gradient-to-l lg:hidden from-[#5f72ab36] bg-opecity-40 to-white text-white p-4 flex justify-between items-center">
            <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
            <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <!-- Tabs (Visible on Desktop) -->
            <nav class="hidden lg:flex space-x-6">
                <button class="text-white hover:text-primary">Dashboard</button>
                <a href="/Profile.html"> <button class="text-white hover:text-primary">Profile</button></a>
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
                    <img src="/download.jpeg" alt="User Profile" class="w-full h-full object-cover rounded-full" />
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
                        <a href="/Profile.html"
                            class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-user mr-3"></i> Profile
                        </a>
                    </li>

                    <!-- Profile -->

                    <!-- QR Code Generator -->
                    <li>
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-qrcode mr-3"></i> Analytics
                        </button>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="relative group">
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700"
                            onclick="toggleDropdown(this)">
                            <i class="fas fa-qrcode mr-3"></i> Create QR Code
                            <i class="fas fa-chevron-down ml-auto"></i>
                        </button>
                        <div class=" left-0 h-full hidden mt-1 w-full bg-gray-800 rounded shadow-md dropdown-items">
                            <ul class="divide-y divide-gray-700">
                                <!-- Dropdown Items with Font Awesome Icons -->
                                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-link mr-2"></i> URL</a></li>
                                <li><a href="/vcard.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-address-card mr-2"></i> vCard</a></li>
                                <li><a href="/text.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-font mr-2"></i> Text</a></li>
                                <li><a href="/emailform.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-envelope mr-2"></i> Email</a></li>
                                <li><a href="/sms.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-sms mr-2"></i> SMS</a></li>
                                <li><a href="/wifi.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-wifi mr-2"></i> Wi-Fi</a></li>
                                <li><a href="/Bitcoin.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-btc mr-2"></i> Bitcoin</a></li>
                                <li><a href="/Twitter.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-twitter mr-2"></i> Twitter</a></li>
                                <li><a href="/Epc.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-cogs mr-2"></i> EPC</a></li>
                                <li><a href="/Pdf.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-file-pdf mr-2"></i> PDF</a></li>
                                <li><a href="/mp3.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-headphones-alt mr-2"></i> MP3</a></li>
                                <li><a href="/image.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-image mr-2"></i> Images</a></li>
                                <li><a href="/video.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-video mr-2"></i> Video</a></li>
                                <li><a href="/app-store.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-store mr-2"></i> App Stores</a></li>
                                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-sync-alt mr-2"></i> Dynamic URL</a></li>
                                <li><a href="/facebook.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-facebook mr-2"></i> Facebook</a></li>
                                <li><a href="/Instagram.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-instagram mr-2"></i>Instagram</a></li>

                                <li><a href="/Event.html" class="block px-4 py-2 hover:bg-gray-700"><i
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
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
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

        <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">
            <div class="container mx-auto lg:pt-12 sm:px-0 lg:px-6 sm:px- lg:px-12 space-y-8">
              <!-- Current Subscription Status -->
              <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden ">
                <div class="md:p-6 p-2 ">
                  <h2 class="text-2xl font-bold text-gray-100 mb-2">Your Current Subscription</h2>
                  <p class="text-gray-400 mb-6">Details of your active subscription plan.</p>
                  <div class="flex items-start justify-between mb-6">
                    <div>
                      <h3 class="text-3xl font-bold text-gray-100"> Plan</h3>
                      <p class="text-xl text-gray-400">$50/month</p>
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Upgrade</button>
                  </div>
                  <div class="flex gap-6 mb-6">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-calendar-days text-gray-400"></i>
                      <span class="text-sm">Start Date: 23 Jan 2025</span>
                      
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-calendar-days text-gray-400"></i>
                      <span class="text-sm">Next Billing: 23 Feb 2025</span>
                    </div>
                  </div>
                  <div class="bg-blue-900 border border-blue-700 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                      <i class="fas fa-exclamation-circle text-blue-400 mt-1 mr-3"></i>
                        {{-- if free plan --}}
                        <div>
                          <h4 class="text-blue-100 font-semibold">Upgrade Your QR Code Experience</h4>
                          <p class="text-blue-200"> You're currently on the Free Plan. Upgrade to create and manage more QR codes with extended features! </p>
                        </div>
                        {{-- if basic plan --}}
                        <div>
                          <h4 class="text-blue-100 font-semibold">Upgrade Your QR Code Experience</h4>
                          <p class="text-blue-200"> You're currently on the Basic Plan. Upgrade before 23 feb 2025 to unlock advanced features and manage more QR codes! </p>
                        </div>
                      {{-- if pro plan --}}
                        <div>
                          <h4 class="text-blue-100 font-semibold"> Reach the Top with Expert Plan.</h4>
                          <p class="text-blue-200"> You're on the Pro Plan. Upgrade before [23 feb 2025] to enjoy the ultimate features and unlimited QR code management with the Expert Plan! </p>
                        </div> 
                        {{-- if expert plan --}}
                        <div>
                          <h4 class="text-blue-100 font-semibold"> Stay at the Top! </h4>
                          <p class="text-blue-200"> You're on the highest plan—Expert. Renew before [23 feb 2025] to continue enjoying premium features and unlimited flexibility! </p>
                        </div>
                    </div>
                  </div>
      
                 {{-- enable auto renew free --}}
                    <div class="flex items-center justify-between mb-6">
                      <div>
                        <label for="auto-renew" class="text-gray-100 font-medium">Enabled auto-renew</label>
                        <p class="text-sm text-gray-400">
                          Your subscription will automatically renew when it expires
                        </p>
                      </div>
                      <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="1" class="sr-only peer" id="autorenew" >
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                      </label>
                    </div>
                
      
                   {{-- enable auto renew basic --}}
                    <div>
                      <label for="auto-renew" class="text-gray-100 font-medium"> Autorenew Disabled </label>
                      <p class="text-sm text-gray-400">
                        Your auto-renew option is disabled. Renew your plan before [23 feb 2025] to continue enjoying uninterrupted access to all features and benefits.
                      </p>
                    </div>
                   {{-- enable auto renew pro --}}
                    <div>
                      <label for="auto-renew" class="text-gray-100 font-medium"> Reactivate Your Plan Today </label>
                      <p class="text-sm text-gray-400">
                        Your plan has been canceled. Reactivate before [23 feb 2025] to regain access to all features and benefits.
                      </p>
                    </div>
                 {{-- features --}}
                    <div>
                      <label for="auto-renew" class="text-gray-100 font-medium"> Activate a Plan to Unlock Features </label>
                      <p class="text-sm text-gray-400">
                        Your current plan has expired or is inactive. Choose a plan today to access advanced features and manage your QR codes effortlessly.
                      </p>
                    </div>
      
      
                
                  <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 mt-3 " id="cancel">
                    Cancel Subscription
                  </button>
                  <!-- Payment Methods -->
                  <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden " id="card-info">
                    <div class="p-6">
                      <h2 class="text-2xl font-bold text-gray-100 mb-2">Payment Methods</h2>
                      <p class="text-gray-400 mb-6">Manage your payment methods</p>
                      <div class="grid gap-4 md:grid-cols-2">
                        <div class="bg-gray-700 border border-gray-600 rounded-lg p-4" id="multicard">
                       
                        </div>
                        <div class="border border-dashed border-gray-600 bg-gray-700 rounded-lg p-4" id="addcard">
                          <button id="openModalBtn" class="w-full h-full flex items-center justify-center text-gray-400 hover:text-gray-100 hover:bg-gray-600 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Card
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Billing History -->
                  <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden ">
                    <div class="p-6">
                      <h2 class="text-2xl font-bold text-gray-100 mb-2">Billing History</h2>
                      <p class="text-gray-400 mb-6">View your past transactions</p>
                      <div class="overflow-x-auto">
                        <table class="w-full">
                          <thead>
                            <tr class="border-b border-gray-700">
                              <th class="text-left py-3 px-4 text-gray-400">Plan Start</th>
                              <th class="text-left py-3 px-4 text-gray-400">Plan End</th>
                              <th class="text-left py-3 px-4 text-gray-400">Amount</th>
                              <th class="text-left py-3 px-4 text-gray-400">Invoice</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </main>
          <div
            id="modalOverlay"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative">
              <!-- Close Button -->
              <button
                id="closeModalBtn"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">
                &times;
              </button>
              <h2 class="text-xl font-semibold text-gray-800">Enter Card Details</h2>
              <p class="text-gray-600 mt-1">Fill in the form below to add your card.</p>
              <!-- Card Form -->
              <form id="cardForm" class="mt-4" action="#" method="post" onsubmit="return false;">
                <div class="mb-4">
                  <label for="cardName" class="block text-sm font-medium text-gray-700">
                    Cardholder Name
                  </label>
                  <input
                    type="text"
                    id="cardName" readonly
                    name="cardName" value=""
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-500"
                    placeholder="John Doe"
                    required>
                </div>
                <div class="mb-4">
                  <div id="card-element"></div>
                </div>
                <div id="card-errors" class="text-red-700"></div>
                <button
                  type="submit"
                  class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition">
                  Save Card
                </button>
              </form>
            </div>
          </div>
        </div>


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
