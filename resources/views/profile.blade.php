<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom CSS for Date Input */
        .date-input {
            border: 1px solid #4B5563;
            border-radius: 0.375rem;
            background-color: #1F2937;
            color: #E5E7EB;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .date-input:hover,
        .date-input:focus {
            border-color: #3B82F6;
            background-color: #374151;
        }

        /* Custom Styling for the Charts */
        .chart-container {
            background-color: #2D3748;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-container canvas {
            border-radius: 0.375rem;
        }
    </style>
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
</head>

<body class="bg-background container mx-auto text-white font-sans">

    <div class="lg:flex flex-col h-screen">

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
                        <a href=""
                            class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('createqrcode') }}"
                            class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-tachometer-alt mr-3"></i> Create QR Code
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile') }}"
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
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-qrcode mr-3"></i>  Subscription
        
                           
                        </button>
                        

                    </li>

                   
                    <!-- Yields -->
                    <li>
                        <button class="flex items-center w-full text-left py-2 px-2 rounded hover:bg-gray-700">
                            <i class="fas fa-chart-line mr-3"></i>  My QR Codes
        
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

      <!-- Main Content -->
      <main class="lg:flex-1 text-black overflow-y-auto p-4 lg:ml-40">

        <div class="container mx-auto pb-12 md:px-4 sm:px-4 lg:px-0">
          <div class="flex-1 lg:p-8">
            <div class="mx-auto w-full lg:pl-20 space-y-8">
              <!-- Account Information Section -->
              <div class="rounded-lg border bg-white p-6">
                <div class="mb-6 flex items-center justify-between">
                  <h3 class="text-xl  font-semibold">Account Information</h3>
                  <div class="flex items-center gap-2">
                    <button
                      id="edit-account"
                      class="rounded-full bg-blue-500 p-2 text-white w-10 h-10 hover:bg-blue-600"
                      onclick="toggleEditing('account')">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button
                      id="save-account"
                      class="hidden rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:bg-green-600"
                      onclick="toggleEditing('account')">
                      Save
                    </button>
                  </div>
                </div>

                <div class="space-y-4">
                  <div class="grid gap-1">
                    <label class="text-sm text-gray-600">Account Created</label>
                    <div class="text-gray-900">OCT/5, 2023, 11:30:00 AM</div>
                  </div>

                  <div class="grid gap-1">
                    <label class="text-sm text-gray-600">Account
                      Activated</label>
                    <div class="text-gray-900">OCT/5, 2023, 4:30:21 PM</div>
                  </div>

                  <div class="grid gap-1">
                    <label class="text-sm text-gray-600">Language</label>
                    <select
                      id="language-select"
                      class="rounded-md border text-black p-2"
                      disabled>
                      <option>English</option>
                      <option>German</option>
                      <option>French</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Password Section -->
              <div class="rounded-lg border bg-white p-6">
                <div class="mb-6 flex items-center justify-between">
                  <h3 class="text-xl font-semibold">Password</h3>
                  <div class="flex items-center gap-2">
                    <button
                      id="edit-password"
                      class="rounded-full bg-blue-500 p-2 text-white w-10 h-10 hover:bg-blue-600"
                      onclick="toggleEditing('password')">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button
                      id="save-password"
                      class="hidden rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:bg-green-600"
                      onclick="toggleEditing('password')">
                      Save
                    </button>
                  </div>
                </div>

                <div class="space-y-4">
                  <!-- Password Field -->
                  <div class="grid gap-1 relative">
                    <label class="text-sm text-gray-600">Password</label>
                    <input
                      id="password-input"
                      type="password"
                      class="w-full rounded-md text-black border p-2 pr-10"
                      readonly />
                    <button
                      type="button"
                      id="toggle-password"
                      class="absolute right-3 top-9 text-gray-500 hover:text-gray-700"
                      onclick="togglePasswordVisibility('password-input', 'password-icon')">
                      <i id="password-icon" class="fas fa-eye"></i>
                    </button>
                  </div>

                  <!-- Confirm Password Field -->
                  <div class="grid gap-1 relative">
                    <label class="text-sm text-gray-600">Confirm
                      Password</label>
                    <input
                      id="confirm-password-input"
                      type="password"
                      class="w-full text-black rounded-md border p-2 pr-10"
                      readonly />
                    <button
                      type="button"
                      id="toggle-confirm-password"
                      class="absolute right-3 top-9 text-gray-500 hover:text-gray-700"
                      onclick="togglePasswordVisibility('confirm-password-input', 'confirm-password-icon')">
                      <i id="confirm-password-icon" class="fas fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Delete Account Button -->
              <div class="flex flex-col items-center justify-center rounded-lg border bg-white p-8 shadow-lg max-full mx-auto mt-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Delete Your Account</h2>
                <p class="text-sm text-gray-600 mb-6 text-center">
                  We're sorry to see you go. Deleting your account is permanent and cannot be undone. Please confirm your choice below.
                </p>
                <button
                  id="delete-account"
                  class="bg-[#6c8ef6] flex items-center w-auto text-white py-3 px-8 rounded-lg shadow-md hover:bg-red-600 transition duration-300">
                  <i class="fas fa-trash-alt mr-2"></i> Delete Account
                </button>
              </div>
              
            </div>
          </div>
        </div>
      </main>
      <script>
          // Toggle editing mode
          function toggleEditing(section) {
            const isAccount = section === 'account';
            const editButton = document.getElementById(isAccount ? 'edit-account' : 'edit-password');
            const saveButton = document.getElementById(isAccount ? 'save-account' : 'save-password');
            const inputField = document.getElementById(isAccount ? 'language-select' : 'password-input');
            const confirmField = document.getElementById('confirm-password-input');
      
            const isEditing = editButton.classList.contains('hidden');
            if (isEditing) {
              editButton.classList.remove('hidden');
              saveButton.classList.add('hidden');
              inputField.setAttribute('readonly', true);
              inputField.setAttribute('disabled', true);
              if (!isAccount) confirmField.setAttribute('readonly', true);
            } else {
              editButton.classList.add('hidden');
              saveButton.classList.remove('hidden');
              inputField.removeAttribute('readonly');
              inputField.removeAttribute('disabled');
              if (!isAccount) confirmField.removeAttribute('readonly');
            }
          }
      
          // Toggle password visibility
          function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
      
            if (input.type === 'password') {
              input.type = 'text';
              icon.classList.remove('fa-eye');
              icon.classList.add('fa-eye-slash');
            } else {
              input.type = 'password';
              icon.classList.remove('fa-eye-slash');
              icon.classList.add('fa-eye');
            }
          }
        </script>

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
