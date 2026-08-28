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
 * 6. Once via cPanel File Manager you have uploaded the images from
 *    assets/images/ into wp-content/uploads/alexanders-assets/images/,
 *    update ALEXANDERS_FALLBACK_BASE below to match that URL. These
 *    become the images shown until you replace them in step 7.
 * 7. TO SWAP IN BETTER QUALITY IMAGES LATER: open the Home page in
 *    WordPress, scroll down to the "Homepage Media" box added by ACF,
 *    click each image field, upload the new file, click Update. No
 *    code changes, no re-pasting this snippet. The hero currently has
 *    4 beats (establish, conquest wide, conquest close, return), each
 *    with its own field except "return" which reuses the establish
 *    image on purpose. Add more beats later by adding another
 *    .cinema__frame in the markup below plus one row in the "frames"
 *    array inside the <script>, no other engine change needed.
 * 8. IMPORTANT: this markup links to about.html, products.html,
 *    certifications.html, contact.html directly. Once those exist
 *    as real WordPress pages, either name their slugs to match
 *    (Settings > Permalinks, page slug = "about", "products", etc.)
 *    or replace these hrefs with the real page URLs from wp-admin.
 */

if (!defined('ALEXANDERS_FALLBACK_BASE')) {
    define('ALEXANDERS_FALLBACK_BASE', 'https://alexanderssalt.com/wp-content/uploads/alexanders-assets/images/');
}

$nav_logo            = function_exists('get_field') ? get_field('nav_logo') : '';
$hero_establish       = function_exists('get_field') ? get_field('hero_frame_establish') : '';
$hero_conquest        = function_exists('get_field') ? get_field('hero_frame_conquest') : '';
$hero_conquest_close  = function_exists('get_field') ? get_field('hero_frame_conquest_close') : '';

if (empty($nav_logo))           { $nav_logo           = ALEXANDERS_FALLBACK_BASE . 'mascot-turnaround.jpeg'; }
if (empty($hero_establish))     { $hero_establish     = ALEXANDERS_FALLBACK_BASE . 'hero-establishing.jpeg'; }
if (empty($hero_conquest))      { $hero_conquest      = ALEXANDERS_FALLBACK_BASE . 'hero-conquest.jpeg'; }
if (empty($hero_conquest_close)){ $hero_conquest_close= ALEXANDERS_FALLBACK_BASE . 'hero-conquest-closeup.jpeg'; }

$mascot_badge = ALEXANDERS_FALLBACK_BASE . 'mascot-front-crop.jpeg';
?>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700;900&family=Instrument+Serif:ital@1&family=Work+Sans:wght@400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

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

  --font-display: 'Unbounded', sans-serif;
  --font-accent: 'Instrument Serif', serif;
  --font-body: 'Work Sans', sans-serif;
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
  font-size: 16px;
  line-height: 1.6;
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
  text-transform: uppercase;
  font-size: clamp(28px, 4vw, 48px);
  line-height: 1.15;
  color: var(--parchment);
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
   CINEMATIC SCROLL-SCRUB HERO
   ============================================================ */
.cinema {
  position: relative;
  height: 800vh; /* scroll distance that drives the scrub, tune freely */
}

.cinema__stage {
  position: sticky;
  top: 0;
  height: 100vh;
  width: 100%;
  overflow: hidden;
  background: var(--void);
}

/* frame layers stack and crossfade via opacity driven by JS */
.cinema__frame {
  position: absolute;
  inset: 0;
  opacity: 0;
  will-change: opacity, transform;
}
.cinema__frame img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 40%;
  transform: scale(1.06);
  will-change: transform;
}

.cinema__scrim {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(18,12,26,0.55) 0%, rgba(18,12,26,0.05) 30%, rgba(18,12,26,0.15) 60%, rgba(18,12,26,0.85) 100%);
  pointer-events: none;
}

.cinema__colorgrade {
  position: absolute;
  inset: 0;
  mix-blend-mode: overlay;
  opacity: 0;
  background: radial-gradient(circle at 50% 55%, rgba(232,166,142,0.55), rgba(201,161,90,0.25) 45%, transparent 75%);
  pointer-events: none;
  will-change: opacity;
}

