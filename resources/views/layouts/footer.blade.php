<!-- Footer -->
<footer class="bg-[#58af0838] lg:block hidden text-gray-900 py-16 shadow-lg">
    <div class="container mx-auto  px-4 lg:px-0">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- Brand Section -->
        <div>
          <div class="flex items-center gap-2 text-white text-2xl font-bold mb-4">
            <img src="/images/NearByVoucherswide.svg" alt="logo" class="w-40">
          </div>
          <p class="mb-6">Don't just get there, get there in
            style</p>
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <i class="fas fa-location-dot"></i>
              <span>901 Thornridge Cir Shiloh, Hawaii
                81063</span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-phone"></i>
              <span>(308) 555-0121</span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-envelope"></i>
              <span>hello@travelwp.com</span>
            </div>
          </div>
        </div>

        <!-- Top Destination -->
        <div>
          <h3 class="text-black text-base lg:text-xl font-bold mb-6">Top
            Destination</h3>
          <ul class="space-y-3 text-sm lg:text-base">
            <li><a href="#" class="hover:text-black transition-colors">Bali</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Bangkok</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Cancun</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Nha
                Trang</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Phuket</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Tokyo</a></li>
            <li><a href="#" class="hover:text-black transition-colors">More
                Destinations</a></li>
          </ul>
        </div>

        <!-- Information -->
        <div>
          <h3 class="text-black text-base lg:text-xl font-bold mb-6">Information</h3>
          <ul class="space-y-3 text-sm lg:text-base">
            <li><a href="#" class="hover:text-black transition-colors">Help
                &
                FAQs</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Careers</a></li>
            <li><a href="#" class="hover:text-black transition-colors">About
                us</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Contact
                us</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Privacy
                policy</a></li>
            <li><a href="#" class="hover:text-black transition-colors">Blogs</a></li>
          </ul>
        </div>

        <!-- Follow Us & Payment -->
        <div>
          <h3 class="text-black text-base lg:text-xl font-bold mb-6">Follow
            Us</h3>
          <div class="flex gap-4 mb-8">
            <a href="#"
              class="bg-[#58af0838] p-1 justify-center rounded-full w-10 h-10 flex items-center hover:bg-cyan-600 transition-colors">
              <i class="fab fa-facebook-f text-white"></i>
            </a>
            <a href="#"
              class="bg-blue-400 p-1 justify-center rounded-full w-10 h-10 flex items-center hover:bg-blue-500 transition-colors">
              <i class="fab fa-twitter text-white"></i>
            </a>
            <a href="#"
              class="bg-red-600 p-1 justify-center rounded-full w-10 h-10 flex items-center hover:bg-red-700 transition-colors">
              <i class="fab fa-youtube text-white"></i>
            </a>
            <a href="#"
              class="bg-pink-600 p-1 justify-center rounded-full w-10 h-10 flex items-center hover:bg-pink-700 transition-colors">
              <i class="fab fa-instagram text-white"></i>
            </a>
          </div>


          <h3 class="text-black text-base lg:text-xl font-bold mb-6">Payment
            Channels</h3>
          <div class="grid grid-cols-4 gap-4">
            <img src="https://via.placeholder.com/50x30" alt="Union Pay" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="Visa" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="Mastercard" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="JCB" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="American Express" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="Apple Pay" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="Google Pay" class="h-8">
            <img src="https://via.placeholder.com/50x30" alt="Alipay" class="h-8">
          </div>

          <button
            class="mt-8 border border-gray-700 rounded-lg px-4 py-2 flex items-center gap-2 hover:border-gray-500 transition-colors">
            <i class="fas fa-globe"></i>
            English | USD
          </button>
        </div>
      </div>

      <div class="mt-16 pt-8 border-t border-gray-800 text-center">
        Copyright © 2024 Travel WP. All Rights Reserved.
      </div>
    </div>
  </footer>

  <footer class=" lg:hidden block bg-[#58af0838] text-gray-900 py-16 shadow-lg">
    <div class="container mx-auto lg:px-0 px-4 lg:px-4">
      <div class="grid grid-cols-1 gap-8">
        <!-- Brand Section -->
        <div>
          <button class="w-full text-left flex justify-between items-center py-2 text-base lg:text-xl font-bold"
            onclick="toggleFooterSection('brand-section')">
            Brand Info
            <i class="fas fa-chevron-down" id="brand-section-icon"></i>
          </button>
          <div id="brand-section" class="hidden">
            <div class="flex items-center gap-2 text-white text-2xl font-bold mb-4">
              <img src="/images/NearByVoucherswide.svg" alt="logo" class="w-40">
            </div>
            <p class="mb-6 text-sm lg:text-base">Don't just get there, get there in style</p>
            <div class="space-y-3 text-sm lg:text-base">
              <div class="flex items-center gap-3">
                <i class="fas fa-location-dot"></i>
                <span>901 Thornridge Cir Shiloh, Hawaii 81063</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fas fa-phone"></i>
                <span>(308) 555-0121</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fas fa-envelope"></i>
                <span>hello@travelwp.com</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Destination -->
        <div>
          <button class="w-full text-left flex justify-between items-center py-2 text-base lg:text-xl font-bold"
            onclick="toggleFooterSection('top-destination')">
            Top Destination
            <i class="fas fa-chevron-down" id="top-destination-icon"></i>
          </button>
          <div id="top-destination" class="hidden">
            <ul class="space-y-3 text-sm lg:text-base">
              <li><a href="#" class="hover:text-black transition-colors">Bali</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Bangkok</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Cancun</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Nha Trang</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Phuket</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Tokyo</a></li>
              <li><a href="#" class="hover:text-black transition-colors">More Destinations</a></li>
            </ul>
          </div>
        </div>

        <!-- Information -->
        <div>
          <button class="w-full text-left flex justify-between items-center py-2 text-base lg:text-xl font-bold"
            onclick="toggleFooterSection('information')">
            Information
            <i class="fas fa-chevron-down" id="information-icon"></i>
          </button>
          <div id="information" class="hidden">
            <ul class="space-y-3 text-sm lg:text-base">
              <li><a href="#" class="hover:text-black transition-colors">Help & FAQs</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Careers</a></li>
              <li><a href="#" class="hover:text-black transition-colors">About us</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Contact us</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Privacy policy</a></li>
              <li><a href="#" class="hover:text-black transition-colors">Blogs</a></li>
            </ul>
          </div>
        </div>

        <!-- Follow Us & Payment -->
        <div>
          <button class="w-full text-left flex justify-between items-center py-2 text-base lg:text-xl font-bold"
            onclick="toggleFooterSection('follow-payment')">
            Follow Us & Payment
            <i class="fas fa-chevron-down" id="follow-payment-icon"></i>
          </button>
          <div id="follow-payment" class="hidden">
            <div class="flex gap-4 mb-8">
              <a href="#" class="bg-[#58af0838] rounded-full p-2 hover:bg-cyan-600 transition-colors">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="bg-blue-400 p-2 rounded-full hover:bg-blue-500 transition-colors">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="bg-red-600 p-2 rounded-full hover:bg-red-700 transition-colors">
                <i class="fab fa-youtube"></i>
              </a>
              <a href="#" class="bg-pink-600 p-2 rounded-full hover:bg-pink-700 transition-colors">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
            <h3 class="text-black text-base lg:text-xl font-bold mb-6">Payment Channels</h3>
            <div class="grid grid-cols-4 gap-4">
              <img src="https://via.placeholder.com/50x30" alt="Union Pay" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="Visa" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="Mastercard" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="JCB" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="American Express" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="Apple Pay" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="Google Pay" class="h-8">
              <img src="https://via.placeholder.com/50x30" alt="Alipay" class="h-8">
            </div>
            <button
              class="mt-8 border border-gray-700 rounded-lg px-4 py-2 flex items-center gap-2 hover:border-gray-500 transition-colors">
              <i class="fas fa-globe"></i>
              English | USD
            </button>
          </div>
        </div>
      </div>

      <div class="mt-16 pt-8 border-t border-gray-800 text-center">
        Copyright © 2024 Travel WP. All Rights Reserved.
      </div>
    </div>
  </footer>

  <script>
    function toggleFooterSection(sectionId) {
      const section = document.getElementById(sectionId);
      const icon = document.getElementById(`${sectionId}-icon`);
      if (section.classList.contains('hidden')) {
        section.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      } else {
        section.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      }
    }
  </script>

  <style>
    /* Custom Styles for Owl Carousel */
    .owl-carousel {
      position: relative;
    }

    /* Center Left and Right Navigation Buttons */
    .owl-prev,
    .owl-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 50px;


      height: 50px;

      border-radius: 100% !important;
      background-color: #fff !important;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Adjust button positions */
    .owl-prev {
      right: 80px;
      top: -45px;

    }

    .owl-prev,
    .owl-next span {
      font-size: 40px !important;
      line-height: 40px !important;
      color: #000 !important;
    }

    .owl-next {
      right: 10px;
      top: -45px;
    }

    /* Hover effect for buttons */
    .owl-prev:hover,
    .owl-next:hover {
      background-color: #00bcd4;
      /* Cyan */
      color: white;
    }

    /* Custom icon size adjustment */
    .custom-left-icon,
    .custom-right-icon {
      width: 24px !important;
      border-radius: 100%;
      height: 24px !important;
      color: #fff !important;
      background-size: cover;
      display: inline-block;
    }

    /* Custom icons (you can add your own image or SVG) */
    .custom-left-icon {
      background-image: url('path-to-your-left-arrow-icon.svg');
      /* Replace with your custom left icon */
    }

    .owl-carousel .owl-dots.disabled,
    .owl-carousel .owl-nav.disabled {
      display: block;
    }

    .custom-right-icon {
      background-image: url('path-to-your-right-arrow-icon.svg');
      /* Replace with your custom right icon */
    }

    @media (max-width: 768px) {

      .owl-prev,
      .owl-next {
        width: 40px;
        height: 40px;
      }

      .owl-prev {
        right: 60px;


      }

      .owl-prev {
        top: -35px;

      }

      .owl-next {

        top: -35px;
      }

      .owl-prev,
      .owl-next span {
        font-size: 25px !important;
      }
    }
  </style>

  <script>
    $(document).ready(function () {
      $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 16,
        nav: true,  // Enable navigation
        dots: true, // Enable dots pagination
        autoplay: false,
        autoplayTimeout: 3000,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            nav: true,
            items: 4
          }
        }
      });
    });
    $(document).ready(function () {
      $(".owl-carousel1").owlCarousel({
        items: 1,
        loop: true,
        margin: 16,
        nav: true,  // Enable navigation
        dots: true, // Enable dots pagination
        autoplay: false,
        autoplayTimeout: 3000,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4,
            nav: true
          }
        }
      });
    });
  </script>

