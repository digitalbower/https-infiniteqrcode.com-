@extends('layouts.layout')
@section('title', 'Edit VCard Qrcode')
@section('content')
        <!-- Main Content Area -->
        <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">
            <div class="container mx-auto pb-12 md:px-6 sm:px-8 lg:px-12">
                <div class="flex-1 w-full p-4 lg:px-12">
                    <div class="container text-center mx-auto pt-1 lg:px-12">
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
                        <div class="flex justify-start">
                            <h2 class="text-2xl font-medium mb-3 text-center text-white">Content</h2>
                        </div>                        
                        <form class="space-y-4 text-black"  id="editvcardqr_form" style="margin-bottom: 1rem;" enctype="multipart/form-data" action="{{ route('update-vcardqr',$vcard->code) }}" method="POST">
                            @csrf
                            <input type="hidden" name="qroption" id="qroption" value="{{$vcard->qrtype}}">
                            <input type="hidden" name="url" id="url" value="{{route('preview-vcard',$vcard->code)}}">

                            <div class="lg:p-8 p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">
                                <div>
                                    <label class="block font-medium mb-1">Profile Picture:</label>
                                    <input type="file" placeholder="propicture" accept=".jpg, .jpeg, .png, .gif"
                                        class="border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                        name="contactimg" id="propicture" />
                                </div>
                                <small id="contactimg"></small>
                                @error('contactimg')
                                <small class="text-red-700 propicture">{{ $message }}</small>
                                @enderror
                                <div>
                                    <label class="block font-medium mb-1">Your Name:* </label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <input type="text" placeholder="First name" name="first_name"
                                                id="first_name"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500" value="{{$vcard->first_name}}"/>
                                            <br>
                                            @error('first_name')
                                            <small class="text-red-700 fname">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Last name" name="last_name"
                                                id="lastname"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500" value="{{$vcard->last_name}}"/>
                                            <br>
                                            @error('last_name')
                                            <small class="text-red-700 lname">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div id="cropperContainer1" class="hidden">
                                        <div style="width: 300px; height: 300px;">
                                            <img id="cropImage1" style="width: 100%;" />
                                        </div>
                                        <button id="saveButton1"
                                            class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save
                                            Cropped Image</button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-medium mb-1">Contact:*</label>
                                    <div class="grid grid-cols-2 gap-4 mb-2">
                                        <div>
                                            <input type="tel" placeholder="Mobile"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                                name="mobile" id="mobile"  value="{{$vcard->mobile}}" />
                                            @error('mobile')
                                                <small class="text-red-700 mobile">{{ $message }}</small>
                                            @enderror   
                                        </div>
                                        <div>
                                            <input type="email" placeholder="your@email.com"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                                name="email" id="email" value="{{$vcard->email}}" />
                                                @error('email')
                                                <small class="text-red-700 email">{{ $message }}</small>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-medium mb-1">Company:*</label>
                                    <input type="text" placeholder="Company"
                                        class="border rounded-md p-2 focus:ring-2 mb-2 focus:ring-blue-500"
                                        name="company" id="company" value="{{$vcard->company}}" />
                                      
                                </div>
                                <small id="company_name"></small>
                                @error('company')
                                 <small class="text-red-700 company">{{ $message }}</small>
                                @enderror 

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">Street:</label>
                                        <input type="text" placeholder="Street"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="street" id="street" value="{{$vcard->street}}"/>
                                        @error('street')
                                            <small class="text-red-700 street">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">Website:</label>
                                        <input type="text" placeholder="Website"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="website" id="Website" value="{{$vcard->website}}"/>
                                        @error('website')
                                            <small class="text-red-700 street">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">City:</label>
                                        <input type="text" placeholder="City"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="city" id="city"  value="{{$vcard->city}}"/>
                                        @error('city')
                                            <small class="text-red-700 city">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">ZIP:</label>
                                        <input type="text" placeholder="ZIP"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="zip" id="zip" value="{{$vcard->zip}}"/>
                                        @error('zip')
                                            <small class="text-red-700 zip">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">State:</label>
                                        <input type="text" placeholder="State"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="state" id="state" value="{{$vcard->state}}"/>
                                        @error('state')
                                            <small class="text-red-700 state">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">Country:</label>
                                        <input type="text" placeholder="Country"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="country" id="country" value="{{$vcard->country}}"/>
                                        @error('country')
                                            <small class="text-red-700 country">{{ $message }}</small>
                                        @enderror 
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
                                                        class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{$vcard->project_name}}">
                                                        @error('projectname')
                                                        <small class="text-red-700 project">{{ $message }}</small>
                                                        @enderror
                                                </div>
                                            </div>

                                               <!-- Select Folder -->
                              <div class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">                           
                                <!-- Folder Dropdown -->
                                <div class="relative">
                                    <button type="button" id="folderDropdownButton"
                                        class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded flex justify-between items-center">
                                        <span id="selectedFolder">{{ $vcard->folder_name ?? 'Select a folder' }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                            
                                    <!-- Dropdown List -->
                                    <div id="folderDropdown" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded shadow mt-1">
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
                                                    $isSelected = isset($vcard->folder_name) && $vcard->folder_name == $folder->name ? 'bg-gray-200 font-bold' : '';
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
                                <input id="folderinput" type="hidden" name="folderinput" value="{{ $vcard->folder_name ?? '' }}" />
                              </div>                            
                              <small id="folder"></small>
                              @error('folderinput')
                              <small class="text-red-700 folderinput">{{ $message }}</small>
                              @enderror


                                            <!-- Date Range -->
                                            <div class="flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                                                <div class="flex-1">
                                                    <label for="startDate"
                                                        class="block font-medium text-gray-800">Start Date</label>
                                                    <div>
                                                        <input id="startDate" min="<?php echo date('Y-m-d'); ?>"
                                                            type="date"
                                                            class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                            name="startdate" value="{{$vcard->start_date}}">
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
                                                            name="enddate"  value="{{$vcard->end_date}}">
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
                                                    <option value="personal" {{ $vcard->usage_type == 'personal' ? 'selected' : '' }}>Personal</option>
                                                    <option value="business" {{ $vcard->usage_type== 'business' ? 'selected' : '' }}>Business</option>
                                                    <option value="event" {{ $vcard->usage_type== 'event' ? 'selected' : '' }}>Event</option>
                                                </select>
                                            </div>

                                            <!-- Remarks -->
                                            <div>
                                                <label for="remarks"
                                                    class="block font-medium text-gray-800">Remarks</label>
                                                <textarea id="remarks" name="remarks" placeholder="Enter any additional remarks"
                                                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{$vcard->remarks}}</textarea>
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
                                width: 100%;
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
                                        <div
                                            class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-gray-700 rounded">
                                        </div>

                                        <!-- Content -->
                                        <div class="p-6 mt-5">
                                            <!-- Header -->
                                            <h2 class="text-center text-lg font-semibold text-white mb-4">
                                                Scan QR Code for Contact
                                            </h2>

                                            <!-- QR Code Preview -->
                                            <div id="qr-preview"
                                                class="bg-white w-full border-3 rounded-lg shadow-sm overflow-hidden">

                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="mt-6 flex flex-col gap-4 items-center">
                                                <button id="downloadBtn"
                                                    class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                                    Generate vCard
                                                </button>
                                                <a id="download-vcard" style="display: none;">Download vCard</a>
                                                <!-- <button
                            class="px-4 py-2 bg-gray-700 text-white font-medium rounded-lg shadow hover:bg-gray-800 focus:ring focus:ring-gray-500">
                            Save Contact
                          </button> -->
                                            </div>
                                        </div>

                                        <!-- Bottom Indicator -->
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-700 rounded-full">
                                        </div>
                                    </div>
                                </div>

                                <!-- Details Tab Content -->
                                <div id="preview-content" class="tab-content  mt-10 w-full">
                                    <div
                                        class=" relative w-full  max-w-sm mx-auto rounded-3xl shadow-lg border-4 min-h-[500px] border-gray-900 relative overflow-hidden">
                                        <!-- Top Indicator -->
                                        <div
                                            class="absolute top-2 left-1/2 -translate-x-1/2 w-20 z-40 h-1.5 bg-gray-700 rounded">
                                        </div>

                                        <!-- Content -->
                                        <div
                                            class="w-full max-w-md bg-zinc-900 border-0 shadow-2xl pb-10 max-h-[500px] rounded-lg overflow-hidden overflow-y-scroll scrollbar-hide">
                                            <div class="relative">
                                                <!-- Background Shape -->
                                                <div class="absolute inset-0">
                                                    <div class="w-3/4 h-48 bg-[#008B9E] rounded-r-full"></div>
                                                    <!-- Dots Pattern -->
                                                    <div class="absolute top-0 right-0 w-24 h-24 opacity-50">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div class="w-1.5 h-1.5 bg-[#008B9E]/40 rounded-full">
                                                            </div>
                                                            <!-- Repeat dots here -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Profile Image -->
                                                <div class="relative flex justify-center py-8">
                                                    <div
                                                        class="w-32 h-32 rounded-full border-4 border-white overflow-hidden">
                                                        <img src="{{ Storage::disk('public')->exists($vcard->contactimg) ? asset('storage/'.$vcard->contactimg) : asset('images/default.jpeg') }}" alt="Profile"
                                                            class="w-full h-full object-cover" id="propreview"
                                                            name="propreview">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Name and Title -->
                                            <div class="text-center space-y-1 mb-2 mt-1">
                                                <h1 class="text-[#FFB95C] text-2xl font-bold tracking-wider name">{{ strtoupper($vcard->first_name . ' ' . $vcard->last_name) }}</h1>
                                                <p class="text-white text-sm tracking-widest font-light company">
                                                    BUSINESS CONSULTANT</p>
                                            </div>

                                            <!-- Contact Form -->
                                            <div class="space-y-2 px-4 pb-2">
                                                <label for="firstName"
                                                    class="block text-sm font-medium text-white">First Name</label>
                                                <input type="text" id="firstName" placeholder="First Name"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="lastName"
                                                    class="block text-sm font-medium text-white">Last Name</label>
                                                <input type="text" id="lastName" placeholder="Last Name"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="phone"
                                                    class="block text-sm font-medium text-white">Phone Number</label>
                                                <input type="tel" id="phone" placeholder="Phone Number"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pemail"
                                                    class="block text-sm font-medium text-white">Email</label>
                                                <input type="email" id="pemail" placeholder="Email"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pcompany"
                                                    class="block text-sm font-medium text-white">Company</label>
                                                <input type="text" id="pcompany" placeholder="Company"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="paddress"
                                                    class="block text-sm font-medium text-white">Address</label>
                                                <input type="text" id="paddress" placeholder="Address"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pwebsite"
                                                    class="block text-sm font-medium text-white">Website</label>
                                                <input type="url" id="pwebsite" placeholder="Website"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pcity"
                                                    class="block text-sm font-medium text-white">City</label>
                                                <input type="text" id="pcity" placeholder="City"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pstate"
                                                    class="block text-sm font-medium text-white">State</label>
                                                <input type="text" id="pstate" placeholder="State"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pzip" class="block text-sm font-medium text-white">ZIP
                                                    Code</label>
                                                <input type="text" id="pzip" placeholder="ZIP Code"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <label for="pcountry"
                                                    class="block text-sm font-medium text-white">Country</label>
                                                <input type="text" id="pcountry" placeholder="Country"
                                                    class="w-full bg-[#008B9E] border-0 text-white placeholder-white/70 h-9 text-sm rounded-md px-2">

                                                <button
                                                    class="w-full bg-[#FFB95C] hover:bg-gold/90 text-zinc-900 font-semibold text-base h-10 rounded-md mt-2">
                                                    Add to contact
                                                </button>
                                            </div>


                                            <!-- Bottom Indicator -->
                                            <div
                                                class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-10 bg-gray-900 rounded-full">
                                            </div>
                                        </div>

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

                                    </div>
                                </div>

                                <!-- Tab Buttons -->

                                <!-- Content Area -->

                            </div>


                        </div>
                    </div>

                </div>

        </main>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
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
            var firstname = $('#first_name').val(); 
            $('#firstName').val(firstname);
            var lastname = $('#lastname').val(); 
            $('#lastName').val(lastname);
            var mobile = $('#mobile').val(); 
            $('#phone').val(mobile);
            var email = $('#email').val(); 
            $('#pemail').val(email);
            var company = $('#company').val(); 
            $('#pcompany').val(company);
            var street = $('#street').val(); 
            $('#paddress').val(street);
            var Website = $('#Website').val(); 
            $('#pwebsite').val(Website);
            var city = $('#city').val(); 
            $('#pcity').val(city);
            var state = $('#state').val(); 
            $('#pstate').val(state);
            var zip = $('#zip').val(); 
            $('#pzip').val(zip);
            var country = $('#country').val(); 
            $('#pcountry').val(country);


            $.validator.addMethod("greaterThan", function (value, element, param) {
                var startDate = $(param).val();
                return this.optional(element) || new Date(value) > new Date(startDate);
            }, "End date must be greater than start date");
            $.validator.addMethod("imageType", function (value, element) {
                return this.optional(element) || /\.(jpg|jpeg|png)$/i.test(value);
            }, "Only JPG, JPEG, or PNG files are allowed.");
            $("#editvcardqr_form").validate({   
                rules: {  
                contactimg:{
                    imageType: true
                },
                first_name:"required",
                last_name:"required",
                mobile:"required",
                email:"required",
                company:"required",
                street:"required",
                website:{
                    required: true,
                    url: true
                },
                city:"required",
                zip:"required",
                state:"required",
                country:"required",
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
                contactimg: {
                    imageType: "Only JPG, JPEG, PNG, or GIF files are allowed."
                },
                first_name:"Enter First Name",
                last_name:"Enter Last Name",
                mobile:"Enter mobile",
                email:"Enter email",
                company:"Enter company",
                street:"Enter street",
                website:{
                    required:"Enter website",
                    url:"Enter a valid URL"
                },
                city:"Enter city",
                zip:"Enter zip",
                state:"Enter state",
                country:"Enter country",
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
                if (element.attr("type") == "file") error.appendTo("#contactimg");
                else if(element.attr("name") == "company") error.appendTo("#company_name")
                    else error.insertAfter(element);
                }
            });
            });
            $("#propicture").change(function(e) {
                e.preventDefault();
                const fileInput = $("#propicture")[0]; // Or .get(0)
                if (fileInput.files && fileInput.files[0]) {
                const fileName = fileInput.files[0].name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#propreview")
                    .attr("src", e.target.result)
                    .show(); // Display the image
                };
                reader.readAsDataURL(fileInput.files[0]);

                } else {
                console.log("No file selected");
                }
             });
             document.getElementById('propicture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;

                    // Create a modal or container for cropping
                    const cropperContainer = document.getElementById('cropperContainer1');
                    cropperContainer.classList.remove('hidden');
                    document.getElementById('cropImage1').src = e.target.result;

                    const cropper = new Cropper(document.getElementById('cropImage1'), {
                        aspectRatio: 1,
                        viewMode: 1,
                    });

                    const saveButton = document.getElementById('saveButton1');
                    //saveButton.innerText = 'Save Cropped Image';
                    saveButton.onclick = function() {
                        cropper.getCroppedCanvas().toBlob(function(blob) {
                       
                        
                                // Create an object URL for the blob and update the image source
                                const imageUrl = URL.createObjectURL(blob);
                                document.getElementById('propreview').src = imageUrl;
                            cropper.destroy();
                            cropperContainer.remove();
                        });
                    };

                    cropperContainer.appendChild(saveButton);
                };
                reader.readAsDataURL(file);
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            function syncFields() {
                
                // Sync values from source form to target form
                document.getElementById('firstName').value = document.getElementById('first_name').value;
                document.getElementById('lastName').value = document.getElementById('lastname').value;
                document.getElementById('phone').value = document.getElementById('mobile').value;
                document.getElementById('pemail').value = document.getElementById('email').value;
                document.getElementById('pcompany').value = document.getElementById('company').value;
                document.getElementById('paddress').value = document.getElementById('street').value;
                document.getElementById('pwebsite').value = document.getElementById('Website').value;
                document.getElementById('pcity').value = document.getElementById('city').value;
                document.getElementById('pstate').value = document.getElementById('state').value;
                document.getElementById('pzip').value = document.getElementById('zip').value;
                document.getElementById('pcountry').value = document.getElementById('country').value;
            }
                    // Add event listeners to all inputs in the source form
            const sourceInputs = document.querySelectorAll('#editvcardqr_form input');
            sourceInputs.forEach(input => {
                input.addEventListener('input', syncFields);
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
