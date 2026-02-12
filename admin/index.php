<?php
session_start();
$error = '';
if (isset($_POST['login'])) {
    require '../includes/db.php';
    $username = $_POST['username'];
    // In a real app, verify password hash
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
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
    <title>Admin Login - Instacash</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0a194f;
            color: white;
            font-family: 'Outfit', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 350px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #fcb900;
            color: #0a194f;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .error { color: #ff6b6b; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 style="text-align: center; color: #fcb900;">Admin Access</h2>
        <?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
