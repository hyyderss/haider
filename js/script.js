/* ============================================================
   ALEXANDER'S — scroll-scrub cinema engine
   Vanilla JS, no dependencies. Maps scroll position inside the
   .cinema section to a "frame" of the story, exactly like
   scrubbing a video timeline. Swap the two placeholder frames
   (hero-establishing.jpeg / hero-conquest.jpeg) for extracted
   AI-video frame sequences later, the driver logic below does
   not need to change, only the frame count and easing windows.
   ============================================================ */

(function () {
  var body = document.body;
  body.classList.remove('no-js');

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var cinema = document.getElementById('cinema');
  var colorgrade = document.getElementById('colorgrade');
  var intro = document.getElementById('cinemaIntro');
  var scrollCue = document.getElementById('scrollCue');
  var discovery = document.getElementById('cinemaDiscovery');
  var edgeLeft = document.getElementById('edgeLeft');
  var edgeRight = document.getElementById('edgeRight');
  var nav = document.getElementById('siteNav');

  if (!cinema) return;

  function clamp(v, min, max) { return Math.max(min, Math.min(max, v)); }

  // remaps progress from [a,b] into [0,1], clamped
  function band(progress, a, b) {
    if (progress <= a) return 0;
    if (progress >= b) return 1;
    return (progress - a) / (b - a);
  }

  /* ----------------------------------------------------------
     Frame sequence. Each entry is one visual beat, on screen
     between "in" and "out", crossfading at the edges. "pan"
     is the direction its Ken Burns drift travels while it is
     the dominant frame, so consecutive beats don't all move
     the same way. To add a real 5th/6th/7th beat later once
     the AI-generated frames exist: add another <div class=
     "cinema__frame"> in index.html with its own id, add one
     row here, nothing else in this engine changes.
     ---------------------------------------------------------- */
  var frames = [
    { el: document.getElementById('frameEstablish'), in: 0.00, out: 0.22, pan: 'zoom-in' },
    { el: document.getElementById('frameConquestWide'), in: 0.20, out: 0.40, pan: 'left-right' },
    { el: document.getElementById('frameConquestClose'), in: 0.38, out: 0.60, pan: 'top-bottom' },
    { el: document.getElementById('frameReturn'), in: 0.58, out: 1.00, pan: 'bottom-top-out' }
  ].filter(function (f) { return f.el; });

  var callouts = {
    macedon: { el: document.getElementById('calloutMacedon'), inAt: 0.22, outAt: 0.34 },
    persia: { el: document.getElementById('calloutPersia'), inAt: 0.34, outAt: 0.46 },
    bactria: { el: document.getElementById('calloutBactria'), inAt: 0.46, outAt: 0.58 }
  };

  var mouseX = 0, mouseY = 0, targetX = 0, targetY = 0;

  function getProgress() {
    var rect = cinema.getBoundingClientRect();
    var total = cinema.offsetHeight - window.innerHeight;
    if (total <= 0) return 0;
    var scrolled = -rect.top;
    return clamp(scrolled / total, 0, 1);
  }

  function setCalloutState(c, p) {
    var inRamp = band(p, c.inAt, c.inAt + 0.035);
    var outRamp = 1 - band(p, c.outAt - 0.035, c.outAt);
    var visibility = Math.min(inRamp, outRamp);
    c.el.style.opacity = visibility;
    c.el.style.transform = 'translateY(' + (24 - 24 * visibility) + 'px) scale(' + (0.96 + 0.04 * visibility) + ')';
  }

  function applyPan(img, pan, t) {
    if (reducedMotion) return;
    var tx = 0, ty = 0, scale = 1.05;
    if (pan === 'zoom-in') { scale = 1.02 + t * 0.10; }
    else if (pan === 'left-right') { tx = -3 + t * 6; scale = 1.06; }
    else if (pan === 'top-bottom') { ty = -3 + t * 6; scale = 1.10; }
    else if (pan === 'bottom-top-out') { ty = 3 - t * 6; scale = 1.10 - t * 0.08; }
    img.style.transform = 'translate(' + tx + '%, ' + ty + '%) scale(' + scale + ')';
  }

  function update() {
    var p = getProgress();

    // nav solidifies once we scroll past the very top
    if (window.scrollY > 40) nav.classList.add('is-solid');
    else nav.classList.remove('is-solid');

    // intro copy and scroll cue fade out quickly
    var introVisible = 1 - band(p, 0.015, 0.09);
    intro.style.opacity = introVisible;
    intro.style.transform = 'translateY(' + (1 - introVisible) * -20 + 'px)';
    scrollCue.style.opacity = 1 - band(p, 0.01, 0.06);

    // crossfade + independent pan for every frame in the sequence
    frames.forEach(function (f) {
      var fadeIn = band(p, f.in, f.in + 0.05);
      var fadeOut = 1 - band(p, f.out - 0.05, f.out);
      var opacity = f.out >= 0.999 ? fadeIn : Math.min(fadeIn, fadeOut);
      f.el.style.opacity = clamp(opacity, 0, 1);

      var t = band(p, f.in, f.out);
      applyPan(f.el.querySelector('img'), f.pan, t);
    });

    // warm color grade rises as the journey returns to Khewra
    colorgrade.style.opacity = band(p, 0.64, 0.88) * 0.9;

    // region callouts
    setCalloutState(callouts.macedon, p);
    setCalloutState(callouts.persia, p);
    setCalloutState(callouts.bactria, p);

    // final discovery reveal
    var discoveryVisible = band(p, 0.90, 1.0);
    discovery.style.opacity = discoveryVisible;
    discovery.style.pointerEvents = discoveryVisible > 0.5 ? 'auto' : 'none';

    // decorative side edges drift slowly with scroll for depth
    var edgeShift = (p * 120).toFixed(1) + 'px';
    edgeLeft.style.backgroundPosition = '0 -' + edgeShift;
    edgeRight.style.backgroundPosition = '0 ' + edgeShift;
  }

  var ticking = false;
  function onScroll() {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        update();
        ticking = false;
      });
      ticking = true;
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);

  // mouse-driven parallax on the active frame, skipped for reduced motion
  if (!reducedMotion) {
    document.addEventListener('mousemove', function (e) {
      targetX = (e.clientX / window.innerWidth - 0.5) * 2;
      targetY = (e.clientY / window.innerHeight - 0.5) * 2;
    });

    function parallaxLoop() {
      mouseX += (targetX - mouseX) * 0.05;
      mouseY += (targetY - mouseY) * 0.05;
      var shiftX = mouseX * 14;
      var shiftY = mouseY * 10;
      frames.forEach(function (f) {
        f.el.querySelector('img').style.marginLeft = shiftX + 'px';
        f.el.querySelector('img').style.marginTop = shiftY + 'px';
      });
      requestAnimationFrame(parallaxLoop);
    }
    parallaxLoop();
  }

  update();
})();

