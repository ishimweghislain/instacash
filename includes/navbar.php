<?php
// Determine base path based on directory depth
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$is_admin = ($current_dir == 'admin');
$base = $is_admin ? '../' : '';
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
/* Modern Navigation Styles */
header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(10, 25, 79, 0.95);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(252, 185, 0, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    padding: 1rem 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.02);
}

.logo img {
    height: 40px;
    width: auto;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
}

.logo span {
    font-size: 1.3rem;
    font-weight: 700;
    color: #fcb900;
    letter-spacing: 0.5px;
    font-family: 'Outfit', sans-serif;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.nav-links a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    color: #8892b0;
    font-size: 0.8rem;
    font-weight: 500;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    white-space: nowrap;
    font-family: 'Inter', sans-serif;
    letter-spacing: 0.3px;
    position: relative;
}

.nav-links a i {
    font-size: 0.75rem;
    transition: transform 0.3s ease;
}

.nav-links a:hover {
    color: #fcb900;
    background: rgba(252, 185, 0, 0.08);
    transform: translateY(-1px);
}

.nav-links a:hover i {
    transform: scale(1.1);
}

.nav-links a.active {
    color: #fcb900;
    background: rgba(252, 185, 0, 0.12);
}

.nav-links a.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 15%;
    right: 15%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #fcb900, transparent);
}

/* Button Styles */
.btn {
    padding: 0.6rem 1.3rem !important;
    font-size: 0.75rem !important;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-radius: 8px;
}

.btn i {
    font-size: 0.75rem !important;
}

.btn-primary {
    background: linear-gradient(135deg, #fcb900 0%, #ff9500 100%) !important;
    color: #0a194f !important;
    border: none;
    box-shadow: 0 4px 12px rgba(252, 185, 0, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ffc520 0%, #ffaa20 100%) !important;
    box-shadow: 0 6px 16px rgba(252, 185, 0, 0.4);
    transform: translateY(-2px) !important;
}

.btn-outline {
    background: transparent !important;
    color: #fcb900 !important;
    border: 1.5px solid #fcb900 !important;
}

.btn-outline:hover {
    background: rgba(252, 185, 0, 0.1) !important;
    border-color: #ffc520 !important;
    color: #ffc520 !important;
    transform: translateY(-2px) !important;
}

/* Responsive */
@media (max-width: 1200px) {
    header {
        padding: 1rem 1.5rem;
    }
    
    .nav-links {
        gap: 0.3rem;
    }
    
    .nav-links a {
        padding: 0.55rem 0.85rem;
        font-size: 0.75rem;
    }
    
    .nav-links a i {
        font-size: 0.7rem;
    }
    
    .btn {
        padding: 0.55rem 1.1rem !important;
        font-size: 0.7rem !important;
    }
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
    }
    
    header {
        padding: 1rem 1.5rem;
    }
    
    .logo span {
        font-size: 1.1rem;
    }
    
    .logo img {
        height: 35px;
    }
}

/* Smooth transitions */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>

<header>
    <a href="<?php echo $base; ?>index.php" class="logo">
        <img src="<?php echo $base; ?>logoofinstacash.png" alt="Instacash Logo">
        <span>INSTACASH</span>
    </a>
    <nav class="nav-links">
        <a href="<?php echo $base; ?>index.php" class="<?php echo ($current_page == 'index.php' && !$is_admin) ? 'active' : ''; ?>">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="<?php echo $base; ?>services.php" class="<?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">
            <i class="fas fa-briefcase"></i> Services
        </a>
        <a href="<?php echo $base; ?>requirements.php" class="<?php echo ($current_page == 'requirements.php') ? 'active' : ''; ?>">
            <i class="fas fa-clipboard-list"></i> Requirements
        </a>
        <a href="<?php echo $base; ?>contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i> Contact
        </a>
        <a href="<?php echo $is_admin ? 'index.php' : 'admin/index.php'; ?>" class="<?php echo ($is_admin) ? 'active' : ''; ?>">
            <i class="fas fa-user-shield"></i> Admin
        </a>
        <a href="<?php echo $base; ?>apply.php" class="btn btn-primary <?php echo ($current_page == 'apply.php') ? 'active' : ''; ?>">
            <i class="fas fa-rocket"></i> Apply Now
        </a>
        <a href="https://instacash.rw/app.instacash.rw/login.php" class="btn btn-outline">
            <i class="fas fa-sign-in-alt"></i> Portal
        </a>
    </nav>
</header>

<div style="height: 75px;"></div> <!-- Spacer for fixed header -->