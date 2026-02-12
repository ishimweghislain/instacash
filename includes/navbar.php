<?php
// Determine base path based on directory depth
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$is_admin = ($current_dir == 'admin');
$base = $is_admin ? '../' : '';
$current_page = basename($_SERVER['PHP_SELF']);
?>
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
            <i class="fas fa-list-check"></i> Requirements
        </a>
        <a href="<?php echo $base; ?>contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i> Contact
        </a>
        <a href="<?php echo $is_admin ? 'index.php' : 'admin/index.php'; ?>" class="<?php echo ($is_admin) ? 'active' : ''; ?>" style="color: #8892b0;">
            <i class="fas fa-user-shield"></i> Admin
        </a>
        <a href="<?php echo $base; ?>apply.php" class="btn btn-primary <?php echo ($current_page == 'apply.php') ? 'active' : ''; ?>">
            <i class="fas fa-paper-plane"></i> Apply Now
        </a>
        <a href="https://instacash.rw/app.instacash.rw/login.php" class="btn btn-outline">
            <i class="fas fa-desktop"></i> System Portal
        </a>
    </nav>
</header>
<div style="height: 70px;"></div> <!-- Spacer for fixed header -->
