

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
      <div class=" flex-col lg:w-[80%]  ml-auto h-screen ">
      <div class="">
        <div class="mx-auto w-full space-y-6 bg-gray-800 p-3 py-6 ">
          <!-- Header -->
          <h3 class="text-4xl mb-3 px-2 lg:px-5 font-semibold text-white">
            Analytics
          </h3>
          <div class="px-2 lg:px-5">
            <p class="text-sm text-gray-100 mb-10">
              The QR Code Analytics page provides detailed insights into the performance of your QR codes. Track total
              scans,
              monitor usage trends, and analyze when and where your codes are being scanned. These insights help you
              understand engagement levels and optimize your campaigns effectively. Manage your QR code activity with ease
              and
              make informed decisions using real-time data.
            </p>
        
          </div>
          
          <div class=" px-2 lg:px-5">
  
            <div class="flex justify-start mb-3 items-center gap-x-2">
              <h3 class="sm:text-2xl text-lg  font-semibold text-white">
                Select Qr Code
              </h3>
              <select
    class="flex items-center gap-2 px-4 py-2 rounded-lg text-blue-500 hover:text-blue-400 bg-gray-900 border border-blue-500 hover:border-blue-400 transition duration-200"
    onchange="location.href='?id=' + this.value">
    <option value="no">Project Name</option>
    @foreach($projects as $project)
        <option value="{{ $project->project_code }}">{{ $project->project_name }}</option>
    @endforeach
</select>
            </div>
            <div class="flex flex-col gap-6 sm:flex-row mb-3 sm:justify-between ">
              <div class="flex gap-x-4 mb-3">
                <div class=" ">
                  <div class="relative inline-block"> <a target="_blank"
                      href="">
                      <img src="https://images.squarespace-cdn.com/content/v1/5d3f241fa4e0350001fa20d5/1636491460338-AIZAXV2978MGIDQE0GT7/qr-code.png" alt="" width="128px" height="128px" />
                      <h1 class="text-xl mt-3 font-bold text-gray-100">My Qrcode</h1>
                    </a>
                    <span
                      class="absolute top-2 left-2 text-sm px-3 py-1 rounded-full font-semibold">
                      
                    </span>
                  </div>
                </div>
                <div>
                  <div class="  gap-x-6 mt-0 text-xs sm:text-sm text-gray-400">
                    <p class="px-3 mb-2 py-1 rounded-full bg-gray-900">Static</p>
                    <p class="px-3 mb-2 py-1 rounded-full bg-gray-900">23 jan 2025</p>
                    <p class="px-3 mb-2 py-1 rounded-full bg-gray-900">Email</p>
                    <p
                      class=" px-3 mb-2 py-1 rounded-full">
                      Expired - Please Upgrade
                    </p>
                  </div>
                </div>
              </div>
              <div class=" gap-6  flex-row items-center mb-3 flex md:block justify-between">
                <button
                  class="flex items-center md:mb-5 gap-2 w-full text-center px-4 py-2 rounded-lg text-blue-500 hover:text-blue-400 border border-blue-500 hover:border-blue-400 transition duration-200">
                  <i class="fas fa-download h-5 w-5"></i>
                  <a href=""
                    download="">Download</a>
                </button>
                <button
                  class="flex items-center gap-2 w-full text-center px-4 py-2 w-full rounded-lg text-blue-500 hover:text-blue-400 border border-blue-500 hover:border-blue-400 transition duration-200 disabled:bg-gray-400 disabled:text-white disabled:cursor-not-allowed"
                  >
                  <i class="fas fa-edit h-5 w-5"></i>
                  Edit
                </button>
              </div>
            </div>
            <!-- Quick Stats -->
            <div class="grid gap-4 grid-cols-2 lg:grid-cols-4 mb-3">
              <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                <div class="text-sm font-medium text-gray-400">CAMPAIGN START</div>
                <div class="mt-2 text-lg sm:text-2xl font-semibold text-gray-200"></div>
              </div>
              <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                <div class="text-sm font-medium text-gray-400">CAMPAIGN END</div>
                <div class="mt-2 text-lg sm:text-2xl font-semibold text-gray-200">
                 
                </div>
              </div>
              <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                <div class="text-sm font-medium text-gray-400">TOTAL SCANS</div>
                <div class="mt-2 text-2xl font-semibold text-gray-200">
                 20
                </div>
              </div>
              <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                <div class="text-sm font-medium text-gray-400">UNIQUE SCANS</div>
                <div class="mt-2 text-2xl font-semibold text-gray-200">
                 5
                </div>
              </div>
            </div>
            <!-- Scans Section -->
            <div class="rounded-lg sm:bg-gray-900 sm:p-4 lg:p-6 shadow-lg mb-3">
              <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-4">
                  <h2 class="text-lg font-semibold text-gray-200">Scans</h2>
                  <button
                    class="flex items-center sm:w-auto w-full gap-2 rounded-md border border-gray-700 px-3 py-1.5 text-sm hover:bg-gray-900">
                    <i class="fas fa-calendar-alt h-4 w-4"></i>
                    <input class="bg-gray-800 sm:bg-gray-900" type="date" max="" id="start_Date" class="text-gray-700"> -
                    <input class="bg-gray-800 sm:bg-gray-900" type="date" max="" id="end_Date"
                      class="text-gray-700">
                  </button>
                  <div class="flex rounded-md sm:w-auto w-full justify-around border border-gray-700">
                    <button id="dayBtn" class="px-3 py-1.5 text-sm hover:bg-gray-900 ">Day</button>
                    <button id="weekBtn" class="px-3 py-1.5 text-sm hover:bg-gray-900">Week</button>
                    <button id="monthBtn" class="px-3 py-1.5 text-sm hover:bg-gray-900">Month</button>
                  </div>
                </div>
                <div class="flex flex-wrap  sm:w-auto w-full justify-around items-center gap-4">
                  <button class="flex items-center gap-2 text-blue-500 hover:text-blue-400 transition duration-200">
                    <i class="fas fa-sync h-4 w-4"></i>
                    Reset
                  </button>
                  <button class="flex items-center gap-2 text-blue-500 hover:text-blue-400 transition duration-200">
                    <i class="fas fa-download h-4 w-4"></i>
                    Download PDF
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
              <div class="rounded-lg bg-gray-900 p-4 lg:p-6 shadow-lg">
                <h3 class="mb-4 font-semibold text-center md:text-left text-gray-200">TOP COUNTRIES</h3>
                <div class="space-y-4">
                    <div class="flex flex-col items-center justify-center text-gray-500 py-10">
                      <i class="fas fa-globe text-4xl mb-4"></i>
                      <p class="text-lg font-semibold">No Countries data available</p>
                      <p class="text-sm text-center md:text-left">Please check back later or contact support for assistance.</p>
                    </div>
                </div>
              </div>
              <div class="rounded-lg bg-gray-900 p-4 lg:p-6 shadow-lg">
                <h3 class="mb-4 font-semibold text-center md:text-left text-gray-200">TOP CITIES</h3>
                <div class="space-y-4">
                    <div class="flex flex-col items-center justify-center text-gray-500 py-10">
                      <i class="fas fa-city text-4xl mb-4"></i>
                      <p class="text-lg font-semibold">No city data available</p>
                      <p class="text-sm text-center md:text-left">Please check back later or contact support for assistance.</p>
                    </div>
                </div>
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



