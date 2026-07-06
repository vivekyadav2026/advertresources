<?php
require_once 'includes/header.php';

$success = "";
$error   = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current  = $_POST['current_password']  ?? '';
    $new      = $_POST['new_password']      ?? '';
    $confirm  = $_POST['confirm_password']  ?? '';

    // Validations
    if (empty($current) || empty($new) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif ($new !== $confirm) {
        $error = "New password and confirmation do not match.";
    } elseif (strlen($new) < 8) {
        $error = "New password must be at least 8 characters long.";
    } else {
        // Verify current password
        $username = $_SESSION['admin_username'] ?? 'admin';
        $stmt = $db->prepare("SELECT password_hash FROM admin_credentials WHERE username = :user LIMIT 1");
        $stmt->execute([':user' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($current, $row['password_hash'])) {
            // Hash the new password and save
            $newHash = password_hash($new, PASSWORD_BCRYPT);
            $upd = $db->prepare("UPDATE admin_credentials SET password_hash = :hash, updated_at = CURRENT_TIMESTAMP WHERE username = :user");
            $upd->execute([':hash' => $newHash, ':user' => $username]);
            $success = "Password updated successfully! Please use your new password on next login.";
        } else {
            $error = "Current password is incorrect.";
        }
    }
}
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family:'Space Grotesk',sans-serif;">
            <i class="far fa-key" style="color: #3b82f6; margin-right: 10px;"></i>Change Password
        </h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Update your admin panel access credentials securely.</p>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert-banner success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert-banner error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-panel" style="max-width: 560px;">
    <div class="panel-header mb-4">
        <h2 style="font-size:1.1rem; color:#3b82f6;">
            <i class="far fa-shield-alt"></i> Secure Credential Update
        </h2>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="change_password" value="1">

        <div class="form-group">
            <label>Current Password</label>
            <div style="position:relative;">
                <input type="password" name="current_password" id="current_password" placeholder="Enter your current password" autocomplete="current-password">
                <button type="button" onclick="toggleVis('current_password',this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;"><i class="far fa-eye"></i></button>
            </div>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <div style="position:relative;">
                <input type="password" name="new_password" id="new_password" placeholder="Minimum 8 characters" autocomplete="new-password">
                <button type="button" onclick="toggleVis('new_password',this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;"><i class="far fa-eye"></i></button>
            </div>
        </div>

        <div class="form-group">
            <label>Confirm New Password</label>
            <div style="position:relative;">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter new password" autocomplete="new-password">
                <button type="button" onclick="toggleVis('confirm_password',this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;"><i class="far fa-eye"></i></button>
            </div>
        </div>

        <!-- Password strength indicator -->
        <div id="strength-wrap" style="margin: -10px 0 20px; font-size: 0.8rem; color:#64748b; display:none;">
            Strength: <span id="strength-label" style="font-weight:700;"></span>
            <div style="height:4px; background:rgba(255,255,255,0.05); border-radius:4px; margin-top:6px;">
                <div id="strength-bar" style="height:100%; border-radius:4px; transition:width 0.3s, background 0.3s; width:0%;"></div>
            </div>
        </div>

        <button type="submit" class="btn-action" style="width:100%; justify-content:center; padding: 14px;">
            <i class="fas fa-lock"></i> UPDATE PASSWORD
        </button>
    </form>

    <div style="margin-top:24px; padding:16px; background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); border-radius:8px;">
        <p style="color:#fbbf24; font-size:0.85rem; margin:0; display:flex; align-items:flex-start; gap:8px;">
            <i class="fas fa-exclamation-triangle" style="margin-top:2px; flex-shrink:0;"></i>
            <span>After changing your password, you will continue to stay logged in. However, you must use the <strong>new password</strong> on your next login. Store it safely.</span>
        </p>
    </div>
</div>

<script>
function toggleVis(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
        btn.style.color = '#3b82f6';
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
        btn.style.color = '#64748b';
    }
}

// Password strength meter
document.getElementById('new_password').addEventListener('input', function() {
    const val = this.value;
    const wrap = document.getElementById('strength-wrap');
    const bar  = document.getElementById('strength-bar');
    const lbl  = document.getElementById('strength-label');

    if (val.length === 0) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'block';

    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { label: 'Very Weak', color: '#ef4444', w: '20%' },
        { label: 'Weak',      color: '#f97316', w: '40%' },
        { label: 'Fair',      color: '#eab308', w: '60%' },
        { label: 'Strong',    color: '#22c55e', w: '80%' },
        { label: 'Very Strong', color: '#10b981', w: '100%' }
    ];
    const lvl = levels[Math.min(score, 4)];
    bar.style.width = lvl.w;
    bar.style.background = lvl.color;
    lbl.textContent = lvl.label;
    lbl.style.color = lvl.color;
});

// Live confirm-match check
document.getElementById('confirm_password').addEventListener('input', function() {
    const newPwd = document.getElementById('new_password').value;
    this.style.borderColor = (this.value === newPwd && this.value.length > 0) ? '#10b981' : '';
});
</script>

<?php require_once 'includes/footer.php'; ?>
