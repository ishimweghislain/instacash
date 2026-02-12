<?php
// submit_application.php
ini_set('display_errors', 1);
require_once 'includes/db.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate required fields
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
            
            $message = "Your application has been submitted successfully! We will contact you shortly.";
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <a href="index.html" class="logo">
            <img src="logoofinstacash.png" alt="Instacash Logo">
            <span>INSTACASH</span>
        </a>
        <nav class="nav-links">
            <a href="index.html">Home</a>
            <a href="requirements.html">Requirements</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>

    <section class="container" style="padding-top: 150px; padding-bottom: 50px;">
        <div style="max-width: 600px; margin: 0 auto;">
            <div class="form-container">
                <h2 style="text-align: center; color: #0a194f; margin-bottom: 2rem;">Loan Application</h2>
                
                <?php if($message): ?>
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        <?= $message ?>
                    </div>
                <?php endif; ?>
                
                <?php if($error): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label">Loan Type</label>
                        <select name="loan_type" class="form-control" required>
                            <option value="Salary Advance">Salary Advance Loan</option>
                            <option value="Business Loan">Business Loan</option>
                            <option value="Emergency Loan">Emergency Loan</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" placeholder="07..." required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Requested Amount (Rwf)</label>
                        <input type="number" name="amount" class="form-control" placeholder="Min 50,000" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Monthly Income (Rwf)</label>
                        <input type="number" name="income" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Loan Duration (Months)</label>
                        <select name="duration" class="form-control" required>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months (Max)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; border: none;">Submit Application</button>
                    <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: #666;">
                        Application Fee: <strong style="color: #0a194f;">10,000 Rwf</strong> (Non-refundable)
                    </p>
                </form>
            </div>
        </div>
    </section>

</body>
</html>
