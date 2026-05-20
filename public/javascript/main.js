document.addEventListener('DOMContentLoaded', function () {
  initTheme();
  initDropdowns();
  initMobileMenu();
  initCarousel();
  initTestimonialSlider();
  initScrollAnimations();
  initCounters();
  initBackToTop();
  initCartButtons();
  initFlashSaleCountdown();
  initFaqAccordion();
  initBrandMarquee();
  initProductImageAnimations();
  initOfferCountdowns();
});

function initTheme() {
  const toggle = document.getElementById('themeToggle');
  if (!toggle) return;
  const html = document.documentElement;
  if (localStorage.getItem('theme') === 'dark') {
    html.setAttribute('data-theme', 'dark');
  } else {
    html.removeAttribute('data-theme');
    if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'light');
  }
  toggle.addEventListener('click', function () {
    const isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? '' : 'dark');
    localStorage.setItem('theme', isDark ? '' : 'dark');
  });
}

function initDropdowns() {
  document.querySelectorAll('[data-dropdown]').forEach(function (wrapper) {
    const btn = wrapper.querySelector('[data-dropdown-btn]');
    const menu = wrapper.querySelector('[data-dropdown-menu]');
    if (!btn || !menu) return;
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      const wasOpen = menu.classList.contains('open');
      closeAllDropdowns();
      if (!wasOpen) menu.classList.add('open');
    });
    document.addEventListener('click', function (e) {
      if (!wrapper.contains(e.target)) menu.classList.remove('open');
    });
  });
}

function closeAllDropdowns() {
  document.querySelectorAll('[data-dropdown-menu]').forEach(function (m) {
    m.classList.remove('open');
  });
}

function initMobileMenu() {
  const btn = document.getElementById('mobileMenuBtn');
  const nav = document.getElementById('mobileNav');
  const overlay = document.getElementById('mobileOverlay');
  if (!btn || !nav) return;
  btn.addEventListener('click', function () {
    nav.classList.toggle('open');
    if (overlay) overlay.classList.toggle('open');
    document.body.style.overflow = nav.classList.contains('open') ? 'hidden' : '';
  });
  if (overlay) {
    overlay.addEventListener('click', function () {
      nav.classList.remove('open');
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    });
  }
}

function initCarousel() {
  const track = document.querySelector('.carousel-track');
  if (!track) return;
  const wrapper = track.closest('.carousel-wrapper');
  const dots = document.querySelectorAll('.carousel-dot');
  const cards = track.querySelectorAll('.product-card');
  if (cards.length === 0) return;

  const gap = 24;
  let cardWidth = cards[0].offsetWidth;
  let currentIndex = 0;
  let autoPlayInterval = null;
  let isDragging = false;
  let startX = 0;
  let scrollLeft = 0;
  let totalCards = cards.length;
  let cardsPerView = 1;
  let maxIndex = 0;

  function recalc() {
    cardWidth = cards[0].offsetWidth;
    cardsPerView = Math.floor(wrapper.offsetWidth / (cardWidth + gap)) || 1;
    maxIndex = Math.max(0, totalCards - cardsPerView);
    if (currentIndex > maxIndex) currentIndex = 0;
  }

  function goTo(index) {
    currentIndex = ((index % (maxIndex + 1)) + (maxIndex + 1)) % (maxIndex + 1);
    const offset = -(currentIndex * (cardWidth + gap));
    track.style.transform = 'translateX(' + offset + 'px)';
    dots.forEach(function (dot, i) {
      dot.classList.toggle('active', i === currentIndex);
    });
  }

  function next() { goTo(currentIndex + 1); }

  function startAutoPlay() {
    stopAutoPlay();
    autoPlayInterval = setInterval(next, 2500);
  }
  function stopAutoPlay() {
    if (autoPlayInterval) { clearInterval(autoPlayInterval); autoPlayInterval = null; }
  }

  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () { goTo(i); });
  });

  if (wrapper) {
    wrapper.addEventListener('mouseenter', stopAutoPlay);
    wrapper.addEventListener('mouseleave', startAutoPlay);
  }

  track.addEventListener('mousedown', function (e) {
    isDragging = true;
    startX = e.pageX - track.offsetLeft;
    scrollLeft = currentIndex * (cardWidth + gap);
    track.classList.add('dragging');
  });
  document.addEventListener('mousemove', function (e) {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - track.offsetLeft;
    const walk = (x - startX) * 0.5;
    const newOffset = -(scrollLeft - walk);
    const maxOffset = 0;
    const minOffset = -(maxIndex * (cardWidth + gap));
    const clampedOffset = Math.max(minOffset, Math.min(maxOffset, newOffset));
    track.style.transform = 'translateX(' + clampedOffset + 'px)';
  });
  document.addEventListener('mouseup', function () {
    if (!isDragging) return;
    isDragging = false;
    track.classList.remove('dragging');
    const offset = Math.abs(parseFloat(track.style.transform.replace('translateX(', '').replace('px', '')) || 0);
    const snappedIndex = Math.round(offset / (cardWidth + gap));
    goTo(Math.min(snappedIndex, maxIndex));
  });

  window.addEventListener('resize', function () { recalc(); goTo(currentIndex); });
  recalc();
  goTo(0);
  startAutoPlay();
}

