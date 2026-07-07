<?php
// ── All PHP logic BEFORE any HTML output (PRG pattern) ──
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit;
}
require_once __DIR__ . "/../db.php";

// ── Save Settings (PRG) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    $keys = ['address', 'phone1', 'phone2', 'email1', 'email2', 'hours',
             'smtp_host', 'smtp_port', 'smtp_user', 'smtp_pass', 'smtp_secure',
             'smtp_from_name', 'mfa_enabled', 'mfa_email'];
    try {
        foreach ($keys as $key) {
            $val = isset($_POST[$key]) ? trim($_POST[$key]) : '';
            $stmt = $db->prepare("UPDATE settings SET value = :val WHERE key = :key");
            $stmt->execute([':val' => $val, ':key' => $key]);
        }
        $_SESSION['settings_success'] = "Configuration parameters updated securely.";
    } catch (Exception $e) {
        $_SESSION['settings_error'] = "Update failed: " . $e->getMessage();
    }
    header("Location: settings.php");
    exit;
}

// ── Test SMTP (PRG) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_smtp'])) {
    $test_to = trim($_POST['test_to'] ?? '');
    if (empty($test_to) || !filter_var($test_to, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['settings_error'] = "Please enter a valid email address to send the test to.";
    } else {
        require_once '../mail-helper.php';
        $result = sendMfaOtpEmail($test_to, '123456');
        if ($result === true) {
            $_SESSION['settings_success'] = "Test email sent to " . $test_to . ". Check your inbox (and spam folder).";
        } else {
            $_SESSION['settings_error'] = "SMTP Test Failed: " . $result;
        }
    }
    header("Location: settings.php");
    exit;
}

// ── Read flash messages ──
$success = '';
$error   = '';
if (!empty($_SESSION['settings_success'])) {
    $success = $_SESSION['settings_success'];
    unset($_SESSION['settings_success']);
}
if (!empty($_SESSION['settings_error'])) {
    $error = $_SESSION['settings_error'];
    unset($_SESSION['settings_error']);
}

