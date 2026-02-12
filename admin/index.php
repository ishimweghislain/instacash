<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    require '../includes/db.php';
    
    $username = $_POST['username'];
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Instacash</title>
    <link rel="icon" href="../logoofinstacash.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .toast {
            visibility: hidden;
            min-width: 300px;
            background-color: #dc3545;
            color: #fff;
            text-align: center;
            border-radius: 8px;
            padding: 16px;
            position: fixed;
            z-index: 9999;
            right: 30px;
            top: 30px;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @keyframes fadein {
            from {right: 0; opacity: 0;}
            to {right: 30px; opacity: 1;}
        }
        @keyframes fadeout {
            from {right: 30px; opacity: 1;}
            to {right: 0; opacity: 0;}
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(135deg, #0a194f 0%, #182b6b 100%);
        }
        .login-box {
            background: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header img {
            height: 60px;
            margin-bottom: 1rem;
        }
        .login-header h2 {
            color: #0a194f;
            margin: 0;
        }
        .login-header p {
            color: #666;
            margin: 0.5rem 0 0;
        }
    </style>
</head>
<body>

    <header>
        <a href="../index.php" class="logo">
            <img src="../logoofinstacash.png" alt="Instacash Logo">
            <span>INSTACASH</span>
        </a>
        <nav class="nav-links">
            <a href="../index.php">Home</a>
            <a href="../services.php">Services</a>
            <a href="../requirements.php">Requirements</a>
            <a href="../contact.php">Contact</a>
            <a href="index.php" style="color: #fcb900;"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>
    </header>

    <div id="toast" class="toast"></div>

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <img src="../logoofinstacash.png" alt="Instacash Logo">
                <h2><i class="fas fa-user-shield"></i> Admin Portal</h2>
                <p>Sign in to access the dashboard</p>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <button type="submit" name="login" class="btn btn-primary" style="width: 100%; border: none; font-size: 1rem; padding: 14px;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="../index.php" style="color: #0a194f; text-decoration: none;">
                        <i class="fas fa-arrow-left"></i> Back to Website
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="../index.php" class="bottom-nav-item">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="../services.php" class="bottom-nav-item">
            <i class="fas fa-briefcase"></i>
            <span>Services</span>
        </a>
        <a href="../apply.php" class="bottom-nav-item">
            <div style="background:var(--accent); color:var(--primary); padding:10px; border-radius:50%; margin-top:-20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                <i class="fas fa-plus" style="margin:0;"></i>
            </div>
        </a>
        <a href="../contact.php" class="bottom-nav-item">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
        </a>
        <a href="index.php" class="bottom-nav-item active">
            <i class="fas fa-user-shield"></i>
            <span>Admin</span>
        </a>
    </nav>

    <script>
        <?php if($error): ?>
            window.onload = function() {
                const toast = document.getElementById('toast');
                toast.textContent = '✗ <?= addslashes($error) ?>. Please try again.';
                toast.className = 'toast show';
                setTimeout(() => { toast.className = 'toast'; }, 3000);
            }
        <?php endif; ?>
    </script>

</body>
</html>
