<?php
/**
 * Alexander's homepage, WordPress/WPCode version.
 *
 * SETUP (one time):
 * 1. Install and activate the free "Advanced Custom Fields" plugin.
 * 2. Go to Custom Fields > Tools > Import Field Groups, upload
 *    acf-alexanders-homepage.json (from this same folder), then open
 *    that field group and set its Location rule to the actual
 *    Homepage page you create in WordPress.
 * 3. Install and activate the free "WPCode" plugin.
 * 4. WPCode > Add Snippet > Add Your Custom Code, paste this entire
 *    file, set Code Type to "PHP Snippet", set Insertion to
 *    "Shortcode", save, and activate it. WPCode will show you the
 *    shortcode it generated, something like [wpcode id="12"].
 * 5. Create a WordPress Page called Home, blank/full-width template,
 *    add a single Shortcode block containing that [wpcode id=".."]
 *    shortcode, publish, set it as your site's front page under
 *    Settings > Reading.
 * 6. Via cPanel File Manager, upload assets/images/journey/*.jpeg
 *    and the logo into wp-content/uploads/alexanders-assets/images/
 *    (keep the same filenames), update ALEXANDERS_FALLBACK_BASE
 *    below to that URL. These are shown until step 7.
 * 7. TO SWAP IN BETTER QUALITY IMAGES LATER: open the Home page in
 *    WordPress, scroll to the "Homepage Media" box added by ACF,
 *    upload a replacement for any of the 8 journey slides or the
 *    logo, click Update. No code changes, no re-pasting this
 *    snippet. Add a 9th/10th slide later by adding another
 *    .journey__slide in the markup below, one data-mx/data-my
 *    marker position, and one ACF image field to match.
 * 8. This markup links to about.html, products.html,
 *    certifications.html, contact.html directly. Once those exist
 *    as real WordPress pages, either name their slugs to match
 *    or replace these hrefs with the real page URLs from wp-admin.
 */

if (!defined('ALEXANDERS_FALLBACK_BASE')) {
    define('ALEXANDERS_FALLBACK_BASE', 'https://alexanderssalt.com/wp-content/uploads/alexanders-assets/images/');
}

$nav_logo = function_exists('get_field') ? get_field('nav_logo') : '';
if (empty($nav_logo)) { $nav_logo = ALEXANDERS_FALLBACK_BASE . 'logo-badge-crop.jpeg'; }

$journey_frame_0 = function_exists('get_field') ? get_field('journey_frame_0') : '';
if (empty($journey_frame_0)) { $journey_frame_0 = ALEXANDERS_FALLBACK_BASE . 'journey/00-opening.jpeg'; }
$journey_frame_1 = function_exists('get_field') ? get_field('journey_frame_1') : '';
if (empty($journey_frame_1)) { $journey_frame_1 = ALEXANDERS_FALLBACK_BASE . 'journey/01-macedon.jpeg'; }
$journey_frame_2 = function_exists('get_field') ? get_field('journey_frame_2') : '';
if (empty($journey_frame_2)) { $journey_frame_2 = ALEXANDERS_FALLBACK_BASE . 'journey/02-persia.jpeg'; }
$journey_frame_3 = function_exists('get_field') ? get_field('journey_frame_3') : '';
if (empty($journey_frame_3)) { $journey_frame_3 = ALEXANDERS_FALLBACK_BASE . 'journey/03-march-aerial.jpeg'; }
$journey_frame_4 = function_exists('get_field') ? get_field('journey_frame_4') : '';
if (empty($journey_frame_4)) { $journey_frame_4 = ALEXANDERS_FALLBACK_BASE . 'journey/04-bactria.jpeg'; }
$journey_frame_5 = function_exists('get_field') ? get_field('journey_frame_5') : '';
if (empty($journey_frame_5)) { $journey_frame_5 = ALEXANDERS_FALLBACK_BASE . 'journey/05-himalayas-appear.jpeg'; }
$journey_frame_6 = function_exists('get_field') ? get_field('journey_frame_6') : '';
if (empty($journey_frame_6)) { $journey_frame_6 = ALEXANDERS_FALLBACK_BASE . 'journey/06-khewra-approach.jpeg'; }
$journey_frame_7 = function_exists('get_field') ? get_field('journey_frame_7') : '';
if (empty($journey_frame_7)) { $journey_frame_7 = ALEXANDERS_FALLBACK_BASE . 'journey/07-discovery-crystal.jpeg'; }
?>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Cormorant+Garamond:ital@1&family=Crimson+Pro:ital,wght@0,400;0,500;0,600;1,400&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
/* ============================================================
   ALEXANDER'S — design system
   Fonts: Unbounded (display), Instrument Serif italic (accent word),
   Work Sans (body), Space Mono (labels/UI)
   ============================================================ */

