document.addEventListener('DOMContentLoaded', function() {
  // Charger la navigation
  fetch('navigation.html')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-container').innerHTML = data;
      
      // Mettre à jour le lien actif
      const currentPath = window.location.pathname;
      const currentPage = currentPath.split('/').pop() || 'index.html';
      const navLinks = document.querySelectorAll('nav a');
      
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
          link.classList.add('active');
        }
      });
    });
}); 