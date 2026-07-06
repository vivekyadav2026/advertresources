<?php
session_start();
require_once 'db.php';

// ── POST handler BEFORE any output (PRG pattern) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_application'])) {
    $job_id  = intval($_POST['job_id'] ?? 0);
    $name    = trim($_POST['applicant_name'] ?? '');
    $email   = trim($_POST['applicant_email'] ?? '');
    $phone   = trim($_POST['applicant_phone'] ?? '');
    $message = trim($_POST['cover_message'] ?? '');
    $cv_file = '';
    $err     = '';

    if ($job_id && $name && $email) {
        try {
            $db->exec("CREATE TABLE IF NOT EXISTS career_applications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                job_id INTEGER, name TEXT, email TEXT, phone TEXT,
                cover_message TEXT, cv_file TEXT,
                applied_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            try { $db->exec("ALTER TABLE career_applications ADD COLUMN cv_file TEXT"); } catch (Exception $e) {}

            if (!empty($_FILES['cv_file']['name'])) {
                $allowed  = ['pdf','doc','docx'];
                $maxSize  = 5 * 1024 * 1024;
                $origName = $_FILES['cv_file']['name'];
                $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                if ($_FILES['cv_file']['error'] !== UPLOAD_ERR_OK) {
                    $err = 'File upload failed. Please try again.';
                } elseif (!in_array($ext, $allowed)) {
                    $err = 'Only PDF, DOC, and DOCX files are allowed.';
                } elseif ($_FILES['cv_file']['size'] > $maxSize) {
                    $err = 'File size must be under 5 MB.';
                } else {
                    $safeName  = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $origName);
                    $uploadDir = __DIR__ . '/uploads/cvs/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                    if (move_uploaded_file($_FILES['cv_file']['tmp_name'], $uploadDir . $safeName)) {
                        $cv_file = $safeName;
                    } else {
                        $err = 'Could not save the uploaded file.';
                    }
                }
            }

            if (empty($err)) {
                $stmt = $db->prepare("INSERT INTO career_applications (job_id, name, email, phone, cover_message, cv_file) VALUES (:job_id,:name,:email,:phone,:msg,:cv)");
                $stmt->execute([':job_id'=>$job_id,':name'=>$name,':email'=>$email,':phone'=>$phone,':msg'=>$message,':cv'=>$cv_file]);
                $_SESSION['apply_success'] = true;
            } else {
                $_SESSION['apply_error'] = $err;
            }
        } catch (Exception $e) {
            $_SESSION['apply_error'] = 'Something went wrong. Please try again.';
        }
    } else {
        $_SESSION['apply_error'] = 'Please fill in all required fields.';
    }

    // PRG: redirect before any HTML is sent
    header('Location: careers.php#open-roles');
    exit;
}

$pageTitle    = "Careers at Advert Resource Ltd | Join Our Elite Team";
$pageDesc     = "Join our elite team of security researchers, analysts, and engineers. Help protect digital infrastructure at a global scale with Advert Resource Ltd.";
$pageKeywords = "cyber security careers, InfoSec jobs, security engineer, SOC analyst, Advert Resource Ltd careers";
include 'header.php';
?>

<style>
/* ========== Careers Page Styles ========== */
.careers-page {
    background-color: #000916;
    color: #a9a9a9;
    font-family: "Kumbh Sans", sans-serif;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
}

/* Background grid */
.careers-page::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(37,99,235,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,0.04) 1px, transparent 1px);
    background-size: 55px 55px;
    pointer-events: none;
    z-index: 0;
}

/* Glow orbs */
.careers-orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(120px);
    pointer-events: none;
    z-index: 0;
    opacity: 0.35;
}
.careers-orb.blue  { background: rgba(37,99,235,0.3);  width: 500px; height: 500px; top: -150px; left: -100px; }
.careers-orb.pink  { background: rgba(224,0,155,0.2);   width: 450px; height: 450px; bottom: 0;  right: -100px; }

.careers-inner { position: relative; z-index: 2; }

