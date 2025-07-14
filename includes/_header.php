<?php // includes/_header.php

// Pastikan session sudah dimulai di file utama
// Misalnya di dashboard_admin.php atau admin_reports.php
// Variabel $page_title diasumsikan sudah ada dari _html_head.php
?>
<header class="navbar">
    <div class="navbar-brand">
        <?php echo htmlspecialchars($page_title ?? "Admin Panel"); ?>
    </div>
    <div class="navbar-user">
        <span>Halo, <?php echo htmlspecialchars($_SESSION['full_name'] ?? 'Admin'); ?>!</span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</header>