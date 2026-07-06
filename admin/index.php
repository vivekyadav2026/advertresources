<?php
session_start();
require_once '../db.php';

// Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$success = "";
$error = "";

// 1. Process Settings Form
if (isset($_POST['update_settings'])) {
    $keys = ['address', 'phone1', 'phone2', 'email1', 'email2', 'hours', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_pass', 'smtp_secure', 'smtp_from_name'];
    try {
        foreach ($keys as $key) {
            if (isset($_POST[$key])) {
                $stmt = $db->prepare("UPDATE settings SET value = :val WHERE key = :key");
                $stmt->execute([':val' => $_POST[$key], ':key' => $key]);
            }
        }
        $success = "Security gateway settings updated successfully.";
    } catch (Exception $e) {
        $error = "Settings update failed: " . $e->getMessage();
    }
}

// 2. Process Blog Addition/Edit Form
if (isset($_POST['save_blog'])) {
    $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $author = $_POST['author'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $content = $_POST['content'] ?? '';
    $image_url = $_POST['image_url'] ?? '';
    
    // Process image file upload if exists
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image_file']['tmp_name'];
        $file_name = $_FILES['image_file']['name'];
        $upload_dir = '../uploads/';
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $dest_path = $upload_dir . time() . '_' . $file_name;
        if (move_uploaded_file($file_tmp, $dest_path)) {
            $image_url = 'uploads/' . time() . '_' . $file_name; // Relative path
        }
    }
    
    if (empty($image_url) && $blog_id > 0) {
        // Keep existing image if editing and no new URL/upload is supplied
        try {
            $img_stmt = $db->prepare("SELECT image FROM blogs WHERE id = :id");
            $img_stmt->execute([':id' => $blog_id]);
            $image_url = $img_stmt->fetchColumn();
        } catch (Exception $e) {}
    }
    
    if (empty($image_url)) {
        $image_url = 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800'; // Default placeholder
    }
    
    if (!empty($title) && !empty($content)) {
        try {
            if ($blog_id > 0) {
                $stmt = $db->prepare("UPDATE blogs SET title = :title, category = :category, author = :author, summary = :summary, content = :content, image = :image WHERE id = :id");
                $stmt->execute([
                    ':title' => $title,
                    ':category' => $category,
                    ':author' => $author,
                    ':summary' => $summary,
                    ':content' => $content,
                    ':image' => $image_url,
                    ':id' => $blog_id
                ]);
                $success = "Intelligence brief updated successfully.";
            } else {
                $stmt = $db->prepare("INSERT INTO blogs (title, category, author, summary, content, image) VALUES (:title, :category, :author, :summary, :content, :image)");
                $stmt->execute([
                    ':title' => $title,
                    ':category' => $category,
                    ':author' => $author,
                    ':summary' => $summary,
                    ':content' => $content,
                    ':image' => $image_url
                ]);
                $success = "New intelligence brief indexed successfully.";
            }
        } catch (Exception $e) {
            $error = "Blog save failed: " . $e->getMessage();
        }
    } else {
        $error = "Title and Content are required fields.";
    }
}

// 3. Process Delete Enquiries
if (isset($_GET['delete_enquiry'])) {
    $id = intval($_GET['delete_enquiry']);
    try {
        $stmt = $db->prepare("DELETE FROM enquiries WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Enquiry removed from local register.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

// 4. Process Add/Edit Career Job
if (isset($_POST['save_career'])) {
    $career_id   = intval($_POST['career_id'] ?? 0);
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
            if ($career_id > 0) {
                $stmt = $db->prepare("UPDATE careers SET title=:title, department=:dept, location=:loc, type=:type, experience=:exp, description=:desc, requirements=:req, is_active=:active WHERE id=:id");
                $stmt->execute([':title'=>$title,':dept'=>$department,':loc'=>$location,':type'=>$type,':exp'=>$experience,':desc'=>$description,':req'=>$requirements,':active'=>$is_active,':id'=>$career_id]);
                $success = "Job listing updated successfully.";
            } else {
                $stmt = $db->prepare("INSERT INTO careers (title, department, location, type, experience, description, requirements, is_active) VALUES (:title,:dept,:loc,:type,:exp,:desc,:req,:active)");
                $stmt->execute([':title'=>$title,':dept'=>$department,':loc'=>$location,':type'=>$type,':exp'=>$experience,':desc'=>$description,':req'=>$requirements,':active'=>$is_active]);
                $success = "New job listing published.";
            }
        } catch (Exception $e) {
            $error = "Save failed: " . $e->getMessage();
        }
    } else {
        $error = "Job title is required.";
    }
}

// 5. Process Delete Career
if (isset($_GET['delete_career'])) {
    $id = intval($_GET['delete_career']);
    try {
        $stmt = $db->prepare("DELETE FROM careers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Job listing removed.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

// 6. Process Delete Application
if (isset($_GET['delete_application'])) {
    $id = intval($_GET['delete_application']);
    try {
        $db->exec("CREATE TABLE IF NOT EXISTS career_applications (id INTEGER PRIMARY KEY AUTOINCREMENT, job_id INTEGER, name TEXT, email TEXT, phone TEXT, cover_message TEXT, applied_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
        $stmt = $db->prepare("DELETE FROM career_applications WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $success = "Application removed.";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

// Fetch all database records
try {
    $enquiries = $db->query("SELECT * FROM enquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    $careers   = $db->query("SELECT * FROM careers ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
    $db->exec("CREATE TABLE IF NOT EXISTS career_applications (id INTEGER PRIMARY KEY AUTOINCREMENT, job_id INTEGER, name TEXT, email TEXT, phone TEXT, cover_message TEXT, applied_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
    $applications = $db->query("SELECT ca.*, c.title as job_title FROM career_applications ca LEFT JOIN careers c ON ca.job_id = c.id ORDER BY ca.applied_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    $edit_career = null;
    if (isset($_GET['edit_career'])) {
        $eid = intval($_GET['edit_career']);
        $stmt = $db->prepare("SELECT * FROM careers WHERE id = :id");
        $stmt->execute([':id' => $eid]);
        $edit_career = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $enquiries = []; $careers = []; $applications = []; $edit_career = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Command - Console Admin</title>
    <link rel="stylesheet" href="../index/app.min.css" />
    <link rel="stylesheet" href="../index/fontawesome.min.css" />
    <style>
        body {
            background-color: #050B18;
            font-family: 'Space Grotesk', sans-serif;
            color: #cbd5e1;
            margin: 0;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Grid Overlay */
        .admin-grid {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(rgba(37, 99, 235, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 0;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 260px;
            background: rgba(15, 23, 42, 0.85);
            border-right: 1px solid rgba(224, 0, 155, 0.2);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            font-weight: 800;
            font-size: 1.2rem;
            margin-bottom: 40px;
            padding-left: 10px;
        }
        .sidebar-logo i {
            color: #E0009B;
            filter: drop-shadow(0 0 8px rgba(224,0,155,0.5));
        }
        
        .nav-menu {
            list-style: none;
            padding: 0; margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            padding: 14px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .nav-item:hover, .nav-item.active {
            color: #ffffff;
            background: rgba(224, 0, 155, 0.1);
            border: 1px solid rgba(224, 0, 155, 0.25);
        }
        
        .nav-item.active i {
            color: #E0009B;
        }
        
        .logout-btn {
            margin-top: auto;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            background: rgba(239, 68, 68, 0.05);
        }
        
        .logout-btn:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(239,68,68,0.3);
        }
        
        /* Main Panel Content Area */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            flex-grow: 1;
            position: relative;
            z-index: 5;
            box-sizing: border-box;
            width: calc(100% - 260px);
        }
        
        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }
        
        .welcome-title h1 {
            font-family: 'Space Grotesk', sans-serif;
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 800;
            margin: 0 0 5px 0;
        }
        .welcome-title p {
            color: #64748b;
            margin: 0;
        }
        
        /* Metrics Counters Row */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }
        
        .metric-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }
        
        .metric-val h3 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 4px 0;
        }
        .metric-val p {
            color: #94a3b8;
            font-size: 0.9rem;
            margin: 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .metric-icon {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .metric-icon.pink { background: rgba(224, 0, 155, 0.1); color: #E0009B; border: 1px solid rgba(224, 0, 155, 0.2); }
        .metric-icon.blue { background: rgba(60, 114, 252, 0.1); color: #3C72FC; border: 1px solid rgba(60, 114, 252, 0.2); }
        .metric-icon.purple { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; border: 1px solid rgba(139, 92, 246, 0.2); }
        .metric-icon.green { background: rgba(6, 152, 69, 0.1); color: #069845; border: 1px solid rgba(6, 152, 69, 0.2); }
        
        /* Glass Panel Section */
        .glass-panel {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            backdrop-filter: blur(12px);
        }
        
        .panel-header {
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 15px;
        }
        .panel-header h2 {
            font-family: 'Space Grotesk', sans-serif;
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0;
        }
        
        /* Forms styling */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-group label {
            font-weight: 600;
            color: #ffffff;
            font-size: 0.9rem;
        }
        
        .form-group input, .form-group textarea, .form-group select {
            background: rgba(5, 11, 24, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            padding: 12px 14px;
            color: #ffffff;
            font-family: 'Kumbh Sans', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #E0009B;
            outline: none;
        }
        
        .btn-action {
            background: linear-gradient(135deg, #3C72FC, #E0009B);
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-action:hover {
            box-shadow: 0 5px 20px rgba(224, 0, 155, 0.3);
            transform: translateY(-1px);
        }
        
        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
        }
        
        .cyber-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        
        .cyber-table th {
            background: rgba(5, 11, 24, 0.6);
            color: #ffffff;
            font-weight: 700;
            padding: 14px 18px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.08);
        }
        
        .cyber-table td {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.92rem;
        }
        
        .cyber-table tr:hover td {
            background: rgba(255, 255, 255, 0.02);
            color: #ffffff;
        }
        
        .badge-tag {
            background: rgba(60, 114, 252, 0.15);
            border: 1px solid rgba(60, 114, 252, 0.3);
            color: #60a5fa;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .btn-delete {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-delete:hover {
            background: #ef4444;
            color: #ffffff;
        }
        
        .btn-view {
            color: #60a5fa;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.25);
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            margin-right: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-view:hover {
            background: #3b82f6;
            color: #ffffff;
        }
        
        /* Banner notifications */
        .alert-banner {
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        .alert-banner.success {
            background: rgba(6, 152, 69, 0.1);
            border: 1px solid rgba(6, 152, 69, 0.3);
            color: #069845;
        }
        .alert-banner.error {
            background: rgba(224, 0, 155, 0.1);
            border: 1px solid rgba(224, 0, 155, 0.3);
            color: #E0009B;
        }
        
        /* Tabs switching control */
        .tab-section {
            display: none;
        }
        .tab-section.active {
            display: block;
        }
        
        /* Modal Popup detail */
        .detail-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 11, 24, 0.8);
            backdrop-filter: blur(8px);
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .detail-modal {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(224, 0, 155, 0.3);
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            padding: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.7);
            position: relative;
        }
        .detail-close {
            position: absolute;
            top: 20px; right: 20px;
            background: none; border: none;
            color: #94a3b8; font-size: 1.5rem;
            cursor: pointer;
        }
        .detail-close:hover { color: #ffffff; }
    </style>
</head>
<body>
    <div class="admin-grid"></div>
    
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-shield-virus"></i> CYBER COMMAND
        </div>
        <ul class="nav-menu">
            <li><a class="nav-item active" onclick="switchTab('dashboard', this)"><i class="far fa-chart-network"></i> Dashboard</a></li>
            <li><a class="nav-item" onclick="switchTab('enquiries', this)"><i class="far fa-inbox-in"></i> Enquiries</a></li>
            <li><a class="nav-item" onclick="switchTab('careers', this)"><i class="far fa-briefcase"></i> Careers</a></li>
            <li><a class="nav-item" onclick="switchTab('settings', this)"><i class="far fa-cogs"></i> Contact Settings</a></li>
            <li><a href="logout.php" class="nav-item logout-btn"><i class="far fa-power-off"></i> Terminate Session</a></li>
        </ul>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Notifications -->
        <?php if (!empty($success)): ?>
            <div class="alert-banner success">
                <i class="fas fa-check-circle"></i>
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert-banner error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <!-- Welcome Header -->
        <div class="welcome-header">
            <div class="welcome-title">
                <h1>ADMIN CONTROL CENTRE</h1>
                <p>Welcome back, Commander. All security modules are online.</p>
            </div>
        </div>
        
        <!-- Metrics Row -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-val">
                    <h3><?php echo count($enquiries); ?></h3>
                    <p>Total Enquiries</p>
                </div>
                <div class="metric-icon pink">
                    <i class="far fa-inbox-in"></i>
                </div>
            </div>
            
            <div class="metric-card">
                <div class="metric-val">
                    <h3><?php echo count($blogs); ?></h3>
                    <p>Indexed Blogs</p>
                </div>
                <div class="metric-icon blue">
                    <i class="far fa-newspaper"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-val">
                    <h3><?php echo count($gallery); ?></h3>
                    <p>Gallery Items</p>
                </div>
                <div class="metric-icon purple">
                    <i class="far fa-images"></i>
                </div>
            </div>
            
            <div class="metric-card">
                <div class="metric-val">
                    <h3>ACTIVE</h3>
                    <p>SQLite Gateway</p>
                </div>
                <div class="metric-icon green">
                    <i class="fas fa-database"></i>
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
                            <h2>Live Network Settings</h2>
                        </div>
                        <table class="cyber-table">
                            <tr>
                                <th style="border: none;">Module</th>
                                <th style="border: none;">Parameters</th>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td style="color: #ffffff;"><?php echo htmlspecialchars(getSetting('address')); ?></td>
                            </tr>
                            <tr>
                                <td>Phone 1</td>
                                <td style="color: #ffffff;"><?php echo htmlspecialchars(getSetting('phone1')); ?></td>
                            </tr>
                            <tr>
                                <td>Business Email</td>
                                <td style="color: #ffffff;"><?php echo htmlspecialchars(getSetting('email1')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SECTION 2: ENQUIRIES INDEX -->
        <div id="tab-enquiries" class="tab-section">
            <div class="glass-panel">
                <div class="panel-header">
                    <h2>Transmission Enquiries Register</h2>
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
                                        <td><?php echo htmlspecialchars($enq['name']); ?></td>
                                        <td><?php echo htmlspecialchars($enq['email']); ?></td>
                                        <td><?php echo htmlspecialchars($enq['company'] ?: 'Individual'); ?></td>
                                        <td><span class="badge-tag"><?php echo htmlspecialchars($enq['service']); ?></span></td>
                                        <td><?php echo date('M d, H:i', strtotime($enq['created_at'])); ?></td>
                                        <td>
                                            <button class="btn-view" onclick="viewEnquiry(<?php echo htmlspecialchars(json_encode($enq)); ?>)">Details</button>
                                            <a href="?delete_enquiry=<?php echo $enq['id']; ?>" class="btn-delete" onclick="return confirm('Purge this enquiry from local log?')">Purge</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- SECTION 3: MANAGE CAREERS -->
        <div id="tab-careers" class="tab-section">
            <!-- Add / Edit Form -->
            <div class="row gy-4 mb-4">
                <div class="col-lg-5">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2 id="careerFormTitle"><?= $edit_career ? 'Edit Job Listing' : 'Post New Job' ?></h2>
                        </div>
                        <form action="" method="POST" id="careerForm">
                            <input type="hidden" name="save_career" value="1">
                            <input type="hidden" name="career_id" id="career_id" value="<?= $edit_career ? $edit_career['id'] : 0 ?>">

                            <div class="form-group mb-3">
                                <label>Job Title *</label>
                                <input type="text" name="career_title" id="career_title" required placeholder="Senior Security Analyst" value="<?= $edit_career ? htmlspecialchars($edit_career['title']) : '' ?>">
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group">
                                    <label>Department</label>
                                    <input type="text" name="department" id="career_dept" placeholder="SOC / Red Team / Engineering" value="<?= $edit_career ? htmlspecialchars($edit_career['department']) : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" name="location" id="career_loc" placeholder="London / Remote" value="<?= $edit_career ? htmlspecialchars($edit_career['location']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group">
                                    <label>Job Type</label>
                                    <select name="job_type" id="career_type" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                                        <option value="Full-Time" <?= ($edit_career && $edit_career['type']=='Full-Time') ? 'selected' : '' ?>>Full-Time</option>
                                        <option value="Part-Time" <?= ($edit_career && $edit_career['type']=='Part-Time') ? 'selected' : '' ?>>Part-Time</option>
                                        <option value="Contract" <?= ($edit_career && $edit_career['type']=='Contract') ? 'selected' : '' ?>>Contract</option>
                                        <option value="Remote" <?= ($edit_career && $edit_career['type']=='Remote') ? 'selected' : '' ?>>Remote</option>
                                        <option value="Internship" <?= ($edit_career && $edit_career['type']=='Internship') ? 'selected' : '' ?>>Internship</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Experience Level</label>
                                    <input type="text" name="experience" id="career_exp" placeholder="3+ Years / Senior / Mid" value="<?= $edit_career ? htmlspecialchars($edit_career['experience']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Job Description *</label>
                                <textarea name="description" id="career_desc" rows="4" placeholder="Describe the role, responsibilities and goals..."><?= $edit_career ? htmlspecialchars($edit_career['description']) : '' ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Requirements</label>
                                <textarea name="requirements" id="career_req" rows="3" placeholder="Certifications, skills, qualifications..."><?= $edit_career ? htmlspecialchars($edit_career['requirements']) : '' ?></textarea>
                            </div>
                            <div class="form-group mb-4" style="display:flex; align-items:center; gap:12px;">
                                <input type="checkbox" name="is_active" id="is_active" value="1" <?= (!$edit_career || $edit_career['is_active']) ? 'checked' : '' ?> style="width:18px;height:18px;accent-color:#3C72FC;">
                                <label for="is_active" style="margin:0; font-size:0.85rem; color:#94a3b8;">Published (visible on careers page)</label>
                            </div>
                            <div style="display:flex; gap:10px;">
                                <button type="submit" class="btn-action" id="careerSubmitBtn"><?= $edit_career ? 'UPDATE JOB <i class="far fa-shield-check"></i>' : 'PUBLISH JOB <i class="far fa-paper-plane"></i>' ?></button>
                                <?php if ($edit_career): ?>
                                <a href="?" class="btn-action" style="background:rgba(255,255,255,0.05); box-shadow:none;">CANCEL</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Jobs List -->
                <div class="col-lg-7">
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
                                                <a href="?edit_career=<?= $job['id'] ?>" class="btn-view">Edit</a>
                                                <a href="?delete_career=<?= $job['id'] ?>" class="btn-delete" onclick="return confirm('Delete this job listing?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="glass-panel">
                <div class="panel-header">
                    <h2>Job Applications (<?= count($applications) ?>)</h2>
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
                                    <td><a href="?delete_application=<?= $app['id'] ?>" class="btn-delete" onclick="return confirm('Remove this application?')">Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2 id="blogFormTitle">Index Intel Briefing</h2>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="blogForm">
                            <input type="hidden" name="save_blog" value="1">
                            <input type="hidden" name="blog_id" id="blog_id" value="0">
                            
                            <div class="form-group mb-3">
                                <label for="title">Article Title</label>
                                <input type="text" name="title" id="title" required placeholder="Zero-Trust Eviction Lifecycle">
                            </div>
                            
                            <div class="form-row mb-3">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" name="category" id="category" placeholder="Threat Intel">
                                </div>
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" id="author" placeholder="Elias Vance">
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="summary">Article Summary (Short Description)</label>
                                <input type="text" name="summary" id="summary" placeholder="Brief technical summary under 120 characters...">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="image_url">Cover Image URL (Optional)</label>
                                <input type="text" name="image_url" id="image_url" placeholder="https://images.unsplash.com/photo-...">
                            </div>

                            <div class="form-group mb-3">
                                <label for="image_file">Or Upload Image File</label>
                                <input type="file" name="image_file" id="image_file" accept="image/*" style="padding: 8px;">
                                <div id="editImageNotice" style="font-size: 0.75rem; color: #8b5cf6; margin-top: 4px; display: none;">If editing, leave empty to retain current cover image.</div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="content">Full Article Content</label>
                                <textarea name="content" id="content" rows="8" required placeholder="Write detailed intelligence breakdown here..."></textarea>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn-action" id="blogSubmitBtn">INDEX BRIEF <i class="far fa-paper-plane"></i></button>
                                <button type="button" class="btn-delete" id="cancelBlogEditBtn" style="display: none;" onclick="cancelBlogEdit()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2>Indexed Security Articles</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="cyber-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($blogs)): ?>
                                        <tr><td colspan="4" style="text-align: center;">No articles indexed.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($blogs as $b): ?>
                                            <tr>
                                                <td style="font-weight: 700; color: #ffffff;"><?php echo htmlspecialchars($b['title']); ?></td>
                                                <td><span class="badge-tag"><?php echo htmlspecialchars($b['category']); ?></span></td>
                                                <td><?php echo htmlspecialchars($b['author']); ?></td>
                                                <td>
                                                    <button class="btn-view" onclick='editBlog(<?php echo json_encode($b, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>Edit</button>
                                                    <a href="?delete_blog=<?php echo $b['id']; ?>" class="btn-delete" onclick="return confirm('Purge this article from database index?')">Purge</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SECTION 4: MANAGE GALLERY -->
        <div id="tab-gallery" class="tab-section">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2>Index Gallery Diagram</h2>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="save_gallery" value="1">
                            
                            <div class="form-group mb-3">
                                <label for="gal_title">Diagram Title</label>
                                <input type="text" name="title" id="gal_title" required placeholder="SOC Operations Dashboard">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="gal_label">Catalog Reference Label (DIAG Code)</label>
                                <input type="text" name="label" id="gal_label" required placeholder="DIAG // 04 - Endpoint Shield Pipeline">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="gal_image_url">Cover Image URL (Optional)</label>
                                <input type="text" name="image_url" id="gal_image_url" placeholder="https://images.unsplash.com/photo-...">
                            </div>

                            <div class="form-group mb-4">
                                <label for="gal_image_file">Or Upload Image File</label>
                                <input type="file" name="image_file" id="gal_image_file" accept="image/*" style="padding: 8px;">
                            </div>
                            
                            <button type="submit" class="btn-action">INDEX DIAGRAM <i class="far fa-images"></i></button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2>Operational Visuals Catalog</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="cyber-table">
                                <thead>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Catalog Label</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($gallery)): ?>
                                        <tr><td colspan="4" style="text-align: center;">No visual logs indexed.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($gallery as $item): ?>
                                            <tr>
                                                <td>
                                                    <img src="../<?php echo htmlspecialchars($item['image']); ?>" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);" alt="thumb">
                                                </td>
                                                <td style="font-weight: 700; color: #ffffff;"><?php echo htmlspecialchars($item['title']); ?></td>
                                                <td><span class="badge-tag" style="background: rgba(139, 92, 246, 0.15); border-color: rgba(139, 92, 246, 0.3); color: #c084fc;"><?php echo htmlspecialchars($item['label']); ?></span></td>
                                                <td>
                                                    <a href="?delete_gallery=<?php echo $item['id']; ?>" class="btn-delete" onclick="return confirm('Purge this diagram from catalog index?')">Purge</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SECTION 5: CONTACT SETTINGS -->
        <div id="tab-settings" class="tab-section">
            <div class="glass-panel" style="max-width: 800px;">
                <div class="panel-header">
                    <h2>Gateway Parameter Configuration</h2>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="update_settings" value="1">
                    
                    <div class="form-group mb-3">
                        <label for="address">Corporate Address</label>
                        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars(getSetting('address')); ?>" required>
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="form-group">
                            <label for="phone1">Phone Line 1</label>
                            <input type="text" name="phone1" id="phone1" value="<?php echo htmlspecialchars(getSetting('phone1')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone2">Phone Line 2 (Backup)</label>
                            <input type="text" name="phone2" id="phone2" value="<?php echo htmlspecialchars(getSetting('phone2')); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="form-group">
                            <label for="email1">Business Email 1</label>
                            <input type="email" name="email1" id="email1" value="<?php echo htmlspecialchars(getSetting('email1')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email2">Business Email 2</label>
                            <input type="email" name="email2" id="email2" value="<?php echo htmlspecialchars(getSetting('email2')); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="hours">Opening / Operation Hours</label>
                        <input type="text" name="hours" id="hours" value="<?php echo htmlspecialchars(getSetting('hours')); ?>" required>
                    </div>
                    
                    <div style="margin: 30px 0 15px 0; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px;">
                        <h3 style="font-family: 'Space Grotesk', sans-serif; color: #ffffff; font-size: 1.15rem; font-weight: 800; margin-bottom: 15px;">SMTP Configuration (For Gmail / SMTP Delivery)</h3>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" name="smtp_host" id="smtp_host" value="<?php echo htmlspecialchars(getSetting('smtp_host', 'smtp.gmail.com')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="text" name="smtp_port" id="smtp_port" value="<?php echo htmlspecialchars(getSetting('smtp_port', '587')); ?>">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group">
                            <label for="smtp_user">SMTP Username / Email</label>
                            <input type="text" name="smtp_user" id="smtp_user" value="<?php echo htmlspecialchars(getSetting('smtp_user')); ?>" placeholder="e.g. your-email@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="smtp_pass">SMTP Password / App Password</label>
                            <input type="password" name="smtp_pass" id="smtp_pass" value="<?php echo htmlspecialchars(getSetting('smtp_pass')); ?>" placeholder="e.g. Gmail 16-character App Password">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group">
                            <label for="smtp_secure">SMTP Encryption</label>
                            <select name="smtp_secure" id="smtp_secure">
                                <option value="tls" <?php echo (getSetting('smtp_secure', 'tls') == 'tls') ? 'selected' : ''; ?>>TLS (STARTTLS)</option>
                                <option value="ssl" <?php echo (getSetting('smtp_secure') == 'ssl') ? 'selected' : ''; ?>>SSL (SMTPS)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="smtp_from_name">From Name</label>
                            <input type="text" name="smtp_from_name" id="smtp_from_name" value="<?php echo htmlspecialchars(getSetting('smtp_from_name', 'Advert Resource Ltd')); ?>">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-action">SAVE PARAMETERS <i class="far fa-shield-check"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Enquiry Detail Modal Overlay -->
    <div id="enquiryModal" class="detail-overlay" onclick="closeEnquiryModalOnOverlay(event)">
        <div class="detail-modal">
            <button class="detail-close" onclick="closeEnquiryModal()">&times;</button>
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
        function switchTab(tabId, el) {
            // Hide all tab sections
            document.querySelectorAll('.tab-section').forEach(sec => {
                sec.classList.remove('active');
            });
            // Show active tab
            document.getElementById('tab-' + tabId).classList.add('active');
            
            // Toggle active menu highlight
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            el.classList.add('active');
        }
        
        function viewEnquiry(enq) {
            document.getElementById('enqTitle').innerText = enq.name + " (" + enq.service.toUpperCase() + ")";
            document.getElementById('enqCompany').innerText = enq.company || 'Individual / Non-corporate';
            document.getElementById('enqEmail').innerText = enq.email;
            document.getElementById('enqPhone').innerText = enq.phone || 'No phone supplied';
            document.getElementById('enqCountry').innerText = enq.country || 'Not specified';
            document.getElementById('enqBudget').innerText = enq.budget || 'Not declared';
            document.getElementById('enqMsg').innerText = enq.message;
            
            const overlay = document.getElementById('enquiryModal');
            overlay.style.display = 'flex';
        }
        
        function closeEnquiryModal() {
            const overlay = document.getElementById('enquiryModal');
            overlay.style.display = 'none';
        }
        
        function closeEnquiryModalOnOverlay(event) {
            if (event.target.id === 'enquiryModal') {
                closeEnquiryModal();
            }
        }
        
        function editBlog(b) {
            document.getElementById('blog_id').value = b.id;
            document.getElementById('title').value = b.title;
            document.getElementById('category').value = b.category || '';
            document.getElementById('author').value = b.author || '';
            document.getElementById('summary').value = b.summary || '';
            document.getElementById('image_url').value = b.image || '';
            document.getElementById('content').value = b.content;
            
            document.getElementById('blogFormTitle').innerText = "Edit Intel Briefing";
            document.getElementById('blogSubmitBtn').innerHTML = "UPDATE BRIEF <i class='far fa-shield-check'></i>";
            document.getElementById('cancelBlogEditBtn').style.display = 'inline-block';
            document.getElementById('editImageNotice').style.display = 'block';
            
            // Scroll to the form
            document.getElementById('blogForm').scrollIntoView({ behavior: 'smooth' });
        }
        
        function cancelBlogEdit() {
            document.getElementById('blog_id').value = "0";
            document.getElementById('blogForm').reset();
            
            document.getElementById('blogFormTitle').innerText = "Index Intel Briefing";
            document.getElementById('blogSubmitBtn').innerHTML = "INDEX BRIEF <i class='far fa-paper-plane'></i>";
            document.getElementById('cancelBlogEditBtn').style.display = 'none';
            document.getElementById('editImageNotice').style.display = 'none';
        }
    </script>
</body>
</html>