:root {
  --void: #120c1a;
  --stone: #1d1428;
  --stone-2: #2b1f3d;
  --dusk-lighter: #382a4d;
  --parchment: #f3ead9;
  --parchment-dim: #cbbfab;
  --salt-pink: #e8a68e;
  --bronze: #c9a15a;
  --bronze-dark: #a9803f;
  --clay: #b8593f;
  --ember: #d97b5c;

  --font-display: 'Cinzel', serif;
  --font-accent: 'Cormorant Garamond', serif;
  --font-body: 'Crimson Pro', serif;
  --font-mono: 'Space Mono', monospace;

  --container: 1240px;
  --edge: clamp(16px, 4vw, 64px);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
  background: var(--void);
  color: var(--parchment);
  font-family: var(--font-body);
  font-size: 18px;
  font-weight: 400;
  line-height: 1.65;
  overflow-x: hidden;
}

img { max-width: 100%; display: block; }

a { color: inherit; text-decoration: none; }

.accent {
  font-family: var(--font-accent);
  font-style: italic;
  font-weight: 400;
  text-transform: none;
  color: var(--salt-pink);
}

.eyebrow {
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--bronze);
}

.section-title {
  font-family: var(--font-display);
  font-weight: 700;
  text-transform: uppercase;
  font-size: clamp(30px, 4.2vw, 52px);
  line-height: 1.18;
  letter-spacing: 0.01em;
  color: var(--parchment);
  text-wrap: balance;
}

/* ---------- scroll-reveal utility, used site-wide ---------- */
.reveal {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}
.reveal.is-visible { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .reveal { opacity: 1; transform: none; transition: none; }
}

.wrap { max-width: var(--container); margin: 0 auto; padding: 0 var(--edge); }

/* ---------- buttons: thin bordered tags, never filled ---------- */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  padding: 13px 22px;
  border: 1px solid var(--bronze);
  border-radius: 3px;
  color: var(--parchment);
  background: transparent;
  transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease;
  cursor: pointer;
}
.btn:hover {
  background: rgba(201, 161, 90, 0.12);
  border-color: var(--bronze);
}
.btn--ember { border-color: var(--ember); }
.btn--ember:hover { background: rgba(217, 123, 92, 0.14); }
.btn--light { border-color: var(--void); color: var(--void); }
.btn--light:hover { background: rgba(18, 12, 26, 0.08); }

/* ---------- nav ---------- */
.site-nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 500;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px var(--edge);
  background: transparent;
  transition: background 0.35s ease, padding 0.35s ease, border-color 0.35s ease;
  border-bottom: 1px solid transparent;
}
.site-nav.is-solid {
  background: rgba(18, 12, 26, 0.92);
  backdrop-filter: blur(10px);
  padding: 14px var(--edge);
  border-bottom-color: rgba(201, 161, 90, 0.15);
}
.site-nav__brand {
  font-family: var(--font-display);
  font-size: 15px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--parchment);
  display: flex;
  align-items: center;
  gap: 10px;
}
.site-nav__brand img { width: 34px; height: 34px; border-radius: 50%; }
.site-nav__links {
  display: flex;
  gap: 34px;
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
.site-nav__links a { opacity: 0.85; transition: opacity 0.2s ease; }
.site-nav__links a:hover { opacity: 1; color: var(--salt-pink); }
.site-nav__cta { display: flex; align-items: center; gap: 22px; }
.site-nav__phone { font-family: var(--font-mono); font-size: 12px; color: var(--parchment-dim); display: none; }
.nav-toggle { display: none; background: none; border: none; color: var(--parchment); font-size: 22px; cursor: pointer; }

@media (max-width: 900px) {
  .site-nav__links, .site-nav__phone { display: none; }
  .nav-toggle { display: block; }
}

/* ============================================================
   THE JOURNEY — map-slide sequence with a traveling route marker
   ============================================================ */
.journey {
  position: relative;
  height: 100vh;
  overflow: hidden;
  background: var(--void);
}
.journey__stage { position: relative; width: 100%; height: 100%; }

.journey__canvas {
  position: absolute;
  inset: 0;
  z-index: 3;
  pointer-events: none;
  opacity: 0.9;
}

.journey__slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.85s ease;
  z-index: 1;
}
.journey__slide.is-active { opacity: 1; visibility: visible; z-index: 2; }
.journey__bg, .journey__bg img {
  position: absolute; inset: 0; width: 100%; height: 100%;
  object-fit: cover; object-position: center;
}
.journey__bg img {
  transform: scale(1.04);
  transition: transform 8s ease;
}
.journey__slide.is-active .journey__bg img { transform: scale(1.12); }

