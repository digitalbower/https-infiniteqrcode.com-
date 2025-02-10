@extends('layouts.layout')
@section('title', 'Social Media')
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
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-white"
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
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
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
                        <div class="flex justify-start">
                            <h2 class="text-2xl font-medium mb-3 text-center text-white">Content</h2>
                        </div>
                        <form  id="socialqr_form" style="margin-bottom: 1rem;" action="{{ route('create-socialqr') }}" method="POST">
                            @csrf
                            <input type="hidden" name="qroption" id="qroption">
                            <div class="w-full mx-auto p-6 bg-gray-50 rounded-lg shadow">
                                <h5 class="text-gray-700 text-sm mb-4">
                                  Add your username or links to social media pages below.</h5>
                                <label class="urlerror"></label>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- Social Media Input Groups -->
                                <div class="space-y-4">
                                  <!-- Facebook -->
                                   <input type="hidden" name="qroption" id="qroption" class="text-gray-600" value="Static">
                                        <input type="hidden" name="code" id="code" class="text-gray-600" value="R1Q9FM">
                                        <input type="hidden" name="url" id="url" class="text-gray-600" value="https://infiniteqrcode.com/redirects/sm-marketing?id=R1Q9FM">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-facebook-f w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="fburl" name="fburl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://www.facebook.com/page" />
                
                                      </div>
                                      <label for="fburl" class="fburl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="fbtext" name="fbtext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Follow us on Facebook" value="Follow us on Facebook" />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- YouTube -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-youtube w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="yturl" name="yturl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://www.youtube.com/@YouTube" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="yutext" name="yutext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Watch my Videos" />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Whatsapp -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"> <i class="fab fa-whatsapp w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="whturl" name="whturl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://wa.me/9XXXXXXXXX" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="whtext" name="whtext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Whatsapp Me" />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Instagram -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-instagram w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="insurl" name="insurl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="instagram.com/yourusername" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="instext" name="instext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="See My Insta" />
                                      </div>
                                    </div>
                                  </div>        
                                  <!-- We Chat -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-weixin w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="wchurl" name="wchurl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="weixin://" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="wchtext" name="wchtext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="we Start Chat" />
                                      </div>
                                    </div>
                                  </div>            
                                  <!-- tiktok -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-tiktok w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="tikurl" name="tikturl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://www.tiktok.com/@username" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="tiktext" name="tiktext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Watch my Reels" />
                                      </div>
                                    </div>
                                  </div>    
                                  <!-- Douyin -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"> <i class="fab fa-snapchat-ghost w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="dyurl" name="dyurl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://www.douyin.com/follow" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="dytext" name="dytext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Watch my Videos" />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Telegram -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"><i class="fab fa-telegram-plane w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="telurl" name="telurl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="https://t.me/username" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="teltext" name="teltext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Connect With me" />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Snapchat -->
                                  <div class="flex items-center space-x-4">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-600 rounded-full">
                                      <span class="text-white text-lg"> <i class="fab fa-snapchat-ghost w-5 h-5"></i></span>
                                    </div>
                                    <div class="flex-1">
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm w-1/4 mt-1 font-medium border border-gray-300 p-2 bg-gray-300 text-gray-600">URL
                                          *</label>
                                        <input type="text" id="snpurl" name="snpurl"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="snapchat.com/add/[USERNAME]" />
                
                                      </div>
                                      <label for="yturl" class="yturl1"></label>
                                      <div class="flex items-center">
                                        <label
                                          class="block text-sm border mt-1 w-1/4 border-gray-300 p-2 bg-gray-300 font-medium text-gray-600 mt-2">Text</label>
                                        <input type="text" id="snptext" name="snptext"
                                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="" value="Share your Active Moments" />
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                
                              <div class="flex mt-10 justify-start">
                                <h2 class="text-2xl font-medium mb-3 text-center text-white">Enter Basic Information</h2>
                              </div>
                              <div class="lg:p-4 p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">
                
                                <div class="space-y-4">
                                  <div class="mx-auto w-full lg:p-6 bg-white text-black">
                
                                    <div class="space-y-4">
                
                                      <!-- QR Project Name -->
                                      <div>
                                        <label for="projectName" class="block font-medium text-gray-800">QR Project Name * </label>
                                        <div>
                                          <input id="projectName" placeholder="Enter project name" name="projectname"
                                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                          <label class="projectName text-red-700"></label>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                              stroke="currentColor" stroke-width="2">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                          </button>
                                          <!-- Dropdown List -->
                                          <div id="folderDropdown"
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
                                            <!-- <button
                                                id="FolderB" type="button"
                                                class="w-full text-green-500  font-semibold py-2 hover:bg-green-100 p-2 flex items-center justify-center">
                                                    Create 
                                              </button> -->
                                            </div>
                                          </div>
                                        </div>
                                        <input id="folderinput" placeholder="Folder Name" type="hidden" name="folderinput" readonly
                                          value=""
                                          class="w-full p-3 mt-2 border border-gray-300 rounded-lg text-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                        <label class="folderinput"></label>
                                      </div>
                                      <!-- Date Range -->
                                      <div class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                                        <div class="flex-1">
                                          <label for="startDate" class="block font-medium text-gray-800">Start Date</label>
                                          <div>
                                            <input id="startDate" min="2025-02-09" type="date"
                                              class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              name="startdate">
                                            <label class="start text-red-700"></label>
                                          </div>
                                        </div>
                                        <div class="flex-1">
                                          <label for="endDate" class="block font-medium text-gray-800">End Date</label>
                                          <div>
                                            <input id="endDate" type="date"
                                              class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              name="enddate">
                                            <label class="end text-red-700"></label>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Usage -->
                                      <div>
                                        <label for="usage" class="block font-medium text-gray-800">Usage</label>
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
                                        <label for="remarks" class="block font-medium text-gray-800">Remarks</label>
                                        <textarea id="remarks" name="remarks" placeholder="Enter any additional remarks"
                                          class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                      </div>
                                      <div class="flex justify-between mt-8">
                  <button type="button" onclick="location.href='QrOption.php'"
                    class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">Previous</button>
                  <span id="message" class="bg-white justify-center align-center pt-2 font-semibold py-2 px-6 rounded-lg hidden"></span>
                  <div id="loadingIndicator"
                    class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
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
                              canvas{
                                width:100%;
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
                                <div class="flex bg-gray-200 rounded-full justify-around shadow-md">
                                  <button id="preview-btn"
                                    class="tab-button text-sm text-gray-500 px-0 w-full py-3 rounded-full transition duration-300 focus:outline-none active">
                                    Preview
                                  </button>
                                  <button id="detail-btn"
                                    class="tab-button text-sm text-gray-500 px-0 w-full py-3 rounded-full transition duration-300 focus:outline-none ">
                                    QRCode
                                  </button>
                                </div>
                
                                <!-- Preview Tab Content -->
                                <div id="detail-content" class="tab-content mt-10 w-full hidden">
                                  <div
                                    class="bg-gray-800 w-full max-w-sm mx-auto mt-10 rounded-3xl shadow-lg border-4 min-h-[550px] border-gray-900 relative overflow-hidden">
                                    <!-- Top Indicator -->
                                    <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-700 rounded"></div>
                
                                    <!-- Content -->
                                    <div class="p-6 mt-5">
                                      <!-- Header -->
                                      <h2 class="text-center text-lg font-semibold text-white mb-4">
                                        Scan QR Code for Events
                                      </h2>
                
                                      <!-- QR Code Preview -->
                                      <div id="qr-preview" class="bg-white w-full border-3 rounded-lg shadow-sm overflow-hidden">
                
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
                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-700 rounded-full"></div>
                                  </div>
                                </div>
                
                                <!-- Details Tab Content -->
                                <div id="preview-content" class="tab-content mt-10 w-full">
                                  <div
                                    class=" relative bg-gray-800 relative w-full py-2 px-2  max-w-sm mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
                                    <!-- Top Indicator -->
                                    <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-700 rounded"></div>
                
                                    <div class="w-full relative mt-12 max-w-md bg-[#2A9D8F] relative">
                                      <div class="absolute -top-6 left-1/2 -translate-x-1/2 transform">
                                        <div class="bg-[#FF8A7B] text-black px-6 py-2 rounded shadow relative font-serif">
                                          <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                                            <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                                          </div>
                                          Follow Me
                                        </div>
                                      </div>
                                      <div class="pt-10 text-center">
                                        <h2 class="text-white text-center font-bold text-xl sm:text-xl font-serif tracking-wider">
                                          FOLLOW ME ON SOCIAL MEDIA
                                        </h2>
                                      </div>
                                      <div class="space-y-2 p-6  h-[300px] pb-10  overflow-hidden overflow-y-scroll scrollbar-hide">
                                        <!-- Facebook -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-facebook-f w-5 h-5"></i>
                                          <p class="text-sm facebook">@REALLYGREATSITE</p>
                                        </button>
                                        <style>
                                          /* Hide scrollbar */
                                          .scrollbar-hide::-webkit-scrollbar {
                                            display: none;
                                          }
                
                                          .scrollbar-hide {
                                            -ms-overflow-style: none;
                                            /* IE and Edge */
                                            scrollbar-width: none;
                                            /* Firefox */
                                          }
                                        </style>
                                        <!-- YouTube -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-youtube w-5 h-5"></i>
                                          <p class="text-sm youtube">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- WhatsApp -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-whatsapp w-5 h-5"></i>
                                          <p class="text-sm whatsapp">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- Instagram -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-instagram w-5 h-5"></i>
                                          <p class="text-sm instagram">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- WeChat -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-weixin w-5 h-5"></i>
                                          <p class="text-sm weixin">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- TikTok -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-tiktok w-5 h-5"></i>
                                          <p class="text-sm tiktok">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- Douyin -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-snapchat-ghost w-5 h-5"></i>
                                          <p class="text-sm douyin">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- Telegram -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-telegram-plane w-5 h-5"></i>
                                          <p class="text-sm telegram">@REALLYGREATSITE</p>
                                        </button>
                
                                        <!-- Snapchat -->
                                        <button
                                          class="w-full bg-white hover:bg-gray-100 text-gray-600 font-serif flex items-center gap-2 justify-start px-2 py-2">
                                          <i class="fab fa-snapchat-ghost w-5 h-5"></i>
                                          <p class="text-sm snapchat">@REALLYGREATSITE</p>
                                        </button>
                
                                        
                                      </div>
                
                
                                    </div>
                
                </html>
                
                
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
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script
                    type="text/javascript"
                    src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="New-folder/create-folder.js"></script>
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
                    var qrCode;
                    $("#nextBtn").on('click', async function (e) {
                      if (validateForm()) {
                        e.preventDefault();
                        const blob = await qrCode.getRawData("png");
                        var formData = new FormData($("#saveForm")[0]);
                        formData.append("qrCodeBase64", blob, "qr-code.png");
                        $("#loadingIndicator").removeClass("hidden");
                        $.ajax({
                          type: "POST",
                          url: "qrbackend/storesocmed.php",
                          data: formData,
                          contentType: false, // Do not set content-type for FormData
                          processData: false, // Let jQuery handle data processing
                          success: function (response) {
                            var data = JSON.parse(response);
                            if (data.success) {
                
                              setTimeout(() => {
                                location.href = 'my-qr-codes.php';
                              }, 2000);
                            } else {
                              $("#message").removeClass('hidden');
                              $("#message").text('Error: ' + data.error);
                              $("#message").addClass("text-red-700 bg-white-700");
                            }
                          },
                          complete: function (data) {
                            $("#loadingIndicator").addClass('hidden');
                          },
                          error: function () {
                            $("#loadingIndicator").addClass('hidden');
                          }
                
                        });
                      }
                    });
                     $('.facebook').text($('#fbtext').val());
                     $('.youtube').text($('#yutext').val());
                      $('.whatsapp').text($('#whtext').val());
                      $('.instagram').text($('#instext').val());
                       $('.weixin').text($('#wchtext').val());
                        $('.tiktok').text($('#tiktext').val());
                         $('.douyin').text($('#dytext').val());
                          $('.telegram').text($('#teltext').val());
                           $('.snapchat').text($('#snptext').val());
                      
                    $('#fbtext').on('input', function () {
                      $('.facebook').text($(this).val());
                    });
                    $('#yutext').on('input', function () {
                      $('.youtube').text($(this).val());
                    });
                    $('#whtext').on('input', function () {
                      $('.whatsapp').text($(this).val());
                    });
                    
                    $('#instext').on('input', function () {
                      $('.instagram').text($(this).val());
                    });
                    $('#wchtext').on('input', function () {
                      $('.weixin').text($(this).val());
                    });
                    
                     $('#tiktext').on('input', function () {
                      $('.tiktok').text($(this).val());
                    });
                     $('#dytext').on('input', function () {
                      $('.douyin').text($(this).val());
                    });
                     $('#teltext').on('input', function () {
                      $('.telegram').text($(this).val());
                    });
                     $('#snptext').on('input', function () {
                      $('.snapchat').text($(this).val());
                    });
                function validateURL(value) {
                    const urlPattern = new RegExp(
                        '^https?://' + // Protocol (http or https)
                        '(([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}|' + // Domain name
                        'localhost|' + // Localhost
                        '\\d{1,3}(\\.\\d{1,3}){3})' + // OR IPv4 address
                        '(:\\d+)?' + // Optional port
                        '(\\/.*)?$', // Path
                        'i' // Case-insensitive
                    );
                
                    return urlPattern.test(value);
                }
                
                
                  $('#fburl').on('input', function () {
                      if(!validateURL($(this).val())) {
                      $('.urlerror').text('Facebook - Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                      }else{
                           $('.urlerror').text(' ');
                      }
                    });
                    $('#yturl').on('input', function () {
                        if(!validateURL( $(this).val())) {
                      $('.urlerror').text('Youtube Invalid Url');
                       $('.urlerror').addClass('text-red-700');
                        }else{
                           $('.urlerror').text(' ');
                      }
                    });
                    $('#whturl').on('input', function () {
                        if(!validateURL( $(this).val())) {
                      $('.urlerror').text('Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                        }else{
                           $('.urlerror').text(' ');
                      }
                    });
                    
                    $('#insurl').on('input', function () {
                        if(!validateURL( $(this).val())) {
                      $('.urlerror').text( 'Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                        }else{
                           $('.urlerror').text(' ');
                      }
                    });
                    $('#wchurl').on('input', function () {
                        if(!validateURL( $(this).val())) {
                      $('.urlerror').text( 'Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                        }else{
                           $('.urlerror').text(' ');
                      }
                    });
                    
                     $('#tikurl').on('input', function () {
                         if(!validateURL( $(this).val())) {
                      $('.urlerror').text( 'Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                         }
                    });
                     $('#dyurl').on('input', function () {
                         if(!validateURL( $(this).val())) {
                      $('.urlerror').text( 'Doyuin - Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                         }else{
                           $('.urlerror').text(' ');
                      }
                    });
                     $('#telurl').on('input', function () {
                     if(!validateURL( $(this).val())) {     
                      $('.urlerror').text( 'telegram - Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                     }else{
                           $('.urlerror').text(' ');
                      }
                    });
                     $('#snpurl').on('input', function () {
                      if(validateURL( $(this).val())) {   
                      $('.urlerror').text('snap - Invalid URL');
                       $('.urlerror').addClass('text-red-700');
                      }else{
                           $('.urlerror').text(' ');
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
                
                    function validateForm() {
                      let isValid = true;
                      // Get form elements
                
                
                      const fburl = document.getElementById("fburl");
                      const yturl = document.getElementById("yturl");
                
                
                      const projectName = document.getElementById("projectName");
                      const folderInput = document.getElementById("folderinput");
                      const startDate = document.getElementById("startDate");
                      const endDate = document.getElementById("endDate");
                
                      var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                
                
                
                      
                     
                      if (projectName.value.trim() === "") {
                        $(".projectName").text('Enter the Project Name');
                        $(".projectName").addClass("text-red-700 bg-white-700");
                        isValid = false;
                      } else {
                        $(".projectName").text('');
                      }
                      if (folderInput.value.trim() === "") {
                        $(".folderinput").text('Choose the Folder Name');
                        $(".folderinput").addClass("text-red-700 bg-white-700");
                        isValid = false;
                      } else {
                        $(".folderinput").text('');
                      }
                      if ((endDate.value.trim() !== '') < (startDate.value.trim() !== '')) {
                        $(".end").text('End Date cannot be lesser than Start Date');
                        $(".end").addClass("text-red-700 bg-white-700");
                      } else {
                        $(".end").text('');
                      }
                      return isValid;
                    }
                  });
                </script>

{{-- <script>
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
<script src="{{asset('js/create-folder.js')}}"></script>
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
    $("#socialqr_form").validate({   
        rules: {  
            whtext:"required",
            whurl:{
                    required: true,
                    url: true
                },
            fbtext:"required",
            fburl:{
                    required: true,
                    url: true
                },
            ybtext:"required",
            yturl:{
                    required: true,
                    url: true
                },
            insurl:{
                    required: true,
                    url: true
                },
            instext:"required",
            wchurl:{
                    required: true,
                    url: true
                },
            wchtext:"required",
            tikurl:{
                    required: true,
                    url: true
                },
            tiktext:"required",
            dyurl:{
                    required: true,
                    url: true
                },
            dytext:"required",
            telurl:{
                    required: true,
                    url: true
                },
            teltext:"required",
            snpurl:{
                    required: true,
                    url: true
                },
            snptext:"required",
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
            whtext:"This field is required",
            whurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            fbtext:"This field is required",
            fburl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            ybtext:"This field is required",
            yturl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            insurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            instext:"This field is required",
            wchurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            wchtext:"This field is required",
            tikurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            tiktext:"This field is required",
            dyurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            dytext:"This field is required",
            telurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            teltext:"This field is required",
            snpurl:{
                    required: "This field is required",
                    url: "Enter a valid URL"
            },
            snptext:"This field is required",
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
            // Append each error message to the single error label
            $("#allErrors").append(error);
        },
        showErrors: function (errorMap, errorList) {
            let errorMessages = "";
            $.each(errorList, function (index, error) {
                errorMessages += error.message + "<br>";
            });
            $("#allErrors").html(errorMessages);
        
        }
    });
    });
    function getQueryParam(param) {
    var params = new URLSearchParams(window.location.search);
    return params.get(param);

    }
</script> --}}
@endsection
