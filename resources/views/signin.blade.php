<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In / Sign Up Page</title>
    <link rel="shortcut icon" href="indexfav.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body
    class="bg-gradient-to-t min-h-screen from-[#00b8cbb5] to-white relative text-black"
  >
    <!-- Navigation Bar -->
    <header class="border-b sticky top-0 bg-white z-50">
      <div class="container mx-auto px-4 sm:px-6 lg:max-w-screen-xl">
        <div class="flex h-16 items-center justify-between lg:h-20">
          <!-- Left section - Phone number -->
          <div class="hidden lg: gap-2 text-black">
            <i class="fas fa-phone text-red-500 animate-pulse"></i>
            <span class="text-sm">+1 800 603 6035</span>
          </div>

          <!-- Mobile menu button -->
          <button id="menuToggle" class="lg:hidden focus:outline-none">
            <i
              class="fas fa-bars h-6 w-6 text-black hover:text-red-500 transition-colors duration-300"
            ></i>
          </button>

          <!-- Logo -->
          <div class="flex justify-center w-full items-center">
            <a href="#" class="flex items-center gap-2">
              <img src="indexfav.png" class="w-[200px]" />
            </a>
          </div>

          <!-- Right section - Icons -->
          <div class="flex items-center gap-4">
            <button class="hidden lg:inline-flex"></button>
            <button onclick="location.href='sign.php';">
              <i
                class="fas fa-user h-4 w-4 text-black hover:text-red-500 transition-colors duration-300"
              ></i>
            </button>
          </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:block">
          <ul class="flex justify-center space-x-8 py-4">
            <li>
              <a
                href="home"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >HOME</a
              >
            </li>
            <li>
              <a
                href="home#specialoffers"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >SPECIAL OFFERS</a
              >
            </li>
            <li>
              <a
                href="home#features"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >FEATURES</a
              >
            </li>
            <li>
              <a
                href="home#pricing"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >PRICING</a
              >
            </li>
            <li>
              <a
                href="home#benifts"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >BENIFITS</a
              >
            </li>
            <li>
              <a
                href="home#faqs"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >FAQS</a
              >
            </li>
            <li>
              <a
                href="home#contactus"
                class="text-sm font-medium hover:text-red-500 transition-colors"
                >CONTACT US</a
              >
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="menuOverlay" class="menu-overlay"></div>

    <!-- Mobile Menu -->
    <div class="fixed inset-0 z-50 hidden lg:hidden fade-in" id="mobileMenu">
      <div
        class="relative flex h-full w-full flex-col items-center bg-white p-8"
      >
        <button
          id="menuClose"
          class="absolute top-4 right-4 text-black hover:text-red-500 focus:outline-none"
        >
          <i class="fas fa-times text-2xl"></i>
        </button>
        <nav
          class="flex flex-col items-center gap-6 mt-12 text-lg font-semibold text-black"
        >
          <a href="home" class="hover:text-red-500">HOME</a>
          <a href="home#specialoffers" class="hover:text-red-500"
            >SPECIAL OFFERS</a
          >
          <a href="home#features" class="hover:text-red-500">FEATURES</a>
          <a href="home#pricing" class="hover:text-red-500">PRICING</a>
          <a href="home#benifts" class="hover:text-red-500">BENIFITS</a>
          <a href="home#faqs" class="hover:text-red-500">FAQS</a>
          <a href="home#contactus" class="hover:text-red-500">CONTACTUS</a>
        </nav>
      </div>
    </div>

    <!-- Sign In Section -->

    <!-- Sign In Section -->
    <section class="container mx-auto">
      <div class="px-4 sm:px-6 py-10">
        <div
          class="lg:max-w-xl mx-auto p-4 md:p-8 my-10 bg-white rounded-2xl shadow-lg"
        >
          <h2 class="text-2xl font-bold text-center mb-6">
            Sign in to score great deals!
          </h2>

          <!-- Tabs -->
          <div class="flex mb-6 border-b">
            <button
              id="signInTab"
              class="flex-1 pb-2 text-[#1B2937] border-b-2 border-red-600"
            >
              I HAVE AN ACCOUNT
            </button>
            <button
              id="signUpTab"
              class="flex-1 pb-2 text-gray-400 hover:text-gray-600"
            >
              I'M A NEW CUSTOMER
            </button>
          </div>

          <!-- Sign In Form -->
          <form id="login" class="space-y-4" action="{{ route('auth.login') }}" method="POST">
    @csrf
            <input
              type="text"
              placeholder="Email"
              id="username"
              name="username"
              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent"
            />
            <small class="error-message text-red-500"></small>
            <div class="relative">
              <input
                id="password"
                name="password"
                type="password"
                placeholder="Password"
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent"
              />
              <small class="error-message text-red-500"></small>
              <button
                type="button"
                id="togglePassword"
                class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
                onclick="togglePasswordVisibility()"
              >
                <i class="fas fa-eye" id="eyeIcon"></i>
              </button>
            </div>
            <button
              type="submit"
              id=""
              class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors"
            >
              Sign In
            </button>
          </form>
          <span class="success"></span>
          <div class="text-center text-gray-500 mt-4">or</div>

          <!-- Google Button -->
          <div class="mt-4">
            <div class="mt-4">
              <button
                class="w-full flex items-center justify-center bg-white text-gray-700 transition-colors"
              >
                <div
                  id="g_id_onload"
                  data-client_id="623466204275-lp0ub4bkq7a9qo4meemkiagb9rb8mquj.apps.googleusercontent.com"
                  data-context="signin"
                  data-callback="handleCredentialResponse"
                  data-auto_prompt="false"
                  data-width="400"
                  data-height="200"
                ></div>

                <div
                  class="g_id_signin"
                  data-type="standard"
                  data-shape="rectangular"
                  data-theme="outline"
                  data-text="sign_in_with"
                  data-size="large"
                ></div>
              </button>
            </div>
          </div>
        </div>

        <!-- Sign Up Section -->
        <div
          id="signUpSection"
          class="lg:max-w-xl mx-auto p-4 md:p-8 mt-8 bg-white rounded-2xl shadow-lg hidden"
        >
          <h2 class="text-2xl font-bold text-center mb-6">
            Create Your Account
          </h2>
          <form id="" class="space-y-4" action="{{ route('auth.register') }}" method="POST">
    @csrf
    <!-- First Name -->
    <div>
      <input
        type="text"
        placeholder="First Name"
        id="firstName1"
        name="first_name"
        value="{{ old('firstName1') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('firstName1') border-red-500 @enderror"
      />
      @error('firstName1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Last Name -->
    <div>
      <input
        type="text"
        placeholder="Last Name"
        id="lastName1"
        name="last_name"
        value="{{ old('lastName1') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('lastName1') border-red-500 @enderror"
      />
      @error('lastName1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Email -->
    <div>
      <input
        type="email"
        placeholder="Email"
        id="Email1"
        name="email"
        value="{{ old('Email1') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('Email1') border-red-500 @enderror"
      />
      @error('Email1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Country Code -->
    <div>
      <select
        class="w-full rounded-md text-gray-400 border py-3 px-1"
        name="countrycode"
        id="countrycode"
      >
        <option value="+1">🇺🇸 USA (+1)</option>
        <option value="+91" {{ old('countrycode') == '+91' ? 'selected' : '' }}>🇮🇳 India (+91)</option>
        <option value="+44" {{ old('countrycode') == '+44' ? 'selected' : '' }}>🇬🇧 UK (+44)</option>
        <option value="+1" {{ old('countrycode') == '+1' ? 'selected' : '' }}>🇨🇦 Canada (+1)</option>
        <option value="+61" {{ old('countrycode') == '+61' ? 'selected' : '' }}>🇦🇺 Australia (+61)</option>
        <option value="+49" {{ old('countrycode') == '+49' ? 'selected' : '' }}>🇩🇪 Germany (+49)</option>
      </select>
    </div>

    <!-- Mobile -->
    <div>
      <input
        type="tel"
        placeholder="Mobile"
        id="Mobile1"
        name="mobile"
        value="{{ old('Mobile1') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('Mobile1') border-red-500 @enderror"
      />
      @error('Mobile1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Password -->
    <div class="relative">
      <input
        type="password"
        placeholder="Password"
        id="Password1"
        name="password"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('Password1') border-red-500 @enderror"
      />
      @error('Password1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Confirm Password -->
    <div class="relative">
      <input
        type="password"
        placeholder="Confirm Password"
        id="cpassword"
        name="CPassword1"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('CPassword1') border-red-500 @enderror"
      />
      @error('CPassword1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <!-- Terms -->
    <div class="relative flex items-center">
      <input
        type="checkbox"
        id="terms"
        name="terms"
        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200"
      />
      <label for="terms" class="ml-2 text-gray-700">
        I agree to all
        <a href="terms" target="_blank" style="text-decoration: none">Terms & Conditions</a>
      </label>
      @error('terms')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>

    <button
      type="submit"
      class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors"
    >
      Sign Up
    </button>
  </form>
          <span class="success"></span>
          <div class="text-center text-gray-500 mt-4">or</div>
          <div class="mt-4">
            <button
              class="w-full flex items-center justify-center bg-white text-gray-700 transition-colors"
            >
              <div
                id="g_id_onload"
                data-client_id="623466204275-lp0ub4bkq7a9qo4meemkiagb9rb8mquj.apps.googleusercontent.com"
                data-context="signin"
                data-callback="handleCredentialResponse"
                data-auto_prompt="false"
                data-width="400"
                data-height="200"
              ></div>
            
            </button>
          </div>
        </div>
      </div>
    </section>
    <div
      id="loadingIndicator"
      class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden"
    >
      <div class="flex flex-col items-center">
        <div
          class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"
        ></div>
        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
      </div>
    </div>
    <!-- Account Creation Section -->
    <footer class="bg-gray-900 absolute bottom-0 w-full text-center text-white">
      <div
        class="container mx-auto py-1 sm:py-1 md:py-2 lg:py-2 sm:px-6 lg:max-w-screen-xl"
      >
        <div
          class="flex justify-center flex-wrap gap-5 space-x-8 mb-8 hidden"
        ></div>
        <div class="text-center text-sm text-gray-400">
          © Copyright 2024. All Rights Reserved
        </div>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://accounts.google.com/gsi/client"
      async
      defer
      reffererpolicy
    ></script>
    <!-- endinject -->

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
    ></script>
    <script>
      function handleCredentialResponse(response) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../fetch/verify_token.php");
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
        xhr.setRequestHeader("Cross-Origin-Resource-Policy", "same-site");
        referrerPolicy: {
          policy: "strict-origin-when-cross-origin";
        }
        xhr.onload = function () {
          if (xhr.status === 200) {
            // Assume the response is the form data you want to send to the next page
            var serverResponse = xhr.responseText;

            // Call function to forward to another page with the response data
            forwardToNextPage(serverResponse);
          } else {
            console.error("An error occurred");
          }
        };
        xhr.send("credential=" + response.credential);
      }

      function forwardToNextPage(formData) {
        // Create a new form element
        var form = document.createElement("form");
        form.method = "POST"; // Use POST method
        form.action = "../fetch/glsignup.php"; // PHP page to forward the data

        // Create an input element to hold the formData
        var input = document.createElement("input");
        input.type = "hidden"; // Hidden input
        input.name = "data"; // Form field name
        input.value = formData; // Pass the responseText from AJAX as form data

        // Append the input to the form
        form.appendChild(input);

        // Append form to the body (it must be in the DOM to submit)
        document.body.appendChild(form);

        // Submit the form programmatically
        form.submit();
      }

      $(document).ready(function () {
        // Populate fields if the cookies exist
        if ($.cookie("username") && $.cookie("password")) {
          $("#username").val($.cookie("username"));
          $("#password").val($.cookie("password"));
          //$('#rememberMe').prop('checked', true);
        }
      });

      // On form submit
    </script>
    <script>
      $(document).ready(function () {
        $("#registerform").on("submit", function (e) {
          e.preventDefault();
          let isValid = false;

          // Clear previous error messages
          $(".error-message").text("");

          // Validate First Name
          const firstName = $("#firstName1").val().trim();
          if (firstName === "") {
            $("#firstName1")
              .next(".error-message")
              .text("First Name is required");
            isValid = false;
          } else {
            isValid = true;
          }

          // Validate Last Name
          const Mobile = $("#Mobile1").val().trim();
          if (Mobile === "") {
            $("#Mobile1").next(".error-message").text("Mobile No. is required");
            isValid = false;
          } else {
            isValid = true;
          }
          const lastName = $("#lastName1").val().trim();
          if (lastName === "") {
            $("#lastName1")
              .next(".error-message")
              .text("Last Name is required");
            isValid = false;
          } else {
            isValid = true;
          }

          // Validate Email
          const email = $("#Email1").val().trim();
          const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (email === "" || !emailPattern.test(email)) {
            $("#Email1")
              .next(".error-message")
              .text("A valid Email is required");
            isValid = false;
          } else {
            isValid = true;
          }

          // Validate Password
          const password = $("#Password1").val().trim();
          if (password === "") {
            $(".perror-message").text("Password is required");
            isValid = false;
          } else {
            isValid = true;
          }

          // Validate Confirm Password
          const confirmPassword = $("#CPassword1").val().trim();
          if (confirmPassword !== password) {
            $(".cperror-message").text("Passwords do not match");
            isValid = false;
          } else {
            isValid = true;
          }

          // Validate Terms & Conditions
          if (!$("#terms").is(":checked")) {
            $(".error-message1").text(
              "You must agree to the Terms & Conditions"
            );
            isValid = false;
          } else {
            isValid = true;
          }

          // If valid, send data via AJAX
          timeout = 1000; 
          if (isValid) {
            $("#loadingIndicator").removeClass("hidden");
            $.ajax({
              type: "POST",
              url: "{{ route('auth.register') }}",
              data: $("#registerform").serialize(),
              success: function (response) {
                if (response == "1") {

                  setTimeout(() => {
                  location.href = 'dashboard.php';
                }, 2000);
                
             
              }
                
                else if (response == "2") {
                  $(".success").text("Fill missed values");
                  $(".success").addClass("text-red-600");
                } else if (response == "3") {
                  $(".success").text("User Already Exists");
                  $(".success").addClass("text-red-600");
                } else {
                  $(".success").text("Contact admin");
                  $(".success").addClass("text-red-600");
                }
              },
              complete: function () {
                $("#loadingIndicator").addClass("hidden");
              },
              error: function (data) {
                $("#loadingIndicator").addClass("hidden");
                $(".success").text("An error occurred. Please try again.");
                $(".success").addClass("text-red-600");
              },
            });
          }
        });
       

        $(".Password1").on("click", function () {
          const passwordInput = $("#Password1");
          // Toggle input type between 'password' and 'text'
          const type =
            passwordInput.attr("type") === "password" ? "text" : "password";
          // Toggle the eye icon SVG
          const eyeIcon = $(".Password1 span");
          if (passwordInput.val() !== "") {
            passwordInput.attr("type", type);
            if (type === "password") {
              eyeIcon.removeClass(`mdi-eye-outline`); // Eye icon
              eyeIcon.addClass(`mdi-eye-off-outline`); // Eye icon
            } else {
              eyeIcon.addClass(`mdi-eye-outline`); // Eye slash icon
              eyeIcon.removeClass(`mdi-eye-off-outline`); // Eye slash icon
            }
          } else {
            $(".success").text("Add Password");
            $(".success").addClass("text-red-600");
          }
        });
        $(".CPassword1").on("click", function () {
          const passwordInput = $("#CPassword1");
          // Toggle input type between 'password' and 'text'
          const type =
            passwordInput.attr("type") === "password" ? "text" : "password";
          // Toggle the eye icon SVG
          const eyeIcon = $(".CPassword1 span");
          if (passwordInput.val() !== "") {
            passwordInput.attr("type", type);
            if (type === "password") {
              eyeIcon.removeClass(`mdi-eye-outline`); // Eye icon
              eyeIcon.addClass(`mdi-eye-off-outline`); // Eye icon
            } else {
              eyeIcon.addClass(`mdi-eye-outline`); // Eye slash icon
              eyeIcon.removeClass(`mdi-eye-off-outline`); // Eye slash icon
            }
          } else {
            $(".success").text("Add Confirm Password");
            $(".success").addClass("text-red-600");
          }
        });

        $('#login1').on('click', function () {
    let isValid = false;
    // Clear previous error messages
    $('.error-message').text('');
    // Validate Username or Email
    const username = $('#username').val().trim();
    if (username === '') {
        $('#username').next('.error-message').text('Username or Email needed');
        isValid = false;
    } else {
        $('#username').next('.error-message').text('');
        isValid = true;
    }
    // Validate Password
    const password = $('#password').val();
    if (password === '') {
        $('#password').next('.error-message').text('Password is needed');
        isValid = false;
    } else {
        $('#password').next('.error-message').text('');
        isValid = true;
    }

    timeout = 1000; // Adjust timeout for redirection delay

    // If valid, send data via AJAX
    if (isValid) {
        $('#loadingIndicator').removeClass('hidden');  // Show loader
        $.ajax({
            url: 'qrbackend/login.php',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            dataType: 'json',
            success: function (response) {
              console.log('Response:', response); // Log the response for debugging

                if (response.status === 'success' && response.message === '1') {
                    // Login success, redirect to dashboard
                    setTimeout(() => {
                        $('#loadingIndicator').addClass('hidden');  // Hide loader
                        window.location.href = 'dashboard.php';
                    }, timeout);
                } else if (response.status === 'success' && response.message === '2') {
                    // Profile redirect
                    setTimeout(() => {
                        $('#loadingIndicator').addClass('hidden');  // Hide loader
                        window.location.href = 'Profile.php';
                    }, timeout);
                } else {
                    // Error handling
                    $('.success').text(response.message);
                    $('.success').addClass('text-red-600');
                    $('#loadingIndicator').addClass('hidden');  // Hide loader in case of error
                }
            },
            complete: function () {
                // Make sure the loader is hidden at the end of the process
                $('#loadingIndicator').addClass('hidden');
            },
            error: function () {
                $('#loadingIndicator').addClass('hidden');
                $('.success').text('An error occurred. Please try again.');
                $('.success').addClass('text-red-600');
            }
        });
    }
});

      });
    </script>
    <script>
      // Toggle between Sign In and Sign Up forms
      document
        .getElementById("signInTab")
        .addEventListener("click", function () {
          document
            .getElementById("login")
            .parentElement.classList.remove("hidden");
          document.getElementById("signUpSection").classList.add("hidden");
          document
            .getElementById("signInTab")
            .classList.add("border-red-600", "text-[#1B2937]");
          document
            .getElementById("signUpTab")
            .classList.remove("border-b-2", "border-red-600", "text-gray-400");
          document
            .getElementById("signUpTab")
            .classList.add("hover:text-gray-600");
        });

      document
        .getElementById("signUpTab")
        .addEventListener("click", function () {
          document
            .getElementById("login")
            .parentElement.classList.add("hidden");
          document.getElementById("signUpSection").classList.remove("hidden");
          document
            .getElementById("signUpTab")
            .classList.remove("text-gray-400", "hover:text-gray-600");
          document
            .getElementById("signUpTab")
            .classList.add("border-b-2", "border-red-600", "text-[#1B2937]");
          document
            .getElementById("signInTab")
            .classList.remove("border-b-2", "border-red-600", "text-[#1B2937]");
        });

      // Toggle Password Visibility
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      }

      function toggleSignUpPasswordVisibility() {
        const signUpPasswordInput = document.getElementById("Password1");
        const signUpEyeIcon = document.getElementById("signUpEyeIcon");
        if (signUpPasswordInput.type === "password") {
          signUpPasswordInput.type = "text";
          signUpEyeIcon.classList.remove("fa-eye");
          signUpEyeIcon.classList.add("fa-eye-slash");
        } else {
          signUpPasswordInput.type = "password";
          signUpEyeIcon.classList.remove("fa-eye-slash");
          signUpEyeIcon.classList.add("fa-eye");
        }
      }

      function toggleConfirmPasswordVisibility() {
        const confirmPasswordInput = document.getElementById("CPassword1");
        const confirmEyeIcon = document.getElementById("confirmEyeIcon");
        if (confirmPasswordInput.type === "password") {
          confirmPasswordInput.type = "text";
          confirmEyeIcon.classList.remove("fa-eye");
          confirmEyeIcon.classList.add("fa-eye-slash");
        } else {
          confirmPasswordInput.type = "password";
          confirmEyeIcon.classList.remove("fa-eye-slash");
          confirmEyeIcon.classList.add("fa-eye");
        }
      }
    </script>
  </body>
</html>
