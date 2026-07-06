<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Sends a notification email when a new contact form enquiry is received.
 */
function sendEnquiryEmail($name, $email, $company, $phone, $country, $service, $budget, $message) {
    $smtp_host = getSetting('smtp_host', 'smtp.gmail.com');
    $smtp_port = getSetting('smtp_port', '587');
    $smtp_user = getSetting('smtp_user');
    $smtp_pass = getSetting('smtp_pass');
    $smtp_secure = getSetting('smtp_secure', 'tls');
    $smtp_from_name = getSetting('smtp_from_name', 'Advert Resource Ltd');
    $to_email = getSetting('email1', 'info@advertresources.com'); // Admin email to receive notifications

    // If SMTP credentials are not yet configured in the admin panel, skip sending
    if (empty($smtp_user) || empty($smtp_pass)) {
        error_log("SMTP credentials are not configured in settings. Email notification skipped.");
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_user;
        $mail->Password   = $smtp_pass;
        $mail->SMTPSecure = ($smtp_secure === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int)$smtp_port;

        // Recipients
        $mail->setFrom($smtp_user, $smtp_from_name);
        $mail->addAddress($to_email);
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Cyber Command Enquiry: " . $name;
        
        $bodyHtml = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
            <h2 style='color: #E0009B; border-bottom: 2px solid #E0009B; padding-bottom: 8px;'>New Contact Form Submission</h2>
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></p>
            <p><strong>Company:</strong> " . htmlspecialchars($company ?: 'Individual / Non-corporate') . "</p>
            <p><strong>Phone:</strong> " . htmlspecialchars($phone ?: 'Not supplied') . "</p>
            <p><strong>Country:</strong> " . htmlspecialchars($country ?: 'Not specified') . "</p>
            <p><strong>Service Requested:</strong> " . htmlspecialchars($service ?: 'General Enquiry') . "</p>
            <p><strong>Project Budget:</strong> " . htmlspecialchars($budget ?: 'Not declared') . "</p>
            <div style='background: #f9f9f9; border-left: 4px solid #3C72FC; padding: 12px; margin-top: 15px;'>
                <strong>Message:</strong><br>
                " . nl2br(htmlspecialchars($message)) . "
            </div>
            <p style='font-size: 0.8rem; color: #666; margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;'>
                This is an automated security transmission notification from the Advert Resource Ltd portal.
            </p>
        </div>
        ";

        $mail->Body    = $bodyHtml;
        $mail->AltBody = strip_tags($bodyHtml);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("SMTP Mail send failed. PHPMailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
