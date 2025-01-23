
              
              

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
    
        
    
      </div>
      <script>
         const folders = [
          { name: 'Ads', count: '12 QR Code', date: 'Jun 01, 2024' },
          { name: 'Restaurants', count: '25 QR Codes', date: 'May 28, 2024' },
          { name: 'Business', count: '16 QR Code', date: 'Feb 15, 2024' },
          { name: 'Brands', count: '5 QR Codes', date: 'Feb 12, 2024' },
          { name: 'Designs', count: '30 QR Codes', date: 'Jan 21, 2024' },
        ];
    
        // QR Codes Data
        const qrCodes = [
  { id: 1, title: "Business Card", url: "https://qrcodes.example.com/1", type: "Marketing", date: "2021-10-26" },
  { id: 2, title: "Feedback Form", url: "https://qrcodes.example.com/2", type: "Survey", date: "2021-11-01" },
  { id: 3, title: "Product Page", url: "https://qrcodes.example.com/3", type: "Marketing", date: "2021-12-15" },
  { id: 4, title: "Event Registration", url: "https://qrcodes.example.com/4", type: "Event", date: "2022-01-10" },
  { id: 5, title: "Exclusive Offer", url: "https://qrcodes.example.com/5", type: "Marketing", date: "2022-02-20" },
  { id: 6, title: "Customer Satisfaction Survey", url: "https://qrcodes.example.com/6", type: "Survey", date: "2022-03-15" },
  { id: 7, title: "Loyalty Program", url: "https://qrcodes.example.com/7", type: "Marketing", date: "2022-04-05" },
  { id: 8, title: "Product Review", url: "https://qrcodes.example.com/8", type: "Survey", date: "2022-05-11" },
  { id: 9, title: "Discount Coupon", url: "https://qrcodes.example.com/9", type: "Marketing", date: "2022-06-01" },
  { id: 10, title: "Newsletter Signup", url: "https://qrcodes.example.com/10", type: "Marketing", date: "2022-07-10" },
  { id: 11, title: "Workshop Registration", url: "https://qrcodes.example.com/11", type: "Event", date: "2022-08-25" },
  { id: 12, title: "Survey for Product Feedback", url: "https://qrcodes.example.com/12", type: "Survey", date: "2022-09-30" }
];
   // Populate Folders
        const foldersGrid = document.getElementById('foldersGrid');
        folders.forEach((folder) => {
          foldersGrid.innerHTML += `
            <div class="bg-gray-800 hover:bg-gray-700 rounded-lg shadow p-4 transition duration-200">
              <div class="flex justify-between items-start mb-3">
                <i class="fas fa-folder text-2xl text-blue-400"></i>
                <button class="text-gray-400 hover:text-gray-200">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
              </div>
              <h3 class="font-semibold text-white">${folder.name}</h3>
              <p class="text-sm text-gray-400">${folder.count}</p>
              <p class="text-xs text-gray-500 mt-2">${folder.date}</p>
            </div>
          `;
        });
    
      
        let currentPage = 1;
        const itemsPerPage = 5;
      
        const qrCodesList = document.getElementById("qrCodesList");
        const pageInfo = document.getElementById("pageInfo");
        const prevPage = document.getElementById("prevPage");
        const nextPage = document.getElementById("nextPage");
      
        function renderQrCodes() {
          qrCodesList.innerHTML = "";
          const startIndex = (currentPage - 1) * itemsPerPage;
          const paginatedItems = qrCodes.slice(startIndex, startIndex + itemsPerPage);
      
          paginatedItems.forEach((qr) => {
            qrCodesList.innerHTML += `
              <div class="p-4 flex items-center hover:bg-gray-700">
                <input type="checkbox" class="mr-4" />
                <div class="w-16 h-16 bg-gray-700 rounded flex items-center justify-center mr-4">
                  <i class="fas fa-qrcode text-4xl text-gray-400"></i>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">${qr.title}</h3>
                  <a href="${qr.url}" target="_blank" class="text-sm text-blue-400 hover:underline">${qr.url}</a>
                  <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500">
                    <span>${qr.type}</span>
                    <span>${qr.date}</span>
                  </div>
                </div>
                <div class="flex items-center space-x-2">
                <button class="p-2 hover:bg-gray-600 rounded">
                  <i class="fas fa-edit text-gray-400"></i> Edit
                </button>
                
              </div>
                <div class="flex items-center space-x-2">
                  <button class="p-2 hover:bg-gray-600 rounded" onclick="deleteQrCode(${qr.id})">
                    <i class="fas fa-trash text-gray-400"></i> Delete
                  </button>
                  <a href="${qr.url}" download class="p-2 hover:bg-gray-600 rounded">
                    <i class="fas fa-download text-gray-400"></i> Download
                  </a>
                </div>
              </div>
            `;
          });
      
          pageInfo.textContent = `Page ${currentPage}`;
          prevPage.disabled = currentPage === 1;
          nextPage.disabled = currentPage * itemsPerPage >= qrCodes.length;
        }
      
        function deleteQrCode(id) {
          if (confirm("Are you sure you want to delete this QR Code?")) {
            const index = qrCodes.findIndex((qr) => qr.id === id);
            if (index !== -1) {
              qrCodes.splice(index, 1);
              renderQrCodes();
            }
          }
        }
      
        prevPage.addEventListener("click", () => {
          if (currentPage > 1) {
            currentPage--;
            renderQrCodes();
          }
        });
      
        nextPage.addEventListener("click", () => {
          if (currentPage * itemsPerPage < qrCodes.length) {
            currentPage++;
            renderQrCodes();
          }
        });
      
        renderQrCodes();
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




