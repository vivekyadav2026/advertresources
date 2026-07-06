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
                    <th>Cover Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($applications)): ?>
                    <tr><td colspan="8" style="text-align:center;">No applications received yet.</td></tr>
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
                                   style="display:inline-flex; align-items:center; gap:6px; padding:6px 12px; background:rgba(60,114,252,0.15); border:1px solid rgba(60,114,252,0.3); border-radius:6px; color:#60a5fa; font-size:0.8rem; font-weight:600; text-decoration:none; transition:all 0.2s;"
                                   onmouseover="this.style.background='rgba(60,114,252,0.3)'"
                                   onmouseout="this.style.background='rgba(60,114,252,0.15)'">
                                    <i class="fas fa-download"></i> Download CV
                                </a>
                            <?php else: ?>
                                <span style="color:#475569; font-size:0.8rem;">No CV</span>
                            <?php endif; ?>
                        </td>
                        <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($app['cover_message']) ?>"><?= htmlspecialchars(substr($app['cover_message'] ?: '-', 0, 50)) ?>...</td>
                        <td><a href="?delete=<?= $app['id'] ?>" class="btn-delete" style="text-decoration:none;" onclick="return confirm('Remove this application?')">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>