.journey__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(9,6,13,0.5) 0%, rgba(9,6,13,0.28) 35%, rgba(9,6,13,0.55) 100%);
}
.journey__overlay--warm {
  background: linear-gradient(180deg, rgba(43,25,20,0.45) 0%, rgba(9,6,13,0.3) 40%, rgba(9,6,13,0.6) 100%);
}
.journey__overlay--discovery {
  background: radial-gradient(circle at 50% 50%, rgba(9,6,13,0.15), rgba(9,6,13,0.75) 78%);
}

.journey__text {
  position: absolute;
  max-width: 420px;
  z-index: 4;
  opacity: 0;
  transform: translateY(16px);
  transition: opacity 0.6s ease 0.25s, transform 0.6s ease 0.25s;
}
.journey__slide.is-active .journey__text { opacity: 1; transform: translateY(0); }
.journey__text .eyebrow { display: block; margin-bottom: 14px; }
.journey__text h1 {
  font-family: var(--font-display);
  font-weight: 900;
  text-transform: uppercase;
  font-size: clamp(32px, 5.6vw, 68px);
  line-height: 1.05;
  color: var(--parchment);
}
.journey__text h2 {
  font-family: var(--font-display);
  font-weight: 700;
  text-transform: uppercase;
  font-size: clamp(26px, 3.6vw, 44px);
  line-height: 1.1;
  color: var(--parchment);
}
.journey__text p {
  margin-top: 14px;
  font-size: 16px;
  color: var(--parchment-dim);
  font-weight: 400;
}
.journey__text .badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 18px;
  padding: 6px 16px 6px 6px;
  border: 1px solid rgba(201,161,90,0.4);
  border-radius: 999px;
  background: rgba(9,6,13,0.5);
}
.journey__text .badge img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
.journey__text .badge span {
  font-family: var(--font-mono);
  font-size: 10px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--parchment-dim);
}

/* the route line + traveling marker sit above every slide */
.journey__route {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  z-index: 5;
  pointer-events: none;
}
.journey__route path {
  stroke-dasharray: 1;
  stroke-dashoffset: 1;
  filter: drop-shadow(0 0 6px rgba(201,161,90,0.6));
}
.journey__marker {
  position: absolute;
  left: 50%; top: 86%;
  transform: translate(-50%, -50%);
  z-index: 6;
  color: var(--ember);
  font-size: 20px;
  text-shadow: 0 0 10px rgba(217,123,92,0.8), 0 0 2px rgba(0,0,0,0.6);
  pointer-events: none;
  transition: none;
}

.journey__progress {
  position: absolute;
  right: clamp(16px, 3vw, 40px);
  top: 50%;
  transform: translateY(-50%);
  z-index: 7;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.journey__progress .dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: rgba(243,234,217,0.3);
  transition: background 0.3s ease, transform 0.3s ease;
}
.journey__progress .dot.is-active { background: var(--salt-pink); transform: scale(1.4); }

.journey__arrow {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  z-index: 7;
  width: 38px; height: 38px;
  border-radius: 50%;
  border: 1px solid rgba(201,161,90,0.4);
  background: rgba(9,6,13,0.5);
  color: var(--parchment);
  font-size: 15px;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: border-color 0.2s ease, opacity 0.2s ease;
}
.journey__arrow:hover { border-color: var(--bronze); }
.journey__arrow:disabled { opacity: 0.25; cursor: default; }
.journey__arrow--up { top: 24px; }
.journey__arrow--down { bottom: 24px; }

.journey__scrollcue {
  position: absolute;
  left: 50%;
  bottom: 5vh;
  transform: translateX(-50%);
  font-family: var(--font-mono);
  font-size: 11px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--parchment-dim);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  z-index: 7;
  transition: opacity 0.4s ease;
}
.journey__scrollcue .line {
  width: 1px; height: 34px;
  background: linear-gradient(180deg, var(--bronze), transparent);
  animation: cue-drop 1.8s ease-in-out infinite;
}
@keyframes cue-drop {
  0% { transform: scaleY(0.3); opacity: 0.3; }
  50% { transform: scaleY(1); opacity: 1; }
  100% { transform: scaleY(0.3); opacity: 0.3; }
}

.no-js .journey { height: auto; }
.no-js .journey__slide { position: relative; opacity: 1; visibility: visible; height: 100vh; }
.no-js .journey__route, .no-js .journey__marker, .no-js .journey__progress,
.no-js .journey__arrow, .no-js .journey__canvas { display: none; }


/* ============================================================
   STATS BAR
   ============================================================ */
.stats {
  background: var(--stone);
  border-top: 1px solid rgba(201,161,90,0.15);
  border-bottom: 1px solid rgba(201,161,90,0.15);
  padding: 48px 0;
}
.stats__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}
.stat__num {
  font-family: var(--font-display);
  font-size: clamp(28px, 3.4vw, 42px);
  color: var(--salt-pink);
}
.stat__label {
  margin-top: 8px;
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.06em;
  color: var(--parchment-dim);
}
@media (max-width: 800px) {
  .stats__grid { grid-template-columns: repeat(2, 1fr); }
}