function initTestimonialSlider() {
  const track = document.querySelector('.testimonial-track');
  const dots = document.querySelectorAll('.testimonial-controls .carousel-dot');
  if (!track) return;
  const cards = track.querySelectorAll('.testimonial-card');
  if (cards.length === 0) return;
  let currentIndex = 0;
  function goTo(index) {
    currentIndex = Math.max(0, Math.min(index, cards.length - 1));
    track.style.transform = 'translateX(-' + (currentIndex * 100) + '%)';
    dots.forEach(function (dot, i) {
      dot.classList.toggle('active', i === currentIndex);
    });
  }
  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () { goTo(i); });
  });
  goTo(0);
}

function initScrollAnimations() {
  const els = document.querySelectorAll('.fade-in, .fade-in-up, .slide-in-left, .slide-in-right');
  if (els.length === 0) return;
  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  els.forEach(function (el) { observer.observe(el); });
}

function initCounters() {
  const counters = document.querySelectorAll('.stat-number');
  if (counters.length === 0) return;
  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.getAttribute('data-target')) || 0;
        const duration = 2000;
        const startTime = performance.now();
        function update(currentTime) {
          const elapsed = currentTime - startTime;
          const progress = Math.min(elapsed / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3);
          el.textContent = Math.round(eased * target);
          if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 });
  counters.forEach(function (el) { observer.observe(el); });
}

function initBackToTop() {
  const btn = document.getElementById('backToTop');
  if (!btn) return;
  window.addEventListener('scroll', function () {
    btn.classList.toggle('visible', window.pageYOffset > 300);
  });
  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

function initCartButtons() {
  document.querySelectorAll('[data-add-to-cart]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const productId = this.getAttribute('data-add-to-cart');
      addToCart(productId);
    });
  });
}

function addToCart(productId) {
  if (!window.isLoggedIn) {
    showToast('Please sign in to add items to your cart');
    setTimeout(function () { window.location.href = 'index.php?controller=user&action=showLogin'; }, 1200);
    return;
  }
  fetch('index.php?controller=cart&action=add&id=' + productId)
    .then(function (r) { return r.json(); })
    .then(function (data) {
      if (data.success) {
        const badge = document.getElementById('cartCount');
        if (badge) {
          badge.textContent = data.cart_count;
          badge.style.display = data.cart_count > 0 ? 'flex' : 'none';
          badge.classList.add('pop');
          setTimeout(function () { badge.classList.remove('pop'); }, 300);
        }
        showToast('Product added to cart!');
      }
    })
    .catch(function () { showToast('Error adding to cart'); });
}

function removeFromCart(productId) {
  if (!confirm('Remove this item from your cart?')) return;
  fetch('index.php?controller=cart&action=remove&id=' + productId)
    .then(function (r) { return r.json(); })
    .then(function (data) {
      if (data.success) window.location.reload();
    });
}

