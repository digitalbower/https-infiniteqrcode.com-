@extends('layouts.layout')
@section('title', 'Profile')
@section('content')
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


  <script>
          const menuToggle = document.getElementById('menu-toggle');
          const sidebar = document.getElementById('sidebar');
      
          // Toggle Sidebar on Mobile
          menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
          });
        </script>

@endsection
    