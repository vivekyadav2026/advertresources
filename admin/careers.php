<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        $stmt = $db->prepare("DELETE FROM careers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Job listing removed successfully.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

try {
    $careers = $db->query("SELECT * FROM careers ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $careers = [];
}
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Careers Management</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">View and manage your active job listings.</p>
    </div>
    <div>
        <a href="career_create.php" class="btn-action" style="text-decoration:none;">POST NEW JOB <i class="fas fa-plus ms-2"></i></a>
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
        <h2>Job Listings (<?= count($careers) ?>)</h2>
    </div>
    <div class="table-responsive">
        <table class="cyber-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($careers)): ?>
                    <tr><td colspan="5" style="text-align:center;">No job listings yet. Post your first job!</td></tr>
                <?php else: ?>
                    <?php foreach ($careers as $job): ?>
                    <tr>
                        <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($job['title']) ?></td>
                        <td><?= htmlspecialchars($job['department'] ?: '-') ?></td>
                        <td><span class="badge-tag"><?= htmlspecialchars($job['type']) ?></span></td>
                        <td>
                            <?php if ($job['is_active']): ?>
                                <span class="badge-tag" style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);color:#10b981;">Live</span>
                            <?php else: ?>
                                <span class="badge-tag" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#ef4444;">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="career_edit.php?id=<?= $job['id'] ?>" class="btn-view" style="display:inline-block;">Edit</a>
                            <a href="?delete=<?= $job['id'] ?>" class="btn-delete" style="display:inline-block;" onclick="return confirm('Delete this job listing?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>