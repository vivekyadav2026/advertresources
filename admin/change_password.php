<?php
// ── All PHP logic BEFORE any HTML output ──
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . "/../db.php";

$success = "";
$error   = "";

// 1. Handle Cancel
if (isset($_GET['cancel_change'])) {
    unset($_SESSION['pwd_change_otp'], $_SESSION['pwd_change_otp_expiry'],
          $_SESSION['pwd_change_new_hash'], $_SESSION['pwd_change_pending']);
    header("Location: change_password.php");
    exit;
}

// 2. Step 1 — Verify current password, send OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password']     ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($current) || empty($new) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif ($new !== $confirm) {
        $error = "New password and confirmation do not match.";
    } elseif (strlen($new) < 8) {
        $error = "New password must be at least 8 characters long.";
    } else {
        $username = $_SESSION['admin_username'] ?? 'admin';
        $stmt = $db->prepare("SELECT password_hash FROM admin_credentials WHERE username = :user LIMIT 1");
        $stmt->execute([':user' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($current, $row['password_hash'])) {
            // Find verification email
            $mfa_email = getSetting('mfa_email', '');
            if (empty($mfa_email)) $mfa_email = getSetting('email1', '');
            if (empty($mfa_email)) $mfa_email = getSetting('smtp_user', '');

            if (empty($mfa_email)) {
                $error = "MFA destination email is not configured. Please configure it in System Configuration.";
            } else {
                $otp = rand(100000, 999999);
                $_SESSION['pwd_change_otp']        = $otp;
                $_SESSION['pwd_change_otp_expiry']  = time() + 300;
                $_SESSION['pwd_change_new_hash']    = password_hash($new, PASSWORD_BCRYPT);
                $_SESSION['pwd_change_pending']     = true;

                require_once '../mail-helper.php';
                $mailResult = sendMfaOtpEmail($mfa_email, $otp);
                if ($mailResult === true) {
                    $success = "Verification code dispatched to: " . htmlspecialchars($mfa_email) . ". Enter the code below to authorize the update.";
                } else {
                    unset($_SESSION['pwd_change_otp'], $_SESSION['pwd_change_otp_expiry'],
                          $_SESSION['pwd_change_new_hash'], $_SESSION['pwd_change_pending']);
                    $error = "SMTP Error: " . htmlspecialchars($mailResult);
                }
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }
}

// 3. Step 2 — Verify OTP and save new password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_pwd_change'])) {
    $entered_otp = trim($_POST['otp_code'] ?? '');

    if (empty($entered_otp)) {
        $error = "Verification code is required.";
    } elseif (!isset($_SESSION['pwd_change_otp'], $_SESSION['pwd_change_otp_expiry'], $_SESSION['pwd_change_new_hash'])) {
        $error = "Session expired. Please submit your details again.";
        unset($_SESSION['pwd_change_pending']);
    } elseif (time() > $_SESSION['pwd_change_otp_expiry']) {
        $error = "Verification code has expired. Please request again.";
        unset($_SESSION['pwd_change_pending']);
    } elseif ($entered_otp != $_SESSION['pwd_change_otp']) {
        $error = "Invalid verification code. Please try again.";
    } else {
        $username = $_SESSION['admin_username'] ?? 'admin';
        $newHash  = $_SESSION['pwd_change_new_hash'];
        try {
            $upd = $db->prepare("UPDATE admin_credentials SET password_hash = :hash, updated_at = CURRENT_TIMESTAMP WHERE username = :user");
            $upd->execute([':hash' => $newHash, ':user' => $username]);
            $success = "Password updated successfully. Please use the new passkey on next login.";
        } catch (Exception $e) {
            $error = "Save failed: " . $e->getMessage();
        }
        // Clean up regardless
        unset($_SESSION['pwd_change_otp'], $_SESSION['pwd_change_otp_expiry'],
              $_SESSION['pwd_change_new_hash'], $_SESSION['pwd_change_pending']);
    }
}

$is_pending = isset($_SESSION['pwd_change_pending']) && $_SESSION['pwd_change_pending'] === true;

// ── Now it is safe to output HTML ──
require_once 'includes/header.php';
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

<?php if ($is_pending): ?>
    <!-- STEP 2: OTP Verification -->
    <div class="glass-panel" style="max-width: 560px;">
        <div class="panel-header mb-4">
            <h2 style="font-size:1.1rem; color:#3b82f6;">
                <i class="far fa-user-shield"></i> Authorize Passkey Update
            </h2>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="verify_pwd_change" value="1">
            <div class="form-group">
                <label>6-Digit Verification Code</label>
                <input type="text" name="otp_code" maxlength="6" pattern="\d{6}"
                       placeholder="000000"
                       style="text-align:center; font-size:1.5rem; letter-spacing:6px; font-weight:700;"
                       required autocomplete="off" autofocus>
                <small style="color:#64748b; font-size:0.78rem; display:block; margin-top:8px; text-align:center;">
                    <i class="fas fa-info-circle" style="color:#3b82f6;"></i> Code is valid for 5 minutes.
                </small>
            </div>
            <button type="submit" class="btn-action" style="width:100%; justify-content:center; padding:14px; margin-bottom:12px;">
                <i class="fas fa-shield-check"></i> VERIFY &amp; CHANGE PASSWORD
            </button>
            <a href="?cancel_change=1"
               style="display:flex; width:100%; justify-content:center; padding:13px; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.25); border-radius:8px; color:#ef4444; text-decoration:none; font-weight:700; font-size:0.9rem; box-sizing:border-box; align-items:center; gap:8px;">
                <i class="fas fa-times"></i> CANCEL REQUEST
            </a>
        </form>
    </div>
<?php else: ?>
    <!-- STEP 1: Enter Passwords -->
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
                    <input type="password" name="current_password" id="current_password"
                           placeholder="Enter your current password" autocomplete="current-password" required>
                    <button type="button" onclick="toggleVis('current_password',this)"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <div style="position:relative;">
                    <input type="password" name="new_password" id="new_password"
                           placeholder="Minimum 8 characters" autocomplete="new-password" required>
                    <button type="button" onclick="toggleVis('new_password',this)"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <div style="position:relative;">
                    <input type="password" name="confirm_password" id="confirm_password"
                           placeholder="Re-enter new password" autocomplete="new-password" required>
                    <button type="button" onclick="toggleVis('confirm_password',this)"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Password strength bar -->
            <div id="strength-wrap" style="margin:-10px 0 20px; font-size:0.8rem; color:#64748b; display:none;">
                Strength: <span id="strength-label" style="font-weight:700;"></span>
                <div style="height:4px; background:rgba(255,255,255,0.05); border-radius:4px; margin-top:6px;">
                    <div id="strength-bar" style="height:100%; border-radius:4px; transition:width 0.3s, background 0.3s; width:0%;"></div>
                </div>
            </div>

            <button type="submit" class="btn-action" style="width:100%; justify-content:center; padding:14px;">
                <i class="fas fa-lock"></i> REQUEST PASSKEY UPDATE
            </button>
        </form>

        <div style="margin-top:24px; padding:16px; background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); border-radius:8px;">
            <p style="color:#fbbf24; font-size:0.85rem; margin:0; display:flex; align-items:flex-start; gap:8px;">
                <i class="fas fa-exclamation-triangle" style="margin-top:2px; flex-shrink:0;"></i>
                <span>A 6-digit verification code will be sent to your configured MFA destination email before the password is changed.</span>
            </p>
        </div>
    </div>
<?php endif; ?>

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

const newPwdInput = document.getElementById('new_password');
if (newPwdInput) {
    newPwdInput.addEventListener('input', function () {
        const val  = this.value;
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
            { label:'Very Weak',   color:'#ef4444', w:'20%'  },
            { label:'Weak',        color:'#f97316', w:'40%'  },
            { label:'Fair',        color:'#eab308', w:'60%'  },
            { label:'Strong',      color:'#22c55e', w:'80%'  },
            { label:'Very Strong', color:'#10b981', w:'100%' }
        ];
        const lvl = levels[Math.min(score, 4)];
        bar.style.width      = lvl.w;
        bar.style.background = lvl.color;
        lbl.textContent      = lvl.label;
        lbl.style.color      = lvl.color;
    });
}

const confirmInput = document.getElementById('confirm_password');
if (confirmInput) {
    confirmInput.addEventListener('input', function () {
        const newPwd = document.getElementById('new_password').value;
        this.style.borderColor = (this.value === newPwd && this.value.length > 0) ? '#10b981' : '';
    });
}
</script>

<?php require_once 'includes/footer.php'; ?>
