<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
require '../includes/db.php';
$applications = $pdo->query("SELECT * FROM applications ORDER BY submitted_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Instacash</title>
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
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        .pending { background: #ffd700; color: #000; }
        .approved { background: #28a745; color: #fff; }
        .rejected { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2 style="color: #fff; margin-bottom: 2rem;">Admin Panel</h2>
            <a href="dashboard.php" class="active">Applications</a>
            <a href="inquiries.php">Inquiries</a>
            <a href="logout.php" style="margin-top: 2rem; color: #ff6b6b;">Logout</a>
        </div>
        <div class="main-content">
            <h1 style="font-size: 2rem; margin-bottom: 2rem;">Loan Applications</h1>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Loan Type</th>
                        <th>Amount</th>
                        <th>Income</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($applications as $app): ?>
                    <tr>
                        <td><?= date('M d, Y', strtotime($app['submitted_at'])) ?></td>
                        <td><?= htmlspecialchars($app['first_name'] . ' ' . $app['last_name']) ?></td>
                        <td><?= htmlspecialchars($app['loan_type']) ?></td>
                        <td><?= number_format($app['amount']) ?> Rwf</td>
                        <td><?= number_format($app['monthly_income']) ?> Rwf</td>
                        <td><span class="status-badge <?= strtolower($app['status']) ?>"><?= $app['status'] ?></span></td>
                        <td>
                            <a href="#" style="color: #fcb900;">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
