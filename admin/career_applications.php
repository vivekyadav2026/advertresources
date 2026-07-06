<?php
require_once 'includes/header.php';

$success = "";
$error   = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        // Also delete CV file if exists
        $row = $db->prepare("SELECT cv_file FROM career_applications WHERE id = :id");
        $row->execute([':id' => $id]);
        $cv = $row->fetchColumn();
        if ($cv && file_exists(__DIR__ . '/../uploads/cvs/' . $cv)) {
            unlink(__DIR__ . '/../uploads/cvs/' . $cv);
        }
        $stmt = $db->prepare("DELETE FROM career_applications WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Application removed.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

try {
    $db->exec("CREATE TABLE IF NOT EXISTS career_applications (id INTEGER PRIMARY KEY AUTOINCREMENT, job_id INTEGER, name TEXT, email TEXT, phone TEXT, cover_message TEXT, cv_file TEXT, applied_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
    try { $db->exec("ALTER TABLE career_applications ADD COLUMN cv_file TEXT"); } catch (Exception $e) {}
    $applications = $db->query("SELECT ca.*, c.title as job_title FROM career_applications ca LEFT JOIN careers c ON ca.job_id = c.id ORDER BY ca.applied_at DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $applications = [];
}
?>

<style>
/* ── Application Details Modal ── */
.app-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.78);
    backdrop-filter: blur(8px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.app-overlay.open { display: flex; }

.app-modal {
    background: linear-gradient(135deg, rgba(15,23,42,0.98), rgba(30,41,59,0.98));
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 36px 40px;
    max-width: 660px;
    width: 100%;
    max-height: 88vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 30px 70px rgba(0,0,0,0.6), 0 0 0 1px rgba(60,114,252,0.12);
    animation: appSlideIn 0.28s ease;
}
@keyframes appSlideIn {
    from { opacity:0; transform:translateY(22px) scale(0.97); }
    to   { opacity:1; transform:translateY(0)    scale(1);    }
}

.app-close {
    position: absolute;
    top: 16px; right: 18px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50%;
    width: 34px; height: 34px;
    color: #94a3b8;
    cursor: pointer;
    font-size: 0.9rem;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
}
.app-close:hover { background:rgba(239,68,68,0.2); color:#ef4444; border-color:rgba(239,68,68,0.3); }

.app-avatar {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3c72fc, #7c3aed);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 14px;
    box-shadow: 0 8px 20px rgba(60,114,252,0.35);
}

.app-name {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 4px;
    padding-right: 40px;
}
.app-applied-for {
    font-size: 0.85rem;
    color: #60a5fa;
    font-weight: 600;
    margin-bottom: 20px;
}

.app-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 22px;
}
.app-info-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px;
    padding: 13px 16px;
}
.app-info-label {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #475569;
    margin-bottom: 5px;
}
.app-info-val {
    font-size: 0.9rem;
    font-weight: 600;
    color: #e2e8f0;
    word-break: break-all;
}
.app-info-val a { color: #60a5fa; text-decoration: none; }
.app-info-val a:hover { text-decoration: underline; }

.app-section-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.8rem;
    font-weight: 700;
    color: #3c72fc;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: flex; align-items: center; gap: 8px;
}
.app-section-title::after {
    content:'';
    flex:1;
    height:1px;
    background: linear-gradient(90deg, rgba(60,114,252,0.3), transparent);
}
.app-text-box {
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 10px;
    padding: 16px 18px;
    color: #94a3b8;
    font-size: 0.92rem;
    line-height: 1.75;
    white-space: pre-line;
    font-family: 'Kumbh Sans', sans-serif;
    margin-bottom: 22px;
    min-height: 80px;
}

.app-cv-box {
    display: flex; align-items: center; gap: 14px;
    background: rgba(60,114,252,0.06);
    border: 1px dashed rgba(60,114,252,0.3);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 24px;
}
.app-cv-icon {
    width: 44px; height: 44px;
    background: rgba(60,114,252,0.15);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #60a5fa;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.app-cv-info { flex:1; }
.app-cv-info .cv-label { font-size:0.72rem; color:#475569; font-weight:700; text-transform:uppercase; letter-spacing:0.7px; }
.app-cv-info .cv-name  { font-size:0.9rem; color:#e2e8f0; font-weight:600; margin-top:3px; word-break:break-all; }

.app-footer {
    display: flex; gap: 10px; justify-content: flex-end;
    margin-top: 24px;
    padding-top: 18px;
    border-top: 1px solid rgba(255,255,255,0.06);
    flex-wrap: wrap;
}

@media(max-width:600px) {
    .app-modal { padding:24px 18px; }
    .app-info-grid { grid-template-columns:1fr; }
}
</style>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Job Applications</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Review candidates who have applied for open positions.</p>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert-banner success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert-banner error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-panel">
    <div class="panel-header">
        <h2>Applications Received (<?= count($applications) ?>)</h2>
    </div>
    <div class="table-responsive">
        <table class="cyber-table">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Applied For</th>
                    <th>Date</th>
                    <th>CV</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($applications)): ?>
                    <tr><td colspan="7" style="text-align:center;">No applications received yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($applications as $app): ?>
                    <tr>
                        <td style="font-weight:700;color:#fff;"><?= htmlspecialchars($app['name']) ?></td>
                        <td><?= htmlspecialchars($app['email']) ?></td>
                        <td><?= htmlspecialchars($app['phone'] ?: '-') ?></td>
                        <td><span class="badge-tag"><?= htmlspecialchars($app['job_title'] ?: 'Unknown') ?></span></td>
                        <td><?= date('M d, Y', strtotime($app['applied_at'])) ?></td>
                        <td>
                            <?php if (!empty($app['cv_file'])): ?>
                                <a href="../uploads/cvs/<?= htmlspecialchars($app['cv_file']) ?>"
                                   download="<?= htmlspecialchars($app['name']) ?>_CV.<?= pathinfo($app['cv_file'], PATHINFO_EXTENSION) ?>"
                                   style="display:inline-flex;align-items:center;gap:5px;padding:5px 10px;background:rgba(60,114,252,0.15);border:1px solid rgba(60,114,252,0.3);border-radius:6px;color:#60a5fa;font-size:0.78rem;font-weight:600;text-decoration:none;">
                                    <i class="fas fa-download"></i> CV
                                </a>
                            <?php else: ?>
                                <span style="color:#475569;font-size:0.8rem;">No CV</span>
                            <?php endif; ?>
                        </td>
                        <td style="white-space:nowrap; display:flex; gap:7px; flex-wrap:wrap;">
                            <button
                                onclick='viewApplication(<?= htmlspecialchars(json_encode($app), ENT_QUOTES) ?>)'
                                style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:rgba(60,114,252,0.15);border:1px solid rgba(60,114,252,0.3);border-radius:6px;color:#60a5fa;font-size:0.82rem;font-weight:600;cursor:pointer;transition:all 0.2s;"
                                onmouseover="this.style.background='rgba(60,114,252,0.3)'"
                                onmouseout="this.style.background='rgba(60,114,252,0.15)'">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <a href="?delete=<?= $app['id'] ?>" class="btn-delete"
                               style="display:inline-flex;align-items:center;gap:5px;text-decoration:none;"
                               onclick="return confirm('Remove this application?')">
                               <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ── Application Details Modal ── -->
<div class="app-overlay" id="appOverlay" onclick="if(event.target===this)closeApp()">
    <div class="app-modal">
        <button class="app-close" onclick="closeApp()"><i class="fas fa-times"></i></button>

        <!-- Avatar + Name -->
        <div class="app-avatar" id="app-avatar"></div>
        <div class="app-name" id="app-name"></div>
        <div class="app-applied-for" id="app-applied-for"></div>

        <!-- Info Grid -->
        <div class="app-info-grid" id="app-info-grid"></div>

        <!-- Cover Message -->
        <div id="app-msg-wrap">
            <div class="app-section-title"><i class="fas fa-envelope-open-text"></i> Cover Message</div>
            <div class="app-text-box" id="app-msg"></div>
        </div>

        <!-- CV -->
        <div id="app-cv-wrap" style="display:none;">
            <div class="app-section-title"><i class="fas fa-file-user"></i> Uploaded CV</div>
            <div class="app-cv-box">
                <div class="app-cv-icon"><i class="fas fa-file-pdf"></i></div>
                <div class="app-cv-info">
                    <div class="cv-label">Curriculum Vitae</div>
                    <div class="cv-name" id="app-cv-name"></div>
                </div>
                <a id="app-cv-link" href="#" download
                   style="display:inline-flex;align-items:center;gap:7px;padding:9px 16px;background:rgba(60,114,252,0.2);border:1px solid rgba(60,114,252,0.35);border-radius:8px;color:#60a5fa;font-size:0.85rem;font-weight:700;text-decoration:none;flex-shrink:0;transition:all 0.2s;"
                   onmouseover="this.style.background='rgba(60,114,252,0.35)'"
                   onmouseout="this.style.background='rgba(60,114,252,0.2)'">
                    <i class="fas fa-download"></i> Download
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="app-footer">
            <button onclick="closeApp()" style="padding:10px 22px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;color:#94a3b8;cursor:pointer;font-family:'Space Grotesk',sans-serif;font-weight:600;">
                Close
            </button>
            <a id="app-email-btn" href="#"
               style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:linear-gradient(135deg,#3c72fc,#7c3aed);border:none;border-radius:8px;color:#fff;font-size:0.88rem;font-weight:700;text-decoration:none;font-family:'Space Grotesk',sans-serif;">
                <i class="fas fa-paper-plane"></i> Reply via Email
            </a>
        </div>
    </div>
</div>

<script>
function viewApplication(app) {
    // Avatar initials
    const initials = app.name.trim().split(' ').map(w => w[0]).join('').toUpperCase().slice(0,2);
    document.getElementById('app-avatar').textContent = initials;

    // Name & applied for
    document.getElementById('app-name').textContent = app.name;
    document.getElementById('app-applied-for').textContent = 
        'Applied for: ' + (app.job_title || 'Unknown Position');

    // Info cards
    const date = app.applied_at ? app.applied_at.split(' ')[0] : '—';
    document.getElementById('app-info-grid').innerHTML = `
        <div class="app-info-card">
            <div class="app-info-label"><i class="fas fa-envelope" style="margin-right:4px;"></i>Email</div>
            <div class="app-info-val"><a href="mailto:${app.email}">${app.email}</a></div>
        </div>
        <div class="app-info-card">
            <div class="app-info-label"><i class="fas fa-phone" style="margin-right:4px;"></i>Phone</div>
            <div class="app-info-val">${app.phone || '—'}</div>
        </div>
        <div class="app-info-card">
            <div class="app-info-label"><i class="fas fa-calendar-alt" style="margin-right:4px;"></i>Applied On</div>
            <div class="app-info-val">${date}</div>
        </div>
        <div class="app-info-card">
            <div class="app-info-label"><i class="fas fa-briefcase" style="margin-right:4px;"></i>Position</div>
            <div class="app-info-val">${app.job_title || 'Unknown'}</div>
        </div>
    `;

    // Cover message
    const msgWrap = document.getElementById('app-msg-wrap');
    const msgEl   = document.getElementById('app-msg');
    if (app.cover_message && app.cover_message.trim()) {
        msgEl.textContent = app.cover_message;
        msgWrap.style.display = 'block';
    } else {
        msgEl.textContent = 'No cover message provided.';
        msgEl.style.color = '#475569';
        msgWrap.style.display = 'block';
    }

    // CV
    const cvWrap = document.getElementById('app-cv-wrap');
    if (app.cv_file) {
        document.getElementById('app-cv-name').textContent = app.cv_file;
        const cvLink = document.getElementById('app-cv-link');
        cvLink.href     = '../uploads/cvs/' + app.cv_file;
        cvLink.download = app.name + '_CV';

        // Set correct file icon
        const ext = app.cv_file.split('.').pop().toLowerCase();
        const icon = document.querySelector('#app-cv-wrap .app-cv-icon i');
        icon.className = ext === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-file-word';

        cvWrap.style.display = 'block';
    } else {
        cvWrap.style.display = 'none';
    }

    // Reply button
    document.getElementById('app-email-btn').href = 'mailto:' + app.email +
        '?subject=Re: Your Application for ' + encodeURIComponent(app.job_title || 'Position');

    // Open modal
    document.getElementById('appOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeApp() {
    document.getElementById('appOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeApp();
});
</script>

<?php require_once 'includes/footer.php'; ?>