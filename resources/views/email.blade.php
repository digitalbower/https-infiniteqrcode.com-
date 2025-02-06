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
            <form style="margin-bottom: 1rem;" id="saveForm" enctype="multipart/form-data">
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
                          placeholder="your@email.com"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;" required />
                        <label class="email"></label>
                      </div>
                      <input type="hidden" name="qroption" id="qroption" class="text-gray-600" value="Static">
                      <input type="hidden" name="qrcode" id="qrcode" class="text-gray-600" value="H0OC0A">
                      <input type="hidden" name="url" id="url" class="text-gray-600" value="https://infiniteqrcode.com/redirects/email?id=H0OC0A">
                    </div>

                    <div style="margin-bottom: 1rem;">
                      <label for="subject"
                        style="font-weight: bold; margin-bottom: 0.5rem; display: block;">Subject:</label>
                      <div>
                        <input
                          type="text"
                          id="subject"
                          name="subject"
                          placeholder="Email Subject"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;" required />
                        <label class="subject"></label>
                      </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                      <label for="message"
                        style="font-weight: bold; margin-bottom: 0.5rem; display: block;">Message:</label>
                      <div>
                        <textarea
                          id="emessage"
                          name="emessage"
                          placeholder="Your Message"
                          rows="4"
                          style="width: 100%; border: 1px solid #ccc; padding: 0.5rem; border-radius: 4px; box-sizing: border-box;" required></textarea>
                        <label class="emessage"></label>
                      </div>
                    </div>
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
                        <div>
                          <input id="projectName" placeholder="Enter project name" name="projectname"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                          <label class="project"></label>
                        </div>
                      </div>

                      <!-- Select Folder -->
                      <div class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <!-- Folder Dropdown -->
                        <div class="relative">
                          <button type="button"
                            id="folderDropdownButton"
                            class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded flex justify-between items-center" required>
                            <span id="selectedFolder">Select a folder</span>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-5 w-5"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2">
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 9l-7 7-7-7" />
                            </svg>
                          </button>
                          <!-- Dropdown List -->
                          <div
                            id="folderDropdown"
                            class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded shadow mt-1">
                            <ul id="folderList" class="divide-y divide-gray-200"></ul>
                            <div class="flex justify-center"> <button
                                id="addFolderButton" type="button"
                                class="w-full text-green-500 font-semibold py-2 hover:bg-green-100 flex items-center justify-center">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="h-5 w-5 mr-1"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke="currentColor"
                                  stroke-width="2">
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4" />
                                </svg>
                                Add New Folder
                              </button>
                            </div>
                          </div>
                        </div>
                        <input id="folderinput" placeholder="Folder Name" type="hidden" name="folderinput" readonly value="" class="w-full p-3 mt-2 border border-gray-300 rounded-lg text-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        <label class="folderinput"></label>
                      </div>

                      <!-- Date Range -->
                      <div
                        class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                        <div class="flex-1">
                          <label for="startDate"
                            class="block font-medium text-gray-800">Start Date</label>
                          <div>
                            <input id="startDate" min="2025-02-05" type="date"
                              class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="startdate">
                            <label class="start"></label>
                          </div>
                        </div>
                        <div class="flex-1">
                          <label for="endDate"
                            class="block font-medium text-gray-800">End Date</label>
                          <input id="endDate" type="date"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="enddate">
                        </div>
                      </div>

                      <!-- Usage -->
                      <div>
                        <label for="usage"
                          class="block font-medium text-gray-800">Usage</label>
                        <select id="usage" name="usage"
                          class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                          <option value="Usage">Select Usage</option>
                          <option value="personal">Personal</option>
                          <option value="business">Business</option>
                          <option value="event">Event</option>
                        </select>
                      </div>

                      <!-- Remarks -->
                      <div>
                        <label for="remarks"
                          class="block font-medium text-gray-800">Remarks</label>
                        <textarea id="remarks" name="remarks"
                          placeholder="Enter any additional remarks"
                          class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
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
                  <div style="background-image: url(./img/ai-generated-nature-landscapes-background-free-photo.jpg)" class="relative w-full px-2 max-w-sm mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
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
  </div>
  
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');

  // Function to show sidebar and hide hamburger icon
  const showSidebar = () => {
    sidebar.classList.remove('-translate-x-full');  // Show the sidebar
    overlay.classList.remove('hidden');  // Show the overlay
    menuToggle.classList.add('hidden');  // Hide the hamburger menu icon
  };

  // Function to hide sidebar and show hamburger icon
  const hideSidebar = () => {
    sidebar.classList.add('-translate-x-full');  // Hide the sidebar
    overlay.classList.add('hidden');  // Hide the overlay
    menuToggle.classList.remove('hidden');  // Show the hamburger menu icon
  };

  // Show Sidebar when the menu toggle button is clicked
  menuToggle.addEventListener('click', showSidebar);

  // Close Sidebar when the close button is clicked
  closeSidebar.addEventListener('click', hideSidebar);

  // Close Sidebar when the overlay is clicked
  overlay.addEventListener('click', hideSidebar);
