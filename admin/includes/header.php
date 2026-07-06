<?php
// Authentication Check
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
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
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --admin-bg: #030712; --admin-surface: #0f172a; --admin-border: #1e293b; --admin-accent: #3b82f6; --admin-text: #f8fafc; --admin-muted: #94a3b8; }
        body { font-family: 'Inter', sans-serif; background-color: var(--admin-bg); color: var(--admin-text); margin: 0; padding: 0; display: flex; min-height: 100vh; overflow-x: hidden; }
        .admin-grid { position: fixed; inset: 0; background-image: linear-gradient(to right, #ffffff05 1px, transparent 1px), linear-gradient(to bottom, #ffffff05 1px, transparent 1px); background-size: 40px 40px; z-index: -1; pointer-events: none; }
        .sidebar { width: 280px; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(16px); border-right: 1px solid var(--admin-border); display: flex; flex-direction: column; padding: 24px 0; }
        .sidebar-logo { padding: 0 24px 24px; font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 700; color: #fff; letter-spacing: 1px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--admin-border); margin-bottom: 24px; }
        .sidebar-logo i { color: var(--admin-accent); }
        .nav-menu { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; px: 12px; }
        .nav-menu li { padding: 0 16px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: var(--admin-muted); text-decoration: none; border-radius: 8px; transition: all 0.3s ease; font-weight: 500; cursor: pointer; }
        .nav-item:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .nav-item.active { background: rgba(59, 130, 246, 0.15); color: var(--admin-accent); border: 1px solid rgba(59, 130, 246, 0.3); }
        .nav-item i { font-size: 1.1rem; width: 24px; text-align: center; }
        .logout-btn { margin-top: auto; color: #ef4444; }
        .logout-btn:hover { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .main-content { flex: 1; padding: 40px; overflow-y: auto; height: 100vh; box-sizing: border-box; }
        .glass-panel { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid var(--admin-border); border-radius: 16px; padding: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .panel-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 16px; }
        .panel-header h2 { font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 600; margin: 0; color: #fff; }
        
        .stat-card { background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.9)); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 12px; display: flex; flex-direction: column; gap: 12px; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--admin-accent); }
        .stat-label { font-size: 0.875rem; color: var(--admin-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .stat-value { font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 700; color: #fff; line-height: 1; }
        .stat-icon { position: absolute; right: 24px; bottom: 24px; font-size: 3rem; color: rgba(255,255,255,0.03); }
        
        .cyber-table { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
        .cyber-table th { color: var(--admin-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; text-align: left; padding: 0 16px 8px; border-bottom: 1px solid var(--admin-border); }
        .cyber-table td { background: rgba(255,255,255,0.02); padding: 16px; font-size: 0.95rem; color: #e2e8f0; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); }
        .cyber-table tr td:first-child { border-left: 1px solid rgba(255,255,255,0.05); border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .cyber-table tr td:last-child { border-right: 1px solid rgba(255,255,255,0.05); border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
        .cyber-table tr:hover td { background: rgba(255,255,255,0.04); }
        
        .btn-action { background: var(--admin-accent); color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-family: 'Inter', sans-serif; font-weight: 600; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); text-decoration: none;}
        .btn-action:hover { background: #2563eb; transform: translateY(-1px); box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4); }
        .btn-delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-delete:hover { background: #ef4444; color: #fff; }
        .btn-view { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-view:hover { background: #3b82f6; color: #fff; }
        
        .badge-tag { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: var(--admin-muted); font-size: 0.85rem; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); padding: 12px 16px; border-radius: 8px; color: #fff; font-family: 'Inter', sans-serif; transition: all 0.3s; box-sizing: border-box; }
        .form-group select option { background: #0f172a; color: #fff; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: var(--admin-accent); box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2); background: rgba(0,0,0,0.4); }
        .form-row { display: flex; gap: 20px; }
        .form-row .form-group { flex: 1; }
        
        .alert-banner { padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
        .alert-banner.success { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #10b981; }
        .alert-banner.error { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; }
        
        /* Responsive design rules */
        .mobile-header {
            display: none;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--admin-border);
            padding: 12px 20px;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            z-index: 1000;
            box-sizing: border-box;
        }
        .mobile-logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .mobile-logo i { color: var(--admin-accent); }
        .toggle-btn {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 998;
        }
        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 991px) {
            body {
                flex-direction: column;
            }
            .mobile-header {
                display: flex;
            }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 999;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                background: #0f172a;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-top: 60px;
                padding: 20px;
                height: auto;
                min-height: calc(100vh - 60px);
                overflow-x: hidden;
            }
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-grid"></div>
    
    <!-- Mobile top bar -->
    <div class="mobile-header">
        <div class="mobile-logo">
            <i class="fas fa-shield-virus"></i> CYBER COMMAND
        </div>
        <button class="toggle-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </div>
    
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Left Sidebar -->
    <div class="sidebar" id="adminSidebar">
        <div class="sidebar-logo">
            <i class="fas fa-shield-virus"></i> CYBER COMMAND
        </div>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"><i class="far fa-chart-network"></i> Dashboard Overview</a></li>
            
            <div style="font-size:0.75rem; font-weight:700; color:#475569; margin: 15px 0 5px 15px; letter-spacing:1px; text-transform:uppercase;">Core Modules</div>
            <li><a href="enquiries.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'enquiries.php' ? 'active' : '' ?>"><i class="far fa-inbox-in"></i> Enquiries Log</a></li>
            <li><a href="careers.php" class="nav-item <?= in_array(basename($_SERVER['PHP_SELF']), ['careers.php', 'career_create.php', 'career_edit.php']) ? 'active' : '' ?>"><i class="far fa-briefcase"></i> Careers & Jobs</a></li>
            <li><a href="career_applications.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'career_applications.php' ? 'active' : '' ?>"><i class="far fa-file-user"></i> Job Applications</a></li>
            
            <div style="font-size:0.75rem; font-weight:700; color:#475569; margin: 15px 0 5px 15px; letter-spacing:1px; text-transform:uppercase;">System</div>
            <li><a href="settings.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>"><i class="far fa-cogs"></i> Configuration</a></li>
            <li><a href="logout.php" class="nav-item logout-btn"><i class="far fa-power-off"></i> Terminate Session</a></li>
        </ul>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-content">
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (toggleBtn && sidebar && overlay) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    });
    </script>