/* text plate: a real backdrop behind cinema text so it reads over any
   image, bright or dark, rather than relying on the page-wide scrim */
.text-plate {
  display: inline-block;
  max-width: 720px;
  padding: 36px clamp(24px, 5vw, 56px);
  background: rgba(9, 6, 13, 0.62);
  backdrop-filter: blur(14px) saturate(1.1);
  -webkit-backdrop-filter: blur(14px) saturate(1.1);
  border: 1px solid rgba(201, 161, 90, 0.28);
  border-radius: 4px;
}

/* opening text */
.cinema__intro {
  position: absolute;
  left: 0; right: 0;
  bottom: 12vh;
  text-align: center;
  padding: 0 var(--edge);
  will-change: opacity, transform;
}
.cinema__intro .eyebrow { display: block; margin-bottom: 20px; }
.cinema__intro h1 {
  font-family: var(--font-display);
  font-weight: 900;
  text-transform: uppercase;
  font-size: clamp(34px, 6.4vw, 82px);
  line-height: 1.02;
  letter-spacing: -0.01em;
  color: var(--parchment);
}
.cinema__intro p {
  max-width: 520px;
  margin: 22px auto 0;
  color: var(--parchment-dim);
  font-size: 15px;
  font-weight: 500;
}

.cinema__scrollcue {
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
  opacity: 1;
  transition: opacity 0.4s ease;
}
.cinema__scrollcue .line {
  width: 1px;
  height: 34px;
  background: linear-gradient(180deg, var(--bronze), transparent);
  animation: cue-drop 1.8s ease-in-out infinite;
}
@keyframes cue-drop {
  0% { transform: scaleY(0.3); opacity: 0.3; }
  50% { transform: scaleY(1); opacity: 1; }
  100% { transform: scaleY(0.3); opacity: 0.3; }
}

/* region callout cards */
.cinema__callouts { position: absolute; inset: 0; pointer-events: none; }
.callout {
  position: absolute;
  width: min(300px, 78vw);
  padding: 22px 24px;
  background: rgba(29, 20, 40, 0.72);
  border: 1px solid rgba(201, 161, 90, 0.4);
  border-radius: 3px;
  backdrop-filter: blur(6px);
  opacity: 0;
  transform: translateY(24px) scale(0.96);
  transition: none; /* driven by JS via opacity/transform for scrub-accuracy */
}
.callout__year { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.15em; color: var(--ember); }
.callout__place {
  font-family: var(--font-display);
  text-transform: uppercase;
  font-size: 22px;
  margin: 8px 0 6px;
  color: var(--parchment);
}
.callout__desc { font-size: 13px; color: var(--parchment-dim); }
.callout--macedon { top: 22%; left: 8%; }
.callout--persia { top: 60%; right: 8%; }
.callout--bactria { top: 24%; right: 10%; }

/* discovery reveal */
.cinema__discovery {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
  opacity: 0;
  pointer-events: none;
  padding: 0 20px;
}
.cinema__discovery .badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 22px;
  padding: 6px 14px 6px 6px;
  border: 1px solid rgba(201,161,90,0.4);
  border-radius: 999px;
  background: rgba(9,6,13,0.5);
}
.cinema__discovery .badge img { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; object-position: top; }
.cinema__discovery .badge span {
  font-family: var(--font-mono);
  font-size: 10px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--parchment-dim);
}
.cinema__discovery .eyebrow { display: block; margin-bottom: 18px; }
.cinema__discovery h2 {
  font-family: var(--font-display);
  font-weight: 900;
  text-transform: uppercase;
  font-size: clamp(40px, 9vw, 108px);
  line-height: 0.98;
  letter-spacing: -0.01em;
  color: var(--parchment);
}
.cinema__discovery p {
  margin-top: 24px;
  max-width: 480px;
  color: var(--parchment-dim);
  font-size: 15px;
  font-weight: 500;
}

