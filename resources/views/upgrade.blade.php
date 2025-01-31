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
        <main class="lg:flex-1 overflow-y-auto md:p-4 lg:ml-64">
            <div class="lg:grid lg:grid-cols-12 gap-0">
                <!-- Left Sidebar with Plan Selection -->
                <div class="col-span-5 border-r border-[#374151]  bg-background lg:h-screen top-0 lg:sticky">
                    <div class="mb-8 pt-3 flex justify-center space-x-4 border-b">
                        <button id="free-button" onclick="selectPlan('free')"
                            class="plan-button border-b-2 px-4 py-2 border-transparent active" data-price="0"
                            data-year="7" data-plan="free">
                            Free
                        </button>
                        <button id="basic-button" onclick="selectPlan('basic')"
                            class="plan-button border-b-2 px-4 py-2 border-transparent selectpland " data-pricet="9"
                            data-yeart="90" data-plant="basic">
                            Basic
                        </button>
                        <button id="pro-button" onclick="selectPlan('pro')"
                            class="plan-button border-b-2 px-4 py-2 border-transparent selectpland " data-pricet="21"
                            data-yeart="210" data-plant="pro">
                            Pro
                        </button>
                        <button id="expert-button" onclick="selectPlan('expert')"
                            class="plan-button border-b-2 px-4 py-2 border-transparent selectpland " data-pricet="45"
                            data-yeart="450" data-plant="expert">
                            Expert
                        </button>
                    </div>
                    <!-- Plan Details -->
                    <div class="lg:w-10/12 p-4 shadow-md mx-auto mb-5 text-black">
                        <div id="free" class="plan-details relative">
                            <div class="rounded-xl bg-white p-6  shadow-sm">
                                <button
                                    class="mb-2 current  text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold active">Active
                                    Plan</button>
                                <h2 class="mb-2 text-2xl font-bold">Free </h2>
                                <p class="mb-2 text-gray-900">For individuals starting their design journey.</p>
                                <div class="mb-2 text-3xl font-bold">
                                    $0/7 Days <span class="text-sm text-gray-900 price" data-price="0"></span>
                                </div>
                                <ul class="mb-2 space-y-4">
                                    <li><i class="fas fa-check text-teal-500"></i> Up to 5 Static QR Codes</li>
                                    <li><i class="fas fa-check text-teal-500"></i>50 Scans for 7 days </li>
                                    <li><i class="fas fa-check text-teal-500"></i> Advanced QR Code Designs</li>
                                    <li><i class="fas fa-check text-teal-500"></i> Mobile-Friendly Dashboard </li>
                                </ul>
                                <button
                                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg  py-3 font-medium text-white bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100 hidden">
                                    Select Plan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div id="basic" class="plan-details relative hidden">
                            <div class="rounded-xl bg-white p-6  shadow-sm">
                                <button
                                    class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold active">Active
                                    Plan </button>
                                <h2 class="mb-2 text-2xl font-bold">Basic</h2>
                                <p class="mb-2 text-gray-900">For individuals starting their design journey.</p>
                                <div class="mb-2 text-3xl font-bold">
                                    $9<span class="text-sm text-gray-900 price" data-price="9" data-year="90"
                                        data-plan="basic">/month</span>
                                </div>
                                <ul class="mt-4 space-y-2 text-gray-700">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Static QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        10 Dynamic QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        5000 Scans per month
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Customizable QR Code Designs
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Scheduled QR Code Activation
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        QR Code Expiry
                                    </li>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Mobile-Friendly Dashboard
                                    </li>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Basic QR Code Analytics
                                    </li>
                                </ul>
                                <button
                                    class=" basic selectplan mt-6 flex w-full items-center justify-center gap-2 rounded-lg  py-3 font-medium text-white bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                                    Select Plan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>

                        </div>
                        <div id="pro" class="plan-details relative hidden">
                            <div class="rounded-xl border bg-white p-6 shadow-sm ring-2 ring-blue-500">
                                <button
                                    class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold ">Active
                                    Plan</button>
                                <h2 class="mb-2 text-2xl font-bold">Pro </h2>
                                <p class="mb-2 text-gray-900">For growing teams with advanced needs.</p>
                                <div class="mb-2 text-3xl font-bold">
                                    $21<span class="text-sm text-gray-900 price" data-price="21" data-year="210"
                                        data-plan="pro">/month</span>
                                </div>
                                <ul class="mt-4 space-y-2 text-gray-700">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Static QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Dynamic QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        20,000 Scans per month
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Customizable Designs with Branding
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Scheduled Activation and Expiry
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Bulk QR Code Generation
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        QR Code Analytics
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Mobile-Friendly Dashboard
                                    </li>
                                </ul>
                                <button
                                    class="pro selectplan mt-6 flex w-full items-center justify-center gap-2 rounded-lg py-3 font-medium text-white  bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                                    Select Plan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div id="expert" class="plan-details relative hidden">
                            <div class="rounded-xl border bg-white p-6 shadow-sm ring-2 ring-blue-500">
                                <button
                                    class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold ">Active
                                    Plan</button>
                                <h2 class="mb-2 text-2xl font-bold">Expert</h2>
                                <p class="mb-2 text-gray-900">For professionals that need stunning designs without
                                    limitations.</p>
                                <div class="mb-2 text-3xl font-bold">
                                    $45<span class="text-sm text-gray-900 price" data-price="45" data-year="450"
                                        data-plan="expert">/month</span>
                                </div>
                                <ul class="mt-4 space-y-2 text-gray-700">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Static QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Dynamic QR Codes
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Unlimited Scans per month
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Complete Custom Branding Options
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Scheduled Activation and Expiry
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Bulk QR Code Upload and Generation
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        QR Code Analytics Report
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M10 15l-3.5-3.5 1.5-1.5L10 12l5-5 1.5 1.5L10 15z" />
                                        </svg>
                                        Advanced Analytics
                                    </li>
                                </ul>
                                <button
                                    class="expert selectplan mt-6 flex w-full items-center justify-center gap-2 rounded-lg  py-3 font-medium text-white  bg-[#6c8ef6]  bg-opacity-90 hover:bg-opacity-100">
                                    Select Plan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="mt-6 py-5 px-10 lg:absolute  hidden  bottom-4  flex items-center w-full justify-between text-sm text-gray-100">
                            <a>
                                <Link href="#"
                                    class="flex items-center gap-1 hover:text-blue-500 transition duration-200">

                                Help
                                </Link>
                            </a>
                            <a>
                                <Link href="#" class="hover:text-blue-500 transition duration-200">
                                Compare Plans
                                </Link>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side (Plan Details and Payment Options) -->
                <div class="col-span-7  px-4 " id="right-section">
                    <div class="max-w-4xl mx-auto p-2 py-4 md:p-6 bg-white mt-10 shadow-lg rounded-xl">
                        <!-- Header -->
                        <div class="col-span-7 px-4">
                            <h2 id="plan-heading" class="text-xl text-black font-bold mb-4">Plan Name</h2>

                            <!-- Payment Options Section: Left & Right Split -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!-- Left Side: Yearly Payment Option -->
                                <div
                                    class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                                    <div class="text-lg font-semibold text-gray-800">Pay Yearly - Save 25%</div>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-xl font-semibold text-gray-900 " id="yearly"></span>
                                        <span class="text-sm text-gray-600">Billed annually</span>
                                    </div>
                                    <label
                                        class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                                        <input type="radio" name="billing"
                                            class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500"
                                            id="cyearly" data-duration="365" />
                                        <span class="text-sm text-gray-700">Select Yearly</span>
                                    </label>
                                </div>

                                <!-- Right Side: Monthly Payment Option -->
                                <div
                                    class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                                    <div class="text-lg font-semibold text-gray-800">Pay Monthly</div>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-xl font-semibold text-gray-900 " id="monthly"></span>
                                        <span class="text-sm text-gray-600">Billed monthly</span>
                                    </div>
                                    <label
                                        class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                                        <input type="radio" name="billing"
                                            class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500"
                                            id="cmonthly" data-duration="30" />
                                        <span class="text-sm text-gray-700">Select Monthly</span>
                                    </label>
                                </div>
                            </div>

                            <!-- User Information Section -->
                            <div class="mt-3 space-y-3">
                                <div id="error-message" class="text-red-800 font-semibold"></div>
                                <form action="" method="post" id="multiStepForm" onsubmit="return false;">
                                    <!-- Credit Card Info Section -->
                                    <div class="mt-3">
                                        <label for="creditCard" class="text-lg font-semibold text-gray-800">Card
                                            Information</label>

                                        <div id="card-element" class="w-full mt-1 p-2 border rounded">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <div id="card-errors" role="alert"></div>
                                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mt-3">

                                            <input type="hidden" id="billingprice" name="bprice"
                                                class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border"
                                                placeholder="Billing Price">
                                            <input type="hidden" id="duration" name="duration"
                                                class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border"
                                                placeholder="Plan Duration">
                                            <input type="hidden" id="plan" name="plan"
                                                class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border"
                                                placeholder="Billing plan">
                                            <input type="hidden" id="token" name="token"
                                                class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border"
                                                placeholder="token">
                                            <input type="hidden" id="name" name="name"
                                                class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border">
                                        </div>

                                        <label class="card text-red-900"></label>
                                    </div>
                                    <button type="submit" id="submit"
                                        class="mt-3 w-full rounded-lg bg-[#6c8ef6]  bg-opacity-80 hover:bg-opacity-100 py-3 text-white text-lg font-semibold transition duration-300">
                                        Pay & Subscribe
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="loadingIndicator"
                    class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full">
                        </div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
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


        // Select all "Select Plan" buttons
        const selectButtons = document.querySelectorAll(".selectplan");

        // Add event listener to each button
        selectButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Find the closest parent containing the price data
                const priceElement = this.closest(".plan-details").querySelector(".price");

                // Get the price from the data attribute
                const plan = priceElement.getAttribute("data-plan");

                const monthlyPrice = parseFloat(priceElement.getAttribute("data-price"));

                const yearlyPrice = parseFloat(priceElement.getAttribute("data-year"));
                // Calculate the yearly price without discount
                //const yearlyPrice = monthlyPrice * 12;

                // Apply 30% discount to the yearly price
                const discountedYearlyPrice = yearlyPrice;


                const yearlySpan = document.getElementById('yearly');
                yearlySpan.textContent = ` $${Math.ceil(discountedYearlyPrice)}/year`;

                const monthlySpan = document.getElementById('monthly');
                monthlySpan.textContent = ` $${monthlyPrice}/month`;


                const cyearlySpan = document.getElementById('cyearly');
                cyearlySpan.value = ` ${Math.ceil(discountedYearlyPrice)}`;

                const cmonthlySpan = document.getElementById('cmonthly');
                cmonthlySpan.value = ` ${monthlyPrice}`;

                const vplan = document.getElementById('plan');
                vplan.value = ` ${plan}`;

                // Log or use the discounted yearly price
                console.log("Discounted Yearly Price: $" + discountedYearlyPrice.toFixed(2));

                // Optionally, display it
                //alert("Discounted Yearly Price: $" + discountedYearlyPrice.toFixed(2));

            });

        });

        const radioButtons = document.querySelectorAll('input[name="billing"]');

        // Add change event listener to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    // Get the value of the selected radio button
                    const selectedValue = this.value.trim();
                    const vduration = this.getAttribute("data-duration");

                    const billingprice = document.getElementById('billingprice');
                    billingprice.value = ` ${selectedValue}`;

                    const duration = document.getElementById('duration');
                    duration.value = ` ${vduration}`;
                }
            });
        });

        function selectPlan(plan) {
            // Hide all plan details initially
            const plans = document.querySelectorAll('.plan-details');
            plans.forEach((el) => el.classList.add('hidden')); // Hide all plans
            document.getElementById(plan).classList.remove('hidden'); // Show the selected plan

            // Update button styles for selected plan
            const buttons = document.querySelectorAll('.plan-button');
            buttons.forEach(button => button.classList.remove('border-blue-500', 'text-blue-500', 'font-medium'));

            const selectedButton = document.querySelector(`#${plan}-button`);
            selectedButton.classList.add('border-blue-500', 'text-blue-500',
            'font-medium'); // Highlight the selected button
           
            if (plan == curnplan) {
                $("#right-section").addClass('hidden');
                // Update the payment section for the selected plan
            } else {
                $("#right-section").removeClass('hidden');
            }

        }
    </script>

</body>

</html>
