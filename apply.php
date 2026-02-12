<?php
require_once 'includes/db.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['phone']) || empty($_POST['amount'])) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO applications (first_name, last_name, email, phone, loan_type, amount, duration_months, monthly_income) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['loan_type'],
                $_POST['amount'],
                $_POST['duration'],
                $_POST['income']
            ]);
            
            $message = "success";
        } catch (PDOException $e) {
            $error = "Error submitting application: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Loan - Instacash</title>
    <link rel="icon" href="logoofinstacash.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .toast {
            visibility: hidden;
            min-width: 300px;
            background-color: #28a745;
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
        .toast.error {
            background-color: #dc3545;
        }
        @keyframes fadein {
            from {right: 0; opacity: 0;}
            to {right: 30px; opacity: 1;}
        }
        @keyframes fadeout {
            from {right: 30px; opacity: 1;}
            to {right: 0; opacity: 0;}
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">
            <img src="logoofinstacash.png" alt="Instacash Logo">
            <span>INSTACASH</span>
        </a>
        <nav class="nav-links">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="services.php"><i class="fas fa-briefcase"></i> Services</a>
            <a href="requirements.php"><i class="fas fa-list-check"></i> Requirements</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="admin/index.php" style="color: #8892b0;"><i class="fas fa-user-shield"></i> Admin</a>
            <a href="apply.php" class="btn btn-primary active"><i class="fas fa-paper-plane"></i> Apply Now</a>
            <a href="https://instacash.rw/app.instacash.rw/login.php" class="btn btn-outline"><i class="fas fa-desktop"></i> System Portal</a>
        </nav>
    </header>

    <div id="toast" class="toast"></div>

    <section class="container" style="padding-top: 150px; padding-bottom: 100px;">
        <div style="max-width: 600px; margin: 0 auto;">
            <div class="form-container">
                <h2 style="text-align: center; color: #0a194f; margin-bottom: 1rem;">Loan Application</h2>
                <p style="text-align: center; color: #666; margin-bottom: 2rem;">Fill in the details below to apply for a loan</p>

                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-hand-holding-usd"></i> Loan Type</label>
                        <select name="loan_type" class="form-control" required>
                            <option value="">Select loan type...</option>
                            <option value="Salary Advance">Salary Advance Loan</option>
                            <option value="Business Loan">Business Loan</option>
                            <option value="Emergency Loan">Emergency Loan</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-user"></i> First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="John" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" name="phone" class="form-control" placeholder="078..." required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-money-bill-wave"></i> Requested Amount (Rwf)</label>
                        <input type="number" name="amount" class="form-control" placeholder="Minimum 50,000" min="50000" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-wallet"></i> Monthly Income (Rwf)</label>
                        <input type="number" name="income" class="form-control" placeholder="Your monthly income" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Loan Duration</label>
                        <select name="duration" class="form-control" required>
                            <option value="">Select duration...</option>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months (Maximum)</option>
                        </select>
                    </div>

                    <div style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
                        <p style="margin: 0; color: #856404; font-size: 0.9rem;">
                            <i class="fas fa-info-circle"></i> <strong>Application Fee:</strong> 10,000 Rwf (Non-refundable)
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; border: none; font-size: 1rem; padding: 16px;">
                        <i class="fas fa-paper-plane"></i> Submit Application
                    </button>
                    
                    <p style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: #999;">
                        Your information is secure and will only be used to process your application.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="index.php" class="bottom-nav-item">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="services.php" class="bottom-nav-item">
            <i class="fas fa-briefcase"></i>
            <span>Services</span>
        </a>
        <a href="apply.php" class="bottom-nav-item active">
            <div style="background:var(--accent); color:var(--primary); padding:10px; border-radius:50%; margin-top:-20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                <i class="fas fa-plus" style="margin:0;"></i>
            </div>
        </a>
        <a href="requirements.php" class="bottom-nav-item">
            <i class="fas fa-list-check"></i>
            <span>Reqs</span>
        </a>
        <a href="contact.php" class="bottom-nav-item">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
        </a>
    </nav>

    <footer style="border-top: 1px solid rgba(255,255,255,0.1); padding: 3rem 0;">
        <div class="container text-center">
            <p style="color: #8892b0;">&copy; 2026 Instacash Ltd. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        <?php if($message == 'success'): ?>
            window.onload = function() {
                const toast = document.getElementById('toast');
                toast.textContent = '✓ Application submitted successfully! We will contact you soon.';
                toast.className = 'toast show';
                setTimeout(() => { 
                    toast.className = 'toast';
                    window.location.href = 'apply.php';
                }, 2000);
            }
        <?php endif; ?>
        
        <?php if($error): ?>
            window.onload = function() {
                const toast = document.getElementById('toast');
                toast.textContent = '✗ <?= addslashes($error) ?>';
                toast.className = 'toast show error';
                setTimeout(() => { toast.className = 'toast'; }, 3000);
            }
        <?php endif; ?>
    </script>

</body>
</html>
