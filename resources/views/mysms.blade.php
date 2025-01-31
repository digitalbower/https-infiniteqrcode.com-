<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="indexfav.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes rise {
      0% { bottom: -100px; transform: translateX(0); }
      50% { transform: translateX(100px); }
      100% { bottom: 1080px; transform: translateX(-200px); }
    }
    .animate-rise { animation: rise infinite ease-in; }
  </style>    
</head>
<body class="flex justify-center items-center min-h-screen font-poppins bg-cover bg-center">
<div class="flex justify-center items-center min-h-screen font-poppins bg-cover bg-center">
    
        <section class="absolute w-full h-full top-0 left-0 z-0 overflow-hidden bg-[#ddd1ca]">
            <div class="absolute bottom-[-100px] w-10 h-10 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 10%; animation-duration: 8s;"></div>
            <div class="absolute bottom-[-100px] w-5 h-5 bg-gray-100 rounded-full opacity-50 animate-rise" style="left: 20%; animation-duration: 5s; animation-delay: 1s;"></div>
        </section>
        <div class="w-full p-4 absolute h-full text-white overflow-hidden flex justify-center items-center">
            <div class="border w-full relative max-w-xl h-auto min-h-[400px] max-h-[400px] pt-3 mt-10 text-card-foreground shadow-sm bg-white rounded-3xl">
                <div class="p-4">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-neutral-600">To:</span>
                            <span class="bg-[#e8e0d9] text-[#8b7b71] px-4 py-1 rounded-full text-sm">{{ $qrCodes->phone }}</span>
                        </div>
                        <hr class="bg-[#d3a58a]"/>
                        <p class="text-neutral-800 text-base leading-relaxed">{{ $qrCodes->sms }}</p>
                    </div>
                </div>
                <div class="mt-4 flex justify-center bottom-4 absolute w-full px-4 text-center ">
                    <button class="bg-[#d3a58a] w-full text-white text-center flex justify-center text-sm px-4 py-2 rounded-lg flex items-center">
                        <a id="smsLink" href="#" target="_blank">SEND</a>
                    </button>
                </div>
            </div>
        </div>
   
</div>

<script>

document.getElementById("sendSmsButton").addEventListener("click", function() {
    let phone = "{{ $qrCodes->phone }}";
    let message = "{{ $qrCodes->sms }}";

    fetch('/send-sms', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
        },
        body: JSON.stringify({ phone: phone, sms: message })
    })
    .then(response => response.json())
    .then(data => alert(data.success || data.error));
});
</script>       
</body>
</html>
