<?php
// 1. Create directories
if (!file_exists('c:\xampp\htdocs\advertresources\admin\includes')) {
    mkdir('c:\xampp\htdocs\advertresources\admin\includes', 0777, true);
}

// Get the CSS
$index_file = 'c:\xampp\htdocs\advertresources\admin\index.php';
$index_content = file_get_contents($index_file);

// Extract CSS
preg_match('/<style>(.*?)<\/style>/s', $index_content, $css_matches);
$css = $css_matches[1] ?? '';

// Write header.php
$header_html = '<?php
// Authentication Check
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION[\'admin_logged_in\']) || $_SESSION[\'admin_logged_in\'] !== true) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . "/../../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Command - Console Admin</title>
    <link rel="stylesheet" href="../index/app.min.css" />
    <link rel="stylesheet" href="../index/fontawesome.min.css" />
    <style>' . $css . '</style>
</head>
<body>
    <div class="admin-grid"></div>
    
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-shield-virus"></i> CYBER COMMAND
        </div>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-item <?= basename($_SERVER[\'PHP_SELF\']) == \'index.php\' ? \'active\' : \'\' ?>"><i class="far fa-chart-network"></i> Dashboard Overview</a></li>
            <div style="font-size:0.75rem; font-weight:700; color:#475569; margin: 15px 0 5px 15px; letter-spacing:1px; text-transform:uppercase;">Careers Module</div>
            <li><a href="careers.php" class="nav-item <?= basename($_SERVER[\'PHP_SELF\']) == \'careers.php\' ? \'active\' : \'\' ?>"><i class="far fa-list"></i> Job Listings</a></li>
            <li><a href="career_create.php" class="nav-item <?= basename($_SERVER[\'PHP_SELF\']) == \'career_create.php\' ? \'active\' : \'\' ?>"><i class="far fa-plus-square"></i> Post New Job</a></li>
            <li><a href="career_applications.php" class="nav-item <?= basename($_SERVER[\'PHP_SELF\']) == \'career_applications.php\' ? \'active\' : \'\' ?>"><i class="far fa-users"></i> Job Applications</a></li>
            <div style="font-size:0.75rem; font-weight:700; color:#475569; margin: 15px 0 5px 15px; letter-spacing:1px; text-transform:uppercase;">System</div>
            <li><a href="logout.php" class="nav-item logout-btn"><i class="far fa-power-off"></i> Terminate Session</a></li>
        </ul>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-content">
';
file_put_contents('c:\xampp\htdocs\advertresources\admin\includes\header.php', $header_html);

// Write footer.php
$footer_html = '
    </div>
</body>
</html>
';
file_put_contents('c:\xampp\htdocs\advertresources\admin\includes\footer.php', $footer_html);

echo "Admin includes generated successfully.\n";
?>
