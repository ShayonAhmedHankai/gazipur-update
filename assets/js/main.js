/**
 * Gazipur Update – main front-end script
 */
(function () {
  'use strict';

  // Search toggle
  const searchToggle = document.getElementById('search-toggle');
  const searchOverlay = document.getElementById('search-overlay');
  const searchField = document.getElementById('search-field');

  if (searchToggle && searchOverlay) {
    searchToggle.addEventListener('click', function () {
      const isHidden = searchOverlay.classList.contains('hidden');
      searchOverlay.classList.toggle('hidden');
      searchToggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
      if (isHidden && searchField) {
        setTimeout(() => searchField.focus(), 50);
      }
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !searchOverlay.classList.contains('hidden')) {
        searchOverlay.classList.add('hidden');
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Mobile menu toggle
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', function () {
      const isHidden = mobileMenu.classList.contains('hidden');
      mobileMenu.classList.toggle('hidden');
      mobileToggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });
  }

  // Sticky header shadow on scroll
  const header = document.querySelector('header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        header.classList.add('shadow-lg');
      } else {
        header.classList.remove('shadow-lg');
      }
    }, { passive: true });
  }
})();
