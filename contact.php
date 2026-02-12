<?php
// submit_contact.php
ini_set('display_errors', 1);
require_once 'includes/db.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate required fields
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, subject, message) VALUES (?, ?, ?, ?)");
            
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['subject'],
                $_POST['message']
            ]);
            
            $message = "Your message has been sent successfully! We will get back to you soon.";
        } catch (PDOException $e) {
            $error = "Error sending message: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Instacash</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <a href="index.html" class="logo">
            <img src="logoofinstacash.png" alt="Instacash Logo">
            <span>InstaCash</span>
        </a>
        <nav class="nav-links">
            <a href="index.html">Home</a>
            <a href="services.html">Services</a>
            <a href="requirements.html">Requirements</a>
            <a href="apply.php" class="btn btn-primary">Apply Now</a>
        </nav>
    </header>

    <section class="container" style="padding-top: 150px; padding-bottom: 50px;">
        <div style="max-width: 600px; margin: 0 auto;">
            <div class="form-container">
                <h2 style="text-align: center; color: #0a194f; margin-bottom: 2rem;">Contact Us</h2>
                
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
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Loan Inquiry" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; border: none;">Send Message</button>
                    
                    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                        <h4 style="margin-bottom: 10px;">Visit Us</h4>
                        <p style="margin-bottom: 5px; font-size: 0.95rem;">Remera, Kisimenti KN 5 RD/72</p>
                        <p style="margin-bottom: 5px; font-size: 0.95rem;">Kigali, Rwanda</p>
                        <p style="margin-bottom: 5px; font-size: 0.95rem;"><strong>Phone:</strong> +250 794 421 142 / +250 794 419 919</p>
                        <p style="font-size: 0.95rem;"><strong>Email:</strong> instacashrw@gmail.com</p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="index.html" class="bottom-nav-item">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="services.html" class="bottom-nav-item">
            <i class="fas fa-briefcase"></i>
            <span>Services</span>
        </a>
        <a href="apply.php" class="bottom-nav-item">
            <div style="background:var(--accent); color:var(--primary); padding:10px; border-radius:50%; margin-top:-20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                <i class="fas fa-plus" style="margin:0;"></i>
            </div>
        </a>
        <a href="requirements.html" class="bottom-nav-item">
            <i class="fas fa-list-check"></i>
            <span>Reqs</span>
        </a>
        <a href="contact.html" class="bottom-nav-item active">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
        </a>
    </nav>
</body>
</html>
