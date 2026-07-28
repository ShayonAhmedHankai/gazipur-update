/**
 * Breaking News Ticker animation
 */
(function () {
  'use strict';

  const ticker = document.getElementById('ticker-content');
  if (!ticker) return;

  // Duplicate content for seamless loop
  const clone = ticker.innerHTML;
  ticker.innerHTML = clone + clone;

  let position = 0;
  const speed = 0.6; // pixels per frame

  function animate() {
    position -= speed;
    const halfWidth = ticker.scrollWidth / 2;

    if (Math.abs(position) >= halfWidth) {
      position = 0;
    }

    ticker.style.transform = `translateX(${position}px)`;
    requestAnimationFrame(animate);
  }

  // Pause on hover
  const wrapper = ticker.closest('.ticker-wrapper');
  if (wrapper) {
    wrapper.addEventListener('mouseenter', () => {
      ticker.style.animationPlayState = 'paused';
      // simple flag approach
      ticker.dataset.paused = '1';
    });
    wrapper.addEventListener('mouseleave', () => {
      ticker.dataset.paused = '0';
    });
  }

  // Restart animation with pause support
  function loop() {
    if (ticker.dataset.paused !== '1') {
      position -= speed;
      const halfWidth = ticker.scrollWidth / 2;
      if (Math.abs(position) >= halfWidth) {
        position = 0;
      }
      ticker.style.transform = `translateX(${position}px)`;
    }
    requestAnimationFrame(loop);
  }

  // Wait for layout
  requestAnimationFrame(() => {
    loop();
  });
})();
