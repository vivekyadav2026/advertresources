<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    $keys = ['address', 'phone1', 'phone2', 'email1', 'email2', 'hours', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_pass', 'smtp_secure', 'smtp_from_name'];
    try {
        foreach ($keys as $key) {
            if (isset($_POST[$key])) {
                $stmt = $db->prepare("UPDATE settings SET value = :val WHERE key = :key");
                $stmt->execute([':val' => $_POST[$key], ':key' => $key]);
            }
        }
        $success = "Configuration parameters updated securely.";
    } catch (Exception $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
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
        
        <button type="submit" class="btn-action">SAVE PARAMETERS <i class="far fa-shield-check ms-2"></i></button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>