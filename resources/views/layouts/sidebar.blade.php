<aside id="sidebar"
class="fixed overflow-y-auto pb-50 top-0 shad left-0 w-10/12 lg:w-64 h-screen  bg-gradient-to-t from-[#1F2937] from-50% to-white text-white p-4 z-50 transition-all transform -translate-x-full lg:translate-x-0 lg:block">
<div class="flex justify-between items-center py-2 mb-8">
    <img src="{{asset('images/indexfav.png')}}" class="w-[200px]" />
</div>

<div class="text-center mb-8">
    <div class="w-16 h-16 mx-auto relative mb-2 rounded-full bg-gray-500">
        <img src="{{asset('images/download.jpeg')}}" alt="User Profile" class="w-full h-full object-cover rounded-full" />
        {{-- <div
            class="absolute -bottom-1 -left-3 bg-white flex items-center p-3 w-8 h-8 rounded-full justify-center">
            <i class="fas fa-edit text-[#6c8ef6] text-xl mx-auto "></i>
        </div> --}}
    </div>
    <p class="font-semibold"></p>
    <p class="font-semibold">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
</div>

<nav class="flex-1 px py-6">
    <ul class="space-y-2">
        <!-- Dashboard -->
        <li>
            <a href="{{route('dashboard')}}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-house mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('createqrcode') }}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-qrcode mr-3"></i> Create QR Code
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-user-circle mr-3"></i> Profile
            </a>
        </li>

        <!-- Profile -->

        <!-- QR Code Generator -->

        <li>
            <a href="{{ route('analytics') }}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-chart-line mr-3"></i> Analytics
            </a>
        </li>

        <li>
            <a href="{{ route('subscription') }}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-calendar-days mr-3"></i> Subscription
            </a>
        </li>


        <li>
            <a href="{{ route('myqrcodelist') }}"
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-qrcode mr-3"></i> My QR Codes
            </a>
        </li>
        <li class="mx-0 pt-4">
            <a href="{{route('upgrade')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <button class="bg-blue-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                    <i class="fa-solid fa-arrow-up mr-2"></i> Upgrade
                </button>
            </a>
        </li>
        <li class="mx-0 pt-4">
                <a href="{{route('auth.logout')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                  <button class="bg-orange-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-orange-600 transition duration-300">
                    <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                </button>
              
            </a>
        </li>
    </ul>
</nav>

</aside>