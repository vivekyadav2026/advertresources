<?php
require_once 'includes/header.php';

$success = "";
$error   = "";

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

<style>
/* ── Job Details Modal ── */
.jd-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(6px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.jd-overlay.open { display: flex; }

.jd-modal {
    background: linear-gradient(135deg, rgba(15,23,42,0.97), rgba(30,41,59,0.97));
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 36px 40px;
    max-width: 720px;
    width: 100%;
    max-height: 88vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(60,114,252,0.1);
    animation: jdSlideIn 0.28s ease;
}
@keyframes jdSlideIn {
    from { opacity:0; transform:translateY(24px) scale(0.97); }
    to   { opacity:1; transform:translateY(0)    scale(1);    }
}

.jd-close {
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
.jd-close:hover { background: rgba(239,68,68,0.2); color:#ef4444; border-color:rgba(239,68,68,0.3); }

.jd-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 14px;
    padding-right: 40px;
    line-height: 1.3;
}

.jd-badges { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:24px; }
.jd-badge  { padding:5px 12px; border-radius:7px; font-size:0.75rem; font-weight:700; }

.jd-section { margin-bottom:24px; }
.jd-section-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.85rem;
    font-weight: 700;
    color: #3c72fc;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.jd-section-title::after {
    content:'';
    flex:1;
    height:1px;
    background: linear-gradient(90deg, rgba(60,114,252,0.3), transparent);
}
.jd-text {
    color: #94a3b8;
    font-size: 0.93rem;
    line-height: 1.75;
    white-space: pre-line;
    font-family: 'Kumbh Sans', sans-serif;
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 10px;
    padding: 16px 18px;
}

.jd-meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
    margin-bottom: 24px;
}
.jd-meta-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px;
    padding: 14px 16px;
}
.jd-meta-card .meta-label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #475569;
    margin-bottom: 6px;
}
.jd-meta-card .meta-val {
    font-size: 0.92rem;
    font-weight: 600;
    color: #e2e8f0;
}

.jd-footer {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.06);
}
</style>

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
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($careers)): ?>
                    <tr><td colspan="7" style="text-align:center;">No job listings yet. Post your first job!</td></tr>
                <?php else: ?>
                    <?php foreach ($careers as $job): ?>
                    <tr>
                        <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($job['title']) ?></td>
                        <td><?= htmlspecialchars($job['department'] ?: '-') ?></td>
                        <td><?= htmlspecialchars($job['location'] ?: '-') ?></td>
                        <td>
                            <?php if (!empty($job['salary'])): ?>
                                <span style="color:#22c55e; font-weight:600; font-size:0.85rem;"><?= htmlspecialchars($job['salary']) ?></span>
                            <?php else: ?>
                                <span style="color:#475569;">-</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge-tag"><?= htmlspecialchars($job['type']) ?></span></td>
                        <td>
                            <?php if ($job['is_active']): ?>
                                <span class="badge-tag" style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);color:#10b981;">Live</span>
                            <?php else: ?>
                                <span class="badge-tag" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#ef4444;">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td style="white-space:nowrap; display:flex; gap:8px; flex-wrap:wrap;">
                            <button
                                onclick='showJobDetails(<?= htmlspecialchars(json_encode($job), ENT_QUOTES) ?>)'
                                class="btn-view"
                                style="border:none; cursor:pointer; background:rgba(60,114,252,0.15); color:#60a5fa; border:1px solid rgba(60,114,252,0.3);">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <a href="career_edit.php?id=<?= $job['id'] ?>" class="btn-view" style="display:inline-flex; align-items:center; gap:5px;">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <a href="?delete=<?= $job['id'] ?>" class="btn-delete" style="display:inline-flex; align-items:center; gap:5px;" onclick="return confirm('Delete this job listing?')">
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

