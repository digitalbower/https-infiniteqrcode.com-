<header
class="bg-gradient-to-l lg:hidden from-[#5f72ab36] bg-opecity-40 to-white text-white p-4 flex justify-between items-center">
<img src="{{asset('images/QRcodeLogo.svg')}}" class="w-[200px]" />
<button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>
<!-- Tabs (Visible on Desktop) -->
<nav class="hidden lg:flex space-x-6">
    <a href="{{route('dashboard')}}">  
        <button class="text-white hover:text-primary">Dashboard</button></a>
        <a href="{{ route('profile') }}"> <button class="text-white hover:text-primary">Profile</button></a>
       <!--  <button class="text-white hover:text-primary">QR Code
            Generator</button> -->
            <a href="{{ route('analytics') }}">  <button
                class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                <i class="fas fa-qrcode mr-3"></i> Analytics
              </button></a>
        <button class="text-white hover:text-primary">Yields</button>
    </nav>
</header>