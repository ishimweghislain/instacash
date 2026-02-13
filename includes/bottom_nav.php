<?php
// Ensure variables are set if not already (in case navbar.php wasn't included)
if (!isset($base)) {
    $current_dir = basename(dirname($_SERVER['PHP_SELF']));
    $is_admin = ($current_dir == 'admin');
    $base = $is_admin ? '../' : '';
}
if (!isset($current_page)) {
    $current_page = basename($_SERVER['PHP_SELF']);
}
?>
<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <a href="<?php echo $base; ?>index.php" class="bottom-nav-item <?php echo ($current_page == 'index.php' && !$is_admin) ? 'active' : ''; ?>">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="<?php echo $base; ?>services.php" class="bottom-nav-item <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">
        <i class="fas fa-briefcase"></i>
        <span>Services</span>
    </a>
    <a href="<?php echo $base; ?>apply.php" class="bottom-nav-item">
        <div style="background:var(--accent); color:var(--primary); padding:10px; border-radius:50%; margin-top:-20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
            <i class="fas fa-plus" style="margin:0;"></i>
        </div>
    </a>
    <a href="<?php echo $base; ?>requirements.php" class="bottom-nav-item <?php echo ($current_page == 'requirements.php') ? 'active' : ''; ?>">
        <i class="fas fa-list-check"></i>
        <span>Reqs</span>
    </a>
    <a href="<?php echo $base; ?>contact.php" class="bottom-nav-item <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
        <i class="fas fa-envelope"></i>
        <span>Contact</span>
    </a>
    <a href="https://instacash.rw/app.instacash.rw/login.php" class="bottom-nav-item">
        <i class="fas fa-sign-in-alt"></i>
        <span>Portal</span>
    </a>
    <a href="<?php echo $base; ?><?php echo $is_admin ? 'index.php' : 'admin/index.php'; ?>" class="bottom-nav-item <?php echo ($is_admin) ? 'active' : ''; ?>">
        <i class="fas fa-user-shield"></i>
        <span>Admin</span>
    </a>
</nav>
