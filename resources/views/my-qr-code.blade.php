<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My QR-Code</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Custom CSS for Date Input */
      .date-input {
        border: 1px solid #4B5563;
        border-radius: 0.375rem;
        background-color: #1F2937;
        color: #E5E7EB;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
      }
  
      .date-input:hover,
      .date-input:focus {
        border-color: #3B82F6;
        background-color: #374151;
      }
  
      /* Custom Styling for the Charts */
      .chart-container {
        background-color: #2D3748;
        border-radius: 0.375rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
  
      .chart-container canvas {
        border-radius: 0.375rem;
      }
    </style>
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
  </head>

  <body class="bg-background container mx-auto text-white font-sans">

    <div class="lg:flex flex-col h-screen">

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
              <a href="/Profile.html"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
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

      <div class="mx-auto w-full lg:pl-72 space-y-6">
        <section class="my-8 mt-10 bg-gray-700 rounded-lg p-5">
            <h2 class="text-2xl font-semibold mb-4">My Folders</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4" id="foldersGrid">
              <!-- Folder Items -->
            </div>
          </section>
      
          <section class="bg-gray-800 rounded-lg shadow-lg">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
              <div class="flex items-center space-x-2">
                <h2 class="text-lg font-semibold">QR Codes (79)</h2>
                <span class="text-gray-500">|</span>
                <button class="text-gray-400 hover:text-gray-200 flex items-center space-x-1">
                  <i class="fas fa-filter"></i>
                  <span>Filters</span>
                </button>
              </div>
              <div class="flex items-center space-x-4">
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-tag"></i>
                  <span>Label</span>
                </button>
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-download"></i>
                  <span>Download</span>
                </button>
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-upload"></i>
                  <span>Bulk Upload</span>
                </button>
              </div>
            </div>
      
            <!-- QR Code Items -->
            <div class="divide-y divide-gray-700" id="qrCodesList">
              <!-- QR Code Items -->
            </div>
          </section>
      
          <!-- Pagination -->
          <div class="p-4 flex justify-between items-center" id="pagination">
            <button class="text-gray-400 hover:text-gray-200" id="prevPage">Previous</button>
            <span class="text-gray-400" id="pageInfo">Page 1</span>
            <button class="text-gray-400 hover:text-gray-200" id="nextPage">Next</button>
          </div>
    
         <!-- QR Code Items -->
         <div class="divide-y divide-gray-700">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Project Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Usage</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Date</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qrCodes as $qrCode)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2 text-white">{{ $qrCode->projectname }}</td>
                            <td class="px-4 py-2 text-gray-400">{{ $qrCode->usage }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $qrCode->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $qrCode->qr_code_svg }}</td>
                           
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('mysms') }}" class="text-blue-400 hover:text-blue-500">View</a>
                                <a href="" class="text-blue-400 hover:text-blue-500">Download</a>
                                <form action="" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
      </div>
    
</html>




