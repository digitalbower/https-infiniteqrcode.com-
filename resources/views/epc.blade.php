                         

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

        <div class="container mx-auto pb-12 md:px-6 sm:px-8 lg:px-12">
          <div class="flex-1 w-full p-4 lg:px-12">
            <div class="container text-center mx-auto pt-2  lg:px-12">
              <h1
                class="text-4xl text-center font-extrabold text-center mb-10 text-white border-[#F5A623] border-b-4 pb-3 inline-block">
                Create Your URL QR Code
              </h1>
            </div>

            <!-- Step Container -->
            <div class="flex items-center justify-center mb-5 space-x-0">
              <!-- Step 1 -->
              <div
                class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#F5A623] bg-opacity-90 shadow-md transition duration-300">
                <svg stroke="currentColor" fill="none" stroke-width="2"
                  viewBox="0 0 24 24" stroke-linecap="round"
                  stroke-linejoin="round" class="h-5 w-5 text-white"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
              </div>

              <!-- Line Gap -->
              <div class="w-10 h-1 bg-gray-300"></div>

              <!-- Step 2 -->
              <div
                class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#F5A623] bg-opacity-90 shadow-md transition duration-300">
                2
              </div>
              <div class="w-10 h-1 bg-gray-300"></div>

              <!-- Step 2 -->
              <div
                class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#F5A623] bg-opacity-90 shadow-md transition duration-300">
                3
              </div>
            </div>

          </div>

          <div
            class="lg:lg:lg:grid lg:p-8 p-4 mb-6 bg-gray-950 rounded-lg border-gray-900 border shadow-sm gap-x-6 grid-cols-12">
            <div class="col-span-8">
              <div class="flex justify-start">
                <h2
                  class="text-2xl font-medium mb-3 text-center text-white">Content</h2>
              </div>
              <div
              class=" p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">
              <div class="space-y-4">
                <div class="mx-auto  lg:p-6 bg-white text-black">
                  <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Receiver's Name -->
                    <div class="mb-4">
                      <label for="receiver" class="block text-base mb-1 font-medium text-gray-700">Receiver's Name</label>
                      <input 
                        type="text" 
                        id="receiver" 
                        name="receiver" 
                        placeholder="Max 70 characters"
                        maxlength="70"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- IBAN -->
                    <div class="mb-4">
                      <label for="iban" class="block text-base mb-1 font-medium text-gray-700">IBAN</label>
                      <input 
                        type="text" 
                        id="iban" 
                        name="iban" 
                        placeholder="Example: IE35AIBK93115212345678"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- BIC/SWIFT -->
                    <div class="mb-4">
                      <label for="bic" class="block text-base mb-1 font-medium text-gray-700">BIC/SWIFT</label>
                      <input 
                        type="text" 
                        id="bic" 
                        name="bic" 
                        placeholder="Example: SPIWD530XXX"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- Amount -->
                    <div class="mb-4">
                      <label for="amount" class="block text-base mb-1 font-medium text-gray-700">Amount (EUR)</label>
                      <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        step="0.01" 
                        placeholder="0.00"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- Payment Reference -->
                    <div class="mb-4">
                      <label for="reference" class="block text-base mb-1 font-medium text-gray-700">Payment Reference</label>
                      <input 
                        type="text" 
                        id="reference" 
                        name="reference" 
                        placeholder="Optional, 35 characters max."
                        maxlength="35"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- Remittance Information -->
                    <div class="mb-4">
                      <label for="remittance" class="block text-base mb-1 font-medium text-gray-700">Remittance Information</label>
                      <input 
                        type="text" 
                        id="remittance" 
                        name="remittance" 
                        placeholder="Optional, 140 characters max."
                        maxlength="140"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- Service Tag (Read-only) -->
                    <div class="mb-4">
                      <label for="service-tag" class="block text-base mb-1 font-medium text-gray-700">Service Tag</label>
                      <input 
                        type="text" 
                        id="service-tag" 
                        name="service-tag" 
                        value="BCD" 
                        readonly 
                        class="w-full p-2 border border-gray-300 rounded-md bg-gray-200 cursor-not-allowed"
                      />
                    </div>
                    
                    <!-- Version -->
                    <div class="mb-4">
                      <label class="block text-base mb-1 font-medium text-gray-700">Version</label>
                      <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                          <input type="radio" id="001" name="version" value="001" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                          <label for="001" class="text-sm text-gray-700">001</label>
                        </div>
                        <div class="flex items-center space-x-2">
                          <input type="radio" id="003" name="version" value="003" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                          <label for="003" class="text-sm text-gray-700">003</label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Character Encoding -->
                    <div class="mb-4">
                      <label for="encoding" class="block text-base mb-1 font-medium text-gray-700">Character Encoding</label>
                      <select 
                        id="encoding" 
                        name="encoding"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      >
                        <option value="utf8">UTF-8</option>
                      </select>
                    </div>
                    
                    <!-- SEPA Credit Transfer (Read-only) -->
                    <div class="mb-4">
                      <label for="sepa" class="block text-base mb-1 font-medium text-gray-700">SEPA Credit Transfer</label>
                      <input 
                        type="text" 
                        id="sepa" 
                        name="sepa" 
                        value="SCT" 
                        readonly 
                        class="w-full p-2 border border-gray-300 rounded-md bg-gray-200 cursor-not-allowed"
                      />
                    </div>
                    
                    <!-- Purpose -->
                    <div class="mb-4">
                      <label for="purpose" class="block text-base mb-1 font-medium text-gray-700">Purpose</label>
                      <input 
                        type="text" 
                        id="purpose" 
                        name="purpose" 
                        placeholder="Four-letter code (e.g., CHAR)"
                        maxlength="4"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                    
                    <!-- Note -->
                    <div class="mb-4">
                      <label for="note" class="block text-base mb-1 font-medium text-gray-700">Note</label>
                      <input 
                        type="text" 
                        id="note" 
                        name="note" 
                        placeholder="Additional notes"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    </div>
                  </form>
                  
                </div>
            </div>
            </div>
              <div class="flex mt-10 justify-start">
                <h2
                  class="text-2xl font-medium mb-3 text-center text-white">Enter Basic Information</h2>
              </div>
              <div
              class="lg:p-4 p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">

                <div class="space-y-4">
                  <div class="mx-auto w-full lg:p-6 bg-white text-black">

                    <div class="space-y-4">

                      <!-- QR Project Name -->
                      <div>
                        <label for="projectName"
                          class="block font-medium text-gray-800">QR Project Name</label>
                        <input id="projectName" placeholder="Enter project name"
                          class="w-full p-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      </div>

                      <!-- Select Folder -->
                      <div>
                        <label for="folderinput"
                          class="block font-medium text-gray-800">Select Folder</label>
                        <div class="flex gap-x-4 items-center mt-2">
                          <button
                            class="p-1.5 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-100 transition duration-300">
                            <svg stroke="currentColor" fill="currentColor"
                              stroke-width="0" viewBox="0 0 512 512"
                              class="text-2xl mt-1 text-gray-700" height="1em"
                              width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                          </button>
                          <div
                            class="w-full p-2 mt-2 border flex justify-center border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <input id="folderinput" type="file" class="hidden">
                            <p
                              class="text-md font-medium text-gray-600">Document name:</p>
                          </div>
                        </div>
                      </div>

                      <!-- Date Range -->
                      <div
                        class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                        <div class="flex-1">
                          <label for="startDate"
                            class="block font-medium text-gray-800">Start Date</label>
                          <input  id="startDate"  min="<?php echo date('Y-m-d');?>" type="date"
                            class="w-full p-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex-1">
                          <label for="endDate"
                            class="block font-medium text-gray-800">End Date</label>
                          <input id="endDate" type="date"
                            class="w-full p-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                      </div>

                      <!-- Usage -->
                      <div>
                        <label for="usage"
                          class="block font-medium text-gray-800">Usage</label>
                        <select id="usage"
                          class="w-full p-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                          <option value>Select Usage</option>
                          <option value="personal">Personal</option>
                          <option value="business">Business</option>
                          <option value="event">Event</option>
                        </select>
                      </div>

                      <!-- Remarks -->
                      <div>
                        <label for="remarks"
                          class="block font-medium text-gray-800">Remarks</label>
                        <textarea id="remarks"
                          placeholder="Enter any additional remarks"
                          class="w-full p-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-4">
              <div class="w-full sticky lg:h-screen top-10 ">
                <div
                  class="bg-gray-900 border border-gray-800 rounded-lg shadow-lg">
                  <div class="p-6">
                    <div
                      class="bg-white aspect-square rounded-lg mb-6 shadow-sm">
                      <img src="/download.png" alt="QR Code Preview"
                        class="w-full h-full object-cover rounded-lg">
                    </div>
                    <button
                      class="w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:scale-105 transition-transform rounded-lg py-3 flex justify-center items-center">
                      <i class="fas fa-qrcode mr-2 text-lg"></i>
                      Download QR
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex justify-between mt-8">
            <butt hover:bg-[#F5A623]on
              class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">Previous</butt>
            <button
              class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Next</button>
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
     
                          
                     
                           
                      
                            
                    
                            
        