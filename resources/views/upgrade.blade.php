@extends('layouts.layout')
@section('title', 'Plan Upgrade')
@section('content')
    <!-- Main Content Area -->
    <main class="lg:flex-1 overflow-y-auto md:p-4 lg:ml-64">
        <div class="lg:grid lg:grid-cols-12 gap-0">
            <!-- Left Sidebar with Plan Selection -->
            <div class="col-span-5 border-r border-[#374151]  bg-background lg:h-screen top-0 lg:sticky">
                <div class="mb-8 pt-3 flex justify-center space-x-4 border-b">
                    <button id="free-button" onclick="selectPlan('free')"
                        class="plan-button border-b-2 px-4 py-2 border-transparent" data-price="0"  
                        data-year="7" data-plan="free">
                        Free
                    </button>
                    <button id="basic-button" onclick="selectPlan('basic')"
                        class="plan-button border-b-2 px-4 py-2 border-transparent selectpland" data-pricet="9"
                        data-yeart="90" data-plant="basic">
                        Basic
                    </button>
                    <button id="pro-button" onclick="selectPlan('pro')"
                        class="plan-button border-b-2 px-4 py-2 border-transparent selectpland" data-pricet="21"
                        data-yeart="210" data-plant="pro">
                        Pro
                    </button>
                    <button id="expert-button" onclick="selectPlan('expert')"
                        class="plan-button border-b-2 px-4 py-2 border-transparent selectpland" data-pricet="45"
                        data-yeart="450" data-plant="expert">
                        Expert
                    </button>
                </div>
                <!-- Plan Details -->
                <div class="lg:w-10/12 p-4 shadow-md mx-auto mb-5 text-black">
                    <div id="free" class="plan-details relative hidden">
                        <div class="rounded-xl bg-white p-6  shadow-sm">
                            <button
                                class="mb-2 current  text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold {{  $plans->plan === 'free' ? 'active' : 'hidden'; }}">Active
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
                            class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold {{ $plans->plan === 'basic' ? 'active' : 'hidden'; }}">Active 
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
                                class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold  {{ $plans->plan === 'pro' ? 'active' : 'hidden';}}">Active
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
                            class="mb-2 current text-base absolute top-3 right-3 text-white p-3 py-1 rounded-md bg-[#6c8ef6] font-bold {{ $plans->plan === 'expert' ? 'active' : 'hidden';}}">Active
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
            <div class="col-span-7  px-4" id="right-section">
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
                                        <label for="creditCard" class="text-lg font-semibold text-gray-800">Card Information</label>

                                        <div id="card-element" class="w-full mt-1 p-2 border rounded">
                                        <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <div id="card-errors" role="alert"></div>
                                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mt-3">

                                        <input type="hidden" id="billingprice" name="bprice" class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border" placeholder="Billing Price">
                                        <input type="hidden" id="duration" name="duration" class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border" placeholder="Plan Duration">
                                        <input type="hidden" id="plan" name="plan" class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border" placeholder="Billing plan">
                                        <input type="hidden" id="token" name="token" class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border" placeholder="token">
                                        <input type="hidden" id="name" name="name" class="p-2 text-blue-500 focus:ring-2 focus:ring-blue-500 border" value="{{auth()->user()->firstname}}">
                                        </div>

                                        <label class="card text-red-900"></label>
                                    </div>
                                    <button type="submit" id="submit" class="mt-3 w-full rounded-lg bg-[#6c8ef6]  bg-opacity-80 hover:bg-opacity-100 py-3 text-white text-lg font-semibold transition duration-300">
                                        Pay & Subscribe
                                    </button>
                                
                                </form>
                            </div>
                            <div id="loadingIndicator"
                                class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
                                <div class="flex flex-col items-center">
                                    <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full">

                                </div>
                                <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                                </div>
                            </div>
                        </div>    
                        
                    </div>    
                </div>    
            </div>   
        </div>    
    </main>
    <!-- Modal Overlay -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative z-50">
            <!-- Close Button -->
            <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
            <h2 class="text-xl font-semibold text-gray-800">Enter Card Details</h2>
            <p class="text-gray-600 mt-1">Fill in the form below to add your card.</p>

            <!-- Card Form -->
            <form id="cardForm" class="mt-4" action="#" method="post" onsubmit="return false;">
                <div class="mb-4">
                  <label for="cardName" class="block text-sm font-medium text-gray-700">
                    Cardholder Name
                  </label>
                  <input
                    type="text"
                    id="cardName" readonly
                    name="cardName" value="{{Session::get('firstname')}} {{Session::get('lastname')}}"
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-500"
                    placeholder="John Doe"
                    required>
                  <input type="hidden" name="stripe_customer_id " id="customer_id" value="{{auth()->user()->stripe_customer_id}}">
                  <input type="hidden" name="price" id="bprice" value="{{auth()->user()->price}}">
                  <input type="hidden" name="plan" id="bplan" value="{{auth()->user()->plan}}">
                  <input type="hidden" name="duration" id="bduration" value="{{auth()->user()->duration}}">
                </div>
                <div class="mb-4">
                  <div id="card-element2"></div>
                </div>
                <div id="card-errors" class="text-red-700"></div>
                <button
                  type="submit"
                  class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition">
                  Pay Now
                </button>
              </form>
        </div>
    </div>
    <style>
       .overflow-hidden {
            overflow: hidden;
        }

        #modalOverlay {
            pointer-events: auto; /* Ensure clicks work inside modal */
        }

        #modalOverlay.hidden {
            display: none;
        }


    </style>
    <script>
        var stripePublicKey = "{{ config('services.stripe.key') }}"; 
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    @if(session('showPaymentPopup'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalOverlay = document.getElementById('modalOverlay');
            const cardElementContainer = document.getElementById('card-element2');

            const stripe = Stripe(stripePublicKey); // Make sure stripePublicKey is set in Blade
            const elements = stripe.elements();
            let cardElement = null;
            let retryCount = 0;
            let isProcessing = false;
        
            // Show the modal and disable interaction with the rest of the page
            modalOverlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Mount the card element only once
            if (!cardElementContainer.classList.contains('mounted')) {
                cardElement = elements.create("card", { hidePostalCode: true });
                cardElement.mount("#card-element2");
                cardElementContainer.classList.add('mounted');
            }
            // Disable closing the modal
            document.getElementById('closeModalBtn')?.remove();
            modalOverlay.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Prevent ESC key from closing the modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    e.preventDefault();
                }
            });

            const form = document.getElementById('cardForm');
            const submitButton = form.querySelector('button[type="submit"]');
            const errorDiv = document.getElementById('card-errors');
            form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable the submit button to prevent multiple clicks
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';

            try {
                // Step 1: Get client secret for SetupIntent from server
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                 const setupResponse = await fetch('/api/stripe/create-setup-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
        
                const setupData = await setupResponse.json();
                if (!setupData.clientSecret) {
                    throw new Error(setupData.error || 'Failed to get setup intent.');
                }
        
                const clientSecret = setupData.clientSecret;
                console.log('clientSecret:', clientSecret);
                const username = document.getElementById("name").value;
                const amount =  document.getElementById('bprice').value; 
        
                const { setupIntent, error: setupError } = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: username }
                    }
                });

                if (setupError ||  setupIntent.status !== 'succeeded' || !setupIntent.payment_method) {
                    throw new Error('Card setup failed or no payment method found.');
                }

                console.log('SetupIntent:', setupIntent);
       
            // Step 3: Create Payment Intent
            const paymentResponse = await fetch('/api/stripe/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        amount: amount,
                        payment_method_id: setupIntent.payment_method
                    })
                });
          
                const paymentData = await paymentResponse.json();
                console.log('Payment Intent Response:', paymentData);

                // Step 4: Handle 3D Secure if needed
                if (paymentData.requires_action) {
                    const { error: confirmError, paymentIntent } = await stripe.confirmCardPayment(paymentData.payment_intent_client_secret);
        
                    if (confirmError || paymentIntent.status !== 'succeeded') {
                        throw new Error('Failed to confirm payment.');
                    }
        
                    await completeSubscription(paymentIntent.id, setupIntent.payment_method, setupIntent.id);
                } 
                // Payment without 3D Secure
                else if (paymentData.payment_intent?.status === 'succeeded') {
                    await completeSubscription(paymentData.payment_intent.id, setupIntent.payment_method,setupIntent.id);
                } 
                else {
                    throw new Error('Unexpected payment status.');
                }
            } catch (err) {
                console.error('Payment error:', err.message || err);
                Swal.fire('Payment Error', err.message || 'Unexpected error occurred.', 'error');
            } finally {
                $("#loadingIndicator").addClass("hidden");
            }
        });
        async function completeSubscription(paymentIntentId,paymentMethodId,setupIntent) {
            try { 
                console.log('Completing subscription with:', { paymentIntentId, paymentMethodId, setupIntent });
                const plan = document.getElementById("bplan").value; 
                const bduration = document.getElementById("bduration").value; 
                const price = document.getElementById("bprice").value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
               //  // Gather form data
                if(bduration === 'monthly'){
                    duration = "30";
                }
                else{
                    duration = "365";
                }
 
                //  Send data to backend
                const responseSubscribe = await fetch("/api/stripe/subscribe", {
                method: "POST",
                headers: { "Content-Type": "application/json",'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({
                    setup_intent_id: setupIntent,
                    payment_intent_id: paymentIntentId,
                    payment_method_id:paymentMethodId,
                    plan,
                    duration,
                    price,
                }),
                });

                const resultSubscribe = await responseSubscribe.json();

                console.log(resultSubscribe);

                if (resultSubscribe.success) {
                    Swal.fire("Payment successful!", "", "success");
                    setTimeout(() => window.location.replace('/subscription'), 2000);
                } else {
                    console.error('Subscription failed:', resultSubscribe.error || 'Unknown error');
                    Swal.fire('Failed to finalize subscription: ' + (resultSubscribe.error || 'Please try again.'));
                }
            } catch (err) {
                console.error('Error finalizing subscription:', err.message || err);
                 Swal.fire('Failed to complete the subscription. Please check your connection and try again.');
            }
        }

        function handleStripeError(error) {
            let errorMessage = "An error occurred. Please try again.";

            if (error.type === "card_error" || error.type === "validation_error") {
                errorMessage = error.message;
            }

            if (error.code) {
                switch (error.code) {
                case "card_declined":
                    errorMessage = "Your card was declined. Please use a different card.";
                    break;
                case "expired_card":
                    errorMessage = "Your card has expired. Please use a valid card.";
                    break;
                case "incorrect_cvc":
                    errorMessage = "The CVC code is incorrect. Please check and try again.";
                    break;
                case "processing_error":
                    errorMessage = "There was a problem processing your card. Please try again later.";
                    break;
                case "insufficient_funds":
                    errorMessage = "Your card has insufficient funds. Please use another card.";
                    break;
                case "authentication_required":
                    errorMessage = "Authentication is required. Please follow the instructions to complete the payment.";
                    break;
                default:
                    errorMessage = error.message || "An error occurred. Please try again.";
                }
            }

            $("#error-message").text(errorMessage);
        }
    });
    </script>
    @endif
   <script>
        const stripe = Stripe(stripePublicKey); // Use the key from Blade
        const elements = stripe.elements();
       
        const cardElement = elements.create('card', { hidePostalCode: true });
        cardElement.mount("#card-element");

        const form = document.getElementById("multiStepForm");
    
    
        form.addEventListener("submit", async (event) => {
            event.preventDefault();
            $("#loadingIndicator").removeClass("hidden");
        
            try {
                // Step 1: Get client secret for SetupIntent from server
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                 const setupResponse = await fetch('/api/stripe/create-setup-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
        
                const setupData = await setupResponse.json();
                if (!setupData.clientSecret) {
                    throw new Error(setupData.error || 'Failed to get setup intent.');
                }
        
                const clientSecret = setupData.clientSecret;
                console.log('clientSecret:', clientSecret);
        
                // Step 2: Confirm card setup
                const username = document.getElementById("name").value;
                const amount = document.getElementById('billingprice').value;
        
                const { setupIntent, error: setupError } = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: username }
                    }
                });
        
                if (setupError ||  setupIntent.status !== 'succeeded' || !setupIntent.payment_method) {
                    throw new Error('Card setup failed or no payment method found.');
                }
        
                console.log('SetupIntent:', setupIntent);
               
        
                // Step 3: Create Payment Intent
                const paymentResponse = await fetch('/api/stripe/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        amount: amount,
                        payment_method_id: setupIntent.payment_method
                    })
                });
          
                const paymentData = await paymentResponse.json();
                console.log('Payment Intent Response:', paymentData);

                // Step 4: Handle 3D Secure if needed
                if (paymentData.requires_action) {
                    const { error: confirmError, paymentIntent } = await stripe.confirmCardPayment(paymentData.payment_intent_client_secret);
        
                    if (confirmError || paymentIntent.status !== 'succeeded') {
                        throw new Error('Failed to confirm payment.');
                    }
        
                    await completeSubscription(paymentIntent.id, setupIntent.payment_method, setupIntent.id);
                } 
                // Payment without 3D Secure
                else if (paymentData.payment_intent?.status === 'succeeded') {
                    await completeSubscription(paymentData.payment_intent.id, setupIntent.payment_method,setupIntent.id);
                } 
                else {
                    throw new Error('Unexpected payment status.');
                }
            } catch (err) {
                console.error('Payment error:', err.message || err);
                Swal.fire('Payment Error', err.message || 'Unexpected error occurred.', 'error');
            } finally {
                $("#loadingIndicator").addClass("hidden");
            }
        });

        
        
        // Complete subscription function
        async function completeSubscription(paymentIntentId, paymentMethodId, setupIntent) {
            try {
                console.log('Completing subscription with:', { paymentIntentId, paymentMethodId, setupIntent });
        
                const plan = document.getElementById("plan").value;
                const duration = document.getElementById("duration").value;
                const price = document.getElementById("billingprice").value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
                const responseSubscribe = await fetch("/api/stripe/subscribe", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        setup_intent_id: setupIntent,
                        payment_intent_id: paymentIntentId,
                        payment_method_id: paymentMethodId,
                        plan,
                        duration,
                        price
                    })
                });
        
                const resultSubscribe = await responseSubscribe.json();
                console.log('Subscription Response:', resultSubscribe);
        
                if (resultSubscribe.success) {
                    Swal.fire("Payment successful!", "", "success");
                    setTimeout(() => window.location.replace('/subscription'), 2000);
                } else {
                    Swal.fire('Failed to finalize subscription: ' + (resultSubscribe.error || 'Please try again.'));
                }
            } catch (err) {
                console.error('Error finalizing subscription:', err.message || err);
                Swal.fire('Failed to complete the subscription. Please check your connection and try again.');
            }
        }


        function handleStripeError(error) {
            $("#loadingIndicator").addClass("hidden");
            let errorMessage = "An error occurred. Please try again.";

            if (error.type === "card_error" || error.type === "validation_error") {
                errorMessage = error.message;
            }

            if (error.code) {
                switch (error.code) {
                case "card_declined":
                    errorMessage = "Your card was declined. Please use a different card.";
                    break;
                case "expired_card":
                    errorMessage = "Your card has expired. Please use a valid card.";
                    break;
                case "incorrect_cvc":
                    errorMessage = "The CVC code is incorrect. Please check and try again.";
                    break;
                case "processing_error":
                    errorMessage = "There was a problem processing your card. Please try again later.";
                    break;
                case "insufficient_funds":
                    errorMessage = "Your card has insufficient funds. Please use another card.";
                    break;
                case "authentication_required":
                    errorMessage = "Authentication is required. Please follow the instructions to complete the payment.";
                    break;
                default:
                    errorMessage = error.message || "An error occurred. Please try again.";
                }
            }

            $("#error-message").text(errorMessage);
        }
   </script>
   <script>
            document.querySelectorAll('.selectpland').forEach(button => {
                button.addEventListener('click', function () { 
                    // Retrieve data attributes
                    const monthlyPrice = this.getAttribute('data-pricet');
                    const yearlyPrice = this.getAttribute('data-yeart');
                    const plan1 = this.getAttribute('data-plant'); 
                    
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
                
                        const planname=document.getElementById("plan-heading"); 
                        
                        let cText = plan1.charAt(0).toUpperCase() + plan1.slice(1); 
                        planname.innerHTML  = `Selected Plan: ${cText}`;
                        
                        const vplan = document.getElementById('plan');
                        vplan.value = ` ${plan1}`;
                                    
                    // You can add further logic here, e.g., updating the UI or making an API call
                });
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
                // console.log("Discounted Yearly Price: $" + discountedYearlyPrice.toFixed(2));

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
        // JavaScript for dynamic plan selection
                    
                
            
        function selectPlan(plan) {
            // Hide all plan details initially
            const plans = document.querySelectorAll('.plan-details'); 
            plans.forEach((el) => el.classList.add('hidden')); // Hide all plans
            document.getElementById(plan).classList.remove('hidden'); // Show the selected plan
            
            // Update button styles for selected plan
            const buttons = document.querySelectorAll('.plan-button');
            buttons.forEach(button => button.classList.remove('border-blue-500', 'text-blue-500', 'font-medium'));
            
            const selectedButton = document.querySelector(`#${plan}-button`);
            selectedButton.classList.add('border-blue-500', 'text-blue-500', 'font-medium'); // Highlight the selected button
            const curnplan="{{$plans->plan}}"; 
                
            if(plan==curnplan){
                $("#right-section").addClass('hidden');
                // Update the payment section for the selected plan
            }else{
                $("#right-section").removeClass('hidden'); 
            }
            
        }
</script>

  <script>

        $(document).ready(function () {
            var plan ="{{$plans->plan}}"; 
            
            if(plan=="basic"){
                $(".basic").addClass('hidden');
                $("#free-button").addClass('hidden');
                $("#pro-button").addClass('hidden');
                $("#expert-button").addClass('hidden');
            }else if(plan=="pro"){
                $(".pro").addClass('hidden');
                $("#basic-button").addClass('hidden');
                $("#free-button").addClass('hidden');
                $("#expert-button").addClass('hidden');
            }else if(plan=="expert"){
                $(".expert").addClass('hidden');
                $("#free-button").addClass('hidden');
                $("#pro-button").addClass('hidden');
                $("#basic-button").addClass('hidden');

            }
                            
            // Initialize with Basic plan details
        
            var currentPlan = "{{ $plans->plan == '' ? 'free' : $plans->plan; }}"; 
            
            selectPlan(currentPlan.trim()); 
            
            $(".plan-details").each(function () {
                const plan = $(this);
                const planId = plan.attr("id"); 
                
                // Select the "currently" button and other action buttons
            
                // Show/hide the right section based on selected plan
                const rightSection = $("#right-section"); 
                if (planId === "free") {
                rightSection.addClass("hidden");
                }else{
                    rightSection.addClass("hidden");
                } 
            
            
            });
        });   
    </script> 
          
@endsection