<!-- ── Job Details Modal ── -->
<div class="jd-overlay" id="jdOverlay" onclick="if(event.target===this) closeJD()">
    <div class="jd-modal">
        <button class="jd-close" onclick="closeJD()"><i class="fas fa-times"></i></button>

        <div class="jd-title" id="jd-title"></div>

        <div class="jd-badges" id="jd-badges"></div>

        <div class="jd-meta-grid" id="jd-meta"></div>

        <div class="jd-section" id="jd-desc-wrap">
            <div class="jd-section-title"><i class="fas fa-file-alt"></i> Job Description</div>
            <div class="jd-text" id="jd-desc"></div>
        </div>

        <div class="jd-section" id="jd-req-wrap">
            <div class="jd-section-title"><i class="fas fa-list-check"></i> Requirements</div>
            <div class="jd-text" id="jd-req"></div>
        </div>

        <div class="jd-footer">
            <button onclick="closeJD()" style="padding:10px 22px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#94a3b8; cursor:pointer; font-family:'Space Grotesk',sans-serif; font-weight:600;">
                Close
            </button>
            <a id="jd-edit-btn" href="#" class="btn-action" style="text-decoration:none; padding:10px 22px;">
                <i class="fas fa-pen"></i> Edit Job
            </a>
        </div>
    </div>
</div>

<script>
function showJobDetails(job) {
    // Title
    document.getElementById('jd-title').textContent = job.title;

    // Badges
    const statusColor = job.is_active == 1
        ? { bg:'rgba(16,185,129,0.15)', color:'#10b981', border:'rgba(16,185,129,0.3)', label:'● Live' }
        : { bg:'rgba(239,68,68,0.15)',  color:'#ef4444', border:'rgba(239,68,68,0.3)',  label:'○ Draft' };

    let badges = `<span class="jd-badge" style="background:${statusColor.bg}; color:${statusColor.color}; border:1px solid ${statusColor.border};">${statusColor.label}</span>`;
    if (job.type)       badges += `<span class="jd-badge" style="background:rgba(60,114,252,0.15); color:#60a5fa; border:1px solid rgba(60,114,252,0.3);">${job.type}</span>`;
    if (job.department) badges += `<span class="jd-badge" style="background:rgba(139,92,246,0.15); color:#a78bfa; border:1px solid rgba(139,92,246,0.3);">${job.department}</span>`;
    document.getElementById('jd-badges').innerHTML = badges;

    // Meta cards
    const metas = [
        { icon:'fa-map-marker-alt', label:'Location',   val: job.location   || '—' },
        { icon:'fa-briefcase',      label:'Experience', val: job.experience || '—' },
        { icon:'fa-money-bill-wave',label:'Salary',     val: job.salary     || 'Not specified', color: job.salary ? '#22c55e' : '' },
        { icon:'fa-calendar-alt',   label:'Posted',     val: job.date_created ? job.date_created.split(' ')[0] : '—' },
    ];
    document.getElementById('jd-meta').innerHTML = metas.map(m =>
        `<div class="jd-meta-card">
            <div class="meta-label"><i class="fas ${m.icon}" style="margin-right:5px;"></i>${m.label}</div>
            <div class="meta-val" style="${m.color ? 'color:'+m.color+';' : ''}">${m.val}</div>
        </div>`
    ).join('');

    // Description
    const descWrap = document.getElementById('jd-desc-wrap');
    const descEl   = document.getElementById('jd-desc');
    if (job.description) {
        descEl.textContent = job.description;
        descWrap.style.display = 'block';
    } else {
        descWrap.style.display = 'none';
    }

    // Requirements
    const reqWrap = document.getElementById('jd-req-wrap');
    const reqEl   = document.getElementById('jd-req');
    if (job.requirements) {
        reqEl.textContent = job.requirements;
        reqWrap.style.display = 'block';
    } else {
        reqWrap.style.display = 'none';
    }

    // Edit button
    document.getElementById('jd-edit-btn').href = 'career_edit.php?id=' + job.id;

    // Open overlay
    document.getElementById('jdOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeJD() {
    document.getElementById('jdOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeJD();
});
</script>

<?php require_once 'includes/footer.php'; ?>