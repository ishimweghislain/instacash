<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Requirements - Instacash</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <a href="requirements.php" class="active">Requirements</a>
            <a href="contact.php">Contact</a>
            <a href="admin/index.php" style="color: #8892b0;"><i class="fas fa-user-shield"></i> Admin</a>
            <a href="apply.php" class="btn btn-primary">Apply Now</a>
        </nav>
    </header>

    <section class="section-padding" style="padding-top:150px;">
        <div class="container">
            <h1 class="text-center" style="margin-bottom:3rem;">Minimum Items Required</h1>

            <div class="req-grid" style="grid-template-columns: 1fr 1fr; gap:3rem;">
                
                <!-- Salary Advance Requirements -->
                <div class="req-card">
                    <div class="req-header">
                        <h3>Salary Advance Loan</h3>
                        <small>For Employees</small>
                    </div>
                    <ul class="req-list">
                        <li><i class="fas fa-check-circle"></i> Non-refundable application fee: 10,000 Rwf</li>
                        <li><i class="fas fa-check-circle"></i> Salary certificate (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Copy of employment contract (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Three (3) recent pay slips (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Marital status certificate (Required)</li>
                        <li><i class="fas fa-check-circle"></i> 1 Passport photo (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Bank statement of the last 6 months (Required)</li>
                        <li><i class="fas fa-info-circle"></i> Salary assignment / Commitment letter (Optional)</li>
                    </ul>
                </div>

                <!-- Business / Emergency Requirements -->
                <div class="req-card">
                    <div class="req-header">
                        <h3>Emergency / Business Loan</h3>
                        <small>For Entrepreneurs & Immediate Cash </small>
                    </div>
                    <ul class="req-list">
                        <li><i class="fas fa-check-circle"></i> Non-refundable application fee: 10,000 Rwf</li>
                        <li><i class="fas fa-check-circle"></i> Copy of ID (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Copy of Spouse/Guarantor ID (Required)</li>
                        <li><i class="fas fa-check-circle"></i>  Marital status certificate (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Bank statement of the last 6 months (Required)</li>
                        <li><i class="fas fa-check-circle"></i> Collateral expertise (Required)</li>
                    </ul>
                </div>

            </div>

            <div style="margin-top:4rem; text-align:center;">
                <h2 style="margin-bottom:2rem;">Other Mandatory Charges</h2>
                <p>Paid directly to third parties – not INSTACASH Ltd</p>
                
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:2rem; margin-top:2rem;">
                    <div class="glass-card">
                        <h4 style="color:#fcb900;">Notary Fee</h4>
                        <p style="font-size:1.5rem; font-weight:700;">13,000 Rwf</p>
                    </div>
                    <div class="glass-card">
                        <h4 style="color:#fcb900;">RDB Collateral Registration</h4>
                        <p style="font-size:1.5rem; font-weight:700;">20,000 Rwf</p>
                    </div>
                    <div class="glass-card">
                        <h4 style="color:#fcb900;">Restructuring Fee</h4>
                        <p style="font-size:1.5rem; font-weight:700;">7%</p>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top:4rem;">
                <p style="font-size:1.2rem; color:#8892b0; max-width:700px; margin:0 auto;">
                    <strong>IMPORTANT NOTICE:</strong> INSTACASH Ltd does not collect third-party fees.
                    These are paid directly to the respective service providers.
                </p>
                <div style="margin-top:2rem;">
                     <a href="apply.php" class="btn btn-primary">Proceed to Application</a>
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
        <a href="requirements.php" class="bottom-nav-item active">
            <i class="fas fa-list-check"></i>
            <span>Reqs</span>
        </a>
        <a href="contact.php" class="bottom-nav-item">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
        </a>
    </nav>

    <!-- Footer -->
    <footer style="text-align:center; padding:3rem 0; border-top:1px solid rgba(255,255,255,0.1);">
        <p style="color:#8892b0;">&copy; 2026 Instacash Ltd.</p>
    </footer>
</body>
</html>
