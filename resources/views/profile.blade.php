@extends('layouts.layout')
@section('title', 'Profile')
@section('content')
      <!-- Main Content -->
      <main class="lg:flex-1 text-black overflow-y-auto p-4 lg:ml-40">

        <div class="container mx-auto pb-12 md:px-0 sm:px-0 lg:px-0">
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
                      class="hidden rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:bg-green-600">
                      Save
                    </button>
                  </div>
                </div>

                <div class="space-y-4">
                  <form autocomplete="off" action="#" method="POST" onsubmit="return false;" id="userdetails">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label class="text-sm text-gray-600">First Name</label>
                            <input
                                id="first-name"
                                type="text" name="firstname"
                                class="w-full rounded-md text-black border p-2 pr-10" readonly
                                value="{{$user->firstname}}" />
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Last Name</label>
                            <input
                                id="last-name"
                                type="text" name="lastname"
                                class="w-full rounded-md text-black border p-2 pr-10" readonly
                                value="{{$user->lastname}}" />
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Email</label>
                            <input
                                id="email"
                                type="email" name="email" 
                                value="{{ $user->username }}" 
                                {{($user->username !== '') ? 'readOnly' : 'required';}}
                                class="w-full rounded-md text-black border p-2 pr-10 {{ $user->username ? 'bg-gray-100' : ''; }}" />
                        </div>
            
                        <div>
                            <label class="text-sm text-gray-600">Phone Number</label>
                            <div class="sm:flex gap-x-2 items-center">
                                <select class="rounded-md text-black border text-sm p-2 pr-2 w-full sm:w-1/2" name="countrycode" id="countrycode" readonly>
                                    <option value="+1" <?= $user->countrycode === '+1' ? 'selected' : ''; ?>>🇺🇸 USA (+1)</option>
                                    <option value="+91" <?= $user->countrycode === '+91' ? 'selected' : ''; ?>>🇮🇳 India (+91)</option>
                                    <option value="+44" <?= $user->countrycode === '+44' ? 'selected' : ''; ?>>🇬🇧 UK (+44)</option>
                                    <option value="+1" <?= $user->countrycode === '+1' ? 'selected' : ''; ?>>🇨🇦 Canada (+1)</option>
                                    <option value="+61" <?= $user->countrycode === '+61' ? 'selected' : ''; ?>>🇦🇺 Australia (+61)</option>
                                    <option value="+49" <?= $user->countrycode === '+49' ? 'selected' : ''; ?>>🇩🇪 Germany (+49)</option>
                                    <option value="+33" <?= $user->countrycode === '+33' ? 'selected' : ''; ?>>🇫🇷 France (+33)</option>
                                    <option value="+81" <?= $user->countrycode === '+81' ? 'selected' : ''; ?>>🇯🇵 Japan (+81)</option>
                                    <option value="+55" <?= $user->countrycode === '+55' ? 'selected' : ''; ?>>🇧🇷 Brazil (+55)</option>
                                    <option value="+971" <?= $user->countrycode === '+971' ? 'selected' : ''; ?>>🇦🇪 UAE (+971)</option>
                                    <option value="+966" <?= $user->countrycode === '+966' ? 'selected' : ''; ?>>🇸🇦 SA (+966)</option>
                                </select>
                                <input type="number" max="999999999999" name="phonenumber" id="phone" readonly
                                    {{($user->phonenumber !== '0') ? 'readOnly' : 'required';}} 
                                    value="{{$user->phonenumber}}"
                                    required placeholder="Phone" class="w-full mt-3 sm:mt-0 sm:w-1/2 rounded-md text-black border p-2 pr-10">
                            </div>
                        </div>
            
                        <div>
                            <label class="text-sm text-gray-600">Company Name</label>
                            <input
                                id="company"
                                type="text" name="companyname"
                                class="w-full rounded-md text-black border p-2 pr-10" readonly value="{{$user->companyname }}" />
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Residence Country</label>
                            <select disabled
                                id="countryname"
                                name="countryname"
                                class="w-full rounded-md text-black border p-2 pr-10" >
                                <option value="no" <?= $user->countryname === 'no' ? 'selected' : ''; ?>>Country of Residence</option>
                                <option value="uae" <?= $user->countryname === 'uae' ? 'selected' : ''; ?>>United Arab Emirates</option>
                                <option value="usa" <?= $user->countryname === 'usa' ? 'selected' : ''; ?>>United States</option>
                                <option value="canada" <?= $user->countryname === 'canada' ? 'selected' : ''; ?>>Canada</option>
                                <option value="uk" <?= $user->countryname === 'uk' ? 'selected' : ''; ?>>United Kingdom</option>
                                <option value="australia" <?= $user->countryname === 'australia' ? 'selected' : ''; ?>>Australia</option>
                                <option value="other" <?= $user->countryname === 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>
                </form>
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
                        class="hidden rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:bg-green-600">
                        Save
                      </button>
                  </div>
                </div>

                <div class="space-y-4">
                  <!-- Password Field -->
                  <label class="success"></label>
                  <div class="grid gap-1 relative">
                    <label class="text-sm text-gray-600">Password</label>
                    <input
                      id="password-input"
                      type="password"
                      name="password"
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
                      name="password_confirmation"
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
                 We're sorry to see you go. Deleting your account is permanent and cannot be undone.
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
          
          // Toggle Edit functionality and make fields editable
          $("#edit-account").click(function() {
              // Remove readonly from input fields
              $("#first-name, #last-name, #company, #phone").removeAttr("readonly");
              // Show the save button and hide the edit button
              $("#save-account").removeClass("hidden");
              $("#edit-account").hide();
          });

          // Account fields
          const fname = document.getElementById('first-name');
          const lname = document.getElementById('last-name');
          const phone = document.getElementById('phone');
          const company = document.getElementById('company');
          const email = document.getElementById('email');
          const countrycode = document.getElementById('countrycode');
          const countryname = document.getElementById('countryname');
          
          // Password fields
          const inputField = document.getElementById('password-input');
          const cinputField = document.getElementById('confirm-password-input');
          
          const isEditing = editButton.classList.contains('hidden');
          
          if (isEditing) {
            // Switch to "edit" mode
            editButton.classList.remove('hidden');
            saveButton.classList.add('hidden');
            // Set specific fields to readonly (except email)
            fname.setAttribute('readonly', true);
            lname.setAttribute('readonly', true);
            phone.setAttribute('readonly', true);
            company.setAttribute('readonly', true);
            countrycode.setAttribute('readonly', true);
            countryname.setAttribute('readonly', true);
            // Make email field readonly, so it cannot be edited
            email.setAttribute('readonly', true);
            // Password fields are read-only as well
            inputField.setAttribute('readonly', true);
            cinputField.setAttribute('readonly', true);
            // Disable fields for account section
            fname.setAttribute('disabled', true);
            lname.setAttribute('disabled', true);
            phone.setAttribute('disabled', true);
            company.setAttribute('disabled', true);
            email.setAttribute('disabled', true);
            countrycode.setAttribute('disabled', true);
            countryname.setAttribute('disabled', true);
        
            // Password fields are also disabled
            inputField.setAttribute('disabled', true);
            cinputField.setAttribute('disabled', true);
        
          } else {
            // Switch to "save" mode
            editButton.classList.add('hidden');
            saveButton.classList.remove('hidden');
          

            
            // Allow editing of fields
            fname.removeAttribute('readonly');
            lname.removeAttribute('readonly');
            phone.removeAttribute('readonly');
            company.removeAttribute('readonly');
            email.removeAttribute('readonly');
            countrycode.removeAttribute('readonly');
            countryname.removeAttribute('readonly');
            
            // Password fields are editable now
            inputField.removeAttribute('readonly');
            cinputField.removeAttribute('readonly');
            
            // Enable fields for account section
            fname.removeAttribute('disabled');
            lname.removeAttribute('disabled');
            phone.removeAttribute('disabled');
            company.removeAttribute('disabled');
            email.removeAttribute('disabled');
            countrycode.removeAttribute('disabled');
            countryname.removeAttribute('disabled');
            
            // Password fields are also enabled
            inputField.removeAttribute('disabled');
            cinputField.removeAttribute('disabled');
          }
        }
      // Handle the save button click
      // Handle the save button click
      $("#save-account").click(function(e) {
          e.preventDefault(); // Prevent page reload
          $.ajax({
              method: "POST",
              url: "{{route('profile.update',$user->id)}}", // Path to your update script
              data: $("#userdetails").serialize(), // Serialize form data
              success: function(response) {
                  const data = JSON.parse(JSON.stringify(response));  // Parse the JSON response
                
                  if (data.status === 'success') {
                      // Show success message
                      swal({
                          title: 'Updated!',
                          text: 'Account successfully updated!',
                          icon: 'success'
                      });
      
                      // Dynamically update the UI with new data without page reload
                      $("#first-name").val(data.user.firstname);
                      $("#last-name").val(data.user.lastname);
                      $("#company").val(data.user.companyname);
                      $("#phone").val(data.user.phonenumber);
                      $("#countrycode").val(data.user.countrycode);
      
                      // Hide save button and show edit button again
                      $("#save-account").addClass("hidden");
                      $("#edit-account").show();
                      
                      location.reload();
      
                  } else {
                      console.log(data.message); // If there was an error, log the message
                  }
              },
              error: function(xhr, status, error) {
                  console.log("Error: " + error);  // Log error in case of AJAX failure
              }
          });
      });
    
         
      $("#save-password").click(function(e) {
        e.preventDefault();
        let password = $('#password-input').val();
        let cpassword = $('#confirm-password-input').val();
        if (password === '' || cpassword === '') {
          $(".success").text('Password fields are Need to be filled');
          $(".success").addClass('text-red-500');
        } else if (password === cpassword) {
          $(".success").text('');
          $.ajax({
            type: "POST",
            url: "{{route('password-reset')}}",
            data: {
              password: password,
              "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function(response) {
              console.log(response);
              if (response.message === 'success') {
                $(".success").text('Password Changed Successfully');
                $(".success").addClass('text-green-500');
                setTimeout(() => {
                  location.reload();
                }, 3000);
              } else {
                $(".success").text(response);
                $(".success").addClass('text-red-500');
              }
            }
          });
        } else {
          $(".success").text('Password Not Matched');
          $(".success").addClass('text-red-500');
        }

      });
      $('#delete-account').on('click', function(e) {
        e.preventDefault();
        swal({
          title: "Delete Your Account?",
          text: "This action cannot be undone. Are you sure you want to proceed?",
          icon: "warning",
          buttons: [
            'Cancel',
            'Delete'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "{{route('delete-account')}}",
              data: {
                data: 'delete',
                "_token": "{{ csrf_token() }}",
              },
              success: function(response) {
                $('.message').text('');
                if (response.message == 'success') {
                  swal({
                    title: 'Deleted!',
                    text: 'Account successfully removed!',
                    icon: 'success'
                  }).then(function() {
                    location.href = "{{route('signin')}}";
                  });

                } else {
                  $('.message').text(response);
                  $('.message').addClass('text-red-500');

                }
              }
            });
          } else {
              swal({
          title: "Cancelled",
          text: "Your account remains safe. Let us know if you need further assistance",
          icon: "warning",
          buttons: [
            'Close'
          ],
          dangerMode: true,
        });
            
          }
        })
      });
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

@endsection
    