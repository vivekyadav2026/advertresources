<?php
session_start();
require_once '../db.php';

$error = "";

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $db->prepare("SELECT password_hash FROM admin_credentials WHERE username = :user LIMIT 1");
        $stmt->execute([':user' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Access Denied: Invalid credentials.";
        }
    } catch (Exception $e) {
        $error = "System error. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Command - Access Authorization</title>
    <link rel="stylesheet" href="../index/app.min.css" />
    <link rel="stylesheet" href="../index/fontawesome.min.css" />
    <style>
        body {
            background-color: #030814;
            font-family: 'Space Grotesk', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        /* Cyber Matrix Background Grid */
        .cyber-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(37, 99, 235, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 1;
        }
        
        .glow-orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            z-index: 1;
        }
        .glow-orb.pink {
            background: #E0009B;
            top: -100px;
            right: -100px;
        }
        .glow-orb.blue {
            background: #3C72FC;
            bottom: -100px;
            left: -100px;
        }
        
        .login-card {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(224, 0, 155, 0.25);
            border-radius: 24px;
            padding: 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8), 0 0 30px rgba(224, 0, 155, 0.1);
            backdrop-filter: blur(15px);
            z-index: 5;
            text-align: center;
        }
        
        .lock-icon {
            font-size: 3rem;
            color: #E0009B;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px rgba(224, 0, 155, 0.5));
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .card-title {
            color: #ffffff;
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .card-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            transition: color 0.3s;
        }
        
        .form-control {
            width: 100%;
            background: rgba(5, 11, 24, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 14px 15px 14px 45px;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            border-color: #E0009B;
            outline: none;
            box-shadow: 0 0 10px rgba(224, 0, 155, 0.2);
        }
        
        .form-control:focus + i {
            color: #E0009B;
        }
        
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%);
            border: none;
            color: #ffffff;
            padding: 14px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(224, 0, 155, 0.4);
        }
        
        .error-banner {
            background: rgba(224, 0, 155, 0.1);
            border: 1px solid rgba(224, 0, 155, 0.3);
            border-radius: 8px;
            color: #E0009B;
            padding: 12px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow-orb pink"></div>
    <div class="glow-orb blue"></div>
    
    <div class="login-card">
        <i class="fas fa-shield-keyhole lock-icon"></i>
        <div class="card-title">ACCESS AUTHORIZATION</div>
        <div class="card-subtitle">Secure Gateway to Admin Dashboard</div>
        
        <?php if (!empty($error)): ?>
            <div class="error-banner">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Authorization Code / User" required autocomplete="off">
                <i class="far fa-user-shield"></i>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Security Passkey" required>
                <i class="far fa-key"></i>
            </div>
            
            <button type="submit" class="btn-submit">
                DECRYPT GATEWAY <i class="far fa-lock-open-alt ms-2"></i>
            </button>
        </form>
    </div>
</body>
</html>
