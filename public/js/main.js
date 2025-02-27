document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');

  const showSidebar = () => {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    menuToggle.classList.add('hidden');
  };

  const hideSidebar = () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    menuToggle.classList.remove('hidden');
  };

  menuToggle.addEventListener('click', showSidebar);
  closeSidebar.addEventListener('click', hideSidebar);
  overlay.addEventListener('click', hideSidebar);
});