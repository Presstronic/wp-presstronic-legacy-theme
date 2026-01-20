(function () {
  const nav = document.querySelector('.site-nav');
  if (!nav) return;

  const toggleBtn = nav.querySelector('.nav-toggle');
  const links = Array.from(nav.querySelectorAll('.nav-links a'));

  const navHeight = () => {
    const v = getComputedStyle(document.documentElement).getPropertyValue('--nav-h').trim();
    const n = parseInt(v, 10);
    return Number.isFinite(n) ? n : 64;
  };

  const setNavState = () => {
    const scrolled = window.scrollY > 8;
    nav.classList.toggle('is-scrolled', scrolled);

    // When back at the top, also close mobile menu
    if (!scrolled) {
      nav.classList.remove('is-open');
      if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
    }
  };

  const setActiveLink = () => {
    const ids = ['about', 'services', 'contact'];
    const offset = window.scrollY + navHeight() + 16;

    let active = ids[0];
    for (const id of ids) {
      const el = document.getElementById(id);
      if (!el) continue;
      const top = el.getBoundingClientRect().top + window.scrollY;
      if (top <= offset) active = id;
    }

    links.forEach(a => {
      a.classList.toggle('is-active', a.getAttribute('href') === `#${active}`);
    });
  };

  // Mobile toggle
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('is-open');
      toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  // Close menu when a link is clicked
  links.forEach(a => {
    a.addEventListener('click', () => {
      nav.classList.remove('is-open');
      if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
    });
  });

  // Smooth scroll with offset
  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href^="#"]');
    if (!a) return;

    const href = a.getAttribute('href');
    if (!href || href === '#') return;

    const target = document.querySelector(href);
    if (!target) return;

    e.preventDefault();

    const top = target.getBoundingClientRect().top + window.scrollY - navHeight();
    window.scrollTo({ top, behavior: 'smooth' });

    // Update URL hash without jumping
    history.pushState(null, '', href);
  });

  // Init
  setNavState();
  setActiveLink();

  window.addEventListener('scroll', () => {
    setNavState();
    setActiveLink();
  }, { passive: true });

  window.addEventListener('resize', () => {
    // close menu on resize to avoid weird states
    nav.classList.remove('is-open');
    if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
  });
})();
