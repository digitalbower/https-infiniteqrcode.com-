

  

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email QR Code Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<script>
  tailwind.config = {
      theme: {
          extend: {
              colors: {
                  primary: '#3B82F6',
                  secondary: '#1E40AF',
              },
          },
      },
  }
</script>
  <body class="bg-gray-100 w-full">

    <!-- Header for mobile with hamburger menu -->
    <header
      class="bg-gradient-to-b from-[#7f9b4e] to-black text-white p-4 flex justify-between items-center lg:hidden">
      <h1 class="text-xl font-bold">DEFILAB</h1>
      <button id="menu-toggle" class="text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </header>
    <div class="flex w-full">
      <aside id="sidebar"
      class="w-10/12 lg:w-[20%] z-[50] top-0 fixed lg:relative lg:translate-x-0 transform -translate-x-full lg:translate-x-0 bg-gradient-to-b h-screen from-[#7f9b4e] to-black text-white flex flex-col transition-transform duration-300">
      <div class="p-4">
        <div class="flex items-center gap-2 mb-8">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-chart-pie h-6 w-6">
            <path
              d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z"></path>
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
          </svg>
          <h1 class="text-xl font-bold">DEFILAB</h1>
        </div>
        <div class="text-center mb-8">
          <div class="w-16 h-16 mx-auto mb-2 rounded-full bg-gray-500">
            <img src="/download.jpeg" alt="User Profile"
              class="w-full h-full object-cover rounded-full" />
          </div>
          <p class="font-semibold">Esther Howard</p>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 w-full px-4">
        <ul class="space-y-1">
          <li><button
              class="flex items-center w-full text-left py-2 px-4 text-white hover:bg-white/10"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-layout-dashboard mr-2 h-4 w-4"><rect
                  width="7" height="9" x="3" y="3" rx="1"></rect><rect
                  width="7" height="5" x="14" y="3" rx="1"></rect><rect
                  width="7" height="9" x="14" y="12" rx="1"></rect><rect
                  width="7" height="5" x="3" y="16" rx="1"></rect></svg>
              Dashboard</button></li>
          <li><button
              class="flex items-center w-full text-left py-2 px-4 text-white hover:bg-white/10 bg-white/20"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-chart-pie mr-2 h-4 w-4"><path
                  d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z"></path><path
                  d="M21.21 15.89A10 10 0 1 1 8 2.83"></path></svg>
              Profile</button></li>
          <li><button
              class="flex items-center w-full text-left py-2 px-4 text-white hover:bg-white/10"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-trending-up mr-2 h-4 w-4"><polyline
                  points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline
                  points="16 7 22 7 22 13"></polyline></svg>
              Yields</button></li>
          <!-- Other links go here -->
        </ul>
      </nav>
    </aside>
      <div class="flex-1 w-full p-4 lg:px-12">
        <div class="flex justify-center">
          <h1
            class="text-4xl font-extrabold text-center mb-10 text-black border-[#7f9b4e] border-b-4 pb-3 inline-block">
            Create Your QR Code
          </h1>
        </div>

        <div class="flex justify-center mb-8 space-x-4">
          <!-- Step indicators -->
          <div
            class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-[#7f9b4e] bg-opacity-90 shadow-md transition duration-300">
            <svg stroke="currentColor" fill="none" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
              class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
          </div>
          <div
            class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">2</div>
          <div
            class="flex items-center justify-center w-10 h-10 rounded-full text-white bg-gray-300 shadow-md transition duration-300">3</div>
          <!-- Additional steps as needed -->
        </div>

        <div
          class="p-8 mb-8 bg-white rounded-lg border border-gray-200 shadow-md">
          

          <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-1/2">
                <div id="qrcode" class="bg-gray-200 p-4 rounded-lg flex items-center justify-center h-64 lg:h-96"></div>
                <div class="mt-4 flex justify-center space-x-4">
                    <button id="downloadBtn" class="bg-secondary text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                        Download QR Code
                    </button>
                    <button id="shareBtn" class="bg-[#7f9b4e] text-white px-4 py-2 rounded hover:bg-[#7f9b4e] transition-colors">
                        Share QR Code
                    </button>
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <h2 class="text-2xl font-semibold mb-4">QR Code Configuration</h2>
                <form id="qrForm" class="space-y-4">
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <input type="text" id="content" name="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="https://example.com" required>
                    </div>
                    <div>
                        <label for="errorCorrection" class="block text-sm font-medium text-gray-700">Error Correction Level</label>
                        <select id="errorCorrection" name="errorCorrection" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="L">Low (7%)</option>
                            <option value="M" selected>Medium (15%)</option>
                            <option value="Q">Quartile (25%)</option>
                            <option value="H">High (30%)</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size (px)</label>
                        <input type="number" id="size" name="size" min="100" max="1000" step="50" value="256" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label for="darkColor" class="block text-sm font-medium text-gray-700">Dark Color</label>
                        <input type="color" id="darkColor" name="darkColor" value="#000000" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label for="lightColor" class="block text-sm font-medium text-gray-700">Light Color</label>
                        <input type="color" id="lightColor" name="lightColor" value="#ffffff" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                   
                </form>
            </div>
        </div>
          
        </div>

        <div class="flex justify-between mt-8">
          <button disabled
            class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400">
            Previous
          </button>
          <button
            class="py-2 px-6 rounded-lg bg-[#7f9b4e] text-white font-semibold hover:bg-[#6f8b3d]">
            Next
          </button>
        </div>
      </div>

    </div>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://example.com",
            width: 256,
            height: 256,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.M
        });

        const form = document.getElementById('qrForm');
        const downloadBtn = document.getElementById('downloadBtn');
        const shareBtn = document.getElementById('shareBtn');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            qrcode.clear();
            qrcode.makeCode(formData.get('content'));
            qrcode._oDrawing._elCanvas.width = formData.get('size');
            qrcode._oDrawing._elCanvas.height = formData.get('size');
            qrcode._htOption.width = formData.get('size');
            qrcode._htOption.height = formData.get('size');
            qrcode._htOption.colorDark = formData.get('darkColor');
            qrcode._htOption.colorLight = formData.get('lightColor');
            qrcode._oQRCode.errorCorrectLevel = QRCode.CorrectLevel[formData.get('errorCorrection')];
            qrcode.makeCode(formData.get('content'));
        });

        downloadBtn.addEventListener('click', () => {
            const canvas = document.querySelector('#qrcode canvas');
            const image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            const link = document.createElement('a');
            link.download = 'qrcode.png';
            link.href = image;
            link.click();
        });

        shareBtn.addEventListener('click', async () => {
            const canvas = document.querySelector('#qrcode canvas');
            canvas.toBlob(async (blob) => {
                const file = new File([blob], "qrcode.png", { type: "image/png" });
                if (navigator.share) {
                    try {
                        await navigator.share({
                            files: [file],
                            title: 'QR Code',
                            text: 'Check out this QR Code!'
                        });
                    } catch (error) {
                        console.error('Error sharing:', error);
                    }
                } else {
                    alert('Web Share API is not supported in your browser.');
                }
            });
        });
    });
</script>
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');

  menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
  });
</script>
</html>
