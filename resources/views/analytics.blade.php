

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

        <!-- Header -->
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between bg-gray-800 p-6 rounded-lg shadow-lg">
          <div>
            <h1 class="text-4xl font-bold text-gray-100">WTM_EN24</h1>
            <div class="flex flex-wrap items-center gap-6 mt-2 text-sm text-gray-400">
              <span class="px-3 py-1 rounded-full bg-gray-700">WEBSITE</span>
              <span class="px-3 py-1 rounded-full bg-gray-700">Oct 27, 2024</span>
              <span class="px-3 py-1 rounded-full bg-gray-700">No folder</span>
            </div>
          </div>
          <div class="flex gap-4">
            <button class="flex items-center gap-2 px-4 py-2 rounded-lg text-blue-500 hover:text-blue-400 border border-blue-500 hover:border-blue-400 transition duration-200">
              <i class="fas fa-edit h-5 w-5"></i>
              Edit
            </button>
            <button class="flex items-center gap-2 px-4 py-2 rounded-lg text-blue-500 hover:text-blue-400 border border-blue-500 hover:border-blue-400 transition duration-200">
              <i class="fas fa-download h-5 w-5"></i>
              Download
            </button>
          </div>
        </div>
        
    
        <!-- Quick Stats -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <div class="text-sm font-medium text-gray-400">CAMPAIGN START</div>
            <div class="mt-2 text-2xl font-semibold text-gray-200">Oct 27, 2024</div>
          </div>
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <div class="text-sm font-medium text-gray-400">CAMPAIGN END</div>
            <div class="mt-2 text-2xl font-semibold text-gray-200">Nov 7, 2024</div>
          </div>
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <div class="text-sm font-medium text-gray-400">TOTAL SCANS</div>
            <div class="mt-2 text-2xl font-semibold text-gray-200">78</div>
          </div>
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <div class="text-sm font-medium text-gray-400">UNIQUE SCANS</div>
            <div class="mt-2 text-2xl font-semibold text-gray-200">71</div>
          </div>
        </div>
    
        <!-- Scans Section -->
        <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
          <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap items-center gap-4">
              <h2 class="text-lg font-semibold text-gray-200">Scans</h2>
              <button class="flex items-center gap-2 rounded-md border border-gray-700 px-3 py-1.5 text-sm hover:bg-gray-700">
                <i class="fas fa-calendar-alt h-4 w-4"></i>
                Oct 27, 2024 - Nov 7, 2024
              </button>
              <div class="flex rounded-md border border-gray-700">
                <button class="px-3 py-1.5 text-sm hover:bg-gray-700">Day</button>
                <button class="px-3 py-1.5 text-sm hover:bg-gray-700">Week</button>
                <button class="px-3 py-1.5 text-sm hover:bg-gray-700">Month</button>
              </div>
            </div>
            <div class="flex flex-wrap items-center gap-4">
              <button class="flex items-center gap-2 text-blue-500 hover:text-blue-400 transition duration-200">
                <i class="fas fa-sync h-4 w-4"></i>
                Reset Scans
              </button>
              <button class="flex items-center gap-2 text-blue-500 hover:text-blue-400 transition duration-200">
                <i class="fas fa-download h-4 w-4"></i>
                Download CSV
              </button>
            </div>
          </div>
    
          <!-- Charts -->
          <div class="grid gap-8 md:grid-cols-2">
            <div class="space-y-4">
              <h3 class="font-semibold text-gray-200">OVER TIME</h3>
              <div class="chart-container">
                <canvas id="lineChart" class="h-64 w-full"></canvas>
              </div>
            </div>
            <div class="space-y-4">
              <h3 class="font-semibold text-gray-200">OPERATING SYSTEM</h3>
              <div class="chart-container">
                <canvas id="barChart" class="h-64 w-full"></canvas>
              </div>
            </div>
          </div>
        </div>
    
        <!-- Bottom Tables -->
        <div class="grid gap-6 md:grid-cols-2">
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <h3 class="mb-4 font-semibold text-gray-200">TOP COUNTRIES</h3>
            <div class="space-y-4">
              <div class="flex items-center justify-between text-gray-400">
                <span>United Kingdom</span>
                <div class="flex items-center gap-4">
                  <span>37</span>
                  <span class="w-16 text-right">75.58%</span>
                </div>
              </div>
              <div class="flex items-center justify-between text-gray-400">
                <span>United States</span>
                <div class="flex items-center gap-4">
                  <span>28</span>
                  <span class="w-16 text-right">57.85%</span>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg bg-gray-800 p-6 shadow-lg">
            <h3 class="mb-4 font-semibold text-gray-200">TOP CITIES</h3>
            <div class="space-y-4">
              <div class="flex items-center justify-between text-gray-400">
                <span>Canning Town</span>
                <div class="flex items-center gap-4">
                  <span>25</span>
                  <span class="w-16 text-right">33.65%</span>
                </div>
              </div>
              <div class="flex items-center justify-between text-gray-400">
                <span>New York</span>
                <div class="flex items-center gap-4">
                  <span>20</span>
                  <span class="w-16 text-right">25.35%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <script>
        // Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
          type: 'line',
          data: {
            labels: ['Oct 27', 'Oct 28', 'Oct 29', 'Oct 30', 'Oct 31', 'Nov 1', 'Nov 2'],
            datasets: [{
              label: 'Scans Over Time',
              data: [5, 10, 8, 13, 9, 15, 12],
              borderColor: '#3B82F6',
              fill: false,
              tension: 0.4
            }]
          },
          options: {
            responsive: true,
            scales: {
              x: {
                grid: { color: '#333' },
                ticks: { color: '#fff' }
              },
              y: {
                grid: { color: '#333' },
                ticks: { color: '#fff' }
              }
            }
          }
        });
    
        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: ['Windows', 'MacOS', 'Linux', 'Android', 'iOS'],
            datasets: [{
              label: 'Operating System Usage',
              data: [55, 25, 10, 5, 5],
              backgroundColor: '#3B82F6',
              borderColor: '#2563EB',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            scales: {
              x: {
                grid: { color: '#333' },
                ticks: { color: '#fff' }
              },
              y: {
                grid: { color: '#333' },
                ticks: { color: '#fff' }
              }
            }
          }
        });
      </script>

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

  <script>
    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['Oct 27', 'Oct 28', 'Oct 29', 'Oct 30', 'Oct 31', 'Nov 1', 'Nov 2'],
        datasets: [{
          label: 'Scans Over Time',
          data: [5, 10, 8, 13, 9, 15, 12],
          borderColor: '#3B82F6',
          fill: false,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            grid: { color: '#333' },
            ticks: { color: '#fff' }
          },
          y: {
            grid: { color: '#333' },
            ticks: { color: '#fff' }
          }
        }
      }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Windows', 'MacOS', 'Linux', 'Android', 'iOS'],
        datasets: [{
          label: 'Operating System Usage',
          data: [55, 25, 10, 5, 5],
          backgroundColor: '#3B82F6',
          borderColor: '#2563EB',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            grid: { color: '#333' },
            ticks: { color: '#fff' }
          },
          y: {
            grid: { color: '#333' },
            ticks: { color: '#fff' }
          }
        }
      }
    });
  </script>
</html>



