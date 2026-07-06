<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title        = trim($_POST['career_title'] ?? '');
    $department   = trim($_POST['department'] ?? '');
    $location     = trim($_POST['location'] ?? '');
    $type         = trim($_POST['job_type'] ?? 'Full-Time');
    $experience   = trim($_POST['experience'] ?? '');
    $salary       = trim($_POST['salary'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $requirements = trim($_POST['requirements'] ?? '');
    $is_active    = isset($_POST['is_active']) ? 1 : 0;

    if (!empty($title)) {
        try {
            $stmt = $db->prepare("INSERT INTO careers (title, department, location, type, experience, salary, description, requirements, is_active) VALUES (:title,:dept,:loc,:type,:exp,:salary,:desc,:req,:active)");
            $stmt->execute([':title'=>$title,':dept'=>$department,':loc'=>$location,':type'=>$type,':exp'=>$experience,':salary'=>$salary,':desc'=>$description,':req'=>$requirements,':active'=>$is_active]);
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
        <div class="form-row mb-3">
            <div class="form-group">
                <label><i class="fas fa-sterling-sign" style="color:#22c55e; margin-right:5px;"></i>Salary Range</label>
                <input type="text" name="salary" placeholder="e.g. £40,000 - £60,000 / year" value="<?= htmlspecialchars($_POST['salary'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label style="color:transparent;">.</label>
                <div style="padding:12px 14px; background:rgba(34,197,94,0.05); border:1px dashed rgba(34,197,94,0.2); border-radius:8px; color:#64748b; font-size:0.82rem; line-height:1.5;">
                    <i class="fas fa-info-circle" style="color:#22c55e; margin-right:5px;"></i>
                    Enter a range like <strong style="color:#94a3b8;">£30k - £50k</strong> or <strong style="color:#94a3b8;">Competitive</strong>. This will be visible to applicants.
                </div>
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