<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Instacash</title>
    <link rel="icon" href="logoofinstacash.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <section class="container" style="padding-top: 50px; padding-bottom: 100px;">
        <div class="container">
            <h1 class="text-center" style="margin-bottom:3rem;">Our Financial Solutions</h1>

            <div class="req-grid">
                <div class="glass-card">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Salary Advance" class="service-img">
                    <h2 style="color:#fcb900;">Salary Advance</h2>
                    <p style="margin-bottom:2rem;">Get quick cash against your salary. Perfect for unexpected expenses before payday.</p>
                    <ul class="req-list" style="padding:0;">
                         <li><i class="fas fa-money-bill-wave"></i> Fast Cash for Employees</li>
                         <li><i class="fas fa-undo"></i> Flexible Repayment</li>
                         <li><i class="fas fa-percentage"></i> Competitive Rates</li>
                     </ul>
                    <a href="requirements.php" class="btn btn-outline" style="width:100%; text-align:center;">Check Requirements</a>
                </div>

                <div class="glass-card">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Business Loan" class="service-img">
                    <h2 style="color:#fcb900;">Business Loan</h2>
                    <p style="margin-bottom:2rem;">Import & Clearing Financing, Invoice Advance. Fuel your business growth.</p>
                     <ul class="req-list" style="padding:0;">
                         <li><i class="fas fa-building"></i> For Startups & SMEs</li>
                         <li><i class="fas fa-file-invoice-dollar"></i> Invoice Advancing</li>
                         <li><i class="fas fa-rocket"></i> Quick Processing</li>
                     </ul>
                    <a href="requirements.php" class="btn btn-outline" style="width:100%; text-align:center;">Check Requirements</a>
                </div>

                <div class="glass-card">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Emergency Cash" class="service-img">
                    <h2 style="color:#fcb900;">Emergency Cash</h2>
                    <p style="margin-bottom:2rem;">Fund your Purchase Orders quickly. Don't let opportunity pass you by.</p>
                     <ul class="req-list" style="padding:0;">
                         <li><i class="fas fa-bolt"></i> Instant Approval</li>
                         <li><i class="fas fa-stopwatch"></i> Minutes to Cash</li>
                         <li><i class="fas fa-hand-holding-usd"></i> No Hidden Fees</li>
                     </ul>
                    <a href="requirements.php" class="btn btn-outline" style="width:100%; text-align:center;">Check Requirements</a>
                </div>
            </div>

            <div class="text-center" style="margin-top:4rem;">
                <h2>Our Charges</h2>
                <div style="background:rgba(255,255,255,0.05); display:inline-block; text-align:left; padding:2rem; border-radius:8px; border:1px solid rgba(255,255,255,0.1);">
                    <p><strong style="color:#fcb900;">Application Fee:</strong> 10,000 Rwf (Non-refundable)</p>
                    <p><strong style="color:#fcb900;">Interest Rate:</strong> 8%</p>
                    <p><strong style="color:#fcb900;">Admin Fee:</strong> 2%</p>
                    <p><strong style="color:#fcb900;">Commission:</strong> 1.5%</p>
                    <p><strong style="color:#fcb900;">Late Payment Fee:</strong> 10% (in case of default)</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/bottom_nav.php'; ?>

    <footer style="text-align:center; padding:3rem 0; border-top:1px solid rgba(255,255,255,0.1);">
        <p style="color:#8892b0;">&copy; 2026 Instacash Ltd.</p>
    </footer>
</body>
</html>