/* ============================================================
   PROCESS
   ============================================================ */
.process { padding: 120px 0; background: var(--void); }
.process__head { max-width: 640px; margin-bottom: 64px; }
.process__head p { margin-top: 18px; color: var(--parchment-dim); }
.process__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1px;
  background: rgba(201,161,90,0.15);
}
.process__step {
  background: var(--void);
  padding: 36px 28px;
}
.process__step .num {
  font-family: var(--font-mono);
  font-size: 13px;
  color: var(--bronze);
}
.process__step h3 {
  margin-top: 22px;
  font-family: var(--font-display);
  text-transform: uppercase;
  font-size: 17px;
  color: var(--parchment);
}
.process__step p {
  margin-top: 12px;
  font-size: 13.5px;
  color: var(--parchment-dim);
}
@media (max-width: 900px) {
  .process__grid { grid-template-columns: 1fr; }
}

/* ============================================================
   PRODUCTS
   ============================================================ */
.products { padding: 0 0 120px; background: var(--void); }
.products__head {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 24px;
  margin-bottom: 48px;
  flex-wrap: wrap;
}
.products__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
}
.product-card {
  position: relative;
  aspect-ratio: 3/4;
  border: 1px solid rgba(201,161,90,0.25);
  border-radius: 3px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  background: linear-gradient(150deg, var(--stone-2), var(--stone) 70%);
  overflow: hidden;
  transition: border-color 0.25s ease, transform 0.25s ease;
}
.product-card:hover { border-color: var(--bronze); transform: translateY(-4px); }
.product-card__icon {
  position: absolute;
  top: 22px; left: 20px;
  width: 30px; height: 30px;
  opacity: 0.85;
}
.product-card__tag {
  font-family: var(--font-mono);
  font-size: 10px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--bronze);
  margin-bottom: 8px;
}
.product-card h3 {
  font-family: var(--font-display);
  text-transform: uppercase;
  font-size: 16px;
  line-height: 1.3;
  color: var(--parchment);
}
@media (max-width: 1000px) { .products__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .products__grid { grid-template-columns: 1fr 1fr; gap: 12px; } }

/* ============================================================
   CERTIFICATIONS STRIP
   ============================================================ */
