<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Sends a notification email when a new contact form enquiry is received.
 */
function sendEnquiryEmail($name, $email, $company, $phone, $country, $service, $budget, $message) {
    $smtp_host      = getSetting('smtp_host', 'smtp.gmail.com');
    $smtp_port      = getSetting('smtp_port', '587');
    $smtp_user      = getSetting('smtp_user');
    $smtp_pass      = getSetting('smtp_pass');
    $smtp_secure    = getSetting('smtp_secure', 'tls');
    $smtp_from_name = getSetting('smtp_from_name', 'Advert Resource Ltd');
    $to_email       = getSetting('email1', '');

    if (empty($smtp_user) || empty($smtp_pass)) {
        error_log("SMTP credentials are not configured in settings. Email notification skipped.");
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_user;
        $mail->Password   = $smtp_pass;
        $mail->SMTPSecure = ($smtp_secure === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int)$smtp_port;
        $mail->CharSet    = 'UTF-8';
        $mail->XMailer    = ' ';

        $mail->setFrom($smtp_user, $smtp_from_name);
        $mail->addAddress($to_email);
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Enquiry from " . $name . " via Advert Resource Ltd";

        $bodyHtml = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #ffffff;'>
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
                This notification was sent from the Advert Resource Ltd website contact form.
            </p>
        </div>";

        $mail->Body    = $bodyHtml;
        $mail->AltBody = strip_tags($bodyHtml);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("SMTP Mail send failed. PHPMailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Sends a two-step verification email with a one-time sign-in code.
 * Designed to pass spam filters with clean plain HTML.
 */
function sendMfaOtpEmail($to_email, $otp_code) {
    $smtp_host      = getSetting('smtp_host', 'smtp.gmail.com');
    $smtp_port      = getSetting('smtp_port', '587');
    $smtp_user      = getSetting('smtp_user');
    $smtp_pass      = getSetting('smtp_pass');
    $smtp_secure    = getSetting('smtp_secure', 'tls');
    $smtp_from_name = getSetting('smtp_from_name', 'Advert Resource Ltd');

    if (empty($smtp_user) || empty($smtp_pass)) {
        return 'SMTP credentials are not configured. Please fill in SMTP Host, Username, and App Password in System Configuration.';
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_user;
        $mail->Password   = $smtp_pass;
        $mail->SMTPSecure = ($smtp_secure === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int)$smtp_port;
        $mail->CharSet    = 'UTF-8';
        $mail->XMailer    = ' ';

        // Deliverability headers
        $mail->addCustomHeader('Precedence', 'normal');

        $mail->setFrom($smtp_user, $smtp_from_name);
        $mail->addAddress($to_email);
        $mail->addReplyTo($smtp_user, $smtp_from_name);

        $mail->isHTML(true);
        $mail->Subject = "[Advert Resource Ltd] Your one-time sign-in code";

        $year     = date('Y');
        $bodyHtml = "<!DOCTYPE html>
<html lang='en'>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Sign-in Code</title></head>
<body style='margin:0; padding:0; background-color:#f4f6f9; font-family: Arial, Helvetica, sans-serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#f4f6f9; padding:40px 20px;'>
    <tr><td align='center'>
      <table width='100%' cellpadding='0' cellspacing='0' style='max-width:560px; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);'>

        <!-- Header -->
        <tr>
          <td style='background-color:#1e3a5f; padding:28px 32px; text-align:center;'>
            <h1 style='margin:0; color:#ffffff; font-size:20px; font-weight:700; letter-spacing:0.5px;'>Advert Resource Ltd</h1>
            <p style='margin:6px 0 0; color:#93bbdc; font-size:13px;'>Admin Panel — Identity Verification</p>
          </td>
        </tr>

        <!-- Body -->
        <tr>
          <td style='padding:36px 32px;'>
            <p style='margin:0 0 16px; font-size:15px; color:#374151; line-height:1.6;'>Hello,</p>
            <p style='margin:0 0 24px; font-size:15px; color:#374151; line-height:1.6;'>
              A sign-in attempt was made on your Admin Panel. Use the code below to complete the process.
            </p>

            <!-- OTP Box -->
            <table width='100%' cellpadding='0' cellspacing='0'>
              <tr><td align='center' style='padding:8px 0 28px;'>
                <table cellpadding='0' cellspacing='0'>
                  <tr>
                    <td style='background-color:#f0f4ff; border:2px solid #3b82f6; border-radius:8px; padding:20px 36px; text-align:center;'>
                      <span style='font-family: Courier New, monospace; font-size:36px; font-weight:700; color:#1e3a5f; letter-spacing:10px;'>" . htmlspecialchars($otp_code) . "</span>
                    </td>
                  </tr>
                </table>
              </td></tr>
            </table>

            <p style='margin:0 0 12px; font-size:14px; color:#6b7280; line-height:1.6;'>
              This code is valid for <strong>5 minutes</strong> and can only be used once.
            </p>
            <p style='margin:0 0 24px; font-size:14px; color:#6b7280; line-height:1.6;'>
              If you did not make this request, please change your password immediately.
            </p>

            <hr style='border:none; border-top:1px solid #e5e7eb; margin:24px 0;'>
            <p style='margin:0; font-size:13px; color:#9ca3af;'>
              Please do not share this code with anyone.
            </p>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style='background-color:#f9fafb; padding:20px 32px; text-align:center; border-top:1px solid #e5e7eb;'>
            <p style='margin:0; font-size:12px; color:#9ca3af;'>
              &copy; {$year} Advert Resource Ltd &nbsp;|&nbsp; Admin Panel Notification
            </p>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>";

        $mail->Body    = $bodyHtml;
        $mail->AltBody = "Your Advert Resource Ltd admin panel sign-in code is: " . $otp_code
            . "\n\nThis code is valid for 5 minutes."
            . "\n\nIf you did not make this request, please change your password immediately.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        $err = $mail->ErrorInfo ?: $e->getMessage();
        error_log("Verification code email failed. PHPMailer Error: {$err}");
        return $err; // return actual error so caller can display it
    }
}
