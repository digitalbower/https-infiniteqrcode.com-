const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');

  // Function to show sidebar and hide hamburger icon
  const showSidebar = () => {
    sidebar.classList.remove('-translate-x-full');  // Show the sidebar
    overlay.classList.remove('hidden');  // Show the overlay
    menuToggle.classList.add('hidden');  // Hide the hamburger menu icon
  };

  // Function to hide sidebar and show hamburger icon
  const hideSidebar = () => {
    sidebar.classList.add('-translate-x-full');  // Hide the sidebar
    overlay.classList.add('hidden');  // Hide the overlay
    menuToggle.classList.remove('hidden');  // Show the hamburger menu icon
  };

  // Show Sidebar when the menu toggle button is clicked
  menuToggle.addEventListener('click', showSidebar);

  // Close Sidebar when the close button is clicked
  closeSidebar.addEventListener('click', hideSidebar);

  // Close Sidebar when the overlay is clicked
  overlay.addEventListener('click', hideSidebar);

    // Toggle Sidebar on Mobile
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });