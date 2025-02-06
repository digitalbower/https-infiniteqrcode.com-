
@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
        <!-- Main Content Area -->
        <div class="lg:grid grid-cols-5 relative  container mx-auto h-screen">

    
<div class="col-span-1">
 
</div>
<div class="col-span-4">
  <div class="grid gap-4 grid-cols-1 lg:grid-cols-8 my-3 lg:my-8 p-4">
    <!-- Total Value Locked (TVL) Section -->
    <div class="bg-card lg:order-1 order-2 lg:col-span-5 rounded-lg shadow-lg  p-2 lg:p-2">
      <h3 class="text-lg lg:text-2xl font-semibold">Account Summary</h3>
      <p class="lg:text-xl text-lg font-bold text-secondary total"> </p>
      <canvas id="projectDeliveries" style="width: 100%; height: 400px;"></canvas>
    </div>

    <!-- Updated Change (24h) and Users Section -->
    <div class="lg:col-span-3 sm:flex lg:block space-y-3   lg:mt-0 lg:order-2 order-1 my-10 lg:mb-0 grid gap-4">
      <!-- Plan Details and Usage -->
      <div
        class="rounded-lg border w-full shadow-sm bg-gray-800 border-gray-600 text-white overflow-hidden transition-all duration-300 ease-in-out transform"
        data-v0-t="card">
        <div class="space-y-1.5 bg-gray-700 flex items-center justify-between p-3">
          <h3 class="tracking-tight text-lg font-bold">Plan Details</h3>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-credit-card h-8 w-8 text-gray-400">
            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
            <line x1="2" x2="22" y1="10" y2="10"></line>
          </svg>
        </div>
        <div class="p-2 pb-0">
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Active Plan</span><span
              class="text-white capitalize"></span></div>
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Plan Validity</span><span
              class="text-green-500">Valid till Days</span></div>
        </div>
      </div>

      <div
        class="rounded-lg border w-full shadow-sm bg-gray-800 border-gray-600 text-white overflow-hidden transition-all duration-300 ease-in-out transform"
        data-v0-t="card">
        <div class="space-y-1.5 bg-gray-700 flex items-center justify-between p-3">
          <h3 class="tracking-tight text-lg font-bold">Usage QR Code</h3>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-qr-code h-8 w-8 text-gray-400">
            <rect width="5" height="5" x="3" y="3" rx="1"></rect>
            <rect width="5" height="5" x="16" y="3" rx="1"></rect>
            <rect width="5" height="5" x="3" y="16" rx="1"></rect>
            <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
            <path d="M21 21v.01"></path>
            <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
            <path d="M3 12h.01"></path>
            <path d="M12 3h.01"></path>
            <path d="M12 16v.01"></path>
            <path d="M16 12h1"></path>
            <path d="M21 12v.01"></path>
            <path d="M12 21v-1"></path>
          </svg>
        </div> 
        <?php
        $staticCount = 0;
        $dynamicCount = 0;

        // Correct SQL query
        $sql = "SELECT * FROM qr_basic_info WHERE userid='{arun1310@gmail.com}'";

        

        ?>
        <div class="p-2 pb-0" id="active-qr">
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Active QR Codes</span><span
              class="text-white"><?= $diffTotal; ?></span></div>
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Static: </span><span
              class="text-white"><label class=""><?= $diffTotal; ?> </label> out of <?= $static; ?></span></div>
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Dynamic: </span><span
              class=""><label class=""><?= $dynamicCount; ?></label> out of <?= $dynamic; ?></span></div>
        </div>
      </div>

      <div
        class="rounded-lg border w-full shadow-sm bg-gray-800 border-gray-600 text-white overflow-hidden transition-all duration-300 ease-in-out transform"
        data-v0-t="card">
        <div class="space-y-1.5 bg-gray-700 flex items-center justify-between p-3">
          <h3 class="tracking-tight text-lg font-bold">Scan Usage</h3>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-activity h-8 w-8 text-gray-400">
            <path
              d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2">
            </path>
          </svg>
        </div>
        <div class="p-2 pb-0">
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Total Scans</span><span
              class="text-white" id="total-scans"></span></div>
          <div class="flex justify-between items-center mb-2"><span class="text-gray-400">Remaining</span>
            <span id="remaining-scans" class="text-amber-500">0 Scans</span>
          </div>
          <div class="mt-4">
            <div aria-valuemax="100" aria-valuemin="0" role="progressbar" data-state="indeterminate" data-max="100"
              class="relative w-full overflow-hidden rounded-full h-2 bg-gray-700" indicatorclassname="bg-blue-500">
              <div data-state="indeterminate" data-max="100" class="h-full w-full flex-1 bg-primary transition-all"
                style="transform: translateX(-0%);" id="progress-bar"></div>
            </div>

            <div class="flex justify-between text-sm mt-2"><span class="text-gray-400">0</span><span
                class="text-gray-400" id="validity">1000</span></div>
          </div>
        </div>
      </div>
    </div>

    <!-- My QR Codes Table -->
    <div class="rounded-lg  lg:col-span-8 order-3 border border-gray-600 bg-gray-700 text-gray-100 shadow-lg"
      data-v0-t="card">
      <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="tracking-tight text-xl sm:text-2xl font-semibold text-center">My QR Codes</h3>
      </div>
      <div class="p-2 lg:p-6 pt-0">
        <div class="rounded-md border border-gray-600">
          <div class="relative w-full overflow-auto">
            <!-- Check if there are QR codes -->
            <table class="w-full caption-bottom text-xs md:text-sm" id="qrTable">
              <thead class="[&amp;_tr]:border-b">
                <tr
                  class="border-b border-gray-600 transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                  <th class="h-12 px-2 md:px-4 align-middle font-medium text-muted-foreground text-center">QR Code</th>
                  <th class="h-12 px-2 md:px-4 align-middle font-medium text-muted-foreground text-center">QR Code Name</th>
                  <th class="h-12 px-2 md:px-4 align-middle font-medium text-muted-foreground text-center">Total Scans</th>
                  <th class="h-12 px-2 md:px-4 align-middle font-medium text-muted-foreground text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="[&amp;_tr:last-child]:border-0">
                <?php if (count($qrCodes) === 0) { ?>

                  <!-- Add a condition for no QR code -->
                  <tr class="border-b transition-colors data-[state=selected]:bg-muted hover:bg-muted/50"
                    id="noQRMessage">
                    <td colspan="4" class="p-4 text-center text-gray-500">
                      <p>No QR code found, create your first QR code.</p>
                      <button onclick="location.href='/qroption'" class="mt-4 bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90">Create QR
                        Code</button>
                    </td>
                  </tr> <?php } ?>
                <!-- Example QR code (this should be dynamically inserted if available) -->
                <?php foreach ($qrCodes as $row) { //print_r($row); 
                ?>
                  <tr class="border-b border-gray-600 transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                    <td class="p-4 align-middle text-center">
                      <div class="flex justify-center">
                        <img
                          src="<?= 'qrbackend/qrcodes/' . $row['code'] . '.png'; ?>"
                          alt="Protocol Logo"
                          class="w-12 h-12 object-cover rounded-full" />
                      </div>
                    </td>
                    <td class="p-4 text-center"><a href="<?= $row['url']; ?>" target="_blank"><?= $row['projectname'] ?></a></td>
                    <td class="p-4 text-center">
                      <?= $row['totalscans']; ?>
                    </td>

                    <td class="p-4 text-center">
                      <a href="<?= 'qrbackend/qrcodes/' . $row['code'] . '.png'; ?>" class="bg-primary text-white py-1 px-3 rounded-md hover:bg-primary/90" download="">Download</a>
                    </td>
                    <!-- <td class="px-4 py-3 text-right text-white font-medium">
                $6.67B
              </td> -->
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
$(document).ready(function() {


  let chart;
  // Fetch data via AJAX
  $.ajax({
    url: 'fetch/fetch_dscans_data.php',
    method: 'GET',
    success: function(response) {
      // Extract unique dates and process data
      function processResponse(response, lastSevenDays) {
// Initialize maps to hold total scans for static and dynamic QR types
const staticScansMap = new Map();
const dynamicScansMap = new Map();

// Populate maps with last seven days initialized to 0
lastSevenDays.forEach(date => {
    staticScansMap.set(date, 0);
    dynamicScansMap.set(date, 0);
});

// Process response to populate scan counts
response.forEach(item => {
    const { scan_date, qrtype, total_scans } = item;
    const scans = parseInt(total_scans, 10); // Ensure total_scans is a number

    if (qrtype === "Static" && staticScansMap.has(scan_date)) {
        staticScansMap.set(scan_date, (staticScansMap.get(scan_date) || 0) + scans);
    } else if (qrtype === "Dynamic" && dynamicScansMap.has(scan_date)) {
        dynamicScansMap.set(scan_date, (dynamicScansMap.get(scan_date) || 0) + scans);
    }
});

// Convert maps to arrays
const sortedDates = Array.from(staticScansMap.keys()).sort(); // Sort dates in ascending order
const staticScans = sortedDates.map(date => staticScansMap.get(date)); // Get static scans in sorted order
const dynamicScans = sortedDates.map(date => dynamicScansMap.get(date)); // Get dynamic scans in sorted order


return { dates1:sortedDates, staticScans, dynamicScans };
}
function getLastSevenDays() {
        const today = new Date();
        const lastSevenDays = new Set();

        for (let i = 0; i < 7; i++) {
          const date = new Date(today);
          date.setDate(today.getDate() - i); // Subtract i days from today
          lastSevenDays.add(date.toISOString().split('T')[0]); // Format as 'YYYY-MM-DD' and add to the Set
        }

        return Array.from(lastSevenDays); // Convert Set back to an array
      }
// Example Usage
const lastSevenDays = getLastSevenDays(); // Function defined earlier
const { dates1, staticScans, dynamicScans } = processResponse(response, lastSevenDays);
     

console.log({ dates1, staticScans, dynamicScans });

      // Generate an array of dates for the last 7 days
      const dates = [...new Set(response.map(item => item.scan_date))];
    
       
      // Separate data for each qrtype
      const staticData = response
        .filter(item => item.qrtype === "Static")
        .reduce((acc, item) => ({
          ...acc,
          [item.scan_date]: item.total_scans
        }), {});
      const dynamicData = response
        .filter(item => item.qrtype === "Dynamic")
        .reduce((acc, item) => ({
          ...acc,
          [item.scan_date]: item.total_scans
        }), {});
      // Map data for charting
      //const staticScans = dates.map(date => staticData[date] || 0);
      //const dynamicScans = dates.map(date => dynamicData[date] || 0);
      const totalScans = response.reduce((sum, item) => sum + parseInt(item.total_scans, 10), 0);
      // Get the total value of staticData
      const staticTotal = Object.values(staticData).reduce((sum, value) => sum + parseInt(value, 10), 0);
      // Get the total value of dynamicData
      const dynamicTotal = Object.values(dynamicData).reduce((sum, value) => sum + parseInt(value, 10), 0);
      $('.total').text(totalScans + ' Scans');
      $('.static').text(staticTotal);
      $('.dynamic').text(dynamicTotal);
      const validity = "<?= $validity; ?>";
      const remainingScans = validity - totalScans;

      // Update UI
      document.getElementById("total-scans").textContent = totalScans;
      document.getElementById("remaining-scans").textContent = `${remainingScans} Scans`;
      document.getElementById("validity").textContent = validity;

      // Calculate progress percentage
      let progressPercentage = 0; // Default progress value

      if (validity !== Infinity) {
        progressPercentage = (totalScans / validity) * 100;
      } else {
        // Handle the case where validity is Infinity
        progressPercentage = 100; // You can decide what to do here, assuming 100% progress
      }
      // Update progress bar width
      document.getElementById("progress-bar").style.width = `${progressPercentage}%`;
      document.getElementById("progress-bar").style.transform = `translateX(-${progressPercentage}%)`;
      // Create the chart
      const canvas = document.getElementById('projectDeliveries'); // Your canvas element
      const ctx = document.getElementById('projectDeliveries').getContext('2d');
      const isDataEmpty = staticScans.length === 0 && dynamicScans.length === 0;

      if (isDataEmpty) {
        // Generate an array of random dates for the past 4 weeks
        function getLastSevenDays() {
          const today = new Date();
          const lastSevenDays = new Set();

          for (let i = 0; i < 6; i++) {
            const date = new Date(today);
            date.setDate(today.getDate() - i); // Subtract i days from today
            lastSevenDays.add(date.toISOString().split('T')[0]); // Format as 'YYYY-MM-DD' and add to the Set
          }

          return Array.from(lastSevenDays); // Convert Set back to an array
        }

        // Generate an array of dates for the last 7 days
        const lastSevenDays = getLastSevenDays();
        // Sort the dates in ascending order
        const sortedDates = lastSevenDays.sort();
        
      } else {
        // Draw the chart if data exists
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: dates1,
            datasets: [{
                label: 'Static Data',
                data: staticScans,
                borderColor: 'lightblue',
                backgroundColor: 'lightblue',
                fill: false
              },
              {
                label: 'Dynamic Data',
                data: dynamicScans,
                borderColor: 'red',
                backgroundColor: 'red',
                fill: false
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'top', // Position legend at the top
                align: 'end', // Align legend to the right
                labels: {
                  usePointStyle: true, // Use custom point style for legend
                  pointStyle: 'circle', // Shape of the legend marker
                  color: '#FFFFFF', // Set legend text color to white
                  padding: 20 // Add padding for better spacing
                }
              },
              title: {
                display: true,
                font: {
                  size: 16,
                  weight: 'bold'
                },
                color: '#FFFFFF'
              }
            },
            scales: {
              x: {
                ticks: {
                  color: '#FFFFFF'
                }
              },
              y: {
                beginAtZero: true,

                ticks: {
                  stepSize: 2,
                  color: '#FFFFFF'
                }
              }
            },
            layout: {
              padding: {
                top: 50 // Add extra padding at the top for the legend
              }
            }
          }
        });
      }

    },
    error: function(xhr, status, error) {
      console.error('AJAX Error: ', status, error);
    }
  });
});

// Chart.js Configurations
</script>

</body>

</html>

@endsection