</body>

<script>
  const toggle = document.getElementById("mobile-menu-toggle");
  const menu = document.getElementById("mobile-menu"); // Ensure this matches the id in the HTML
  toggle.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });
</script>

<script>
  const dropdown = document.getElementById("dropdown");

  function showDropdown() {
    dropdown.classList.remove("hidden");
  }

  function toggleDropdown() {
    dropdown.classList.toggle("hidden");
  }

  // Hide dropdown when clicking outside
  document.addEventListener("click", (event) => {
    if (
      !event.target.closest("#dropdown") &&
      !event.target.closest("#search-input") &&
      !event.target.closest("button")
    ) {
      dropdown.classList.add("hidden");
    }
  });
</script>
<!-- Modal Structure -->
<div id="modal"
  class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 flex items-center justify-center hidden transition-opacity duration-300 ease-in-out">
  <div
    class="bg-[#daedc9]  p-8 rounded-xl shadow-2xl w-full max-w-md mx-auto transform transition-all scale-95 relative">
    <!-- Close Button in Top-Right Corner -->
    <button id="closeModalButton" class="absolute top-3 right-3 text-gray-800 text-xl font-bold focus:outline-none">
      &times;
    </button>

    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Talk to a Specialist</h2>
    <form id="modalForm" class="">
      <!-- Name Field -->
      <div class="mb-5">
        <label for="name" class="block text-sm font-medium text-gray-800">Name</label>
        <input type="text" id="name" name="name"
          class="mt-2 p-3 border border-transparent rounded-lg w-full bg-white focus:ring-2 focus:ring-blue-400 transition-all"
          placeholder="Enter your name" required>
      </div>

      <!-- Email Field -->
      <div class="mb-5">
        <label for="email" class="block text-sm font-medium text-gray-800">Email</label>
        <input type="email" id="email" name="email"
          class="mt-2 p-3 border border-transparent rounded-lg w-full bg-white focus:ring-2 focus:ring-blue-400 transition-all"
          placeholder="Enter your email" required>
      </div>

      <!-- Phone Number Field -->
      <div class="mb-5">
        <label for="number" class="block text-sm font-medium text-gray-800">Phone Number</label>
        <div class="flex items-center space-x-3">
          <select id="countryCode" name="countryCode"
            class="p-3 border border-transparent rounded-lg bg-white focus:ring-2 focus:ring-blue-400 transition-all">
            <option value="+1">+1 (USA)</option>
            <option value="+44">+44 (UK)</option>
            <option value="+91">+91 (India)</option>
            <!-- Add more country codes as needed -->
          </select>
          <input type="tel" id="phone" name="phone"
            class="mt-2 p-3 border border-transparent rounded-lg w-full bg-white focus:ring-2 focus:ring-blue-400 transition-all"
            placeholder="Enter phone number" required>
        </div>
      </div>

      <!-- Message Field -->
      <div class="mb-5">
        <label for="message" class="block text-sm font-medium text-gray-800">Message</label>
        <textarea id="message" name="message"
          class="mt-2 p-3 border border-transparent rounded-lg w-full bg-white focus:ring-2 focus:ring-blue-400 transition-all"
          rows="4" placeholder="Your message" required></textarea>
      </div>

      <!-- Buttons -->
      <div class="flex justify-between mt-6">
        <button type="submit"
          class="from-cyan-300 to-blue-300 bg-gradient-to-r w-full text-gray-800 px-6 py-3 rounded-md hover:bg-blue-700 transition-all transform duration-200">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Get modal and button elements
  const openModalButton = document.getElementById('openModalButton');
  const modal = document.getElementById('modal');
  const closeModalButton = document.getElementById('closeModalButton');

  // Open the modal when the button is clicked
  openModalButton.addEventListener('click', (e) => {
    e.preventDefault();  // Prevent default link behavior
    modal.classList.remove('hidden');  // Show the modal
  });

  // Close the modal when the close button is clicked
  closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');  // Hide the modal
  });

  // Optional: Close the modal if user clicks outside the modal content
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
    }
  });
</script>


</html>