.certs {
  background: var(--stone);
  padding: 64px 0;
  border-top: 1px solid rgba(201,161,90,0.15);
}
.certs__grid {
  margin-top: 32px;
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.cert-chip {
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 12px 18px;
  border: 1px solid rgba(201,161,90,0.35);
  border-radius: 3px;
  color: var(--parchment-dim);
}

/* ============================================================
   CTA BANNER
   ============================================================ */
.cta-band {
  padding: 110px 0;
  text-align: center;
  background: radial-gradient(circle at 50% 30%, var(--dusk-lighter), var(--void) 70%);
}
.cta-band h2 { max-width: 760px; margin: 0 auto; }
.cta-band p { max-width: 520px; margin: 20px auto 34px; color: var(--parchment-dim); }
.cta-band__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

/* ============================================================
   INNER PAGE HERO (About, Products, Certifications, Contact)
   ============================================================ */
.page-hero {
  padding: 180px 0 80px;
  background: linear-gradient(180deg, var(--stone-2), var(--void) 85%);
  border-bottom: 1px solid rgba(201,161,90,0.15);
}
.page-hero p { max-width: 620px; margin-top: 18px; color: var(--parchment-dim); }

/* ============================================================
   VALUES GRID (About)
   ============================================================ */
.values { padding: 100px 0; background: var(--void); }
.values__grid {
  margin-top: 48px;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 1px;
  background: rgba(201,161,90,0.15);
}
.value-card { background: var(--void); padding: 30px 22px; }
.value-card .num { font-family: var(--font-mono); font-size: 12px; color: var(--bronze); }
.value-card h3 { margin-top: 16px; font-family: var(--font-display); text-transform: uppercase; font-size: 15px; }
.value-card p { margin-top: 10px; font-size: 13px; color: var(--parchment-dim); }
@media (max-width: 900px) { .values__grid { grid-template-columns: repeat(2, 1fr); } }

/* ============================================================
   STORY TIMELINE (About)
   ============================================================ */
.timeline { padding: 0 0 100px; background: var(--void); }
.timeline__row {
  display: grid;
  grid-template-columns: 140px 1fr;
  gap: 28px;
  padding: 28px 0;
  border-top: 1px solid rgba(201,161,90,0.15);
}
.timeline__row:last-child { border-bottom: 1px solid rgba(201,161,90,0.15); }
.timeline__year { font-family: var(--font-mono); color: var(--ember); font-size: 14px; }
.timeline__row h3 { font-family: var(--font-display); text-transform: uppercase; font-size: 16px; margin-bottom: 8px; }
.timeline__row p { color: var(--parchment-dim); font-size: 14px; max-width: 640px; }

/* ============================================================
   PRODUCT FILTERS (Products page)
   ============================================================ */
.filter-bar { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 40px; }
.filter-btn {
  font-family: var(--font-mono);
  font-size: 11px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 10px 16px;
  border: 1px solid rgba(201,161,90,0.35);
  border-radius: 3px;
  background: transparent;
  color: var(--parchment-dim);
  cursor: pointer;
  transition: all 0.2s ease;
}
.filter-btn:hover { border-color: var(--bronze); color: var(--parchment); }
.filter-btn.is-active { border-color: var(--bronze); background: rgba(201,161,90,0.14); color: var(--parchment); }
.product-card.is-hidden { display: none; }

/* ============================================================
   CERTIFICATIONS PAGE
   ============================================================ */
.cert-page-grid {
  margin-top: 48px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}
.cert-card {
  border: 1px solid rgba(201,161,90,0.25);
  border-radius: 3px;
  padding: 28px;
  background: var(--stone-2);
}
.cert-card__label { font-family: var(--font-mono); font-size: 11px; color: var(--bronze); text-transform: uppercase; letter-spacing: 0.08em; }
.cert-card h3 { margin-top: 12px; font-family: var(--font-display); text-transform: uppercase; font-size: 17px; }
.cert-card p { margin-top: 10px; font-size: 13.5px; color: var(--parchment-dim); }
.cert-card .btn { margin-top: 20px; }
@media (max-width: 900px) { .cert-page-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 560px) { .cert-page-grid { grid-template-columns: 1fr; } }

/* ============================================================
   CERTIFICATE PASSWORD MODAL
   ============================================================ */
.cert-unlock { width: 100%; justify-content: center; }
.cert-modal {
  position: fixed; inset: 0; z-index: 1000;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none;
  transition: opacity 0.25s ease;
}
.cert-modal.is-open { opacity: 1; pointer-events: auto; }
.cert-modal__backdrop {
  position: absolute; inset: 0;
  background: rgba(9,6,13,0.82);
  backdrop-filter: blur(4px);
}
.cert-modal__panel {
  position: relative;
  z-index: 1;
  width: min(560px, 92vw);
  max-height: 86vh;
  background: var(--stone);
  border: 1px solid rgba(201,161,90,0.3);
  border-radius: 6px;
  padding: 44px 36px;
  overflow: auto;
}
.cert-modal__close {
  position: absolute; top: 14px; right: 16px;
  background: none; border: none;
  color: var(--parchment-dim);
  font-size: 26px; line-height: 1;
  cursor: pointer;
}
.cert-modal__lock { font-size: 34px; text-align: center; margin-bottom: 8px; }
.cert-modal__gate h3 {
  font-family: var(--font-display);
  text-transform: uppercase;
  font-size: 22px;
  text-align: center;
}
.cert-modal__gate p {
  text-align: center;
  color: var(--parchment-dim);
  font-size: 15px;
  margin-top: 10px;
}
#certGateForm {
  display: flex;
  gap: 10px;
  margin-top: 24px;
}
#certGatePassword {
  flex: 1;
  background: var(--stone-2);
  border: 1px solid rgba(201,161,90,0.3);
  border-radius: 3px;
  padding: 13px 14px;
  color: var(--parchment);
  font-family: var(--font-body);
  font-size: 16px;
}
.cert-modal__viewer { width: 100%; height: 70vh; }
.cert-modal__viewer iframe { width: 100%; height: 100%; border: none; border-radius: 4px; background: var(--parchment); }

/* ============================================================
   CONTACT PAGE
   ============================================================ */
.contact-section { padding: 0 0 120px; background: var(--void); }
.contact-grid {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: 60px;
}
.contact-info__item { padding: 26px 0; border-top: 1px solid rgba(201,161,90,0.15); }
.contact-info__item:last-child { border-bottom: 1px solid rgba(201,161,90,0.15); }
.contact-info__label { font-family: var(--font-mono); font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--bronze); }
.contact-info__value { margin-top: 10px; font-size: 20px; }
.contact-info__badge {
  margin-top: 36px;
  padding: 22px;
  border: 1px solid rgba(201,161,90,0.25);
  border-radius: 4px;
  background: var(--stone-2);
  display: flex;
  align-items: center;
  gap: 16px;
}
.contact-info__badge img { width: 54px; height: 54px; border-radius: 50%; flex-shrink: 0; }
.contact-info__badge p { font-size: 15px; color: var(--parchment-dim); margin: 0; }

