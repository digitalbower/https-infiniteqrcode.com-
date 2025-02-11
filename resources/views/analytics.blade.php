@extends('layouts.layout')
@section('title', 'My QR Analytics')
@section('content')
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
    onchange="updateProjectDetails()">
    <option value="no">Project Name</option> 
    @foreach($projects as $project)
        <option 
            value="{{ $project->project_code }}" 
            data-qrtype="{{ $project->qrtype }}"
            data-startdate="{{ $project->start_date }}"
            data-email="{{ $project->user->email }}"
            data-enddate="{{ $project->end_date }}"
            data-image ="{{ $project->url }}">
            {{ $project->project_name }}
        </option>
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
                <div class="gap-x-6 mt-0 text-xs sm:text-sm text-gray-400">
    <p id="qrtype" class="px-3 mb-2 py-1 rounded-full bg-gray-900">QR Type</p>
    <p id="startdate" class="px-3 mb-2 py-1 rounded-full bg-gray-900">Date</p>
    <p id="email" class="px-3 mb-2 py-1 rounded-full bg-gray-900">Email</p>
    <p id="expiryMessage" class="px-3 mb-2 py-1 rounded-full">Your Subscription Status</p>
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
                <div class="mt-2 text-lg sm:text-2xl font-semibold text-gray-200">45</div>
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

<script>
  function updateProjectDetails() {
    // Get selected option
    let select = document.querySelector("select");
    let selectedOption = select.options[select.selectedIndex];

    // Get values from data attributes
    let qrtype = selectedOption.getAttribute("data-qrtype");
    let startDate = selectedOption.getAttribute("data-startdate");
    let email = selectedOption.getAttribute("data-email");
    let endDate = selectedOption.getAttribute("data-enddate");
    let image = selectedOption.getAttribute("data-image");

    // Update HTML elements
    document.getElementById("qrtype").innerText = qrtype || "N/A";
    document.getElementById("startdate").innerText = startDate || "N/A";
    document.getElementById("email").innerText = email || "N/A";
    document.getElementById("image").innerText = image || "N/A";

    // Check expiry logic
    let currentDate = new Date();
    let endDateObj = new Date(endDate);

    if (endDateObj > currentDate) {
        document.getElementById("expiryMessage").innerText = "Active";
        document.getElementById("expiryMessage").classList.remove("bg-red-500");
        document.getElementById("expiryMessage").classList.add("bg-green-500", "text-white");
    } else {
        document.getElementById("expiryMessage").innerText = "Expired - Please Upgrade";
        document.getElementById("expiryMessage").classList.remove("bg-green-500");
        document.getElementById("expiryMessage").classList.add("bg-red-500", "text-white");
    }
}

</script>


@endsection