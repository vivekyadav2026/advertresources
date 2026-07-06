<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        $stmt = $db->prepare("DELETE FROM career_applications WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Application removed.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

try {
    $db->exec("CREATE TABLE IF NOT EXISTS career_applications (id INTEGER PRIMARY KEY AUTOINCREMENT, job_id INTEGER, name TEXT, email TEXT, phone TEXT, cover_message TEXT, applied_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
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
                    <th>Message</th>
                    <th>Action</th>
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
                        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($app['cover_message']) ?>"><?= htmlspecialchars(substr($app['cover_message'] ?: '-', 0, 60)) ?>...</td>
                        <td><a href="?delete=<?= $app['id'] ?>" class="btn-delete" style="text-decoration:none;" onclick="return confirm('Remove this application?')">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>