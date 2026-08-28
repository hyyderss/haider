<?php
/**
 * Alexander's contact form handler, WPCode PHP snippet.
 *
 * SETUP:
 * 1. WPCode > Add Snippet > Add Your Custom Code.
 * 2. Paste this entire file, set Code Type to "PHP Snippet".
 * 3. Insertion: "Run Everywhere" (this registers WordPress hooks,
 *    it does not print anything itself, so it is not a shortcode).
 * 4. Save and activate.
 *
 * This handles POSTs from contact.html's form (action="/wp-admin/
 * admin-post.php", hidden field action=alexanders_contact), emails
 * the submission to support@alexandersalts.com via wp_mail(), and
 * returns a plain success/failure response since the form submits
 * via fetch() rather than a full page reload.
 *
 * wp_mail() delivery depends on your Bluehost mail setup. If
 * inquiries are not arriving, install a free SMTP plugin (WP Mail
 * SMTP) and connect it to a real mailbox, PHP's default mail() is
 * unreliable on shared hosting and often lands in spam or nowhere.
 */

add_action('admin_post_alexanders_contact', 'alexanders_handle_contact_form');
add_action('admin_post_nopriv_alexanders_contact', 'alexanders_handle_contact_form');

function alexanders_handle_contact_form() {
    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $scope   = isset($_POST['scope']) ? sanitize_text_field($_POST['scope']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($message) || !is_email($email)) {
        status_header(400);
        wp_send_json_error(array('message' => 'Missing or invalid required fields.'));
    }

    $to      = 'support@alexandersalts.com';
    $subject = 'New Inquiry: ' . ($scope ? $scope : 'General') . ' from ' . $name;
    $body    = "Name: {$name}\n" .
               "Email: {$email}\n" .
               "Phone: {$phone}\n" .
               "Project Scope: {$scope}\n\n" .
               "Message:\n{$message}";
    $headers = array('Reply-To: ' . $name . ' <' . $email . '>');

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => 'Message sent.'));
    } else {
        status_header(500);
        wp_send_json_error(array('message' => 'Mail could not be sent, check SMTP configuration.'));
    }
}