// ── Safe to output HTML now ──
require_once 'includes/header.php';
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">System Configuration</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Manage core contact details and SMTP communication gateways.</p>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert-banner success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert-banner error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-panel" style="max-width: 1000px;">
    <form action="" method="POST">
        <input type="hidden" name="update_settings" value="1">
        
        <div class="panel-header mb-4">
            <h2 style="font-size: 1.1rem; color: #3b82f6;"><i class="far fa-address-book"></i> Public Contact Details</h2>
        </div>

        <div class="form-row mb-3">
            <div class="form-group">
                <label>Primary Business Email</label>
                <input type="text" name="email1" value="<?= htmlspecialchars(getSetting('email1')) ?>">
            </div>
            <div class="form-group">
                <label>Secondary / Support Email</label>
                <input type="text" name="email2" value="<?= htmlspecialchars(getSetting('email2')) ?>">
            </div>
        </div>
        
        <div class="form-group mb-3">
            <label>Business Address</label>
            <input type="text" name="address" value="<?= htmlspecialchars(getSetting('address')) ?>">
        </div>
        
        <div class="form-group mb-4">
            <label>Operational Hours</label>
            <input type="text" name="hours" value="<?= htmlspecialchars(getSetting('hours')) ?>">
        </div>

        <div class="panel-header mb-4 mt-5">
            <h2 style="font-size: 1.1rem; color: #3b82f6;"><i class="far fa-envelope-open-text"></i> SMTP Transport Gateway (For forms)</h2>
        </div>
        
        <div class="form-row mb-3">
            <div class="form-group">
                <label>SMTP Host</label>
                <input type="text" name="smtp_host" value="<?= htmlspecialchars(getSetting('smtp_host', 'smtp.gmail.com')) ?>">
            </div>
            <div class="form-group">
                <label>SMTP Port</label>
                <input type="text" name="smtp_port" value="<?= htmlspecialchars(getSetting('smtp_port', '587')) ?>">
            </div>
        </div>
        
        <div class="form-row mb-3">
            <div class="form-group">
                <label>SMTP Username (Email)</label>
                <input type="text" name="smtp_user" value="<?= htmlspecialchars(getSetting('smtp_user')) ?>">
            </div>
            <div class="form-group">
                <label>SMTP Password (App Password)</label>
                <input type="password" name="smtp_pass" value="<?= htmlspecialchars(getSetting('smtp_pass')) ?>">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="form-group">
                <label>SMTP Encryption</label>
                <select name="smtp_secure" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                    <option value="tls" <?= (getSetting('smtp_secure', 'tls') == 'tls') ? 'selected' : '' ?>>TLS (STARTTLS)</option>
                    <option value="ssl" <?= (getSetting('smtp_secure') == 'ssl') ? 'selected' : '' ?>>SSL (SMTPS)</option>
                </select>
            </div>
            <div class="form-group">
                <label>From Name</label>
                <input type="text" name="smtp_from_name" value="<?= htmlspecialchars(getSetting('smtp_from_name', 'Advert Resource Ltd')) ?>">
            </div>
        </div>

        <div class="panel-header mb-4 mt-5">
            <h2 style="font-size: 1.1rem; color: #3b82f6;"><i class="far fa-user-shield"></i> Multi-Factor Authentication (MFA)</h2>
        </div>

        <div class="form-row mb-4">
            <div class="form-group">
                <label>MFA Status</label>
                <select name="mfa_enabled" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                    <option value="0" <?= (getSetting('mfa_enabled') == '0') ? 'selected' : '' ?>>Disabled (Password Only)</option>
                    <option value="1" <?= (getSetting('mfa_enabled') == '1') ? 'selected' : '' ?>>Enabled (Email OTP Verification)</option>
                </select>
            </div>
            <div class="form-group">
                <label>MFA Verification Destination Email</label>
                <input type="email" name="mfa_email" placeholder="e.g. admin@advertresources.com" value="<?= htmlspecialchars(getSetting('mfa_email')) ?>">
                <small style="color: #64748b; font-size: 0.78rem; display: block; margin-top: 4px;">
                    <i class="fas fa-info-circle" style="color: #3b82f6;"></i> The verification code will be sent here. Make sure SMTP Transport details are configured.
                </small>
            </div>
        </div>
        
        <button type="submit" class="btn-action">SAVE PARAMETERS <i class="far fa-shield-check ms-2"></i></button>
    </form>
</div>

<!-- Test SMTP Section (separate form, outside the main glass-panel) -->
<div class="glass-panel" style="max-width: 1000px; margin-top: 24px;">
    <div class="panel-header mb-4">
        <h2 style="font-size: 1.1rem; color: #3b82f6;"><i class="fas fa-paper-plane"></i> Test SMTP Connection</h2>
    </div>
    <div style="background:rgba(59,130,246,0.06); border:1px solid rgba(59,130,246,0.2); border-radius:10px; padding:20px 24px;">
        <p style="color:#94a3b8; font-size:0.88rem; margin:0 0 16px;">
            <i class="fas fa-info-circle" style="color:#3b82f6;"></i>
            Save your SMTP settings first, then use this tool to verify the connection works correctly.
        </p>
        <form method="POST" action="" style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
            <input type="hidden" name="test_smtp" value="1">
            <div style="flex:1; min-width:220px;">
                <label style="display:block; font-size:0.78rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:8px;">Send Test Email To</label>
                <input type="email" name="test_to" placeholder="your@email.com" required
                       style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem; box-sizing:border-box;">
            </div>
            <button type="submit"
                    style="padding:10px 20px; background:rgba(59,130,246,0.15); border:1px solid rgba(59,130,246,0.35); border-radius:8px; color:#60a5fa; font-size:0.88rem; font-weight:700; cursor:pointer; white-space:nowrap; transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(59,130,246,0.3)'"
                    onmouseout="this.style.background='rgba(59,130,246,0.15)'">
                <i class="fas fa-flask"></i> Send Test Email
            </button>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>