function showToast(message) {
  const existing = document.querySelector('.toast');
  if (existing) existing.remove();
  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.textContent = message;
  Object.assign(toast.style, {
    position: 'fixed',
    bottom: '80px',
    left: '50%',
    transform: 'translateX(-50%)',
    background: '#1e293b',
    color: '#fff',
    padding: '12px 24px',
    borderRadius: '8px',
    fontSize: '14px',
    fontWeight: '500',
    boxShadow: '0 8px 24px rgba(0,0,0,0.2)',
    zIndex: '9999',
    opacity: '0',
    transition: 'opacity 0.3s ease',
  });
  document.body.appendChild(toast);
  requestAnimationFrame(function () { toast.style.opacity = '1'; });
  setTimeout(function () {
    toast.style.opacity = '0';
    setTimeout(function () { toast.remove(); }, 300);
  }, 2500);
}

function initFlashSaleCountdown() {
  const el = document.getElementById('flashCountdown');
  if (!el) return;
  const end = new Date();
  end.setHours(end.getHours() + 24);
  function tick() {
    const diff = end - new Date();
    if (diff <= 0) { el.innerHTML = 'EXPIRED'; return; }
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    el.innerHTML =
      '<div class="time-box"><div class="num">' + String(h).padStart(2,'0') + '</div><div class="label">Hours</div></div>' +
      '<div class="time-box"><div class="num">' + String(m).padStart(2,'0') + '</div><div class="label">Mins</div></div>' +
      '<div class="time-box"><div class="num">' + String(s).padStart(2,'0') + '</div><div class="label">Secs</div></div>';
  }
  tick();
  setInterval(tick, 1000);
}

function initFaqAccordion() {
  document.querySelectorAll('.faq-question').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const answer = this.nextElementSibling;
      const isOpen = answer.classList.contains('open');
      document.querySelectorAll('.faq-answer.open').forEach(function (a) { a.classList.remove('open'); });
      document.querySelectorAll('.faq-question.open').forEach(function (q) { q.classList.remove('open'); });
      if (!isOpen) { answer.classList.add('open'); this.classList.add('open'); }
    });
  });
}

function initBrandMarquee() {
  const track = document.querySelector('.brand-track');
  if (!track) return;
  const items = track.children;
  if (items.length === 0) return;
  const clone = track.innerHTML;
  track.innerHTML = clone + clone;
  let pos = 0;
  let speed = 0.8;
  function step() {
    pos -= speed;
    if (pos <= -track.scrollWidth / 2) pos = 0;
    track.style.transform = 'translateX(' + pos + 'px)';
    requestAnimationFrame(step);
  }
  track.addEventListener('mouseenter', function () { speed = 0; });
  track.addEventListener('mouseleave', function () { speed = 0.8; });
  requestAnimationFrame(step);
}

function initProductImageAnimations() {
  const animations = ['img-float', 'img-pulse', 'img-rotate', 'img-wobble', 'img-tilt'];
  document.querySelectorAll('.product-card').forEach(function (card, i) {
    card.classList.add(animations[i % animations.length]);
  });
}

function initOfferCountdowns() {
  document.querySelectorAll('.offer-countdown').forEach(function (el) {
    const hours = parseInt(el.getAttribute('data-hours')) || 12;
    const end = new Date();
    end.setHours(end.getHours() + hours);
    function tick() {
      const diff = end - new Date();
      if (diff <= 0) { el.innerHTML = 'Expired'; return; }
      const h = Math.floor(diff / 3600000);
      const m = Math.floor((diff % 3600000) / 60000);
      const s = Math.floor((diff % 60000) / 1000);
      el.innerHTML =
        '<div class="otime"><div class="onum">' + String(h).padStart(2,'0') + '</div><div class="olabel">Hrs</div></div>' +
        '<div class="otime"><div class="onum">' + String(m).padStart(2,'0') + '</div><div class="olabel">Min</div></div>' +
        '<div class="otime"><div class="onum">' + String(s).padStart(2,'0') + '</div><div class="olabel">Sec</div></div>';
    }
    tick();
    setInterval(tick, 1000);
  });
}
