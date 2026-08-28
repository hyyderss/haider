<?php
/**
 * Alexander's certificate password gate, WPCode PHP snippet.
 *
 * This is the REAL security. The client-side "Unlock" form on
 * certifications.html cannot be trusted on its own, any password
 * check written in JavaScript is visible to anyone who views the
 * page source. This snippet checks the password on the server and
 * streams the PDF bytes back directly, the certificate files are
 * never sitting at a public, guessable URL that could be shared
 * or found without the password at all.
 *
 * SETUP:
 * 1. Pick a password and set ALEXANDERS_CERT_PASSWORD below.
 * 2. Via cPanel File Manager, create a folder OUTSIDE the public
 *    web root if your hosting allows it, or if not, directly
 *    under wp-content (NOT wp-content/uploads, which is usually
 *    fully public): wp-content/alexanders-private-certs/
 * 3. Inside that folder, add a file named exactly "index.php"
 *    containing only "<?php // silence" and, if your host
 *    supports .htaccess, also add a ".htaccess" file containing
 *    "Deny from all" (Apache 2.2) or "Require all denied"
 *    (Apache 2.4). This blocks direct access even if someone
 *    guesses the folder path, the password check below is what
 *    actually protects the files but this is good defense in
 *    depth and costs nothing to add.
 * 4. Upload your real certificate PDFs into that folder with
 *    filenames matching the $certFiles map below (or edit the
 *    map to match whatever you name them).
 * 5. WPCode > Add Snippet > Add Your Custom Code, paste this
 *    entire file, Code Type "PHP Snippet", Insertion "Run
 *    Everywhere" (this only registers hooks, it does not print
 *    anything, so it is not a shortcode). Save and activate.
 */

if (!defined('ALEXANDERS_CERT_PASSWORD')) {
    define('ALEXANDERS_CERT_PASSWORD', 'change-this-password');
}

if (!defined('ALEXANDERS_CERT_PRIVATE_DIR')) {
    define('ALEXANDERS_CERT_PRIVATE_DIR', WP_CONTENT_DIR . '/alexanders-private-certs/');
}

add_action('admin_post_alexanders_cert_auth', 'alexanders_handle_cert_auth');
add_action('admin_post_nopriv_alexanders_cert_auth', 'alexanders_handle_cert_auth');

function alexanders_handle_cert_auth() {
    $certFiles = array(
        'fda-registration'      => 'fda-registration.pdf',
        'halal-certification'   => 'halal-certification.pdf',
        'iso-9001'               => 'iso-9001.pdf',
        'haccp'                  => 'haccp.pdf',
        'kosher-certification'  => 'kosher-certification.pdf',
        'lab-analysis'           => 'lab-analysis.pdf',
    );

    $certId   = isset($_POST['cert_id']) ? sanitize_text_field($_POST['cert_id']) : '';
    $password = isset($_POST['password']) ? (string) $_POST['password'] : '';

    if (!hash_equals(ALEXANDERS_CERT_PASSWORD, $password)) {
        status_header(403);
        exit;
    }

    if (!isset($certFiles[$certId])) {
        status_header(404);
        exit;
    }

    $path = ALEXANDERS_CERT_PRIVATE_DIR . $certFiles[$certId];
    if (!file_exists($path)) {
        status_header(404);
        exit;
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($path) . '"');
    header('Content-Length: ' . filesize($path));
    header('Cache-Control: private, no-store');
    readfile($path);
    exit;
}
