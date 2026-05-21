/**
 * Leap Theme — Main JavaScript
 * GSAP + ScrollTrigger animations, hero canvas, mobile nav, stat counters
 */

(function () {
  'use strict';

  // ── Wait for DOM ─────────────────────────────────────────────
  document.addEventListener('DOMContentLoaded', init);

  function init() {
    setupGSAP();
    setupMobileNav();
    setupHeader();
    setupCardGlow();
    setupHeroCanvas();

    // GSAP animations only if GSAP loaded
    if (typeof gsap !== 'undefined') {
      animateHero();
      animateSections();
      animateServiceCards();
      animateProcess();
      animateStats();
      animateCTA();
      animateTrustBar();
    }
  }

  // ── GSAP Setup ───────────────────────────────────────────────
  function setupGSAP() {
    if (typeof gsap === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);
    if (typeof SplitText !== 'undefined') {
      gsap.registerPlugin(SplitText);
    }
    // Default eases
    gsap.defaults({ ease: 'power3.out' });
  }

  // ── Hero Animations ──────────────────────────────────────────
  function animateHero() {
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    // Badge
    tl.from('.hero-badge', { y: 20, opacity: 0, duration: 0.6 }, 0.2);

    // Headline — split by words if SplitText is available
    const headline = document.getElementById('hero-headline');
    if (headline) {
      if (typeof SplitText !== 'undefined') {
        const split = new SplitText(headline, { type: 'words,chars' });
        tl.from(split.words, {
          y: 40, opacity: 0, duration: 0.7,
          stagger: 0.05, ease: 'power4.out'
        }, 0.4);
      } else {
        tl.from(headline, { y: 40, opacity: 0, duration: 0.8 }, 0.4);
      }
    }

    // Subheading + actions
    tl.from('.hero-subheading', { y: 24, opacity: 0, duration: 0.7 }, 0.7);
    tl.from('.hero-actions',    { y: 20, opacity: 0, duration: 0.6 }, 0.85);

    // Floating cards with stagger + continuous float
    const cards = document.querySelectorAll('.floating-card');
    if (cards.length) {
      tl.from(cards, { y: 30, opacity: 0, duration: 0.7, stagger: 0.12 }, 0.9);

      // Continuous subtle floating
      cards.forEach((card, i) => {
        gsap.to(card, {
          y: i % 2 === 0 ? -10 : -14,
          duration: 3 + i * 0.5,
          ease: 'sine.inOut',
          repeat: -1,
          yoyo: true,
          delay: i * 0.3,
        });
      });
    }
  }

  // ── Section Fade/Slide Animations ───────────────────────────
  function animateSections() {
    // Generic fade-up elements
    gsap.utils.toArray('[data-gsap="fade-up"]').forEach((el) => {
      gsap.from(el, {
        y: 32, opacity: 0, duration: 0.8,
        scrollTrigger: { trigger: el, start: 'top 85%', once: true },
      });
    });

    gsap.utils.toArray('[data-gsap="fade-right"]').forEach((el) => {
      gsap.from(el, {
        x: -40, opacity: 0, duration: 0.9,
        scrollTrigger: { trigger: el, start: 'top 80%', once: true },
      });
    });

    gsap.utils.toArray('[data-gsap="fade-left"]').forEach((el) => {
      gsap.from(el, {
        x: 40, opacity: 0, duration: 0.9,
        scrollTrigger: { trigger: el, start: 'top 80%', once: true },
      });
    });
  }

  // ── Service Cards Stagger ────────────────────────────────────
  function animateServiceCards() {
    const grids = document.querySelectorAll('[data-gsap="stagger-cards"]');
    grids.forEach((grid) => {
      const cards = grid.querySelectorAll('.service-card, .testimonial-card, .post-card');
      if (!cards.length) return;

      gsap.from(cards, {
        y: 40, opacity: 0, duration: 0.7,
        stagger: { each: 0.1, from: 'start' },
        scrollTrigger: { trigger: grid, start: 'top 80%', once: true },
      });
    });
  }

  // ── Process Timeline ─────────────────────────────────────────
  function animateProcess() {
    const steps = document.querySelectorAll('.process-step');
    if (!steps.length) return;

    const line = document.querySelector('.timeline-line');
    if (line) {
      gsap.from(line, {
        scaleY: 0, transformOrigin: 'top center', duration: 1.5, ease: 'power2.out',
        scrollTrigger: { trigger: '.process-timeline', start: 'top 75%', once: true },
      });
    }

    steps.forEach((step, i) => {
      const content = step.querySelector('.step-content');
      const node    = step.querySelector('.step-node');
      const isRight = step.classList.contains('process-step--right');

      gsap.from(content, {
        x: isRight ? 40 : -40,
        opacity: 0, duration: 0.7,
        scrollTrigger: { trigger: step, start: 'top 82%', once: true },
        delay: i * 0.05,
      });

      if (node) {
        gsap.from(node, {
          scale: 0.5, opacity: 0, duration: 0.5,
          scrollTrigger: { trigger: step, start: 'top 82%', once: true },
          onComplete: () => node.classList.add('is-active'),
        });
      }
    });
  }

  // ── Stats Counter Animation ──────────────────────────────────
  function animateStats() {
    const counters = document.querySelectorAll('.stat-count');
    counters.forEach((el) => {
      const target = parseFloat(el.dataset.target || 0);
      const isDecimal = target % 1 !== 0;

      ScrollTrigger.create({
        trigger: el,
        start: 'top 85%',
        once: true,
        onEnter: () => {
          gsap.to({ val: 0 }, {
            val: target,
            duration: 1.8,
            ease: 'power2.out',
            onUpdate: function () {
              el.textContent = isDecimal
                ? this.targets()[0].val.toFixed(1)
                : Math.round(this.targets()[0].val).toLocaleString();
            },
          });
        },
      });
    });
  }

  // ── CTA Section ──────────────────────────────────────────────
  function animateCTA() {
    const cta = document.querySelector('.cta-section');
    if (!cta) return;

    gsap.from(cta.querySelector('.cta-content'), {
      y: 40, opacity: 0, duration: 0.9,
      scrollTrigger: { trigger: cta, start: 'top 75%', once: true },
    });

    // Ambient glow motion
    const glows = cta.querySelectorAll('.cta-glow');
    glows.forEach((glow, i) => {
      gsap.to(glow, {
        x: i === 0 ? 30 : -30,
        y: i === 0 ? 20 : -20,
        duration: 6 + i * 2,
        ease: 'sine.inOut',
        repeat: -1, yoyo: true,
      });
    });
  }

  // ── Trust Bar Fade ────────────────────────────────────────────
  function animateTrustBar() {
    const logos = document.querySelectorAll('.trust-logo');
    if (!logos.length) return;

    gsap.from(logos, {
      y: 16, opacity: 0, duration: 0.6,
      stagger: 0.08,
      scrollTrigger: { trigger: '.trust-bar', start: 'top 88%', once: true },
    });
  }

  // ── Hero Canvas (wave mesh) ───────────────────────────────────
  function setupHeroCanvas() {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let animId, W, H, time = 0;

    function resize() {
      W = canvas.width  = canvas.offsetWidth;
      H = canvas.height = canvas.offsetHeight;
    }

    function getPoint(col, row, cols, rows) {
      const baseX = (col / (cols - 1)) * W;
      const baseY = (row / (rows - 1)) * H;
      const amp   = H * 0.055;
      const y = baseY
        + Math.sin(col * 0.45 + time + row * 0.6) * amp
        + Math.sin(col * 0.2  + time * 0.7 + row * 0.3) * amp * 0.5
        + Math.sin(col * 0.8  + time * 1.4 - row * 0.2) * amp * 0.25;
      const depth = (Math.sin(col * 0.35 + row * 0.5 + time * 0.5) + 1) / 2;
      return { x: baseX, y, depth };
    }

    function draw() {
      ctx.clearRect(0, 0, W, H);
      time += 0.006;

      const cols = Math.floor(W / 55) + 2;
      const rows = Math.floor(H / 55) + 2;

      // Build grid
      const grid = [];
      for (let r = 0; r < rows; r++) {
        grid[r] = [];
        for (let c = 0; c < cols; c++) {
          grid[r][c] = getPoint(c, r, cols, rows);
        }
      }

      // Horizontal lines
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols - 1; c++) {
          const a = grid[r][c], b = grid[r][c + 1];
          const alpha = 0.08 + a.depth * 0.32;
          ctx.beginPath();
          ctx.strokeStyle = `rgba(0, 160, 255, ${alpha})`;
          ctx.lineWidth = 0.7;
          ctx.moveTo(a.x, a.y);
          ctx.lineTo(b.x, b.y);
          ctx.stroke();
        }
      }

      // Vertical lines
      for (let r = 0; r < rows - 1; r++) {
        for (let c = 0; c < cols; c++) {
          const a = grid[r][c], b = grid[r + 1][c];
          const alpha = 0.05 + a.depth * 0.22;
          ctx.beginPath();
          ctx.strokeStyle = `rgba(0, 210, 255, ${alpha})`;
          ctx.lineWidth = 0.5;
          ctx.moveTo(a.x, a.y);
          ctx.lineTo(b.x, b.y);
          ctx.stroke();
        }
      }

      // Glowing nodes at intersections
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          const p = grid[r][c];
          if (p.depth > 0.6) {
            ctx.beginPath();
            ctx.arc(p.x, p.y, 1 + p.depth * 1.8, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(0, 220, 255, ${0.2 + p.depth * 0.6})`;
            ctx.fill();
          }
        }
      }

      animId = requestAnimationFrame(draw);
    }

    document.addEventListener('visibilitychange', () => {
      if (document.hidden) cancelAnimationFrame(animId);
      else draw();
    });

    const ro = new ResizeObserver(resize);
    ro.observe(canvas.parentElement);
    resize();
    draw();
  }

  // ── Mobile Nav ────────────────────────────────────────────────
  function setupMobileNav() {
    const toggle = document.getElementById('nav-toggle');
    const nav    = document.getElementById('primary-nav');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      nav.classList.toggle('is-open', !isOpen);
      document.body.style.overflow = isOpen ? '' : 'hidden';
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (!nav.contains(e.target) && !toggle.contains(e.target)) {
        toggle.setAttribute('aria-expanded', 'false');
        nav.classList.remove('is-open');
        document.body.style.overflow = '';
      }
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) {
        toggle.setAttribute('aria-expanded', 'false');
        nav.classList.remove('is-open');
        document.body.style.overflow = '';
        toggle.focus();
      }
    });
  }

  // ── Header scroll state ───────────────────────────────────────
  function setupHeader() {
    const header = document.getElementById('site-header');
    if (!header) return;

    const onScroll = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ── Card glow-on-hover (follows mouse) ────────────────────────
  function setupCardGlow() {
    document.querySelectorAll('.service-card').forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width)  * 100;
        const y = ((e.clientY - rect.top)  / rect.height) * 100;
        card.style.setProperty('--mouse-x', `${x}%`);
        card.style.setProperty('--mouse-y', `${y}%`);
      });
    });
  }

})();

// ── Pricing Toggle ────────────────────────────────────────────
(function setupPricingToggle() {
  const toggle = document.getElementById('billing-toggle');
  if (!toggle) return;

  toggle.addEventListener('click', () => {
    const isAnnual = toggle.getAttribute('aria-checked') === 'true';
    toggle.setAttribute('aria-checked', String(!isAnnual));

    document.querySelectorAll('.price-amount[data-monthly]').forEach((el) => {
      const val = !isAnnual
        ? parseInt(el.dataset.annual, 10)
        : parseInt(el.dataset.monthly, 10);
      if (!isNaN(val)) {
        el.textContent = val === 0 ? '$0' : '$' + val;
      }
    });
  });
})();

// ── FAQ Accordion ─────────────────────────────────────────────
(function setupFAQ() {
  document.querySelectorAll('.faq-question').forEach((btn) => {
    btn.addEventListener('click', () => {
      const isOpen   = btn.getAttribute('aria-expanded') === 'true';
      const answerId = btn.getAttribute('aria-controls');
      const answer   = document.getElementById(answerId);

      // Close all
      document.querySelectorAll('.faq-question').forEach((b) => {
        b.setAttribute('aria-expanded', 'false');
        const a = document.getElementById(b.getAttribute('aria-controls'));
        if (a) a.hidden = true;
      });

      // Open clicked (unless already open)
      if (!isOpen && answer) {
        btn.setAttribute('aria-expanded', 'true');
        answer.hidden = false;
      }
    });
  });
})();

// ── Contact Form (basic UX feedback) ─────────────────────────
(function setupContactForm() {
  const form    = document.getElementById('contact-form');
  const success = document.getElementById('form-success');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    // Add your real form handler (WP AJAX / WPForms / Formspree) here.
    // For now, show the success message.
    if (success) {
      form.querySelector('.form-submit').disabled = true;
      success.hidden = false;
      success.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
  });
})();

// ── About page stat counters ──────────────────────────────────
(function setupAboutCounters() {
  if (typeof gsap === 'undefined') return;

  document.querySelectorAll('.stats-bar-number[data-count]').forEach((el) => {
    const target = parseFloat(el.dataset.count);
    if (typeof ScrollTrigger === 'undefined') return;

    ScrollTrigger.create({
      trigger: el,
      start: 'top 85%',
      once: true,
      onEnter: () => {
        gsap.to({ val: 0 }, {
          val: target,
          duration: 1.6,
          ease: 'power2.out',
          onUpdate: function () {
            el.textContent = Number.isInteger(target)
              ? Math.round(this.targets()[0].val).toLocaleString()
              : this.targets()[0].val.toFixed(1);
          },
        });
      },
    });
  });
})();
