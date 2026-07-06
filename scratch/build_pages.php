<?php

// careers.php
$careers_content = <<<'EOD'
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
EOD;

file_put_contents('c:\xampp\htdocs\advertresources\admin\careers.php', $careers_content);

// career_create.php
$career_create_content = <<<'EOD'
<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['career_title'] ?? '');
    $department  = trim($_POST['department'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $type        = trim($_POST['job_type'] ?? 'Full-Time');
    $experience  = trim($_POST['experience'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $requirements = trim($_POST['requirements'] ?? '');
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    if (!empty($title)) {
        try {
            $stmt = $db->prepare("INSERT INTO careers (title, department, location, type, experience, description, requirements, is_active) VALUES (:title,:dept,:loc,:type,:exp,:desc,:req,:active)");
            $stmt->execute([':title'=>$title,':dept'=>$department,':loc'=>$location,':type'=>$type,':exp'=>$experience,':desc'=>$description,':req'=>$requirements,':active'=>$is_active]);
            $success = "New job listing published successfully.";
            // Clear post vars
            $_POST = [];
        } catch (Exception $e) {
            $error = "Publish failed: " . $e->getMessage();
        }
    } else {
        $error = "Job title is required.";
    }
}
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Post New Job</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Create a new open role for the careers page.</p>
    </div>
    <div>
        <a href="careers.php" class="btn-action" style="text-decoration:none; background:rgba(255,255,255,0.05); box-shadow:none; border:1px solid rgba(255,255,255,0.1);">&larr; BACK TO LIST</a>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert-banner success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert-banner error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-panel" style="max-width: 800px;">
    <form action="" method="POST">
        <div class="form-group mb-3">
            <label>Job Title *</label>
            <input type="text" name="career_title" required placeholder="Senior Security Analyst" value="<?= htmlspecialchars($_POST['career_title'] ?? '') ?>">
        </div>
        <div class="form-row mb-3">
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" placeholder="SOC / Red Team / Engineering" value="<?= htmlspecialchars($_POST['department'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" placeholder="London / Remote" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="form-group">
                <label>Job Type</label>
                <select name="job_type" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                    <option value="Full-Time" <?= ($_POST['job_type'] ?? '') == 'Full-Time' ? 'selected' : '' ?>>Full-Time</option>
                    <option value="Part-Time" <?= ($_POST['job_type'] ?? '') == 'Part-Time' ? 'selected' : '' ?>>Part-Time</option>
                    <option value="Contract" <?= ($_POST['job_type'] ?? '') == 'Contract' ? 'selected' : '' ?>>Contract</option>
                    <option value="Remote" <?= ($_POST['job_type'] ?? '') == 'Remote' ? 'selected' : '' ?>>Remote</option>
                    <option value="Internship" <?= ($_POST['job_type'] ?? '') == 'Internship' ? 'selected' : '' ?>>Internship</option>
                </select>
            </div>
            <div class="form-group">
                <label>Experience Level</label>
                <input type="text" name="experience" placeholder="3+ Years / Senior / Mid" value="<?= htmlspecialchars($_POST['experience'] ?? '') ?>">
            </div>
        </div>
        <div class="form-group mb-3">
            <label>Job Description *</label>
            <textarea name="description" rows="5" required placeholder="Describe the role, responsibilities and goals..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>
        <div class="form-group mb-3">
            <label>Requirements</label>
            <textarea name="requirements" rows="4" placeholder="Certifications, skills, qualifications..."><?= htmlspecialchars($_POST['requirements'] ?? '') ?></textarea>
        </div>
        <div class="form-group mb-4" style="display:flex; align-items:center; gap:12px;">
            <input type="checkbox" name="is_active" id="is_active" value="1" <?= (!isset($_POST['is_active']) && empty($_POST)) || !empty($_POST['is_active']) ? 'checked' : '' ?> style="width:18px;height:18px;accent-color:#3C72FC;">
            <label for="is_active" style="margin:0; font-size:0.85rem; color:#94a3b8;">Published (visible on careers page)</label>
        </div>
        <button type="submit" class="btn-action">PUBLISH JOB <i class="far fa-paper-plane ms-2"></i></button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
EOD;

file_put_contents('c:\xampp\htdocs\advertresources\admin\career_create.php', $career_create_content);

// career_edit.php
$career_edit_content = <<<'EOD'
<?php
require_once 'includes/header.php';

$success = "";
$error = "";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    echo "<script>window.location.href='careers.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['career_title'] ?? '');
    $department  = trim($_POST['department'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $type        = trim($_POST['job_type'] ?? 'Full-Time');
    $experience  = trim($_POST['experience'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $requirements = trim($_POST['requirements'] ?? '');
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    if (!empty($title)) {
        try {
            $stmt = $db->prepare("UPDATE careers SET title=:title, department=:dept, location=:loc, type=:type, experience=:exp, description=:desc, requirements=:req, is_active=:active WHERE id=:id");
            $stmt->execute([':title'=>$title,':dept'=>$department,':loc'=>$location,':type'=>$type,':exp'=>$experience,':desc'=>$description,':req'=>$requirements,':active'=>$is_active,':id'=>$id]);
            $success = "Job listing updated successfully.";
        } catch (Exception $e) {
            $error = "Update failed: " . $e->getMessage();
        }
    } else {
        $error = "Job title is required.";
    }
}

// Fetch job
try {
    $stmt = $db->prepare("SELECT * FROM careers WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$job) {
        echo "<script>window.location.href='careers.php';</script>";
        exit;
    }
} catch (Exception $e) {
    $job = null;
}
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Edit Job Listing</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Update the details for this open role.</p>
    </div>
    <div>
        <a href="careers.php" class="btn-action" style="text-decoration:none; background:rgba(255,255,255,0.05); box-shadow:none; border:1px solid rgba(255,255,255,0.1);">&larr; BACK TO LIST</a>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert-banner success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert-banner error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-panel" style="max-width: 800px;">
    <form action="" method="POST">
        <div class="form-group mb-3">
            <label>Job Title *</label>
            <input type="text" name="career_title" required value="<?= htmlspecialchars($job['title']) ?>">
        </div>
        <div class="form-row mb-3">
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" value="<?= htmlspecialchars($job['department']) ?>">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($job['location']) ?>">
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="form-group">
                <label>Job Type</label>
                <select name="job_type" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                    <option value="Full-Time" <?= $job['type'] == 'Full-Time' ? 'selected' : '' ?>>Full-Time</option>
                    <option value="Part-Time" <?= $job['type'] == 'Part-Time' ? 'selected' : '' ?>>Part-Time</option>
                    <option value="Contract" <?= $job['type'] == 'Contract' ? 'selected' : '' ?>>Contract</option>
                    <option value="Remote" <?= $job['type'] == 'Remote' ? 'selected' : '' ?>>Remote</option>
                    <option value="Internship" <?= $job['type'] == 'Internship' ? 'selected' : '' ?>>Internship</option>
                </select>
            </div>
            <div class="form-group">
                <label>Experience Level</label>
                <input type="text" name="experience" value="<?= htmlspecialchars($job['experience']) ?>">
            </div>
        </div>
        <div class="form-group mb-3">
            <label>Job Description *</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($job['description']) ?></textarea>
        </div>
        <div class="form-group mb-3">
            <label>Requirements</label>
            <textarea name="requirements" rows="4"><?= htmlspecialchars($job['requirements']) ?></textarea>
        </div>
        <div class="form-group mb-4" style="display:flex; align-items:center; gap:12px;">
            <input type="checkbox" name="is_active" id="is_active" value="1" <?= $job['is_active'] ? 'checked' : '' ?> style="width:18px;height:18px;accent-color:#3C72FC;">
            <label for="is_active" style="margin:0; font-size:0.85rem; color:#94a3b8;">Published (visible on careers page)</label>
        </div>
        <button type="submit" class="btn-action">UPDATE JOB <i class="far fa-shield-check ms-2"></i></button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
EOD;

file_put_contents('c:\xampp\htdocs\advertresources\admin\career_edit.php', $career_edit_content);

// career_applications.php
$career_applications_content = <<<'EOD'
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
EOD;

file_put_contents('c:\xampp\htdocs\advertresources\admin\career_applications.php', $career_applications_content);

echo "Careers pages built successfully.\n";
?>