/* ---- Hero ---- */
.careers-hero {
    padding: 20px 0 10px;
    text-align: center;
}
.careers-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 18px;
    background: rgba(224,0,155,0.1);
    border: 1px solid rgba(224,0,155,0.35);
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: 22px;
}
.careers-badge-dot {
    width: 8px; height: 8px;
    background: #069845;
    border-radius: 50%;
    box-shadow: 0 0 8px #069845;
    animation: pulse-dot 1.5s infinite;
}
@keyframes pulse-dot {
    0%,100% { transform: scale(1); opacity: 1; }
    50%      { transform: scale(1.4); opacity: 0.5; }
}
.careers-hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.5rem);
    font-weight: 800;
    line-height: 1.15;
    background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 18px;
}
.careers-hero p {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #94a3b8;
    max-width: 640px;
    margin: 0 auto 30px;
}

/* ---- Stats Strip ---- */
.careers-stats {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px 40px;
    padding: 30px 0 50px;
    border-top: 1px solid rgba(255,255,255,0.06);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    margin-bottom: 60px;
}
.stat-item { text-align: center; }
.stat-item strong {
    display: block;
    font-size: 1.8rem;
    font-weight: 800;
    color: #fff;
    font-family: "Space Grotesk", monospace;
}
.stat-item span { font-size: 0.8rem; color: #64748b; letter-spacing: 1px; text-transform: uppercase; }

/* ---- Filter Tabs ---- */
.careers-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 40px;
}
.filter-btn {
    padding: 8px 20px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.03);
    color: #94a3b8;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
}
.filter-btn:hover, .filter-btn.active {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 5px 15px rgba(37,99,235,0.3);
}

/* ---- Job Cards ---- */
.job-card {
    background: rgba(15,23,42,0.6);
    border: 1px solid rgba(59,130,246,0.1);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 20px;
    transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}
.job-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 3px; height: 100%;
    background: linear-gradient(180deg, #3C72FC, #E0009B);
    border-radius: 18px 0 0 18px;
    opacity: 0;
    transition: opacity 0.3s;
}
.job-card:hover {
    border-color: rgba(59,130,246,0.35);
    box-shadow: 0 20px 50px rgba(37,99,235,0.12);
    transform: translateY(-4px);
}
.job-card:hover::before { opacity: 1; }

