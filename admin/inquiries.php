<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
require '../includes/db.php';
$inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Inquiries</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #020c1b;
            padding: 2rem;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar a {
            display: block;
            color: #8892b0;
            padding: 10px 0;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            color: #fcb900;
        }
        .main-content {
            padding: 2rem;
            background-color: #0a194f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e6f1ff;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        th { color: #fcb900; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2 style="color: #fff; margin-bottom: 2rem;">Admin Panel</h2>
            <a href="dashboard.php">Applications</a>
            <a href="inquiries.php" class="active">Inquiries</a>
            <a href="logout.php" style="margin-top: 2rem; color: #ff6b6b;">Logout</a>
        </div>
        <div class="main-content">
            <h1 style="font-size: 2rem; margin-bottom: 2rem;">User Inquiries</h1>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inquiries as $msg): ?>
                    <tr>
                        <td style="white-space:nowrap;"><?= date('M d, Y', strtotime($msg['created_at'])) ?></td>
                        <td><?= htmlspecialchars($msg['name']) ?></td>
                        <td><a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color: #fcb900;"><?= htmlspecialchars($msg['email']) ?></a></td>
                        <td><?= htmlspecialchars($msg['subject']) ?></td>
                        <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
