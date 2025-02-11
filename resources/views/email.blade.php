@extends('layouts.layout')
@section('title', 'Create Email QR')
@section('content')
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
        <div class="lg:lg:lg:grid lg:p-8 p-4 mb-6 bg-gray-950 rounded-lg border-gray-900 border shadow-sm gap-x-6 grid-cols-12">
          <div class="col-span-8">
            <form  id="emailqr_form" style="margin-bottom: 1rem;" action="{{ route('create-emailqr') }}" method="POST">
              @csrf
              <input type="hidden" name="qroption" id="qroption">
              <div class="flex justify-start">
                <h2
                  class="text-2xl font-medium mb-3 text-center text-white">Content</h2>
              </div>
              <div class=" p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">

                <div class="space-y-4">
                  <div class="mx-auto p-6 bg-white text-black">

                    <div style="margin-bottom: 1rem;">
                      <label for="email"
                        style="font-weight: bold; margin-bottom: 0.5rem; display: block;">Email:</label>
                      <div>
                        <input
                          type="email"
                          id="email"
                          name="email"
                          placeholder="your@email.com" value="{{old('email')}}"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;"  />
                          @error('email')
                            <small class="error-message text-red-500 email">{{ $message }}</small>
                          @enderror
                      </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                      <label for="subject"
                        style="font-weight: bold; margin-bottom: 0.5rem; display: block;">Subject:</label>
                      <div>
                        <input
                          type="text"
                          id="subject"
                          name="subject"
                          placeholder="Email Subject" value="{{old('subject')}}"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;"  />
                        @error('subject')
                        <small class="text-red-700 subject">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                      <label for="message"
                        style="font-weight: bold; margin-bottom: 0.5rem; display: block;">Message:</label>
                      <div>
                        <textarea
                          id="emessage"
                          name="message"
                          placeholder="Your Message"
                          rows="4" 
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;" >{{old('message')}}</textarea>
                        @error('message')
                        <small class="text-red-700 emessage">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex mt-10 justify-start">
                <h2 class="text-2xl font-medium mb-3 text-center text-white">Enter Basic Information
                </h2>
            </div>


            <div class="lg:p-4 p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">

                <div class="space-y-4">
                    <div class="mx-auto w-full lg:p-6 bg-white text-black">

                        <div class="space-y-4">

                            <!-- QR Project Name -->
                            <div>
                                <label for="projectName" class="block font-medium text-gray-800">QR
                                    Project Name * </label>
                                <div>
                                    <input id="projectName" placeholder="Enter project name"
                                        name="projectname"
                                        class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{old('projectname')}}">
                                        @error('projectname')
                                        <small class="text-red-700 project">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>

                            <!-- Select Folder -->
                            <div
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <!-- Folder Dropdown -->
                                <div class="relative">
                                    <button type="button" id="folderDropdownButton"
                                        class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded flex justify-between items-center">
                                        <span id="selectedFolder">Select a folder</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown List -->
                                    <div id="folderDropdown"
                                        class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded shadow mt-1">
                                        @php
                                        $userId = auth()->user()->id; 
            
                                        $folders = DB::table('qr_basic_info')
                                        ->selectRaw('folder_name as name')
                                        ->where('userid', $userId)
                                        ->groupBy('folder_name')
                                        ->get();
            
                                        @endphp
                                        <ul id="folderList" class="divide-y divide-gray-200">
                                          @foreach ($folders as $folder)
                                             @php
                                                $isSelected = old('foldername') == $folder->name ? 'bg-gray-200 font-bold' : '';
                                            @endphp
                                            <li class="p-2 text-gray-600 flex items-center cursor-pointer hover:bg-gray-100 {{ $isSelected }}">
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
                                <input id="folderinput" placeholder="Folder Name" type="hidden"
                                    name="folderinput" readonly value=""
                                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg text-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                    @error('folderinput')
                                    <small class="text-red-700 folderinput">{{ $message }}</small>
                                    @enderror
                            </div>


                            <!-- Date Range -->
                            <div class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                                <div class="flex-1">
                                    <label for="startDate"
                                        class="block font-medium text-gray-800">Start Date</label>
                                    <div>
                                        <input id="startDate" min="<?php echo date('Y-m-d'); ?>"
                                            type="date"
                                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            name="startdate" value="{{old('startdate')}}">
                                            @error('startdate')
                                            <small class="text-red-700 start">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="endDate" class="block font-medium text-gray-800">End
                                        Date</label>
                                    <div>
                                        <input id="endDate" type="date"
                                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            name="enddate"  value="{{old('enddate')}}">
                                            @error('enddate')
                                            <small class="text-red-700 end">{{ $message }}</small>
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
                                    <option value="">Select Usage</option>
                                    <option value="personal" {{ old('usage') == 'personal' ? 'selected' : '' }}>Personal</option>
                                    <option value="business" {{ old('usage') == 'business' ? 'selected' : '' }}>Business</option>
                                    <option value="event" {{ old('usage') == 'event' ? 'selected' : '' }}>Event</option>
                                </select>
                            </div>

                            <!-- Remarks -->
                            <div>
                                <label for="remarks"
                                    class="block font-medium text-gray-800">Remarks</label>
                                <textarea id="remarks" name="remarks" placeholder="Enter any additional remarks"
                                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{old('remarks')}}</textarea>
                            </div>
                            <div class="flex justify-between mt-8">
                                <button type="button" onclick="location.href='QrOption.php'"
                                    class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">Previous</button>
                                <span id="message"
                                    class="bg-white justify-center align-center pt-2 font-semibold py-2 px-6 rounded-lg hidden"></span>
                                <div id="loadingIndicator"
                                    class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full">
                                        </div>
                                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                                    </div>
                                </div>

                                <button type="submit" id="nextBtn"
                                    class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]">Generate
                                    Qr Code</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-span-4">

            <style>
              canvas {
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
                    class="bg-gray-800 w-full max-w-sm mx-auto mt-10 rounded-3xl shadow-lg border-4 min-h-[550px] border-gray-900 relative overflow-hidden">
                    <!-- Top Indicator -->
                    <div
                      class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-400 z-40 rounded"></div>

                    <!-- Content -->
                    <div class="p-6 mt-5">
                      <!-- Header -->
                      <h2
                        class="text-center text-lg font-semibold text-white mb-4">
                        Scan QR Code for Contact
                      </h2>

                      <!-- QR Code Preview -->
                      <div id="qr-preview" class="bg-white w-full border-3 rounded-lg shadow-sm overflow-hidden">

                      </div>

                      <!-- Action Buttons -->

                    </div>

                    <!-- Bottom Indicator -->
                    <div
                      class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-700 rounded-full"></div>
                  </div>
                </div>

                <!-- Details Tab Content -->
                <div id="preview-content" class="tab-content mt-10 w-full">
                  <div style="background-image: url('{{ asset('images/ai-generated-nature-landscapes-background-free-photo.jpg') }}')" class="relative w-full px-2 max-w-sm mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
                    <!-- Top Indicator -->
                    <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 z-40 bg-gray-500 rounded"></div>

                    <!-- Content -->
                    <div class="rounded-lg border text-card-foreground text-black mt-10 w-full max-w-md bg-white shadow-lg relative overflow-hidden" data-v0-t="card">
                      <div class="p-6 space-y-4">
                        <div class="space-y-2">
                          <div class="flex items-center gap-2">
                            <span class="text-sm text-muted-foreground">To:</span>
                            <span class="text-sm bg-neutral-100 px-2 py-1 rounded-md " id="pemail">Recipient Name</span>
                          </div>
                          <div class="flex items-center gap-2 border-y-2 border-orange-200 py-2 mt-4">
                            <span class="text-sm text-muted-foreground">Subject:</span>
                            <span class="text-sm font-medium" id="psubject">Congratulations!!</span>
                          </div>
                        </div>


                        <div class="space-y-2 pt-0">
                          <p class="text-sm" id="pmessage">Congratulations, you've won the $500 gift card in our Summer Giveaway Contest. Please DM us to claim your prize.</p>
                        </div>
                      </div>
                    </div>

                    <button class="inline-flex mt-2 items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 h-11 rounded-md px-8 w-full bg-zinc-700 hover:bg-zinc-600 text-white text-base">SEND </button>
                    <!-- Bottom Indicator -->
                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-900 rounded-full"></div>
                  </div>
                </div>
              </div>

              <!-- Tab Buttons -->

              <!-- Content Area -->

            </div>
          </div>
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
      var passedValue = getQueryParam('option'); 
      if (passedValue !== null) {
          $('#qroption').val(passedValue);
      }
      $.validator.addMethod("greaterThan", function (value, element, param) {
          var startDate = $(param).val();
          return this.optional(element) || new Date(value) > new Date(startDate);
      }, "End date must be greater than start date");
      $("#emailqr_form").validate({   
        rules: {  
          email: {  
            required: true,  
            email: true,  
          },  
          subject: "required",
          message: "required",  
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
          email: "Enter valid Email Id", 
          subject: "Enter Subject",
          message: "Enter Message",  
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
        errorClass: "text-red-500"
      });
    });
    function getQueryParam(param) {
      var params = new URLSearchParams(window.location.search);
      return params.get(param);

    }
    $("#emessage").on('change', function(e) {
        e.preventDefault();
        const email = document.getElementById("email").value;
        const subject = document.getElementById("subject").value;
        const message = document.getElementById("emessage").value;
        $("#pemail").text(email);
        $("#psubject").text(subject);
        $("#pmessage").text(message);
        if (email) {
          // Construct mailto link
          const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(message)}`;

        }
      });
      $("#email").on('change', function(e) {
        $("#emessage").on('change', function(e) {});
      })
      $("#subject").on('change', function(e) {
        $("#emessage").on('change', function(e) {});
      })
    </script>
   
@endsection