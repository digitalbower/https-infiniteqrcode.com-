<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In / Sign Up Page</title>
    <link rel="shortcut icon" href="{{asset('images/indexfav.png')}}" type="image/x-icon">
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
              <img src="{{asset('images/indexfav.png')}}" class="w-[200px]" />
            </a>
          </div>

          <!-- Right section - Icons -->
          <div class="flex items-center gap-4">
            <button class="hidden lg:inline-flex"></button>
            <a href="{{ route('login') }}">
              <i
                class="fas fa-user h-4 w-4 text-black hover:text-red-500 transition-colors duration-300"
              ></i>
            </a>
          </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:block">
          <ul class="flex justify-center space-x-8 py-4">
            <li>
              <a
                href="{{'/'}}"
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
          <a href="{{'/'}}" class="hover:text-red-500">HOME</a>
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
              name="email"
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
          @if (session('error'))
            <span class="success text-red-600">{{session('error')}}</span>
          @endif
          <span class="success"></span>
           <div class="text-center text-gray-500 mt-4">or</div> 

          <!-- Google Button -->
          <div class="mt-4">
            <div class="mt-4">
            <a href="{{ route('google.login') }}">
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
              </a>
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
          <form id="registerform" class="space-y-4" action="{{ route('auth.register') }}" method="POST">
    @csrf
    <!-- First Name -->
      <input
        type="text"
        placeholder="First Name"
        id="firstName1"
        name="firstname"
        value="{{ old('firstname') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('firstname') border-red-500 @enderror"
      />
      @error('firstname')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    <!-- Last Name -->
      <input
        type="text"
        placeholder="Last Name"
        id="lastName1"
        name="lastname"
        value="{{ old('lastname') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('lastname') border-red-500 @enderror"
      />
      @error('lastname')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    <!-- Email -->
      <input
        type="email"
        placeholder="Email"
        id="Email1"
        name="email"
        value="{{ old('email') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent"
      />
      @error('email')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror

      <select
        class="w-full rounded-md mr-4 text-gray-400 border py-3 px-1 w-0.5"
        name="countrycode"
        id="countrycode"
            readonly>
          @foreach ($countries as $country)
              <option value="{{ $country['dial_code'] }}">
                  {{ $country['name'] }} ({{ $country['dial_code'] }})
              </option>
          @endforeach
      </select>
      <input
        type="tel"
        placeholder="Mobile"
        id="Mobile1"
        name="phonenumber"
        value="{{ old('phonenumber') }}"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('phonenumber') border-red-500 @enderror"
      />
      @error('phonenumber')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    <div class="relative">
      <input
        type="password"
        placeholder="Password"
        id="Password1"
        name="password"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent"
      />
      <button
      type="button"
      class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
      onclick="toggleSignUpPasswordVisibility()"
    >
      <i class="fas fa-eye" id="signUpEyeIcon"></i>
    </button>
      @error('password')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="relative">
      <input
        type="password"
        placeholder="Confirm Password"
        id="CPassword1"
        name="password_confirmation"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:border-transparent @error('CPassword1') border-red-500 @enderror"
      />
    <br />
      <button
      type="button"
      class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
      onclick="toggleConfirmPasswordVisibility()"
    >
      <i class="fas fa-eye" id="confirmEyeIcon"></i>
    </button>
      @error('CPassword1')
      <small class="error-message text-red-500">{{ $message }}</small>
      @enderror
    </div>
    <div class="relative flex items-center mb-3">
    <div>
      <label for="terms" class="ml-2 text-gray-700">
      <input
        type="checkbox"
        id="terms"
        name="terms"
        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200"
      />
        I agree to all
        <a href="terms" target="_blank" style="text-decoration: underline;">Terms & Conditions</a>
        <br />
        @error('terms')
        <small class="error-message text-red-500">{{ $message }}</small>
        @enderror
      </label>
    </div>
    <br />
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
              <a href="{{ route('google.login') }}" >
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
              </a>
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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

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
        $.validator.addMethod('email', function (value, element) {
           return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }, "Enter Valid email");

        $('#registerform').validate({  
        rules: {  
          firstname: 'required',  
          lastname: 'required',  
          phonenumber:{
            required: true,  
            number:true
          },
          email: {  
            required: true,  
            email: true,  
          },  
          
            password: {  
              required: true,  
              minlength: 6,  
            },
            password_confirmation: {
              equalTo: "#Password1"
          },
          terms:{
            required: true,  
          }
        },  
        messages: {  
          firstname: 'First name is required',  
          lastname: 'Last name is required',  
          email: 'A valid Email is required', 
          phonenumber:{
            required:'Phone Number is required' ,
            number:'Please enter numbers Only'
          },
          password: { 
            required:'Password is required' ,
            minlength: 'Password must be at least 6 characters long'  
          },
          password_confirmation: { 
            equalTo:'Password do not match' ,
          },
          terms:'You must agree to the Terms & Conditions'
        },  
        errorElement: 'small',
        errorClass: "text-red-500",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
        errorPlacement: function (error, element) {
          if (element.attr("type") == "checkbox") error.appendTo("#termsError");
            else error.insertAfter(element);
        }
      });  
      $('#login').validate({  
        rules: {  
          email: {  
            required: true,  
            email: true,  
          },  
          password: {  
              required: true,  
              minlength: 6,  
          }
        },  
        messages: {  
          email: 'Email is required', 
          password: { 
            required:'Password is required' ,
          },
        },  
        errorElement: 'small',
        errorClass: "text-red-500",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
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
  <script>
    const menuToggle = document.getElementById("menuToggle");
    const menuOverlay = document.getElementById("menuOverlay");
    const mobileMenu = document.getElementById("mobileMenu");
    const menuClose = document.getElementById("menuClose");

    menuToggle.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
      menuOverlay.classList.toggle("show");
    });

    menuClose.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    });

    menuOverlay.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    });
    const menuLinks = document.querySelectorAll("#mobileMenu nav a");
    menuLinks.forEach(link => {
      link.addEventListener("click", closeMobileMenu);
    });

    function closeMobileMenu() {
      const mobileMenu = document.getElementById("mobileMenu");
      mobileMenu.classList.add("hidden");
      menuOverlay.classList.remove("show");
    }

  </script>

</body>
</html>