.job-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}
.job-title {
    font-size: 1.2rem;
    font-weight: 800;
    color: #fff;
    margin: 0;
}
.job-badges { display: flex; flex-wrap: wrap; gap: 8px; }
.job-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.badge-dept { background: rgba(37,99,235,0.12); border: 1px solid rgba(37,99,235,0.25); color: #60a5fa; }
.badge-type { background: rgba(16,185,129,0.1);  border: 1px solid rgba(16,185,129,0.3);  color: #10b981; }
.badge-loc  { background: rgba(224,0,155,0.1);   border: 1px solid rgba(224,0,155,0.3);   color: #e879b2; }
.badge-exp  { background: rgba(245,158,11,0.1);  border: 1px solid rgba(245,158,11,0.3);  color: #f59e0b; }

.job-desc {
    font-size: 0.9rem;
    line-height: 1.65;
    color: #94a3b8;
    margin-bottom: 20px;
}
.job-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 18px;
    border-top: 1px solid rgba(255,255,255,0.05);
}
.job-posted { font-size: 0.75rem; color: #475569; font-family: "Space Grotesk", monospace; }
.apply-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(37,99,235,0.25);
}
.apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(37,99,235,0.4);
    color: #fff;
}

/* ---- Empty State ---- */
.no-jobs {
    text-align: center;
    padding: 80px 20px;
}
.no-jobs i { font-size: 3rem; color: #334155; margin-bottom: 20px; display: block; }
.no-jobs h3 { color: #fff; font-size: 1.4rem; margin-bottom: 10px; }
.no-jobs p { color: #64748b; font-size: 0.9rem; }

/* ---- Apply Modal ---- */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(4px);
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: #0d1526;
    border: 1px solid rgba(59,130,246,0.2);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 560px;
    position: relative;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
    max-height: 90vh;
    overflow-y: auto;
}
.modal-close {
    position: absolute;
    top: 16px; right: 20px;
    background: none; border: none;
    color: #64748b; font-size: 1.4rem;
    cursor: pointer;
    transition: color 0.2s;
}
.modal-close:hover { color: #fff; }
.modal-title { font-size: 1.4rem; font-weight: 800; color: #fff; margin-bottom: 6px; }
.modal-sub   { font-size: 0.85rem; color: #64748b; margin-bottom: 28px; }
.form-group  { margin-bottom: 18px; }
.form-label  { display: block; font-size: 0.8rem; font-weight: 700; color: #94a3b8; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
.form-control {
    width: 100%;
    padding: 12px 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: #fff;
    font-size: 0.9rem;
    transition: border-color 0.3s;
    outline: none;
    font-family: "Kumbh Sans", sans-serif;
}
.form-control:focus { border-color: #3C72FC; box-shadow: 0 0 0 3px rgba(60,114,252,0.15); }
.form-control::placeholder { color: #475569; }
.submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(37,99,235,0.3);
    margin-top: 8px;
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(37,99,235,0.5); }
.alert-success {
    background: rgba(16,185,129,0.1);
    border: 1px solid rgba(16,185,129,0.3);
    border-radius: 10px;
    color: #10b981;
    padding: 14px 18px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.alert-error {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: 10px;
    color: #ef4444;
    padding: 14px 18px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Mobile bottom nav spacing */
@media (max-width: 767px) {
    .careers-hero { padding-top: 10px; }
    .job-card { padding: 22px 18px; }
    .modal-box { padding: 28px 20px; }
    .careers-stats { gap: 16px 30px; }
}
</style>

<?php
// ── Read PRG flash messages set by the top-of-file POST handler ──
$apply_success = false;
$apply_error   = '';

if (!empty($_SESSION['apply_success'])) {
    $apply_success = true;
    unset($_SESSION['apply_success']);
}
if (!empty($_SESSION['apply_error'])) {
    $apply_error = $_SESSION['apply_error'];
    unset($_SESSION['apply_error']);
}

// Fetch active jobs
try {
    $jobs = $db->query("SELECT * FROM careers WHERE is_active = 1 ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
    $total_jobs = count($jobs);
    $departments = array_unique(array_filter(array_column($jobs, 'department')));
} catch (Exception $e) {
    $jobs = [];
    $total_jobs = 0;
    $departments = [];
}
?>

<div class="careers-page">
    <div class="careers-orb blue"></div>
    <div class="careers-orb pink"></div>
    <div class="careers-inner">

        <!-- Hero -->
        <div class="careers-hero">
            <div class="container">
                <div class="careers-badge">
                    <span class="careers-badge-dot"></span>
                    We're Hiring
                </div>
                <h1>Build the Future of<br>Cyber Defense</h1>
                <p>Join our elite team of security researchers, analysts, and engineers. Help protect digital infrastructure at a global scale.</p>
                <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                    <a href="contact-us.php" class="apply-btn"><i class="fas fa-envelope"></i> General Enquiry</a>
                    <a href="#open-roles" class="apply-btn" style="background:rgba(255,255,255,0.06); box-shadow:none; border:1px solid rgba(255,255,255,0.12);">
                        <i class="fas fa-list"></i> View Open Roles
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Strip -->
        <div class="container">
            <div class="careers-stats">
                <div class="stat-item">
                    <strong><?= $total_jobs ?></strong>
                    <span>Open Positions</span>
                </div>
                <div class="stat-item">
                    <strong><?= count($departments) ?></strong>
                    <span>Departments</span>
                </div>
                <div class="stat-item">
                    <strong>Remote</strong>
                    <span>Work Options</span>
                </div>
                <div class="stat-item">
                    <strong>24/7</strong>
                    <span>Global Team</span>
                </div>
            </div>
        </div>

        <!-- Job Listings -->
        <section id="open-roles" style="padding: 0 0 100px;">
            <div class="container">
                <div class="title-area mb-4">
                    <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:#E0009B; font-weight:700;">Open Positions</span>
                    <h2 style="font-size:clamp(1.8rem,4vw,2.5rem); font-weight:800; color:#fff; margin-top:8px;">Current Opportunities</h2>
                </div>

                <?php if (!empty($departments)): ?>
                <div class="careers-filter mb-4">
                    <button class="filter-btn active" onclick="filterJobs('all', this)">All Departments</button>
                    <?php foreach ($departments as $dept): ?>
                    <button class="filter-btn" onclick="filterJobs('<?= htmlspecialchars($dept) ?>', this)"><?= htmlspecialchars($dept) ?></button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (empty($jobs)): ?>
                <div class="no-jobs">
                    <i class="fas fa-briefcase"></i>
                    <h3>No Open Positions Right Now</h3>
                    <p>We're always looking for talent. Send your CV to <a href="mailto:careers@advertresources.com" style="color:#60a5fa;">careers@advertresources.com</a></p>
                </div>
                <?php else: ?>
                <div id="jobs-list">
                    <?php foreach ($jobs as $job): ?>
                    <div class="job-card" data-dept="<?= htmlspecialchars($job['department']) ?>">
                        <div class="job-details-data" style="display:none;" 
                             data-desc="<?= htmlspecialchars($job['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                             data-reqs="<?= htmlspecialchars($job['requirements'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                             data-salary="<?= htmlspecialchars($job['salary'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="job-card-top">
                            <h3 class="job-title"><?= htmlspecialchars($job['title']) ?></h3>
                            <div class="job-badges">
                                <?php if ($job['department']): ?><span class="job-badge badge-dept"><?= htmlspecialchars($job['department']) ?></span><?php endif; ?>
                                <?php if ($job['type']): ?><span class="job-badge badge-type"><?= htmlspecialchars($job['type']) ?></span><?php endif; ?>
                                <?php if ($job['location']): ?><span class="job-badge badge-loc"><i class="fas fa-map-marker-alt" style="margin-right:4px;font-size:0.65rem;"></i><?= htmlspecialchars($job['location']) ?></span><?php endif; ?>
                                <?php if ($job['experience']): ?><span class="job-badge badge-exp"><?= htmlspecialchars($job['experience']) ?></span><?php endif; ?>
                                <?php if (!empty($job['salary'])): ?><span class="job-badge" style="background:rgba(34,197,94,0.12); color:#22c55e; border:1px solid rgba(34,197,94,0.25);"><i class="fas fa-money-bill-wave" style="margin-right:4px;font-size:0.65rem;"></i><?= htmlspecialchars($job['salary']) ?></span><?php endif; ?>
                            </div>
                        </div>
                        <?php if ($job['description']): ?>
                        <p class="job-desc"><?= nl2br(htmlspecialchars(substr($job['description'], 0, 280))) ?><?= strlen($job['description']) > 280 ? '...' : '' ?></p>
                        <?php endif; ?>
                        <div class="job-card-footer" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <span class="job-posted"><i class="fas fa-clock" style="margin-right:5px;"></i>Posted <?= date('d M Y', strtotime($job['date_created'])) ?></span>
                            <div style="display: flex; gap: 10px;">
                                <button class="apply-btn" style="background: rgba(255,255,255,0.06); box-shadow: none; border: 1px solid rgba(255,255,255,0.12);" onclick="showJobDetails(this, <?= $job['id'] ?>, '<?= htmlspecialchars($job['title'], ENT_QUOTES) ?>', '<?= htmlspecialchars($job['department'], ENT_QUOTES) ?>', '<?= htmlspecialchars($job['type'], ENT_QUOTES) ?>', '<?= htmlspecialchars($job['location'], ENT_QUOTES) ?>', '<?= htmlspecialchars($job['experience'], ENT_QUOTES) ?>')">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="apply-btn" onclick="openModal(<?= $job['id'] ?>, '<?= htmlspecialchars($job['title'], ENT_QUOTES) ?>')">
                                    <i class="fas fa-paper-plane"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- General Application Banner -->
                <div class="general-apply-banner" style="margin-top: 50px; background: rgba(15, 23, 42, 0.45); border: 1px solid rgba(59, 130, 246, 0.15); border-radius: 12px; padding: 30px; text-align: center; backdrop-filter: blur(12px);">
                    <h3 style="color:#fff; font-size:1.3rem; font-weight:700; margin-bottom:8px;">Don't see a fitting role?</h3>
                    <p style="color:#a9a9a9; font-size:0.95rem; margin-bottom:0;">We are always on the lookout for elite security talent. Send your CV directly to <a href="mailto:careers@advertresources.com" style="color:#60a5fa; font-weight:600; text-decoration:none;">careers@advertresources.com</a></p>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal-overlay" id="applyModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        <div class="modal-title">Apply for <span id="modal-job-title" style="color:#60a5fa;"></span></div>
        <div class="modal-sub">Fill in your details and we'll get back to you within 48 hours.</div>

        <?php if ($apply_success): ?>
        <div class="alert-success"><i class="fas fa-check-circle"></i> Application submitted successfully! We'll contact you soon.</div>
        <?php elseif ($apply_error): ?>
        <div class="alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($apply_error) ?></div>
        <?php endif; ?>

        <form method="POST" action="careers.php#open-roles" enctype="multipart/form-data">
            <input type="hidden" name="submit_application" value="1">
            <input type="hidden" name="job_id" id="modal-job-id" value="">
            <div class="form-group">
                <label class="form-label">Full Name <span style="color:#ef4444;">*</span></label>
                <input type="text" name="applicant_name" class="form-control" placeholder="John Smith" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address <span style="color:#ef4444;">*</span></label>
                <input type="email" name="applicant_email" class="form-control" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="applicant_phone" class="form-control" placeholder="+1 234 567 8901">
            </div>
            <div class="form-group">
                <label class="form-label">Cover Message</label>
                <textarea name="cover_message" class="form-control" rows="4" placeholder="Tell us about yourself and why you're a great fit..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-file-upload" style="margin-right:6px; color:#3c72fc;"></i>Upload CV / Resume <span style="color:#94a3b8; font-weight:400; font-size:0.75rem;">(PDF, DOC, DOCX — max 5 MB)</span></label>
                <label for="cv_file" id="cv-drop-zone" style="display:block; padding:24px; background:rgba(255,255,255,0.03); border:2px dashed rgba(59,130,246,0.3); border-radius:12px; text-align:center; cursor:pointer; transition:all 0.3s;">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2rem; color:#3c72fc; display:block; margin-bottom:10px;"></i>
                    <span id="cv-filename" style="color:#94a3b8; font-size:0.9rem;">Click to browse or drag & drop your CV here</span>
                </label>
                <input type="file" name="cv_file" id="cv_file" accept=".pdf,.doc,.docx" style="display:none;" onchange="updateCVLabel(this)">
            </div>
            <button type="submit" class="submit-btn"><i class="fas fa-paper-plane" style="margin-right:8px;"></i>Submit Application</button>
        </form>
    </div>
</div>

<!-- Details Modal -->
<div class="modal-overlay" id="detailsModal">
    <div class="modal-box" style="max-width: 720px;">
        <button class="modal-close" onclick="closeDetailsModal()"><i class="fas fa-times"></i></button>
        <div class="modal-title" id="details-job-title" style="color: #fff; font-size: 1.8rem; font-weight: 800; font-family: 'Space Grotesk', sans-serif;"></div>
        <div class="job-badges" id="details-job-badges" style="margin-top: 10px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 8px;"></div>
        
        <div style="max-height: 400px; overflow-y: auto; padding-right: 10px; text-align: left;">
            <h4 style="color: #3c72fc; font-size: 1.1rem; font-weight: 700; margin-bottom: 12px; font-family: 'Space Grotesk', sans-serif; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-file-alt"></i> Job Description
            </h4>
            <div id="details-job-desc" style="color: #a9a9a9; font-size: 0.95rem; line-height: 1.6; margin-bottom: 25px; white-space: pre-line; font-family: 'Kumbh Sans', sans-serif;"></div>
            
            <h4 style="color: #3c72fc; font-size: 1.1rem; font-weight: 700; margin-bottom: 12px; font-family: 'Space Grotesk', sans-serif; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-list-check"></i> Key Requirements
            </h4>
            <div id="details-job-reqs" style="color: #a9a9a9; font-size: 0.95rem; line-height: 1.6; white-space: pre-line; font-family: 'Kumbh Sans', sans-serif;"></div>
        </div>
        
        <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 12px;">
            <button class="apply-btn" style="background: rgba(255,255,255,0.06); box-shadow: none; border: 1px solid rgba(255,255,255,0.12);" onclick="closeDetailsModal()">Close</button>
            <button class="apply-btn" id="details-apply-btn">Apply Now <i class="fas fa-paper-plane" style="margin-left:8px;"></i></button>
        </div>
    </div>
</div>

<script>
function openModal(jobId, jobTitle) {
    document.getElementById('modal-job-id').value = jobId;
    document.getElementById('modal-job-title').textContent = jobTitle;
    document.getElementById('applyModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('applyModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.getElementById('applyModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

function updateCVLabel(input) {
    const label    = document.getElementById('cv-filename');
    const dropZone = document.getElementById('cv-drop-zone');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        label.innerHTML = '<i class="fas fa-file-check" style="color:#22c55e; margin-right:6px;"></i><strong style="color:#fff;">' + file.name + '</strong> <span style="color:#64748b;">(' + sizeMB + ' MB)</span>';
        dropZone.style.borderColor = 'rgba(34,197,94,0.5)';
        dropZone.style.background  = 'rgba(34,197,94,0.05)';
    }
}

// Drag & drop styling
document.addEventListener('DOMContentLoaded', function() {
    const dz = document.getElementById('cv-drop-zone');
    if (!dz) return;
    dz.addEventListener('dragover', function(e) {
        e.preventDefault();
        dz.style.borderColor = '#3c72fc';
        dz.style.background  = 'rgba(60,114,252,0.07)';
    });
    dz.addEventListener('dragleave', function() {
        dz.style.borderColor = 'rgba(59,130,246,0.3)';
        dz.style.background  = 'rgba(255,255,255,0.03)';
    });
    dz.addEventListener('drop', function(e) {
        e.preventDefault();
        const fileInput = document.getElementById('cv_file');
        fileInput.files = e.dataTransfer.files;
        updateCVLabel(fileInput);
    });
});

function closeDetailsModal() {
    document.getElementById('detailsModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.getElementById('detailsModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetailsModal();
});

function showJobDetails(btn, id, title, dept, type, loc, exp) {
    const card = btn.closest('.job-card');
    const dataEl = card.querySelector('.job-details-data');
    const desc   = dataEl.dataset.desc   || 'No description provided.';
    const reqs   = dataEl.dataset.reqs   || 'No specific requirements listed.';
    const salary = dataEl.dataset.salary || '';

    document.getElementById('details-job-title').textContent = title;
    
    let badgeHtml = '';
    if (dept)   badgeHtml += `<span class="job-badge badge-dept" style="background: rgba(37,99,235,0.15); color: #60a5fa; border: 1px solid rgba(37,99,235,0.3); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">${dept}</span>`;
    if (type)   badgeHtml += `<span class="job-badge badge-type" style="background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.3); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">${type}</span>`;
    if (loc)    badgeHtml += `<span class="job-badge badge-loc" style="background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600;"><i class="fas fa-map-marker-alt" style="margin-right:4px;"></i>${loc}</span>`;
    if (exp)    badgeHtml += `<span class="job-badge badge-exp" style="background: rgba(139,92,246,0.15); color: #a78bfa; border: 1px solid rgba(139,92,246,0.3); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">${exp}</span>`;
    if (salary) badgeHtml += `<span style="background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600;"><i class="fas fa-money-bill-wave" style="margin-right:4px;"></i>${salary}</span>`;
    
    document.getElementById('details-job-badges').innerHTML = badgeHtml;
    document.getElementById('details-job-desc').textContent = desc;
    document.getElementById('details-job-reqs').textContent = reqs;

    document.getElementById('details-apply-btn').onclick = function() {
        closeDetailsModal();
        openModal(id, title);
    };

    document.getElementById('detailsModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function filterJobs(dept, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.job-card').forEach(card => {
        if (dept === 'all' || card.dataset.dept === dept) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

<?php if ($apply_success): ?>
// Show success message and clear form
window.addEventListener('load', function() {
    alert("Application submitted successfully! Our recruitment team will review it and contact you soon.");
});
<?php elseif ($apply_error): ?>
// Reopen modal to show error
window.addEventListener('load', function() {
    document.getElementById('applyModal').classList.add('open');
});
<?php endif; ?>
</script>

<?php include 'footer.php'; ?>
