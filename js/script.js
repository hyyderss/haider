/* ============================================================
   ALEXANDER'S — the journey (map-slide sequence)
   Vanilla JS, no dependencies except an optional Three.js CDN
   script for the ambient floating-crystal layer (skipped
   gracefully if that script isn't loaded). Wheel, touch, and
   arrow keys advance one full-bleed location slide at a time;
   a marker travels along a drawn route line between each pair
   of locations while the background crossfades underneath.
   ============================================================ */

(function () {
  var body = document.body;
  body.classList.remove('no-js');

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var journey = document.getElementById('journey');
  if (!journey) return;

  var slides = Array.prototype.slice.call(journey.querySelectorAll('.journey__slide'));
  var routePath = document.getElementById('routePath');
  var marker = document.getElementById('journeyMarker');
  var dotsWrap = document.getElementById('journeyDots');
  var prevBtn = document.getElementById('journeyPrev');
  var nextBtn = document.getElementById('journeyNext');
  var scrollCue = document.getElementById('scrollCue');
  var nav = document.getElementById('siteNav');

  var current = 0;
  var animating = false;
  var TRANSITION_MS = 900;

  // build progress dots
  slides.forEach(function (s, i) {
    var d = document.createElement('div');
    d.className = 'dot' + (i === 0 ? ' is-active' : '');
    dotsWrap.appendChild(d);
  });
  var dots = Array.prototype.slice.call(dotsWrap.children);

  function markerPos(index) {
    var s = slides[index];
    return { x: parseFloat(s.getAttribute('data-mx')), y: parseFloat(s.getAttribute('data-my')) };
  }

  function setMarker(x, y) {
    marker.style.left = x + '%';
    marker.style.top = y + '%';
  }
  setMarker(markerPos(0).x, markerPos(0).y);

  function updateChrome() {
    dots.forEach(function (d, i) { d.classList.toggle('is-active', i === current); });
    prevBtn.disabled = current === 0;
    nextBtn.disabled = current === slides.length - 1;
    scrollCue.style.opacity = current === 0 ? 1 : 0;
    if (nav) nav.classList.toggle('is-solid', current > 0);
  }
  updateChrome();

  function animateRoute(from, to, duration) {
    if (reducedMotion) { setMarker(to.x, to.y); return; }
    var midX = (from.x + to.x) / 2;
    var midY = (from.y + to.y) / 2;
    // bow the control point perpendicular to the travel direction for a gentle arc
    var dx = to.x - from.x, dy = to.y - from.y;
    var bow = Math.min(14, Math.hypot(dx, dy) * 0.3);
    var cx = midX - dy * (bow / (Math.hypot(dx, dy) || 1));
    var cy = midY + dx * (bow / (Math.hypot(dx, dy) || 1));

    routePath.setAttribute('d', 'M ' + from.x + ',' + from.y + ' Q ' + cx + ',' + cy + ' ' + to.x + ',' + to.y);
    var len = routePath.getTotalLength();
    routePath.style.strokeDasharray = len;
    routePath.style.strokeDashoffset = len;

    var start = null;
    function frame(ts) {
      if (!start) start = ts;
      var t = Math.min(1, (ts - start) / duration);
      var eased = 1 - Math.pow(1 - t, 3);
      routePath.style.strokeDashoffset = len * (1 - eased);
      var point = routePath.getPointAtLength(len * eased);
      setMarker(point.x, point.y);
      if (t < 1) requestAnimationFrame(frame);
      else {
        setTimeout(function () { routePath.style.strokeDasharray = '1'; routePath.style.strokeDashoffset = '1'; }, 400);
      }
    }
    requestAnimationFrame(frame);
  }

  function goTo(index) {
    index = Math.max(0, Math.min(slides.length - 1, index));
    if (index === current || animating) return;
    animating = true;

    var from = markerPos(current);
    var to = markerPos(index);

    slides[current].classList.remove('is-active');
    slides[index].classList.add('is-active');

    animateRoute(from, to, TRANSITION_MS);

    current = index;
    updateChrome();

    setTimeout(function () { animating = false; }, TRANSITION_MS + 50);
  }

  prevBtn.addEventListener('click', function () { goTo(current - 1); });
  nextBtn.addEventListener('click', function () { goTo(current + 1); });

  function isPinned() {
    var rect = journey.getBoundingClientRect();
    return Math.abs(rect.top) < 3;
  }

  window.addEventListener('wheel', function (e) {
    if (!isPinned()) return;
    var goingDown = e.deltaY > 0;
    if (goingDown && current < slides.length - 1) { e.preventDefault(); goTo(current + 1); }
    else if (!goingDown && current > 0) { e.preventDefault(); goTo(current - 1); }
    // else: at a boundary, let the browser scroll the page normally
  }, { passive: false });

  var touchStartY = null;
  window.addEventListener('touchstart', function (e) {
    if (!isPinned()) { touchStartY = null; return; }
    touchStartY = e.touches[0].clientY;
  }, { passive: true });
  window.addEventListener('touchend', function (e) {
    if (touchStartY === null) return;
    var delta = touchStartY - e.changedTouches[0].clientY;
    if (Math.abs(delta) < 40) return;
    if (delta > 0 && current < slides.length - 1) goTo(current + 1);
    else if (delta < 0 && current > 0) goTo(current - 1);
    touchStartY = null;
  }, { passive: true });

  window.addEventListener('keydown', function (e) {
    if (!isPinned()) return;
    if (e.key === 'ArrowDown' || e.key === 'PageDown') { goTo(current + 1); }
    else if (e.key === 'ArrowUp' || e.key === 'PageUp') { goTo(current - 1); }
  });

  /* ----------------------------------------------------------
     Ambient floating salt crystals, real WebGL via Three.js
     (loaded from a CDN script tag before this file). Simple
     low-poly geometry for now, deliberately not photoreal,
     upgrade the geometry/material later without touching the
     slide logic above.
     ---------------------------------------------------------- */
  function initCrystals() {
    if (typeof THREE === 'undefined' || reducedMotion) return;
    var canvas = document.getElementById('crystalCanvas');
    if (!canvas) return;

    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
    camera.position.set(0, 0, 12);

    scene.add(new THREE.AmbientLight(0xffffff, 0.5));
    var key = new THREE.DirectionalLight(0xf3ead9, 1.1);
    key.position.set(4, 6, 8);
    scene.add(key);
    var rim = new THREE.DirectionalLight(0xe8a68e, 0.8);
    rim.position.set(-6, -2, -4);
    scene.add(rim);

    var material = new THREE.MeshStandardMaterial({
      color: 0xe8a68e, roughness: 0.25, metalness: 0.1,
      transparent: true, opacity: 0.85
    });

    var crystals = [];
    var layout = [
      { x: -6.5, y: 2.4, z: 0, s: 0.9 },
      { x: 6.8, y: -1.5, z: -1, s: 1.2 },
      { x: -5.8, y: -3.2, z: 1, s: 0.7 },
      { x: 6.2, y: 3.0, z: 0.5, s: 0.6 }
    ];
    layout.forEach(function (p) {
      var geo = new THREE.OctahedronGeometry(p.s, 0);
      var mesh = new THREE.Mesh(geo, material);
      mesh.position.set(p.x, p.y, p.z);
      mesh.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, 0);
      scene.add(mesh);
      crystals.push({ mesh: mesh, baseY: p.y, speed: 0.3 + Math.random() * 0.3, phase: Math.random() * Math.PI * 2 });
    });

    function resize() {
      var w = canvas.clientWidth, h = canvas.clientHeight;
      renderer.setSize(w, h, false);
      camera.aspect = w / h;
      camera.updateProjectionMatrix();
    }
    window.addEventListener('resize', resize);
    resize();

    var clock = new THREE.Clock();
    function tick() {
      var t = clock.getElapsedTime();
      crystals.forEach(function (c) {
        c.mesh.position.y = c.baseY + Math.sin(t * c.speed + c.phase) * 0.4;
        c.mesh.rotation.x += 0.002;
        c.mesh.rotation.y += 0.003;
      });
      renderer.render(scene, camera);
      requestAnimationFrame(tick);
    }
    tick();
  }
  initCrystals();

})();