.form-field { margin-bottom: 22px; }
.form-field label {
  display: block;
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--parchment-dim);
  margin-bottom: 9px;
}
.form-field input,
.form-field select,
.form-field textarea {
  width: 100%;
  background: var(--stone-2);
  border: 1px solid rgba(201,161,90,0.3);
  border-radius: 3px;
  padding: 15px 16px;
  color: var(--parchment);
  font-family: var(--font-body);
  font-size: 17px;
}
.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus {
  outline: none;
  border-color: var(--bronze);
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-status { margin-top: 16px; font-family: var(--font-mono); font-size: 12px; }
.form-status.is-success { color: var(--salt-pink); }
.form-status.is-error { color: var(--clay); }
@media (max-width: 800px) {
  .contact-grid { grid-template-columns: 1fr; }
  .form-row { grid-template-columns: 1fr; }
}

/* ============================================================
   FOOTER
   ============================================================ */
.site-footer {
  background: var(--stone);
  padding: 80px 0 32px;
  border-top: 1px solid rgba(201,161,90,0.15);
}
.footer__grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr;
  gap: 48px;
}
.footer__brand {
  font-family: var(--font-display);
  text-transform: uppercase;
  font-size: 20px;
}
.footer__tagline {
  margin-top: 14px;
  color: var(--parchment-dim);
  font-size: 14px;
  max-width: 320px;
}
.footer__heading {
  font-family: var(--font-mono);
  font-size: 12px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--bronze);
  margin-bottom: 18px;
}
.footer__links { display: flex; flex-direction: column; gap: 12px; font-size: 14px; color: var(--parchment-dim); }
.footer__links a:hover { color: var(--salt-pink); }
.footer__contact { display: flex; flex-direction: column; gap: 12px; font-size: 14px; color: var(--parchment-dim); }
.footer__bottom {
  margin-top: 64px;
  padding-top: 24px;
  border-top: 1px solid rgba(201,161,90,0.12);
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  font-family: var(--font-mono);
  font-size: 11px;
  color: var(--parchment-dim);
}
@media (max-width: 800px) {
  .footer__grid { grid-template-columns: 1fr; gap: 32px; }
}

</style>


<!-- ============================================================
     NAV
     ============================================================ -->
<nav class="site-nav" id="siteNav">
  <a href="#top" class="site-nav__brand">
    <img src="<?php echo esc_url($nav_logo); ?>" alt="Alexander's emblem">
    Alexander's
  </a>
  <div class="site-nav__links">
    <a href="index.html">Home</a>
    <a href="about.html">Our Story</a>
    <a href="products.html">Products</a>
    <a href="certifications.html">Certifications</a>
    <a href="contact.html">Contact</a>
  </div>
  <div class="site-nav__cta">
    <span class="site-nav__phone">+92 300 5348542</span>
    <a href="contact.html" class="btn">Request A Quote</a>
    <button class="nav-toggle" aria-label="Open menu">&#9776;</button>
  </div>
</nav>

<!-- ============================================================
     THE JOURNEY — a map-slide sequence, not a video scrub.
     Each .journey__slide is one location. Scrolling (wheel, touch,
     or arrow keys) advances one slide at a time; a marker dot
     travels along a drawn route line from the previous location's
     mark to the next while the background crossfades underneath.
     data-acf hooks mark text a future ACF field group should
     expose in wp-admin, wire these once WordPress is set up.
     ============================================================ -->
