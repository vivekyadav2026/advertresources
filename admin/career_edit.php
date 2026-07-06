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