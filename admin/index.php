<?php
session_start();
require_once '../db.php';

// Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Fetch all database records for Dashboard stats
try {
    $enquiries = $db->query("SELECT * FROM enquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    $careers   = $db->query("SELECT * FROM careers ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
    $db->exec("CREATE TABLE IF NOT EXISTS career_applications (id INTEGER PRIMARY KEY AUTOINCREMENT, job_id INTEGER, name TEXT, email TEXT, phone TEXT, cover_message TEXT, applied_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
    $applications = $db->query("SELECT ca.*, c.title as job_title FROM career_applications ca LEFT JOIN careers c ON ca.job_id = c.id ORDER BY ca.applied_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch blogs
    $db->exec("CREATE TABLE IF NOT EXISTS blogs (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, category TEXT, author TEXT, summary TEXT, content TEXT, image TEXT, date_created DATETIME DEFAULT CURRENT_TIMESTAMP)");
    $blogs = $db->query("SELECT * FROM blogs ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $enquiries = []; $careers = []; $applications = []; $blogs = [];
}
?>
<?php require_once 'includes/header.php'; ?>

<div class="welcome-header mb-4" style="margin-bottom: 25px;">
    <div class="welcome-title">
        <h2 style="font-size:1.8rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">System Status & Telemetry</h2>
        <p style="color:#94a3b8; font-size:0.95rem;">Welcome back to Cyber Command. Here is the operational overview.</p>
    </div>
</div>
<div class="row gy-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Enquiries</div>
            <div class="stat-value"><?= count($enquiries) ?></div>
            <i class="far fa-inbox-in stat-icon"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-label">Active Job Postings</div>
            <div class="stat-value"><?= count($careers) ?></div>
            <i class="far fa-briefcase stat-icon"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="stat-label">Job Applications</div>
            <div class="stat-value"><?= count($applications) ?></div>
            <i class="far fa-file-user stat-icon"></i>
        </div>
    </div>
</div>

<!-- SECTION 1: DASHBOARD INDEX -->
        <div id="tab-dashboard" class="tab-section active">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="glass-panel" style="height: 100%;">
                        <div class="panel-header">
                            <h2>Recent Telemetry Enquiries</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="cyber-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($enquiries)): ?>
                                        <tr><td colspan="3" style="text-align: center;">No enquiries registered.</td></tr>
                                    <?php else: ?>
                                        <?php $limit = min(5, count($enquiries)); for ($i=0; $i<$limit; $i++): $enq = $enquiries[$i]; ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($enq['name']); ?></td>
                                                <td><span class="badge-tag"><?php echo htmlspecialchars($enq['service']); ?></span></td>
                                                <td><?php echo date('M d, Y', strtotime($enq['created_at'])); ?></td>
                                            </tr>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="glass-panel" style="height: 100%;">
                        <div class="panel-header">
                            <h2>Recent Job Applications</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="cyber-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($applications)): ?>
                                        <tr><td colspan="3" style="text-align: center;">No applications received yet.</td></tr>
                                    <?php else: ?>
                                        <?php $limit = min(5, count($applications)); for ($i=0; $i<$limit; $i++): $app = $applications[$i]; ?>
                                            <tr>
                                                <td style="font-weight:600; color:#fff;"><?php echo htmlspecialchars($app['name']); ?></td>
                                                <td><span class="badge-tag"><?php echo htmlspecialchars($app['job_title'] ?: 'Unknown'); ?></span></td>
                                                <td><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></td>
                                            </tr>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
<?php require_once 'includes/footer.php'; ?>
