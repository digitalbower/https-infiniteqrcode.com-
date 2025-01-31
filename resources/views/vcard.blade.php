<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <script>
        const toggleButton = document.getElementById('toggle-btn');
        const chevronIcon = document.getElementById('chevron-icon');

        toggleButton.addEventListener('click', () => {
            // Toggle the rotation class
            chevronIcon.classList.toggle('rotate-180');
            chevronIcon.classList.toggle('rotate-0');
        });
    </script>
</head>

<body class="bg-background text-white font-sans">

    <div class="flex flex-col h-screen">

        <header
            class="bg-gradient-to-l lg:hidden from-[#5f72ab36] bg-opecity-40 to-white text-white p-4 flex justify-between items-center">
            <img src="/QR code Logo - 750250.svg" class="w-[200px]" />
            <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <!-- Tabs (Visible on Desktop) -->
            <nav class="hidden lg:flex space-x-6">
                <button class="text-white hover:text-primary">Dashboard</button>
                <a href="/Profile.html"> <button class="text-white hover:text-primary">Profile</button></a>
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
                    <img src="/download.jpeg" alt="User Profile" class="w-full h-full object-cover rounded-full" />
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
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-qrcode mr-3"></i> Analytics
                        </button>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="relative group">
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700"
                            onclick="toggleDropdown(this)">
                            <i class="fas fa-qrcode mr-3"></i> Create QR Code
                            <i class="fas fa-chevron-down ml-auto"></i>
                        </button>
                        <div class=" left-0 h-full hidden mt-1 w-full bg-gray-800 rounded shadow-md dropdown-items">
                            <ul class="divide-y divide-gray-700">
                                <!-- Dropdown Items with Font Awesome Icons -->
                                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-link mr-2"></i> URL</a></li>
                                <li><a href="/vcard.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-address-card mr-2"></i> vCard</a></li>
                                <li><a href="/text.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-font mr-2"></i> Text</a></li>
                                <li><a href="/emailform.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-envelope mr-2"></i> Email</a></li>
                                <li><a href="/sms.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-sms mr-2"></i> SMS</a></li>
                                <li><a href="/wifi.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-wifi mr-2"></i> Wi-Fi</a></li>
                                <li><a href="/Bitcoin.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-btc mr-2"></i> Bitcoin</a></li>
                                <li><a href="/Twitter.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-twitter mr-2"></i> Twitter</a></li>
                                <li><a href="/Epc.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-cogs mr-2"></i> EPC</a></li>
                                <li><a href="/Pdf.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-file-pdf mr-2"></i> PDF</a></li>
                                <li><a href="/mp3.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-headphones-alt mr-2"></i> MP3</a></li>
                                <li><a href="/image.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-image mr-2"></i> Images</a></li>
                                <li><a href="/video.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-video mr-2"></i> Video</a></li>
                                <li><a href="/app-store.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-store mr-2"></i> App Stores</a></li>
                                <li><a href="/Url.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fas fa-sync-alt mr-2"></i> Dynamic URL</a></li>
                                <li><a href="/facebook.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-facebook mr-2"></i> Facebook</a></li>
                                <li><a href="/Instagram.html" class="block px-4 py-2 hover:bg-gray-700"><i
                                            class="fab fa-instagram mr-2"></i>Instagram</a></li>

                                <li><a href="/Event.html" class="block px-4 py-2 hover:bg-gray-700"><i
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
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
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
        <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">
            <div class="container mx-auto pb-12 md:px-6 sm:px-8 lg:px-12">
                <div class="flex-1 w-full p-4 lg:px-12">
                    <div class="container text-center mx-auto pt-1 lg:px-12">
                        <h1
                            class="text-4xl text-center font-extrabold text-center mb-10 text-white border-[#F5A623] border-b-4 pb-3 inline-block">
                            Create Your VCard QR Code
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
                        <form autocomplete="on" class="space-y-4 text-black" id="saveVcard" onsubmit="return false"
                            action="#" enctype="multipart/form-data">
                            <div class="lg:p-8 p-4 mb-6 bg-white rounded-lg border-gray-100 border shadow-sm">
                                <div>
                                    <label class="block font-medium mb-1">Profile Picture:</label>
                                    <input type="file" placeholder="propicture" accept=".jpg, .jpeg, .png, .gif"
                                        class="border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                        name="propicture" id="propicture" required />
                                </div>
                                <label for="" class="propicture text-red-600"></label>
                                <div>
                                    <label class="block font-medium mb-1">Your Name:* </label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <input type="text" placeholder="First name" name="first_name"
                                                id="first_name"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500" />
                                            <br>
                                            <label for="" class="fname text-red-600"></label>
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Last name" name="last_name"
                                                id="lastname"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500" />
                                            <br>
                                            <label for="" class="lname text-red-600"></label>
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
                                                name="mobile" id="mobile" />
                                            <label class="mobile  text-red-600"></label>
                                        </div>
                                        <div>
                                            <input type="email" placeholder="your@email.com"
                                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                                name="email" id="email" />
                                            <label class="email  text-red-600"></label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-medium mb-1">Company:*</label>
                                    <input type="text" placeholder="Company"
                                        class="border rounded-md p-2 focus:ring-2 mb-2 focus:ring-blue-500"
                                        name="company" id="company" />

                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">Street:</label>
                                        <input type="text" placeholder="Street"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="street" id="street" />
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">Website:</label>
                                        <input type="text" placeholder="Street"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="Website" id="Website" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">City:</label>
                                        <input type="text" placeholder="City"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="city" id="city" />
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">ZIP:</label>
                                        <input type="text" placeholder="ZIP"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="zip" id="zip" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium mb-1">State:</label>
                                        <input type="text" placeholder="State"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="state" id="state" />
                                    </div>
                                    <div>
                                        <label class="block font-medium mb-1">Country:</label>
                                        <input type="text" placeholder="Country"
                                            class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500"
                                            name="country" id="country" />
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
                                                        class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <label class="project text-red-700"></label>
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
                                                        <ul id="folderList" class="divide-y divide-gray-200"></ul>
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
                                                <label class="folderinput"></label>
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
                                                            name="startdate">
                                                        <label class="start text-red-700"></label>
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <label for="endDate" class="block font-medium text-gray-800">End
                                                        Date</label>
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
                                                <textarea id="remarks" name="remarks" placeholder="Enter any additional remarks"
                                                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
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
                                                        <img src="download.jpeg" alt="Profile"
                                                            class="w-full h-full object-cover" id="propreview"
                                                            name="propreview">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Name and Title -->
                                            <div class="text-center space-y-1 mb-2 mt-1">
                                                <h1 class="text-[#FFB95C] text-2xl font-bold tracking-wider name">MATT
                                                    ZHANG</h1>
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

</html>