<a id="top"></a>
<section class="journey" id="journey" aria-label="Alexander's origin story, scroll to advance">
  <div class="journey__stage">

    <canvas id="crystalCanvas" class="journey__canvas" aria-hidden="true"></canvas>

    <div class="journey__slide is-active" data-index="0" data-mx="50" data-my="86">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_0); ?>" alt="Alexander on horseback overlooking the Himalayan mountain range at dusk"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="left:50%; bottom:16%; transform:translateX(-50%); text-align:center;">
        <span class="eyebrow" data-acf="hero_eyebrow">326 BC &middot; THE HIMALAYAS</span>
        <h1 data-acf="hero_headline">The Salt That <span class="accent">Conquered</span> Time</h1>
        <p data-acf="hero_subcopy">A warhorse once knelt on a ridge like this one and licked a rock that glowed pink beneath the dusk. This is that campaign.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="1" data-mx="20" data-my="62">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_1); ?>" alt="Alexander overlooking Macedon and the Acropolis at dusk"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="left:8%; top:58%;">
        <span class="eyebrow">334 BC</span>
        <h2>Macedon</h2>
        <p>The campaign begins. The army marches east from the Macedonian court.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="2" data-mx="78" data-my="34">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_2); ?>" alt="Alexander commanding his army toward the Persian sunrise"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="right:8%; top:16%; text-align:right;">
        <span class="eyebrow">331 BC</span>
        <h2>Persia</h2>
        <p>The Achaemenid Empire falls. The known world's borders are redrawn.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="3" data-mx="50" data-my="50">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_3); ?>" alt="Aerial view of the army marching east across the desert"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="left:50%; top:12%; transform:translateX(-50%); text-align:center;">
        <span class="eyebrow">THE MARCH EAST</span>
        <h2>Ten Thousand Strong</h2>
        <p>The campaign turns toward the mountains, an empire's army moving as one.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="4" data-mx="24" data-my="70">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_4); ?>" alt="Alexander charging through a conquered fortress gate at the Bactrian frontier"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="left:6%; bottom:10%;">
        <span class="eyebrow">329 BC</span>
        <h2>Bactria</h2>
        <p>The eastern frontier holds through a punishing campaign.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="5" data-mx="72" data-my="38">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_5); ?>" alt="The Himalayas rise ahead as Alexander approaches on horseback"></div>
      <div class="journey__overlay"></div>
      <div class="journey__text text-plate" style="right:8%; top:14%; text-align:right;">
        <span class="eyebrow">326 BC</span>
        <h2>The Himalayas Appear</h2>
        <p>Ahead, foothills rise from the dust for the first time.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="6" data-mx="46" data-my="58">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_6); ?>" alt="A caravan approaches a massive glowing pink salt formation at Khewra"></div>
      <div class="journey__overlay journey__overlay--warm"></div>
      <div class="journey__text text-plate" style="left:50%; bottom:12%; transform:translateX(-50%); text-align:center;">
        <span class="eyebrow">KHEWRA</span>
        <h2>The Reserve</h2>
        <p>A formation unlike anything seen before, waiting beneath the dust.</p>
      </div>
    </div>

    <div class="journey__slide" data-index="7" data-mx="50" data-my="50">
      <div class="journey__bg"><img src="<?php echo esc_url($journey_frame_7); ?>" alt="A glowing burst of pink salt crystal, the moment of discovery"></div>
      <div class="journey__overlay journey__overlay--discovery"></div>
      <div class="journey__text text-plate" style="left:50%; top:50%; transform:translate(-50%,-50%); text-align:center;">
        <div class="badge">
          <img src="<?php echo esc_url($nav_logo); ?>" alt="Alexander's emblem">
          <span>Guardian Since 326 BC</span>
        </div>
        <span class="eyebrow" data-acf="discovery_eyebrow">THE DISCOVERY</span>
        <h2 data-acf="discovery_headline">Purity, Found</h2>
        <p data-acf="discovery_subcopy">A horse knelt to drink and licked the stone beneath it. Alexander's has guarded this reserve ever since.</p>
      </div>
    </div>

    <svg class="journey__route" id="journeyRoute" viewBox="0 0 100 100" preserveAspectRatio="none">
      <path id="routePath" fill="none" stroke="var(--bronze)" stroke-width="0.3" stroke-linecap="round"></path>
    </svg>
    <div class="journey__marker" id="journeyMarker">&#9673;</div>

    <div class="journey__progress" id="journeyDots"></div>
    <button class="journey__arrow journey__arrow--up" id="journeyPrev" aria-label="Previous location">&#8593;</button>
    <button class="journey__arrow journey__arrow--down" id="journeyNext" aria-label="Next location">&#8595;</button>

    <div class="journey__scrollcue" id="scrollCue">
      <span>Scroll to begin the campaign</span>
      <span class="line"></span>
    </div>
  </div>
</section>

<noscript>
  <div style="padding:120px 20px; text-align:center; background:#120c1a;">
    <p style="font-family:'Space Mono',monospace; letter-spacing:0.15em; text-transform:uppercase; color:#c9a15a; font-size:12px;">326 BC &middot; Khewra, The Himalayas</p>
    <h1 style="font-family:'Cinzel',serif; text-transform:uppercase; color:#f3ead9; font-size:36px; margin-top:16px;">The Salt That Conquered Time</h1>
  </div>
</noscript>

<!-- ============================================================
     STATS
     ============================================================ -->
<section class="stats">
  <div class="wrap stats__grid">
    <div class="stat">
      <div class="stat__num">500+</div>
      <div class="stat__label">Tons Exported Monthly</div>
    </div>
    <div class="stat">
      <div class="stat__num">100%</div>
      <div class="stat__label">Additive-Free &amp; Halal Certified</div>
    </div>
    <div class="stat">
      <div class="stat__num">84+</div>
      <div class="stat__label">Trace Minerals Preserved</div>
    </div>
    <div class="stat">
      <div class="stat__num">2,000+</div>
      <div class="stat__label">Years Since Discovery</div>
    </div>
  </div>
</section>

<!-- ============================================================
     PROCESS
     ============================================================ -->