</script>

<script
    type="text/javascript"
    src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
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
    $(document).ready(function() {
      var qrCode;
      $("#nextBtn").on('click', async function(e) {
        if (validateForm()) {
          e.preventDefault();
          const blob = await qrCode.getRawData("png");
          var formData = new FormData($("#saveForm")[0]);
          formData.append("qrCodeBase64", blob, "qr-code.png");

          $("#loadingIndicator").removeClass("hidden");

          $.ajax({
            type: "POST",
            url: "qrbackend/storeEmail.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              var data = JSON.parse(response);
              if (data.success) {
                setTimeout(() => {
                  location.href = 'my-qr-codes.php';
                }, 2000);
              } else {
                $("#message").removeClass('hidden').text(data.error).addClass("text-red-700");
              }
            },
            fail: function() {
              $("#message").removeClass('hidden').text('Network error. Please try again later.').addClass("text-red-700");
            },
            complete: function() {
              $("#loadingIndicator").addClass('hidden');
            }
          });
        }
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
      generateQRCodeWithLogo();

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

      function validateForm() {
        let isValid = true;
        // Get form elements
        const email = document.getElementById("email");
        const subject = document.getElementById("subject");
        const emessage = document.getElementById("emessage");
        const projectName = document.getElementById("projectName");
        const folderInput = document.getElementById("folderinput");
        const startDate = document.getElementById("startDate");
        const endDate = document.getElementById("endDate");
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        // Validate Project Name
        if (email.value.trim() === "" || !pattern.test(email.value)) {
          $(".email").text('Enter the valid Email Id');
          $(".email").addClass("text-red-700 ");
          isValid = false;
        } else {
          $(".email").text('');
        }
        if (subject.value.trim() === "") {

          $(".subject").text('Enter the Subject');
          $(".subject").addClass("text-red-700 ");
          isValid = false;
        } else {
          $(".subject").text('');
        }
        if (emessage.value.trim() === "") {
          $(".emessage").text('Enter the Message');
          $(".emessage").addClass("text-red-700 ");
          isValid = false;
        } else {
          $(".emessage").text('');
        }
        if (projectName.value.trim() === "") {
          $(".project").text('Enter the Project Name');
          $(".project").addClass("text-red-700 ");
          isValid = false;
        } else {
          $(".project").text('');
        }
        if (folderInput.value.trim() === "") {
          $(".folderinput").text('choose the Folder Name');
          $(".folderinput").addClass("text-red-700 ");
          isValid = false;
        } else {
          $(".folderinput").text('');
        }
        if ((endDate.value.trim() !== '') > (startDate.value.trim() != '')) {

          $(".start").text('End Date cannot be lesser than Start Date');
          $(".start").addClass("text-red-700 ");
        } else {
          $(".start").text('');

        }
        return isValid;
      }
    });
  </script>
@endsection