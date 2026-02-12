<?php
require_once 'includes/db.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message'])) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['subject'],
                $_POST['message']
            ]);
            
            $message = "success";
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
        .map-container {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid rgba(252, 185, 0, 0.3);
        }
        .contact-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }
        @media (max-width: 768px) {
            .contact-layout {
                grid-template-columns: 1fr;
            }
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
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <a href="requirements.php">Requirements</a>
            <a href="contact.php" class="active">Contact</a>
            <a href="admin/index.php" style="color: #8892b0;"><i class="fas fa-user-shield"></i> Admin</a>
            <a href="apply.php" class="btn btn-primary">Apply Now</a>
        </nav>
    </header>

    <div id="toast" class="toast"></div>

    <section class="container" style="padding-top: 150px; padding-bottom: 100px;">
        
        <h1 class="text-center" style="margin-bottom: 3rem;">Get In Touch</h1>

        <div class="contact-layout">
            
            <!-- LEFT SIDE: Map -->
            <div>
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4906891827583!2d30.1059049!3d-1.9536723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca425e3eaffff%3A0x6c2aa46b3ec8148c!2sRemera%2C%20Kigali%2C%20Rwanda!5e0!3m2!1sen!2s!4v1234567890"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <div class="glass-card" style="margin-top: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-map-marker-alt" style="color: #fcb900;"></i> Visit Our Office</h3>
                    <p style="margin-bottom: 10px;"><strong>Address:</strong> Remera, Kisimenti KN 5 RD/72, Kigali, Rwanda</p>
                    <p style="margin-bottom: 10px;"><strong>Phone:</strong> +250 794 421 142 / +250 794 419 919</p>
                    <p style="margin-bottom: 10px;"><strong>Email:</strong> instacashrw@gmail.com</p>
                    <p style="margin-bottom: 0;"><strong>Hours:</strong> Mon-Fri 9:00-18:00, Sat 9:00-13:00</p>
                </div>
            </div>

            <!-- RIGHT SIDE: Form -->
            <div>
                <div class="form-container">
                    <h2 style="text-align: center; color: #0a194f; margin-bottom: 2rem;">Send Us a Message</h2>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+250 78..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-tag"></i> Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="General Inquiry" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-comment"></i> Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Your message here..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; border: none; padding: 14px;">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
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
        <a href="apply.php" class="bottom-nav-item">
            <div style="background:var(--accent); color:var(--primary); padding:10px; border-radius:50%; margin-top:-20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                <i class="fas fa-plus" style="margin:0;"></i>
            </div>
        </a>
        <a href="requirements.php" class="bottom-nav-item">
            <i class="fas fa-list-check"></i>
            <span>Reqs</span>
        </a>
        <a href="contact.php" class="bottom-nav-item active">
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
                toast.textContent = '✓ Message sent successfully! We will get back to you soon.';
                toast.className = 'toast show';
                setTimeout(() => { 
                    toast.className = 'toast';
                    window.location.href = 'contact.php';
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
