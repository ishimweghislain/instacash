<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
require '../includes/db.php';

$message = '';
$error = '';

// Get current admin info
$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Verify current password
    if (!password_verify($currentPassword, $admin['password'])) {
        $error = "Current password is incorrect";
    } elseif (!empty($newPassword) && $newPassword !== $confirmPassword) {
        $error = "New passwords do not match";
    } else {
        try {
            if (!empty($newPassword)) {
                // Update username and password
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
                $stmt = $pdo->prepare("UPDATE admins SET username = ?, password = ? WHERE id = ?");
                $stmt->execute([$newUsername, $hashedPassword, $_SESSION['admin_id']]);
            } else {
                // Update only username
                $stmt = $pdo->prepare("UPDATE admins SET username = ? WHERE id = ?");
                $stmt->execute([$newUsername, $_SESSION['admin_id']]);
            }
            
            $_SESSION['admin_username'] = $newUsername;
            $message = "Settings updated successfully!";
            
            // Refresh admin data
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
            $stmt->execute([$_SESSION['admin_id']]);
            $admin = $stmt->fetch();
        } catch (PDOException $e) {
            $error = "Error updating settings: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Instacash Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { 
            background: #0a194f; 
            color: #e6f1ff; 
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .dashboard-container {
            display: block;
            min-height: 100vh;
        }
        
        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background-color: #020c1b;
            padding: 2rem;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            overflow-y: auto;
            z-index: 100;
        }
        
        .sidebar h2 {
            color: #fff;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #8892b0;
            padding: 12px 0;
            text-decoration: none;
            transition: 0.3s;
            font-size: 1rem;
        }
        
        .sidebar a i {
            font-size: 1.2rem;
            width: 24px;
        }
        
        .sidebar a:hover, .sidebar a.active {
            color: #fcb900;
            transform: translateX(5px);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            background-color: #0a194f;
            min-height: 100vh;
            padding-bottom: 100px;
        }
        
        .settings-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(252, 185, 0, 0.3);
            border-radius: 12px;
            padding: 2rem;
            max-width: 600px;
        }
        
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #28a745;
        }
        
        .alert-error {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #dc3545;
        }
        
        footer {
            margin-left: 250px;
            background: #020c1b;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            text-align: center;
            color: #8892b0;
            width: calc(100% - 250px);
        }
        
        /* Mobile Bottom Navigation */
        .admin-bottom-nav {
            display: none;
        }
        
        /* Responsive Design */
        @media (max-width: 968px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
                padding-bottom: 80px;
            }
            
            footer {
                margin-left: 0;
                width: 100%;
                padding-bottom: 70px;
            }
            
            .admin-bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: rgba(10, 25, 79, 0.95);
                backdrop-filter: blur(10px);
                border-top: 1px solid rgba(252, 185, 0, 0.3);
                padding: 10px 0;
                z-index: 2000;
                justify-content: space-around;
                align-items: center;
            }
            
            .admin-bottom-nav a {
                display: flex;
                flex-direction: column;
                align-items: center;
                color: #8892b0;
                text-decoration: none;
                font-size: 0.75rem;
                transition: all 0.3s ease;
            }
            
            .admin-bottom-nav a i {
                font-size: 1.25rem;
                margin-bottom: 5px;
            }
            
            .admin-bottom-nav a.active, .admin-bottom-nav a:hover {
                color: #fcb900;
                transform: translateY(-2px);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2><i class="fas fa-shield-halved"></i> Admin</h2>
            <a href="dashboard.php">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="applications.php">
                <i class="fas fa-file-invoice-dollar"></i> Applications
            </a>
            <a href="inquiries.php">
                <i class="fas fa-envelope"></i> Inquiries
            </a>
            <a href="settings.php" class="active">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="#" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        
        <div class="main-content">
            <h1 style="font-size: 2rem; margin-bottom: 2rem;">Account Settings</h1>
            
            <div class="settings-card">
                <?php if($message): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= $message ?>
                    </div>
                <?php endif; ?>
                
                <?php if($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Current Username</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>" disabled style="background: rgba(0,0,0,0.2);">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Current Password</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password to make changes" required>
                    </div>
                    
                    <hr style="border: none; border-top: 1px solid rgba(255,255,255,0.1); margin: 2rem 0;">
                    
                    <h3 style="margin-bottom: 1.5rem; color: #fcb900;"><i class="fas fa-edit"></i> Update Credentials</h3>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user-edit"></i> New Username</label>
                        <input type="text" name="new_username" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-key"></i> New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Leave blank to keep current password">
                        <small style="color: #8892b0; font-size: 0.85rem;">Minimum 8 characters recommended</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-check"></i> Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; border: none; font-size: 1rem; padding: 14px; margin-top: 1rem;">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Mobile Bottom Navigation -->
    <nav class="admin-bottom-nav">
        <a href="dashboard.php">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
        <a href="applications.php">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Apps</span>
        </a>
        <a href="inquiries.php">
            <i class="fas fa-envelope"></i>
            <span>Inquiries</span>
        </a>
        <a href="settings.php" class="active">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
        <a href="#" onclick="confirmLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>
    
    <footer>
        <p>&copy; 2026 Instacash Ltd. Admin Portal</p>
    </footer>

    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>