/* decorative side borders ("tweed") during the cinematic section */
.cinema__edge {
  position: absolute;
  top: 0; bottom: 0;
  width: clamp(28px, 4vw, 64px);
  background-repeat: repeat-y;
  background-size: 100% auto;
  opacity: 0.5;
  pointer-events: none;
  will-change: background-position;
}
.cinema__edge--left {
  left: 0;
  background-image: repeating-linear-gradient(
    180deg,
    transparent 0, transparent 26px,
    rgba(201,161,90,0.55) 26px, rgba(201,161,90,0.55) 28px
  );
  mask-image: linear-gradient(90deg, black 0%, transparent 100%);
}
.cinema__edge--right {
  right: 0;
  background-image: repeating-linear-gradient(
    180deg,
    transparent 0, transparent 26px,
    rgba(201,161,90,0.55) 26px, rgba(201,161,90,0.55) 28px
  );
  mask-image: linear-gradient(270deg, black 0%, transparent 100%);
}
/* NOTE: this is a deliberately simple placeholder texture.
   Swap the background-image for a tiled AI-generated ornamental
   asset (rope, laurel, engraved column motif) once available,
   this hook is already wired to the same parallax driver. */

.no-js .cinema { height: auto; }
.no-js .cinema__stage { position: relative; height: 90vh; }
.no-js .cinema__callouts, .no-js .cinema__discovery { display: none; }

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
   CONTACT PAGE
   ============================================================ */
.contact-section { padding: 0 0 120px; background: var(--void); }
.contact-grid {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: 60px;
}
.contact-info__item { padding: 22px 0; border-top: 1px solid rgba(201,161,90,0.15); }
.contact-info__item:last-child { border-bottom: 1px solid rgba(201,161,90,0.15); }
.contact-info__label { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--bronze); }
.contact-info__value { margin-top: 8px; font-size: 15px; }