/* ============================================================
   SCROLL-REVEAL, used site-wide on inner pages
   ============================================================ */
(function () {
  var targets = document.querySelectorAll('.reveal');
  if (!targets.length) return;
  if (typeof IntersectionObserver === 'undefined') {
    targets.forEach(function (t) { t.classList.add('is-visible'); });
    return;
  }
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  targets.forEach(function (t) { io.observe(t); });
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

/* ============================================================
   CERTIFICATE PASSWORD GATE (certifications.html)
   Posts to admin-post.php, handled by
   wordpress/cert-password-gate.php, which checks the password
   server-side and streams the PDF bytes back directly (the
   files are never at a public, guessable URL). Fails gracefully
   to a status message if that endpoint isn't installed yet.
   ============================================================ */
(function () {
  var modal = document.getElementById('certModal');
  if (!modal) return;

  var backdrop = document.getElementById('certModalBackdrop');
  var closeBtn = document.getElementById('certModalClose');
  var gate = document.getElementById('certGate');
  var gateTitle = document.getElementById('certGateTitle');
  var gateForm = document.getElementById('certGateForm');
  var gatePassword = document.getElementById('certGatePassword');
  var gateStatus = document.getElementById('certGateStatus');
  var viewer = document.getElementById('certViewer');
  var pdfFrame = document.getElementById('certPdfFrame');

  var currentCertId = null;

  function openModal(certId, certName) {
    currentCertId = certId;
    gateTitle.textContent = 'Enter Password: ' + certName;
    gateStatus.textContent = '';
    gateStatus.className = 'form-status';
    gatePassword.value = '';
    gate.hidden = false;
    viewer.hidden = true;
    pdfFrame.src = 'about:blank';
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { gatePassword.focus(); }, 50);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    pdfFrame.src = 'about:blank';
  }

  document.querySelectorAll('.cert-unlock').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openModal(btn.getAttribute('data-cert-id'), btn.getAttribute('data-cert-name'));
    });
  });
  closeBtn.addEventListener('click', closeModal);
  backdrop.addEventListener('click', closeModal);
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

  gateForm.addEventListener('submit', function (e) {
    e.preventDefault();
    gateStatus.textContent = 'Checking...';
    gateStatus.className = 'form-status';

    var data = new FormData();
    data.append('action', 'alexanders_cert_auth');
    data.append('cert_id', currentCertId);
    data.append('password', gatePassword.value);

    fetch('/wp-admin/admin-post.php', { method: 'POST', body: data })
      .then(function (res) {
        if (res.status === 403) { throw new Error('WRONG_PASSWORD'); }
        if (!res.ok) { throw new Error('NOT_CONNECTED'); }
        return res.blob();
      })
      .then(function (blob) {
        var url = URL.createObjectURL(blob);
        pdfFrame.src = url;
        gate.hidden = true;
        viewer.hidden = false;
      })
      .catch(function (err) {
        if (err.message === 'WRONG_PASSWORD') {
          gateStatus.textContent = 'Incorrect password, try again.';
        } else {
          gateStatus.textContent = 'This password gate isn\'t connected yet, install wordpress/cert-password-gate.php first.';
        }
        gateStatus.className = 'form-status is-error';
      });
  });
})();
