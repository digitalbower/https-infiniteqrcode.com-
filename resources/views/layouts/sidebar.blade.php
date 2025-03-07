<aside id="sidebar"
class="fixed overflow-y-auto pb-50 top-0 shad left-0 w-10/12 lg:w-64 h-screen  bg-gradient-to-t from-[#1F2937] from-50% to-white text-white p-4 z-50 transition-all transform -translate-x-full lg:translate-x-0 lg:block">
<div class="flex justify-between items-center py-2 mb-8" onclick="location.href='index'">
    <img src="{{asset('images/indexfav.png')}}" class="w-[200px]" onclick="location.href='/'"/>
</div>
    <button id="close-sidebar" class="lg:hidden text-white absolute w-8 h-8 rounded-full border flex justify-center items-center border-black top-4 right-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
<div class="text-center mb-8">
    <div class="w-16 h-16 mx-auto relative mb-2 rounded-full bg-gray-500">
        <img src="{{ auth()->user()->propic ? asset('storage/' . auth()->user()->propic) : asset('images/download.jpeg') }}" alt="Profile" class="w-full h-full object-cover rounded-full" id="profileImage">
            <input type="file" id="imageInput" class="hidden" accept="image/*">
        <div
            class="absolute -bottom-1 -left-3 bg-white flex items-center p-3 w-8 h-8 rounded-full justify-center" id="uploadButton">
            <i class="fas fa-edit text-[#6c8ef6] text-xl mx-auto "></i>
            </div>
        </div>
        <div id="cropperContainer" class="hidden">
            <div style="width: 200px; height: 200px;">
                <img id="cropImage" style="width: 100%;" />
            </div>
            <button id="saveButton" class="bg-green-500 my-4 hover:bg-green-700 text-white py-2 px-4 rounded">Save Cropped Image</button>
        </div>


        <p class="font-semibold">{{ Auth::user()->firstname }} {{ auth()->user()->lastname }}</p>
    </div>

    <nav class="flex-1 px py-6">
    <ul class="space-y-2">
    <!-- Dashboard -->
    <!-- Based  on Payment Failed or Not -->
    @php
        $subscriptionEnded = Auth::user()->subscription_end && Carbon\Carbon::parse(Auth::user()->subscription_end)->isPast();
          $isNewUser = Auth::user()->subscription_end === null;
    @endphp
    
  
    @if (!$subscriptionEnded && !$isNewUser && Auth::user()->payment_failed_at == "")
        <!-- Your content goes here -->
        
    <li>
        <a href="{{route('dashboard')}}"
         class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
        <i class="fa-solid fa-house mr-2"></i> Dashboard
        </a>
    </li>

    <!-- Create QR Code -->
    <li>
        <a href="{{ route('createqrcode') }}"
         class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-qrcode mr-3"></i> Create QR Code
        </a>
    </li>

    <!-- Profile -->
    <li>
        <a href="{{ route('profile') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-user-circle mr-3"></i> Profile
        </a>
    </li>

    <!-- Analytics -->
    <li>
        <a href="{{ route('analytics') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-chart-line mr-3"></i> Analytics
        </a>
    </li>

    <!-- Subscription -->
    <li>
        <a href="{{ route('subscription') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-calendar-days mr-3"></i> Subscription
        </a>
    </li>

    <!-- My QR Codes -->
    <li>
        <a href="{{ route('myqrcodelist') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-qrcode mr-3"></i> My QR Codes
        </a>
    </li>
 @if(auth()->user()->plan == 'free')
    <li class="mx-0 pt-4">
        <a href="{{route('upgrade')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <button class="bg-blue-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                <i class="fa-solid fa-arrow-up mr-2"></i> Upgrade
            </button>
        </a>
    </li>
  @endif
    <!-- Logout -->
    <li class="mx-0 pt-4">
        <a href="{{route('auth.logout')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <button class="bg-orange-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-orange-600 transition duration-300">
                <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
            </button>
        </a>
    </li>
    
    
@elseif ($isNewUser)
    <li>
        <a href="{{route('dashboard')}}"
         class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
        <i class="fa-solid fa-house mr-2"></i> Dashboard
        </a>
    </li>

    <!-- Create QR Code -->
    <li>
        <a href="{{ route('createqrcode') }}"
         class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-qrcode mr-3"></i> Create QR Code
        </a>
    </li>

    <!-- Profile -->
    <li>
        <a href="{{ route('profile') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-user-circle mr-3"></i> Profile
        </a>
    </li>

    <!-- Analytics -->
    <li>
        <a href="{{ route('analytics') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-chart-line mr-3"></i> Analytics
        </a>
    </li>

    <!-- Subscription -->
    <li>
        <a href="{{ route('subscription') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-calendar-days mr-3"></i> Subscription
        </a>
    </li>

    <!-- My QR Codes -->
    <li>
        <a href="{{ route('myqrcodelist') }}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <i class="fa-solid fa-qrcode mr-3"></i> My QR Codes
        </a>
    </li>
    @if(auth()->user()->plan == 'free')
    <li class="mx-0 pt-4">
        <a href="{{route('upgrade')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <button class="bg-blue-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                <i class="fa-solid fa-arrow-up mr-2"></i> Upgrade
            </button>
        </a>
    </li>
  @endif
    <!-- Logout -->
    <li class="mx-0 pt-4">
        <a href="{{route('auth.logout')}}" class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
            <button class="bg-orange-500 flex items-center w-full text-white py-3 px-12 rounded-lg shadow-md hover:bg-orange-600 transition duration-300">
                <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
            </button>
        </a>
    </li>
    
@endif
</ul>
</nav>

</aside>
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('cropperContainer').classList.remove('hidden');
            document.getElementById('cropImage').src = e.target.result;

            const cropper = new Cropper(document.getElementById('cropImage'), {
                aspectRatio: 1,
                viewMode: 1,
            });

            document.getElementById('saveButton').addEventListener('click', function() {
                cropper.getCroppedCanvas().toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('croppedImage', blob);
                    formData.append('_token', csrfToken); // CSRF token added

                    fetch('/profile-picture/update', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('profileImage').src = data.imagePath; // Update profile image
                        } else {
                            alert('Failed to upload image: ' + data.message);
                        }
                        cropper.destroy();
                        document.getElementById('cropperContainer').classList.add('hidden');
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        };
        reader.readAsDataURL(file);
    }
});

</script>