.form-field { margin-bottom: 20px; }
.form-field label {
  display: block;
  font-family: var(--font-mono);
  font-size: 11px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--parchment-dim);
  margin-bottom: 8px;
}
.form-field input,
.form-field select,
.form-field textarea {
  width: 100%;
  background: var(--stone-2);
  border: 1px solid rgba(201,161,90,0.3);
  border-radius: 3px;
  padding: 13px 14px;
  color: var(--parchment);
  font-family: var(--font-body);
  font-size: 14px;
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
     CINEMATIC SCROLL-SCRUB HERO
     data-acf hooks mark the text a future ACF field group should
     expose in wp-admin, wire these once the WordPress side is set up.
     ============================================================ -->
<a id="top"></a>
<section class="cinema" id="cinema" aria-label="Alexander's origin story, scroll to progress">

  <div class="cinema__stage">

    <div class="cinema__edge cinema__edge--left" id="edgeLeft"></div>
    <div class="cinema__edge cinema__edge--right" id="edgeRight"></div>

    <!-- beat 1: establishing shot, slow zoom-in -->
    <div class="cinema__frame" id="frameEstablish" style="opacity:1;">
      <img src="<?php echo esc_url($hero_establish); ?>" alt="Alexander on horseback overlooking the Himalayan mountain range at dusk">
    </div>

    <!-- beat 2: conquest, wide, pans left to right with the charge -->
    <div class="cinema__frame" id="frameConquestWide">
      <img src="<?php echo esc_url($hero_conquest); ?>" alt="Alexander charging through a conquered fortress gate">
    </div>

    <!-- beat 3: conquest, tight on Alexander, pans top to bottom -->
    <div class="cinema__frame" id="frameConquestClose">
      <img src="<?php echo esc_url($hero_conquest_close); ?>" alt="Close on Alexander raising his sword mid-charge">
    </div>

    <!-- beat 4: return to the Himalayas, warm graded, pans bottom to top -->
    <div class="cinema__frame" id="frameReturn">
      <img src="<?php echo esc_url($hero_establish); ?>" alt="Returning to the Himalayan ridge at dusk">
    </div>

    <div class="cinema__scrim"></div>
    <div class="cinema__colorgrade" id="colorgrade"></div>

    <!-- opening headline, fades out as scrub begins -->
    <div class="cinema__intro" id="cinemaIntro">
      <div class="text-plate">
        <span class="eyebrow" data-acf="hero_eyebrow">326 BC &middot; KHEWRA, THE HIMALAYAS</span>
        <h1 data-acf="hero_headline">The Salt That <span class="accent">Conquered</span> Time</h1>
        <p data-acf="hero_subcopy">A warhorse once knelt on this ridge and licked a rock that glowed pink beneath the dusk. Two thousand years later, we are still its guardians.</p>
      </div>
    </div>

    <div class="cinema__scrollcue" id="scrollCue">
      <span>Scroll to begin the campaign</span>
      <span class="line"></span>
    </div>

    <!-- region callouts, fired by scroll progress -->
    <div class="cinema__callouts">
      <div class="callout callout--macedon" id="calloutMacedon">
        <div class="callout__year">334 BC</div>
        <div class="callout__place">Macedon</div>
        <div class="callout__desc">The campaign begins. The army marches east from the Macedonian court.</div>
      </div>
      <div class="callout callout--persia" id="calloutPersia">
        <div class="callout__year">331 BC</div>
        <div class="callout__place">Persia</div>
        <div class="callout__desc">The Achaemenid Empire falls. The known world's borders are redrawn.</div>
      </div>
      <div class="callout callout--bactria" id="calloutBactria">
        <div class="callout__year">329 BC</div>
        <div class="callout__place">Bactria</div>
        <div class="callout__desc">The eastern frontier holds. The mountains of the Himalayas come into view.</div>
      </div>
    </div>

    <!-- final discovery reveal -->
    <div class="cinema__discovery" id="cinemaDiscovery">
      <div class="badge">
        <img src="<?php echo esc_url($mascot_badge); ?>" alt="Alexander's emblem">
        <span>Guardian Since 326 BC</span>
      </div>
      <span class="eyebrow" data-acf="discovery_eyebrow">326 BC &middot; KHEWRA</span>
      <h2 data-acf="discovery_headline">The Discovery</h2>
      <p data-acf="discovery_subcopy">A horse knelt to drink, licked the stone beneath it, and revealed a reserve of pink salt formed over millions of years. Alexander's has been its guardian ever since.</p>
    </div>

  </div>
</section>

<noscript>
  <div style="padding:120px 20px; text-align:center; background:#120c1a;">
    <p style="font-family:'Space Mono',monospace; letter-spacing:0.15em; text-transform:uppercase; color:#c9a15a; font-size:12px;">326 BC &middot; Khewra, The Himalayas</p>
    <h1 style="font-family:'Unbounded',sans-serif; text-transform:uppercase; color:#f3ead9; font-size:36px; margin-top:16px;">The Salt That Conquered Time</h1>
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
      <div class="process__step">
        <div class="num">01</div>
        <h3>Ethical Extraction</h3>
        <p>Hand-mined by skilled workers at fair wages, no explosives, no mechanized blasting.</p>
      </div>
      <div class="process__step">
        <div class="num">02</div>
        <h3>The Purification Wash</h3>
        <p>Rinsed in natural spring water to clear surface sediment before any processing begins.</p>
      </div>
      <div class="process__step">
        <div class="num">03</div>
        <h3>Precision Crafting</h3>
        <p>Ground to exact specification, from micro-fine powder to coarse culinary crystals.</p>
      </div>
      <div class="process__step">
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
      <div class="product-card"><div class="product-card__tag">Culinary</div><h3>Fine Grain Salt</h3></div>
      <div class="product-card"><div class="product-card__tag">Culinary</div><h3>Coarse Grain Salt</h3></div>
      <div class="product-card"><div class="product-card__tag">Culinary</div><h3>Cooking Bricks</h3></div>
      <div class="product-card"><div class="product-card__tag">Decor</div><h3>Crafted Lamps</h3></div>
      <div class="product-card"><div class="product-card__tag">Decor</div><h3>Natural Lamps</h3></div>
      <div class="product-card"><div class="product-card__tag">Wellness</div><h3>Bath Salt / Detox</h3></div>
      <div class="product-card"><div class="product-card__tag">Agriculture</div><h3>Animal Licks</h3></div>
      <div class="product-card"><div class="product-card__tag">Export</div><h3>Wholesale Bulk</h3></div>
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


<script>
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

</script>
