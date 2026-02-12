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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries - Instacash Admin</title>
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
        
        .table-container {
            overflow-x: auto;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            color: #e6f1ff;
        }
        
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            white-space: nowrap;
        }
        
        th { 
            color: #fcb900;
            background: rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
        }
        
        .btn-view {
            background: #fcb900;
            color: #0a194f;
            padding: 6px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
            display: inline-block;
        }
        
        .btn-view:hover {
            background: #ffd700;
            transform: translateY(-2px);
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            animation: fadeIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: #0a194f;
            margin: 5% auto;
            padding: 0;
            border: 2px solid #fcb900;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            animation: slideDown 0.3s;
        }
        
        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-header {
            background: linear-gradient(135deg, #0a194f 0%, #fcb900 100%);
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
        
        .modal-header h2 {
            color: white;
            margin: 0;
        }
        
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }
        
        .close:hover {
            color: #ff6b6b;
        }
        
        .modal-body {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .detail-row {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 1rem;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #fcb900;
            font-weight: 600;
        }
        
        .detail-value {
            color: #e6f1ff;
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
            <a href="dashboard.php">
                <i class="fas fa-file-invoice-dollar"></i> Applications
            </a>
            <a href="inquiries.php" class="active">
                <i class="fas fa-envelope"></i> Inquiries
            </a>
            <a href="settings.php">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="#" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        
        <div class="main-content">
            <h1 style="font-size: 2rem; margin-bottom: 2rem;">User Inquiries</h1>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($inquiries as $msg): ?>
                        <tr>
                            <td><?= date('M d', strtotime($msg['created_at'])) ?></td>
                            <td><?= htmlspecialchars($msg['name']) ?></td>
                            <td><a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color: #fcb900;"><?= htmlspecialchars($msg['email']) ?></a></td>
                            <td><?= htmlspecialchars($msg['phone'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($msg['subject']) ?></td>
                            <td>
                                <a href="#" class="btn-view" onclick="viewInquiry(<?= htmlspecialchars(json_encode($msg)) ?>); return false;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Mobile Bottom Navigation -->
    <nav class="admin-bottom-nav">
        <a href="dashboard.php">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
        <a href="inquiries.php" class="active">
            <i class="fas fa-envelope"></i>
            <span>Inquiries</span>
        </a>
        <a href="settings.php">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
        <a href="#" onclick="confirmLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>
    
    <!-- Inquiry Details Modal -->
    <div id="inquiryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2><i class="fas fa-envelope-open-text"></i> Inquiry Details</h2>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2026 Instacash Ltd. Admin Portal</p>
    </footer>

    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
        
        function viewInquiry(inquiry) {
            const modal = document.getElementById('inquiryModal');
            const modalBody = document.getElementById('modalBody');
            
            modalBody.innerHTML = `
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-user"></i> Name:</div>
                    <div class="detail-value">${inquiry.name}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-envelope"></i> Email:</div>
                    <div class="detail-value"><a href="mailto:${inquiry.email}" style="color: #fcb900;">${inquiry.email}</a></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-phone"></i> Phone:</div>
                    <div class="detail-value">${inquiry.phone || 'Not provided'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-tag"></i> Subject:</div>
                    <div class="detail-value">${inquiry.subject}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-comment"></i> Message:</div>
                    <div class="detail-value">${inquiry.message.replace(/\n/g, '<br>')}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-clock"></i> Received:</div>
                    <div class="detail-value">${new Date(inquiry.created_at).toLocaleString()}</div>
                </div>
            `;
            
            modal.style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('inquiryModal').style.display = 'none';
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('inquiryModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
