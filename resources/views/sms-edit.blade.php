@extends('layouts.layout')
@section('title', 'Edit SMS QrCode')
@section('content')
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
            @if(session('success'))
              <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">{{ session('success') }}</div>
            @endif
            <form action="{{ route('update-smsqr',$sms->code) }}" id="editsmsqr_form" style="margin-bottom: 1rem;" method="POST">
              @csrf
              <div class="flex justify-start">
                <h2
                  class="text-2xl font-medium mb-3 text-center text-white">Content</h2>
              </div>
              <div
                class=" lg:p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">

                <div class="space-y-4">
                  <div class="mx-auto p-2 lg:p-6 bg-white">
                    <form style="margin-bottom: 1rem;">
                      <!-- QR Code Text Input -->
                      <div>
                        <label class="text-base text-gray-600">Phone Number</label>
                        <div class="flex gap-x-2 items-center mt-2">
                          <select class="w-full text-xs md:text-sm rounded-md text-black border p-1 h-10 md:h-auto py-2 md:p-2 lg:pr-10 w-1/3" name="countrycode" id="countrycode" readonly>
                            <option value="+1" {{ $sms->countrycode == '+1' ? 'selected' : '' }}>🇺🇸 USA (+1)</option>
                            <option value="+91" {{ $sms->countrycode  == '+91' ? 'selected' : '' }}>🇮🇳 India (+91)</option>
                            <option value="+44" {{ $sms->countrycode  == '+44' ? 'selected' : '' }}>🇬🇧 UK (+44)</option>
                            <option value="+1" {{ $sms->countrycode  == '+1' ? 'selected' : '' }}>🇨🇦 Canada (+1)</option>
                            <option value="+61" {{ $sms->countrycode  == '+61' ? 'selected' : '' }}>🇦🇺 Australia (+61)</option>
                            <option value="+49" {{ $sms->countrycode  == '+49' ? 'selected' : '' }}>🇩🇪 Germany (+49)</option>
                            <option value="+33" {{ $sms->countrycode  == '+33' ? 'selected' : '' }}>🇫🇷 France (+33)</option>
                            <option value="+81" {{ $sms->countrycode  == '+81' ? 'selected' : '' }}>🇯🇵 Japan (+81)</option>
                            <option value="+55" {{ $sms->countrycode  == '+55' ? 'selected' : '' }}>🇧🇷 Brazil (+55)</option>
                            <option value="+971" {{ $sms->countrycode  == '+971' ? 'selected' : '' }}>🇦🇪 UAE (+971)</option>
                            <option value="+966" {{ $sms->countrycode  == '+966' ? 'selected' : '' }}>🇸🇦 SA (+966)</option>
                          </select>
                          <input type="tel" max="999999999999" name="phone" id="phone" value="{{$sms->phonenumber}}" placeholder="Phone" class="w-full w-full rounded-md text-black border text-xs md:text-sm p-2 h-10 md:h-auto pr-10">

                        </div>
                        <small id="phoneError"></small>
                        @error('phone')
                        <small class="text-red-700 phone">{{ $message }}</small>
                        @enderror
                      </div>
                      <div
                        style="margin-bottom: 1rem; position: relative;">
                       <div class="py-2 mt-4">
                       <label for="url"
                          class="text-base text-gray-600">QR
                          Code SMS Text:</label>
                       </div>
                        <textarea
                          type="text"
                          id="sms"
                          name="sms" class="text-gray-900" rows="5"
                          placeholder="Enter SMS text for QR Code"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.75rem 1.5rem 0.75rem 1rem; border-radius: 4px; box-sizing: border-box; font-size: 1rem;">{{$sms->qrsms}}</textarea>

                        @error('sms')
                              <small class="text-red-700 sms">{{ $message }}</small>
                        @enderror
                        <input type="hidden" name="qroption" id="qroption" value="{{$sms->qrtype}}">
                        <input type="hidden" name="url" id="url" value="{{route('preview-sms',$sms->code)}}">


                        <div class="char-counter" style="margin-top: 5px;font-size: 14px;color: #555;">
                          Characters: <span id="charCount">0</span> / 160
                        </div>
                      </div>
                      <!-- Enhanced Image Upload Input -->
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
                      <div class="mx-auto w-full lg:p-6 bg-white text-black">

                        <div class="space-y-4">

                          <!-- QR Project Name -->
                          <div>
                            <label for="projectName"
                              class="block font-medium text-gray-800">QR Project Name</label>
                            <div>
                              <input id="projectName" placeholder="Enter project name" name="projectname" value="{{ $sms->project_name}}"
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                              @error('projectname')
                              <small class="text-red-700 projectName">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>

                              <!-- Select Folder -->
                              <div class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">                           
                                <!-- Folder Dropdown -->
                                <div class="relative">
                                    <button type="button" id="folderDropdownButton"
                                        class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded flex justify-between items-center">
                                        <span id="selectedFolder">{{ $sms->folder_name ?? 'Select a folder' }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                            
                                    <!-- Dropdown List -->
                                    <div id="folderDropdown" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded shadow mt-1">
                                        @php
                                            $userId = auth()->user()->id; 
                                            $folders = App\Models\QrBasicInfo::selectRaw('folder_name as name')
                                                ->where('userid', $userId)
                                                ->groupBy('folder_name')
                                                ->get();
                                        @endphp
                            
                                        <ul id="folderList" class="divide-y divide-gray-200">
                                            @foreach ($folders as $folder)
                                                @php
                                                    $isSelected = isset($sms->folder_name) && $sms->folder_name == $folder->name ? 'bg-gray-200 font-bold' : '';
                                                @endphp
                                                <li class="folder-item p-2 text-gray-600 flex items-center cursor-pointer hover:bg-gray-100 {{ $isSelected }}"
                                                    data-folder="{{ $folder->name }}">
                                                    <span>{{ $folder->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="flex justify-center"> <button id="addFolderButton"
                                                  type="button"
                                                  class="w-full text-green-500 font-semibold py-2 hover:bg-green-100 flex items-center justify-center">
                                                  <svg xmlns="http://www.w3.org/2000/svg"
                                                      class="h-5 w-5 mr-1" fill="none"
                                                      viewBox="0 0 24 24" stroke="currentColor"
                                                      stroke-width="2">
                                                      <path stroke-linecap="round"
                                                          stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                  </svg>
                                                  Add New Folder
                                              </button>
                                          </div>
                                    </div>
                                </div>
                                <input id="folderinput" type="hidden" name="folderinput" value="{{ $sms->folder_name ?? '' }}" />
                              </div>                            
                              <small id="folder"></small>
                              @error('folderinput')
                              <small class="text-red-700 folderinput">{{ $message }}</small>
                              @enderror
                          <!-- Date Range -->
                          <div
                            class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                            <div class="flex-1">
                              <label for="startDate"
                                class="block font-medium text-gray-800">Start Date</label>
                              <input id="startDate" min="<?php echo date('Y-m-d'); ?>" type="date" value="{{$sms->start_date}}"
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="startdate">
                                @error('startdate')
                                <small class="text-red-700 start_date">{{ $message }}</small>
                                @enderror
                              </div>
                            <div class="flex-1">
                              <label for="endDate"
                                class="block font-medium text-gray-800">End Date</label>
                              <div>
                                <input id="endDate" type="date" value="{{$sms->end_date}}"
                                  class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="enddate">
                                @error('enddate')
                                <small class="text-red-700 enddate">{{ $message }}</small>
                                @enderror
                              </div>
                            </div>
                          </div>

                          <!-- Usage -->
                          <div>
                            <label for="usage"
                              class="block font-medium text-gray-800">Usage</label>
                            <select id="usage" name="usage"
                              class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                              <option value="personal" {{ $sms->usage_type == 'personal' ? 'selected' : '' }}>Personal</option>
                              <option value="business" {{ $sms->usage_type == 'business' ? 'selected' : '' }}>Business</option>
                              <option value="event" {{ $sms->usage_type == 'event' ? 'selected' : '' }}>Event</option>
                            </select>
                            @error('usage')
                            <small class="text-red-700 usage">{{ $message }}</small>
                            @enderror
                          </div>

                          <!-- Remarks -->
                          <div>
                            <label for="remarks"
                              class="block font-medium text-gray-800">Remarks</label>
                            <textarea id="remarks" name="remarks"
                              placeholder="Enter any additional remarks"
                              class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{$sms->remarks}}</textarea>
                          </div>
                          <div class="flex justify-between mt-8">
                            <button type="button" onclick="location.href='QrOption.php'"
                              class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">Previous</button>
                            <span id="message" class="bg-white justify-center align-center pt-2 font-semibold py-2 px-6 rounded-lg hidden"></span>
                            <div id="loadingIndicator" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
                              <div class="flex flex-col items-center">
                                <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                                <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                              </div>
                            </div>
                            <button type="submit" id="nextBtn"
                            class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Generate Qr Code</button>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-span-4">
            <style>
              canvas{
                width: 100% !important;
              }
              .tab-button.active {

                background-color: #00aaff;
                color: white;
              }
            </style>
            <div class=" col-span-4  flex justify-center">

              <!-- Header -->
              <div class="p-1 w-full mt-10">
                <!-- Tab Navigation -->
                <div
                  class="flex bg-gray-200 rounded-full justify-around shadow-md">
                  <button
                    id="preview-btn"
                    class="tab-button text-sm text-gray-500 px-0 w-full py-3 rounded-full transition duration-300 focus:outline-none active">
                    Preview
                  </button>
                  <button
                    id="detail-btn"
                    class="tab-button text-sm text-gray-500 px-0 w-full py-3 rounded-full transition duration-300 focus:outline-none ">
                    QRCode
                  </button>
                </div>

                <!-- Preview Tab Content -->
                <div id="detail-content" class="tab-content mt-10 w-full hidden">
                  <div
                    class="bg-gray-800 w-full  mx-auto mt-10 rounded-3xl shadow-lg border-4 min-h-[550px] border-gray-900 relative overflow-hidden">
                    <!-- Top Indicator -->
                    <div
                      class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-700 rounded"></div>

                    <!-- Content -->
                    <div class="p-6 mt-5">
                      <!-- Header -->
                      <h2
                        class="text-center text-lg font-semibold text-white mb-4">
                        Scan QR Code for Contact
                      </h2>

                      <!-- QR Code Preview -->
                      <div id="qr-preview"
                        class="bg-white w-full border-3 rounded-lg shadow-sm overflow-hidden">
                      </div>

                      <!-- Action Buttons -->
                      <div class="mt-6 flex flex-col gap-4 items-center">
                        <!-- <button id="downloadBtn"
                          class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                          Generate vCard
                        </button> -->

                        <!-- <button
                          class="px-4 py-2 bg-gray-700 text-white font-medium rounded-lg shadow hover:bg-gray-800 focus:ring focus:ring-gray-500">
                          Save Contact
                        </button> -->
                      </div>
                    </div>

                    <!-- Bottom Indicator -->
                    <div
                      class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-700 rounded-full"></div>
                  </div>
                </div>

                <!-- Details Tab Content -->
                <div id="preview-content"
                  class="tab-content  mt-10 w-full">
                  <div 
                    class=" relative w-full  mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
                    <!-- Top Indicator -->
                    <div
                      class="absolute top-2 left-1/2 -translate-x-1/2 w-20 z-40 h-1.5 bg-gray-700 rounded"></div>

                    <!-- Content -->

                    <div style="background-image: url('{{ asset('images/ai-generated-nature-landscapes-background-free-photo.jpg') }}')"
                      class="w-full absolute  h-full px-4 text-white  rounded-lg shadow-lg overflow-hidden">
                      <!-- Profile Header -->
                  

                      <!-- Contact Actions -->
                     

                      <!-- Profile Description -->
                      <div class="border h-[350px] overflow-y-auto pt-3 mt-10 text-card-foreground shadow-sm w-full max-w-md bg-white rounded-3xl" data-v0-t="card"><div class="p-2"><div class="flex flex-col gap-4"><div class="flex items-center gap-2"><span class="text-neutral-600">To:</span><span class="bg-[#e8e0d9] text-[#8b7b71] px-4 py-1 rounded-full text-sm mobile1">Savannah C. Riley</span></div>
                      <p class="text-neutral-800 text-base leading-relaxed smsarea">Congratulations, you've won the $500 gift card in our Summer Giveaway Contest. Please DM us to claim your prize.</p></div></div></div>

                      <!-- Contact Information -->
                     
                      <div class="mt-2 flex justify-center">
    <button class="bg-blue-600 text-white text-sm px-4 py-2 rounded-full flex items-center hover:bg-blue-700">
              Send sms
    </button>
  </div>
  <div
                      class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-900 rounded-full"></div>
                        </div>
                      </div>
                    </div>
                    <!-- Bottom Indicator -->
                    
                  </div>
                </div>
              </div>
              <!-- Tab Buttons -->
              <!-- Content Area -->
            </div>
          </div>
       
       
      

    </main>

  
  <script src="{{asset('js/create-folder.js')}}"></script>
  <script>
    const previewBtn = document.getElementById("preview-btn");
    const detailBtn = document.getElementById("detail-btn");
    const previewContent = document.getElementById("preview-content");
    const detailContent = document.getElementById("detail-content");
    const urlInput = document.getElementById("url-input");
    const qrPreview = document.getElementById("qr-preview");

    previewBtn.addEventListener("click", () => {
      previewBtn.classList.add("active");
      detailBtn.classList.remove("active");
      previewContent.classList.remove("hidden");
      detailContent.classList.add("hidden");
    });

    detailBtn.addEventListener("click", () => {
      detailBtn.classList.add("active");
      previewBtn.classList.remove("active");
      detailContent.classList.remove("hidden");
      previewContent.classList.add("hidden");
    });
  </script>
  <script>
    $(document).ready(function () {
      generateQRCodeWithLogo();

      var phone = $("#phone").attr('value');  
      const countrycode = $("#countrycode").val();
      $(".mobile1").text(countrycode+'-'+phone);
      var sms = $('#sms').val(); 
      $('.smsarea').text(sms);
      

      $.validator.addMethod("greaterThan", function (value, element, param) {
          var startDate = $(param).val();
          return this.optional(element) || new Date(value) > new Date(startDate);
      }, "End date must be greater than start date");
      $("#editsmsqr_form").validate({   
        rules: {   
          phone: "required",
          sms: "required",  
          projectname:"required",
          folderinput:"required",
          startdate: {
                required: true,
                date: true
            },
            enddate: {
                required: true,
                date: true,
                greaterThan: "#startDate" // Custom validation rule
            }
        },  
        messages: {  
          phone: "Enter valid Phone number", 
          sms: "Enter SMS",
          projectname:"Enter Project Name",
          folderinput:"Choose the Folder Name",
          startdate: {
                required: "Please enter a start date",
                date: "Enter a valid date"
            },
            enddate: {
                required: "Please enter an end date",
                date: "Enter a valid date",
                greaterThan: "End date must be later than start date"
            }
        },  
        errorElement: "small",
        errorClass: "text-red-500",
        errorPlacement: function (error, element) {
          if (element.attr("name") == "phone") error.appendTo("#phoneError");
            else error.insertAfter(element);
        }
      });
      $("#sms").on('change', function(e) {
        e.preventDefault();
        const phone = $("#phone").val();
        const message = $("#sms").val(); 
        const countrycode = $("#countrycode").val();
        $(".mobile1").text(countrycode+'-'+phone);
       
        $(".smsarea").text(message);
        if (phone) {
          const smsLink = `sms:${phone}?body=${message}`;
     
        } else {
          alert("Please enter a valid phone number.");
        }
      });
      $("#phone").on('change', function(e) {
        e.preventDefault();
        const phone = $("#phone").val();
        const message = $("#sms").val();
        const countrycode = $("#countrycode").val();
        $(".mobile1").text(countrycode+'-'+phone);
        $(".smsarea").text(message);
        if (phone) {
          const smsLink = `sms:${phone}?body=${message}`;
       
        } else {
          alert("Please enter Message Text.");
        }
      });
    });
    function generateQRCodeWithLogo() {
        var canvas = document.getElementById("qr-preview");
        var url = $("#url").val();
        qrCode = new QRCodeStyling({
          "type": "canvas",
          "shape": "square",
          "width": 280,
          "height": 280,
          "data": url,
          "margin": 0,
          "qrOptions": {
            "typeNumber": "0",
            "mode": "Byte",
            "errorCorrectionLevel": "Q"
          },
          "imageOptions": {
            "saveAsBlob": true,
            "hideBackgroundDots": true,
            "imageSize": 0.4,
            "margin": 0
          },
          "dotsOptions": {
            "type": "extra-rounded",
            "color": "#6a1a4c",
            "roundSize": true
          },
          "backgroundOptions": {
            "round": 0,
            "color": "#ffffff"
          },
          "dotsOptionsHelper": {
            "colorType": {
              "single": true,
              "gradient": false
            },
            "gradient": {
              "linear": true,
              "radial": false,
              "color1": "#6a1a4c",
              "color2": "#6a1a4c",
              "rotation": "0"
            }
          },
          "cornersSquareOptions": {
            "type": "extra-rounded",
            "color": "#000000"
          },
          "cornersSquareOptionsHelper": {
            "colorType": {
              "single": true,
              "gradient": false
            },
            "gradient": {
              "linear": true,
              "radial": false,
              "color1": "#000000",
              "color2": "#000000",
              "rotation": "0"
            }
          },
          "cornersDotOptions": {
            "type": "",
            "color": "#000000"
          },
          "cornersDotOptionsHelper": {
            "colorType": {
              "single": true,
              "gradient": false
            },
            "gradient": {
              "linear": true,
              "radial": false,
              "color1": "#000000",
              "color2": "#000000",
              "rotation": "0"
            }
          },
          "backgroundOptionsHelper": {
            "colorType": {
              "single": true,
              "gradient": false
            },
            "gradient": {
              "linear": true,
              "radial": false,
              "color1": "#ffffff",
              "color2": "#ffffff",
              "rotation": "0"
            }
          }

        });
        qrCode.append(canvas);

      }
  </script>
@endsection

                       
                     
                      