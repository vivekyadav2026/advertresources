<?php
session_start();
require_once '../db.php';
require_once '../mail-helper.php';

// If no pending MFA, bounce to login
if (!isset($_SESSION['mfa_pending_username'])) {
    header("Location: login.php");
    exit;
}

$error = "";
$success = "";
$mfa_email = getSetting('mfa_email', '');

// Handle Resend Code Request
if (isset($_GET['resend']) && $_GET['resend'] == '1') {
    if (!empty($mfa_email)) {
        // Generate secure 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['mfa_otp'] = $otp;
        $_SESSION['mfa_otp_expiry'] = time() + 300; // valid for 5 min
        
        if (sendMfaOtpEmail($mfa_email, $otp)) {
            $success = "Verification code has been resent to your email.";
        } else {
            $error = "Transmission failure: Unable to send verification email.";
        }
    } else {
        $error = "MFA email configuration is missing.";
    }
}

// Handle OTP Verification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = trim($_POST['otp_code'] ?? '');

    if (empty($entered_otp)) {
        $error = "Please enter the 6-digit authorization code.";
    } elseif (!isset($_SESSION['mfa_otp']) || !isset($_SESSION['mfa_otp_expiry'])) {
        $error = "Session expired. Please log in again.";
    } elseif (time() > $_SESSION['mfa_otp_expiry']) {
        $error = "Verification code has expired. Please click 'Resend Code'.";
    } elseif ($entered_otp != $_SESSION['mfa_otp']) {
        $error = "Access Denied: Invalid authentication code.";
    } else {
        // Verification Successful!
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $_SESSION['mfa_pending_username'];

        // Clean up MFA session variables
        unset($_SESSION['mfa_otp']);
        unset($_SESSION['mfa_otp_expiry']);
        unset($_SESSION['mfa_pending_username']);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Command - MFA Verification</title>
    <link rel="stylesheet" href="../index/app.min.css" />
    <link rel="stylesheet" href="../index/fontawesome.min.css" />
    <style>
        body {
            background-color: #030814;
            font-family: 'Space Grotesk', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .cyber-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(37, 99, 235, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 1;
        }
        
        .glow-orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            z-index: 1;
        }
        .glow-orb.pink {
            background: #E0009B;
            top: -100px;
            right: -100px;
        }
        .glow-orb.blue {
            background: #3C72FC;
            bottom: -100px;
            left: -100px;
        }
        
        .login-card {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(59, 130, 246, 0.25);
            border-radius: 24px;
            padding: 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8), 0 0 30px rgba(59, 130, 246, 0.1);
            backdrop-filter: blur(15px);
            z-index: 5;
            text-align: center;
        }
        
        .lock-icon {
            font-size: 3rem;
            color: #3b82f6;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.5));
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .card-title {
            color: #ffffff;
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .card-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            transition: color 0.3s;
        }
        
        .form-control {
            width: 100%;
            background: rgba(5, 11, 24, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 14px 15px 14px 45px;
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-align: center;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
        }
        
        .form-control:focus + i {
            color: #3b82f6;
        }
        
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%);
            border: none;
            color: #ffffff;
            padding: 14px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
        }
        
        .error-banner {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            color: #ef4444;
            padding: 12px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-align: left;
        }

        .success-banner {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 8px;
            color: #10b981;
            padding: 12px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-align: left;
        }

        .mfa-links {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            font-size: 0.85rem;
        }

        .mfa-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s;
        }

        .mfa-links a:hover {
            color: #3b82f6;
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow-orb pink"></div>
    <div class="glow-orb blue"></div>
    
    <div class="login-card">
        <i class="fas fa-key-skeleton lock-icon" style="font-size: 3rem; color: #3b82f6;"></i>
        <div class="card-title">MFA VERIFICATION</div>
        <div class="card-subtitle">
            Enter the 6-digit authorization code sent to:<br>
            <strong style="color: #fff;"><?= htmlspecialchars(substr($mfa_email, 0, 3) . '...' . strstr($mfa_email, '@')) ?></strong>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-banner">
                <i class="fas fa-exclamation-triangle" style="flex-shrink:0;"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-banner">
                <i class="fas fa-check-circle" style="flex-shrink:0;"></i>
                <span><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="otp_code" maxlength="6" pattern="\d{6}" class="form-control" placeholder="000000" required autocomplete="off" autofocus>
                <i class="far fa-shield-alt"></i>
            </div>
            
            <button type="submit" class="btn-submit">
                AUTHENTICATE <i class="far fa-shield-check ms-2"></i>
            </button>
        </form>

        <div class="mfa-links">
            <a href="?resend=1"><i class="fas fa-sync-alt"></i> Resend Code</a>
            <a href="login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
        </div>
    </div>
</body>
</html>