/* ============================================================
   PRODUCT FILTER (products.html and the homepage grid, both use
   the same markup: .product-card[data-category] + .filter-btn)
   ============================================================ */
(function () {
  var filterBar = document.getElementById('filterBar');
  if (!filterBar) return;

  var buttons = filterBar.querySelectorAll('.filter-btn');
  var cards = document.querySelectorAll('.product-card');

  filterBar.addEventListener('click', function (e) {
    var btn = e.target.closest('.filter-btn');
    if (!btn) return;

    buttons.forEach(function (b) { b.classList.remove('is-active'); });
    btn.classList.add('is-active');

    var filter = btn.getAttribute('data-filter');
    cards.forEach(function (card) {
      var match = filter === 'all' || card.getAttribute('data-category') === filter;
      card.classList.toggle('is-hidden', !match);
    });
  });
})();

/* ============================================================
   CONTACT FORM
   Posts to WordPress admin-post.php (see wordpress/contact-form-
   handler.php). If that endpoint isn't live yet (static preview,
   or the WPCode snippet hasn't been installed), fails gracefully
   to a mailto link so a visitor is never met with a dead form.
   ============================================================ */
(function () {
  var form = document.getElementById('contactForm');
  if (!form) return;

  var status = document.getElementById('formStatus');

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    status.textContent = 'Sending...';
    status.className = 'form-status';

    var data = new FormData(form);

    fetch(form.action, { method: 'POST', body: data, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (res) {
        if (!res.ok) throw new Error('Request failed');
        status.textContent = 'Message sent. Our export team will respond within one business day.';
        status.className = 'form-status is-success';
        form.reset();
      })
      .catch(function () {
        var subject = encodeURIComponent('Wholesale Inquiry: ' + (data.get('scope') || 'General'));
        var body = encodeURIComponent(
          'Name: ' + data.get('name') + '\n' +
          'Email: ' + data.get('email') + '\n' +
          'Phone: ' + data.get('phone') + '\n\n' +
          data.get('message')
        );
        status.innerHTML = 'The contact form isn\'t connected yet. <a href="mailto:support@alexandersalts.com?subject=' + subject + '&body=' + body + '" style="color:var(--salt-pink);text-decoration:underline;">Click here to send this by email instead</a>.';
        status.className = 'form-status is-error';
      });
  });
})();