<section class="process" id="story">
  <div class="wrap">
    <div class="process__head">
      <span class="eyebrow">What We Do</span>
      <h2 class="section-title" style="margin-top:14px;">The Value Is Our <span class="accent">Process</span></h2>
      <p>Most commercial salt is blasted with explosives, bleached, then cut with anti-caking agents. We do not. Every crystal that leaves Khewra passes through four stages, and not one of them touches a chemical.</p>
    </div>
    <div class="process__grid">
      <div class="process__step reveal">
        <div class="num">01</div>
        <h3>Ethical Extraction</h3>
        <p>Hand-mined by skilled workers at fair wages, no explosives, no mechanized blasting.</p>
      </div>
      <div class="process__step reveal">
        <div class="num">02</div>
        <h3>The Purification Wash</h3>
        <p>Rinsed in natural spring water to clear surface sediment before any processing begins.</p>
      </div>
      <div class="process__step reveal">
        <div class="num">03</div>
        <h3>Precision Crafting</h3>
        <p>Ground to exact specification, from micro-fine powder to coarse culinary crystals.</p>
      </div>
      <div class="process__step reveal">
        <div class="num">04</div>
        <h3>The Purity Seal</h3>
        <p>Optical color sorting, metal detection, then a hermetic seal before it ever leaves the facility.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     PRODUCTS
     ============================================================ -->
<section class="products" id="products">
  <div class="wrap">
    <div class="products__head">
      <div>
        <span class="eyebrow">The Collection</span>
        <h2 class="section-title" style="margin-top:14px;">Eight Categories.<br>One <span class="accent">Reserve</span>.</h2>
      </div>
      <a href="contact.html" class="btn">Request A Quote</a>
    </div>
    <div class="products__grid">
      <div class="product-card reveal"><div class="product-card__tag">Culinary</div><h3>Fine Grain Salt</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Culinary</div><h3>Coarse Grain Salt</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Culinary</div><h3>Cooking Bricks</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Decor</div><h3>Crafted Lamps</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Decor</div><h3>Natural Lamps</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Wellness</div><h3>Bath Salt / Detox</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Agriculture</div><h3>Animal Licks</h3></div>
      <div class="product-card reveal"><div class="product-card__tag">Export</div><h3>Wholesale Bulk</h3></div>
    </div>
  </div>
</section>

<!-- ============================================================
     CERTIFICATIONS
     ============================================================ -->
<section class="certs" id="certifications">
  <div class="wrap">
    <span class="eyebrow">Trust, Verified</span>
    <h2 class="section-title" style="margin-top:14px;">Certified At Every <span class="accent">Stage</span></h2>
    <div class="certs__grid">
      <span class="cert-chip">FDA Registered</span>
      <span class="cert-chip">Halal Certified</span>
      <span class="cert-chip">ISO 9001</span>
      <span class="cert-chip">HACCP Compliant</span>
      <span class="cert-chip">Kosher Certified</span>
      <span class="cert-chip">Third-Party Lab Verified</span>
    </div>
  </div>
</section>

<!-- ============================================================
     CTA BAND
     ============================================================ -->
<section class="cta-band">
  <div class="wrap">
    <span class="eyebrow">Wholesale &amp; Bulk Export</span>
    <h2 class="section-title" style="margin-top:14px;">Ready To Stock The World's Finest <span class="accent">Pink Salt</span>?</h2>
    <p>Low minimum order quantities, FCL and LCL container logistics, and dedicated support for retailers and importers across the US and Europe.</p>
    <div class="cta-band__actions">
      <a href="contact.html" class="btn btn--ember">Request A Quote</a>
      <a href="certifications.html" class="btn">View Certifications</a>
    </div>
  </div>
</section>

<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer class="site-footer" id="contact">
  <div class="wrap footer__grid">
    <div>
      <div class="footer__brand">Alexander's</div>
      <p class="footer__tagline">Guardians of the ancient reserves. Purity preserved, from the Khewra mines to your table.</p>
    </div>
    <div>
      <div class="footer__heading">Navigate</div>
      <div class="footer__links">
        <a href="index.html">Home</a>
        <a href="about.html">Our Story</a>
        <a href="products.html">Products</a>
        <a href="certifications.html">Certifications</a>
      </div>
    </div>
    <div>
      <div class="footer__heading">Contact</div>
      <div class="footer__contact">
        <a href="tel:+923005348542">+92 300 5348542</a>
        <a href="mailto:support@alexandersalts.com">support@alexandersalts.com</a>
        <span>104 Jennifer Ln, Stafford, VA 22554</span>
      </div>
    </div>
  </div>
  <div class="wrap footer__bottom">
    <span>&copy; 2026 Alexander's. All rights reserved.</span>
    <span>Khewra Salt Mines, Pakistan</span>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js"></script>
<script>
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

</script>
