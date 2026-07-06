<?php
require_once 'includes/header.php';

$success = "";
$error = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        $stmt = $db->prepare("DELETE FROM enquiries WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Enquiry removed from local register.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

try {
    $enquiries = $db->query("SELECT * FROM enquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $enquiries = [];
}
?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Transmission Enquiries Log</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Review all secure communications received from the front-end gateway.</p>
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
        <h2>Received Transmissions (<?= count($enquiries) ?>)</h2>
    </div>
    <div class="table-responsive">
        <table class="cyber-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($enquiries)): ?>
                    <tr><td colspan="6" style="text-align: center;">No transmission logs found.</td></tr>
                <?php else: ?>
                    <?php foreach ($enquiries as $enq): ?>
                        <tr>
                            <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($enq['name']) ?></td>
                            <td><?= htmlspecialchars($enq['email']) ?></td>
                            <td><?= htmlspecialchars($enq['company'] ?: 'Individual') ?></td>
                            <td><span class="badge-tag"><?= htmlspecialchars($enq['service']) ?></span></td>
                            <td><?= date('M d, H:i', strtotime($enq['created_at'])) ?></td>
                            <td>
                                <button type="button" class="btn-view" onclick='viewEnquiry(<?= json_encode($enq, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>Details</button>
                                <a href="?delete=<?= $enq['id'] ?>" class="btn-delete" style="text-decoration:none;" onclick="return confirm('Purge this enquiry from local log?')">Purge</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal CSS -->
<style>
.detail-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(3, 7, 18, 0.8); backdrop-filter: blur(8px); display: none; justify-content: center; align-items: center; z-index: 1000; }
.detail-modal { background: var(--admin-surface); border: 1px solid var(--admin-border); border-radius: 16px; padding: 30px; width: 90%; max-width: 600px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8); position: relative; }
.detail-close { position: absolute; top: 20px; right: 20px; background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; }
.detail-close:hover { color: #ffffff; }
</style>

<!-- Enquiry Detail Modal Overlay -->
<div id="enquiryModal" class="detail-overlay" onclick="closeEnquiryModalOnOverlay(event)">
    <div class="detail-modal">
        <button type="button" class="detail-close" onclick="closeEnquiryModal()">&times;</button>
        <h3 id="enqTitle" style="font-family: 'Space Grotesk', sans-serif; color: #ffffff; margin-bottom: 20px; font-weight: 800;">Enquiry Details</h3>
        
        <table class="cyber-table" style="margin-bottom: 20px;">
            <tr>
                <td style="font-weight: 700; width: 140px;">Company</td>
                <td id="enqCompany" style="color: #ffffff;">-</td>
            </tr>
            <tr>
                <td style="font-weight: 700;">Email Address</td>
                <td id="enqEmail" style="color: #ffffff;">-</td>
            </tr>
            <tr>
                <td style="font-weight: 700;">Phone Line</td>
                <td id="enqPhone" style="color: #ffffff;">-</td>
            </tr>
            <tr>
                <td style="font-weight: 700;">Country</td>
                <td id="enqCountry" style="color: #ffffff;">-</td>
            </tr>
            <tr>
                <td style="font-weight: 700;">Budget Scope</td>
                <td id="enqBudget" style="color: #ffffff;">-</td>
            </tr>
        </table>
        
        <div style="font-weight: 700; color: #ffffff; margin-bottom: 8px; font-size: 0.92rem;">Transmission Message Body:</div>
        <div id="enqMsg" style="background: rgba(5, 11, 24, 0.7); border: 1px solid rgba(255,255,255,0.06); padding: 15px; border-radius: 8px; font-size: 0.95rem; line-height: 1.6; max-height: 200px; overflow-y: auto;">
            Message goes here...
        </div>
    </div>
</div>

<script>
function viewEnquiry(enq) {
    document.getElementById('enqTitle').innerText = enq.name + " (" + enq.service.toUpperCase() + ")";
    document.getElementById('enqCompany').innerText = enq.company || 'Individual / Non-corporate';
    document.getElementById('enqEmail').innerText = enq.email;
    document.getElementById('enqPhone').innerText = enq.phone || 'No phone supplied';
    document.getElementById('enqCountry').innerText = enq.country || 'Not specified';
    document.getElementById('enqBudget').innerText = enq.budget || 'Not declared';
    document.getElementById('enqMsg').innerText = enq.message;
    
    document.getElementById('enquiryModal').style.display = 'flex';
}
function closeEnquiryModal() { document.getElementById('enquiryModal').style.display = 'none'; }
function closeEnquiryModalOnOverlay(event) { if (event.target.id === 'enquiryModal') { closeEnquiryModal(); } }
</script>

<?php require_once 'includes/footer.php'; ?>