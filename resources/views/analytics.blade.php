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
                <select id="projectChange"
                  class="flex items-center gap-2 px-4 py-2 rounded-lg text-blue-500 hover:text-blue-400 bg-gray-900 border border-blue-500 hover:border-blue-400 transition duration-200">
                  <option value="no">Project Name</option> 
                  @foreach($projects as $project)
                      <option 
                          value="{{ $project->project_code }}" 
                          data-qrtype="{{ $project->qrtype }}"
                          data-startdate="{{ $project->start_date }}"
                          data-enddate = "{{ $project->end_date }}"
                          data-email="{{ $project->user->email }}"
                          data-image ="{{ $project->url }}"
                          data-totalscan ="{{ $project->total_scans }}"
                          data-uniquescan ="{{ $project->unique_scans }}" >
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
                        <img id="image" src="https://images.squarespace-cdn.com/content/v1/5d3f241fa4e0350001fa20d5/1636491460338-AIZAXV2978MGIDQE0GT7/qr-code.png" alt="" width="128px" height="128px" />
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
                    <a id="download" href=""
                      download="">Download</a>
                  </button>
                  <button id="edit"
                    class="flex items-center gap-2 w-full text-center px-4 py-2 w-full rounded-lg text-blue-500 hover:text-blue-400 border border-blue-500 hover:border-blue-400 transition duration-200 disabled:bg-gray-400 disabled:text-white disabled:cursor-not-allowed">
                    <i class="fas fa-edit h-5 w-5"></i>
                    Edit
                  </button>
                </div>
              </div>
              <!-- Quick Stats -->
              <div class="grid gap-4 grid-cols-2 lg:grid-cols-4 mb-3">
                <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                  <div class="text-sm font-medium text-gray-400">CAMPAIGN START</div>
                  <div class="mt-2 text-lg sm:text-2xl font-semibold text-gray-200" id="campaign_start"></div>
                </div>
                <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                  <div class="text-sm font-medium text-gray-400">CAMPAIGN END</div>
                  <div class="mt-2 text-lg sm:text-2xl font-semibold text-gray-200"  id="campaign_end">
                  
                  </div>
                </div>
                <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                  <div class="text-sm font-medium text-gray-400">TOTAL SCANS</div>
                  <div class="mt-2 text-2xl font-semibold text-gray-200" id="total_scan">
                  </div>
                </div>
                <div class="rounded-lg bg-gray-900 p-2 lg:p-6 shadow-lg">
                  <div class="text-sm font-medium text-gray-400">UNIQUE SCANS</div>
                  <div class="mt-2 text-2xl font-semibold text-gray-200" id="unique_scan">
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
                    <input class="bg-gray-800 sm:bg-gray-900" type="date" id="start_Date" class="text-gray-700"> -
                    <input class="bg-gray-800 sm:bg-gray-900" type="date" id="end_Date"
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
                    <div class="chart-container" id="lineChart-container" data-code="">
                      <canvas id="lineChart" class="h-64 w-full"></canvas>
                    </div>
                  </div>
                  <div class="space-y-4">
                    <h3 class="font-semibold text-gray-200">OPERATING SYSTEM</h3>
                    <div class="chart-container" id="barChart-container" data-code="">
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
                      <div id="noCountry" class="flex flex-col items-center justify-center text-gray-500 py-10">
                        <i class="fas fa-globe text-4xl mb-4"></i>
                        <p class="text-lg font-semibold">No Countries data available</p>
                        <p class="text-sm text-center md:text-left">Please check back later or contact support for assistance.</p>
                      </div>
                      <div class="flex items-center justify-between text-gray-400 hidden" id="showCountry">
                        <span id="country"></span>
                        <div class="flex items-center gap-4">
                          <span id="scan_count"></span>
                          <span id="percentage" class="w-16 text-right"></span>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="rounded-lg bg-gray-900 p-4 lg:p-6 shadow-lg">
                  <h3 class="mb-4 font-semibold text-center md:text-left text-gray-200">TOP CITIES</h3>
                  <div class="space-y-4">
                      <div class="flex flex-col items-center justify-center text-gray-500 py-10" id="noCity">
                        <i class="fas fa-city text-4xl mb-4"></i>
                        <p class="text-lg font-semibold">No city data available</p>
                        <p class="text-sm text-center md:text-left">Please check back later or contact support for assistance.</p>
                      </div>
                      <div class="flex items-center justify-between text-gray-400 hidden" id="showCity">
                        <span id="city"></span>
                        <div class="flex items-center gap-4">
                          <span id="city_scan_count"></span>
                          <span class="w-16 text-right" id="city_percentage"></span>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        
        $(document).ready(function() {
          let barChartInstance, lineChartInstance;

          $('#projectChange').on('change', function() {
              if (window.barChartInstance) {
                    window.barChartInstance.destroy();
                }
                if (window.lineChartInstance) {
                    window.lineChartInstance.destroy();
                }
                let select = $('select option:selected');
                let code = select.val(); 
                let qrtype = select.data('qrtype');
                let startDate = select.data('startdate');
                let email = select.data('email');
                let endDate = select.data('enddate');
                let image = select.data('image');
                let totalscan = select.data('totalscan');
                let uniquescan = select.data('uniquescan');

                let $createQrElement = $('#create_qr');
                if (code === 'no') {
                    $createQrElement.removeClass('hidden');
                } else {
                    $createQrElement.addClass('hidden');
                }

                let campaignStartDate = new Date(startDate).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' });
                $('#campaign_start').text(campaignStartDate || '');

                let campaignEndDate = new Date(endDate).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' });
                $('#campaign_end').text(campaignEndDate || '');

                $('#total_scan').text(totalscan || '');
                $('#unique_scan').text(uniquescan || '');

                $('#start_Date').val(new Date(startDate).toISOString().split('T')[0]);
                $('#end_Date').val(new Date(endDate).toISOString().split('T')[0]);

                $('#qrtype').text(qrtype || 'N/A');
                $('#startdate').text(startDate || 'N/A');
                $('#email').text(email || 'N/A');
                $('#image').attr('src', image || 'N/A');

                let currentDate = new Date();
                let endDateObj = new Date(endDate);
                if (endDateObj > currentDate) {
                    $('#expiryMessage').text('Active').removeClass('bg-red-500').addClass('bg-green-500 text-white');
                    $('#download').attr('href', image);
                } else {
                    $('#expiryMessage').text('Expired - Please Upgrade').removeClass('bg-green-500').addClass('bg-red-500 text-white');
                    $('#download').attr('href', '#');
                }

                $.getJSON(`/get-country-data/${code}`, function(data) {
                    $.each(data, function(index, item) {
                        let percentage = Math.round(parseFloat(item.percentage));
                        $('#country').text(item.country);
                        $('#scan_count').text(item.scan_count);
                        $('#percentage').text(percentage + '%');
                        $('#showCountry').removeClass('hidden');
                        $('#noCountry').addClass('hidden');
                    });
                }).fail(function(error) { console.error('Error:', error); });

                $.getJSON(`/get-city-data/${code}`, function(data) {
                    $.each(data, function(index, item) {
                        let percentage = Math.round(parseFloat(item.percentage));
                        $('#city').text(item.city);
                        $('#city_scan_count').text(item.scan_count);
                        $('#city_percentage').text(percentage + '%');
                        $('#showCity').removeClass('hidden');
                        $('#noCity').addClass('hidden');
                    });
                }).fail(function(error) { console.error('Error:', error); });

                $('#barChart-container, #lineChart-container').attr('data-code', code);
               
                $.ajax({
                  url: "{{route('barchart')}}",
                  method: 'GET',
                  data: {
                    code: code,
                    start_date: '',
                    end_date: '',
                    range: ''
                  },
                  dataType: 'json',
                  success: function (data) {
                    const regex = /\(([^;]+); ([^;]+)/;
                    const labels = data.map(item => {
                      const match = item.user_agent.match(regex);
                      if (match) {
                        return match[1]; // Device type, e.g., "Mobile";
                      } else {
                        return {
                          os: null,
                          deviceType: null
                        }; // No match found
                      }
                    });
                    const scanCounts = data.map(item => item.scan_count);
          
                    const ctx = $('#barChart')[0].getContext('2d');
                    window.barChartInstance = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Scans by OS',
                          data: scanCounts,
                          backgroundColor: 'rgba(153, 102, 255, 0.6)',
                          borderColor: 'rgba(153, 102, 255, 1)',
                          borderWidth: 1,
                          barThickness: 30,
                        }]
                      },
                      options: {
                        responsive: true,
                        scales: {
                          x: {
                            title: {
                              display: true,
                              text: 'Operating System'
                            },
                            ticks: {
                              maxRotation: 90,
                              minRotation: 0,
                            }
                          },
                          y: {
                            title: {
                              display: true,
                              text: 'Scans'
                            }
                          }
                        },
                        plugins: {
                          legend: {
                            display: true
                          },
                          tooltip: {
                            enabled: true
                          }
                        }
                      }
                    });
                  },
                  error: function (xhr, status, error) {
                    console.error('Error fetching bar chart data:', status, error);
                  }
                });


                $.ajax({
                  url: "{{route('linechart')}}",
                  method: 'GET',
                  data: {
                    code: code,
                    start_date: '',
                    end_date: '',
                    range: ''
                  },
                  dataType: 'json',
                  success: function (data) {
                    const labels = data.map(item => item.scan_date); // Assuming the data contains a "date" field
                    const scanCounts = data.map(item => item.total_scans); // Assuming the data contains a "scan_count" field
                  
                    const ctx = $('#lineChart')[0].getContext('2d');
                    window.lineChartInstance = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Scans Over Time',
                          data: scanCounts,
                          backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                          fill: true,
                          tension: 0.4 // Adds smoothing to the line
                        }]
                      },
                      options: {
                        responsive: true,
                        scales: {
                          x: {
                            title: {
                              display: true,
                              text: 'Date'
                            }
                          },
                          y: {
                            title: {
                              display: true,
                              text: 'Scans'
                            }
                          }
                        }
                      }
                    });
                  },
                  error: function (xhr, status, error) {
                    console.error('Error fetching line chart data:', status, error);
                  }
                });
            
                // jQuery event listeners
                $('#dayBtn').on('click', function () {
                  //updateCharts('day');
                  fetchDataAndUpdate('day');
                  $(this).addClass('bg-gray-900');
                  $('#weekBtn').removeClass('bg-gray-900');
                  $('#monthBtn').removeClass('bg-gray-900');
                });

                $('#weekBtn').on('click', function () {
                  //updateCharts('week');
                  fetchDataAndUpdate('week');
                  $(this).addClass('bg-gray-900');
                  $('#dayBtn').removeClass('bg-gray-900');
                  $('#monthBtn').removeClass('bg-gray-900');
                });

                $('#monthBtn').on('click', function () {
                  //updateCharts('month');
                  fetchDataAndUpdate('month');
                  $(this).addClass('bg-gray-900');
                  $('#dayBtn').removeClass('bg-gray-900');
                  $('#weekBtn').removeClass('bg-gray-900');
                });
  
  
                function fetchDataAndUpdate(range) {
                  if(window.barChartInstance) {
                      window.barChartInstance.destroy();
                  }
                  if (window.lineChartInstance) {
                     window.lineChartInstance.destroy();
                  }
                  let startDate, endDate;
                  // Determine date range
                  const today = new Date();
                  if (range === 'day') {
                    startDate = today.toISOString().split('T')[0];
                    endDate = today.toISOString().split('T')[0];
                  } else if (range === 'week') {
                    const firstDay = new Date(today.setDate(today.getDate() - today.getDay()));
                    startDate = firstDay.toISOString().split('T')[0];
                    endDate = new Date().toISOString().split('T')[0];
                  } else if (range === 'month') {
                    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                    startDate = firstDay.toISOString().split('T')[0];
                    endDate = new Date().toISOString().split('T')[0];
                  }
                 
                  $.ajax({
                    url: "{{route('barchart')}}",
                    method: 'GET',
                    data: {
                      code: code,
                      start_date: startDate,
                      end_date: endDate,
                      range: range
                    },
                    dataType: 'json',
                    success: function (data) {
                      const regex = /\(([^;]+); ([^;]+)/;
                      const labels = data.map(item => {
                        const match = item.user_agent.match(regex);
                        if (match) {
                          return match[1]; // Device type, e.g., "Mobile";
                        } else {
                          return {
                            os: null,
                            deviceType: null
                          }; // No match found
                        }
                      });
                      const scanCounts = data.map(item => item.scan_count);
                      if (window.barChartInstance) {
                      window.barChartInstance.destroy();
                      }
                      const ctx = $('#barChart')[0].getContext('2d');
                      window.barChartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: labels,
                          datasets: [{
                            label: 'Scans by OS',
                            data: scanCounts,
                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            barThickness: 30,
                          }]
                        },
                        options: {
                          responsive: true,
                          scales: {
                            x: {
                              title: {
                                display: true,
                                text: 'Operating System'
                              },
                              ticks: {
                                maxRotation: 90,
                                minRotation: 0,
                              }
                            },
                            y: {
                              title: {
                                display: true,
                                text: 'Scans'
                              }
                            }
                          },
                          plugins: {
                            legend: {
                              display: true
                            },
                            tooltip: {
                              enabled: true
                            }
                          }
                        }
                      });
                    },
                    error: function (xhr, status, error) {
                      console.error('Error fetching bar chart data:', status, error);
                    }
                  });
                  $.ajax({
                    url: "{{route('linechart')}}",
                    method: 'GET',
                    data: {
                      code: code,
                      start_date: startDate,
                      end_date: endDate,
                      range: range
                    },
                    dataType: 'json',
                    success: function (data) {
                      const labels = data.map(item => item.scan_date); // Assuming the data contains a "date" field
                      const scanCounts = data.map(item => item.total_scans); // Assuming the data contains a "scan_count" field
                      console.log(scanCounts);
                      const ctx = $('#lineChart')[0].getContext('2d');
                      if (window.lineChartInstance) {
                      window.lineChartInstance.destroy();
                      }
                      window.lineChartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: labels,
                          datasets: [{
                            label: 'Scans Over Time',
                            data: scanCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4 // Adds smoothing to the line
                          }]
                        },
                        options: {
                          responsive: true,
                          scales: {
                            x: {
                              title: {
                                display: true,
                                text: 'Date'
                              }
                            },
                            y: {
                              title: {
                                display: true,
                                text: 'Scans'
                              }
                            }
                          }
                        }
                      });
                    },
                    error: function (xhr, status, error) {
                      console.error('Error fetching line chart data:', status, error);
                    }
                  });
            
            
            
                }
            $("#end_Date").change(function (e) {
              e.preventDefault();
              if (window.barChartInstance) {
                  window.barChartInstance.destroy();
              }
              if (window.lineChartInstance) {
                  window.lineChartInstance.destroy();
              }
              startDate = $("#start_Date").val();
              if (startDate !== '') {
                endDate = $("#end_Date").val();
              } else {
                alert('Choose Start Date');
              }
             
              $.ajax({
                url: "{{route('barchart')}}",
                method: 'GET',
                data: {
                  code: code,
                  start_date: startDate,
                  end_date: endDate,
                  range: ''
                },
                dataType: 'json',
                success: function (data) {
                  const regex = /\(([^;]+); ([^;]+)/;
                  const labels = data.map(item => {
                    const match = item.user_agent.match(regex);
                    if (match) {
                      return match[1]; // Device type, e.g., "Mobile";
                    } else {
                      return {
                        os: null,
                        deviceType: null
                      }; // No match found
                    }
                  });
                  const scanCounts = data.map(item => item.scan_count);
        
                  const ctx = $('#barChart')[0].getContext('2d');
                  if (window.barChartInstance) {
                  window.barChartInstance.destroy();
                  }
                 
                  window.barChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: labels,
                      datasets: [{
                        label: 'Scans by OS',
                        data: scanCounts,
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        barThickness: 30,
                      }]
                    },
                    options: {
                      responsive: true,
                      scales: {
                        x: {
                          title: {
                            display: true,
                            text: 'Operating System'
                          },
                          ticks: {
                            maxRotation: 90,
                            minRotation: 0,
                          }
                        },
                        y: {
                          title: {
                            display: true,
                            text: 'Scans'
                          }
                        }
                      },
                      plugins: {
                        legend: {
                          display: true
                        },
                        tooltip: {
                          enabled: true
                        }
                      }
                    }
                  });
                },
                error: function (xhr, status, error) {
                  console.error('Error fetching bar chart data:', status, error);
                }
              });
              $.ajax({
                url: "{{route('linechart')}}",
                method: 'GET',
                data: {
                  code: code,
                  start_date: startDate,
                  end_date: endDate,
                  range: ''
                },
                dataType: 'json',
                success: function (data) {
                  const labels = data.map(item => item.scan_date); // Assuming the data contains a "date" field
                  const scanCounts = data.map(item => item.total_scans); // Assuming the data contains a "scan_count" field
                  console.log(scanCounts);
                  const ctx = $('#lineChart')[0].getContext('2d');
                  if (window.lineChartInstance) {
                      window.lineChartInstance.destroy();
                  }
                  window.lineChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                      labels: labels,
                      datasets: [{
                        label: 'Scans Over Time',
                        data: scanCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4 // Adds smoothing to the line
                      }]
                    },
                    options: {
                      responsive: true,
                      scales: {
                        x: {
                          title: {
                            display: true,
                            text: 'Date'
                          }
                        },
                        y: {
                          title: {
                            display: true,
                            text: 'Scans'
                          }
                        }
                      }
                    }
                  });
                },
                error: function (xhr, status, error) {
                  console.error('Error fetching line chart data:', status, error);
                }
              });
            });
          });
        });
  </script>

@endsection