<?php
$current_page = basename($_SERVER['PHP_SELF']);

function is_parent_active($current_page, $sub_pages) {
    return in_array($current_page, $sub_pages);
}

// PERBARUI BARIS INI: Hapus 'admin_manage_locations.php'
$management_asset_pages = ['admin_manage_cars.php', 'admin_manage_maintenance.php', 'admin_car_tracker.php', 'admin_manage_documents.php'];
$management_transaction_pages = ['admin_manage_bookings.php', 'admin_manage_payments.php', 'admin_promotions.php'];
$management_user_pages = ['admin_manage_users.php', 'admin_verify_documents.php', 'admin_manage_reviews.php'];
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="assets/logo.png" alt="Logo Perusahaan" class="sidebar-logo">
        <h2>Admin Panel</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="dashboard_admin.php" class="<?= $current_page == 'dashboard_admin.php' ? 'active' : ''; ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <li class="sidebar-dropdown <?= is_parent_active($current_page, $management_asset_pages) ? 'active' : ''; ?>" id="dropdown-aset">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-fw fa-car-alt"></i> Manajemen Aset <i class="fas fa-caret-down dropdown-icon"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_manage_cars.php" class="<?= $current_page == 'admin_manage_cars.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-car"></i> Mobil</a></li>
                    <li><a href="admin_manage_maintenance.php" class="<?= $current_page == 'admin_manage_maintenance.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-tools"></i> Maintenance</a></li>
                    <li><a href="admin_car_tracker.php" class="<?= $current_page == 'admin_car_tracker.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-map-marker-alt"></i> Pelacakan Mobil</a></li>
                    </ul>
            </li>

            <li class="sidebar-dropdown <?= is_parent_active($current_page, $management_transaction_pages) ? 'active' : ''; ?>" id="dropdown-transaksi">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-fw fa-exchange-alt"></i> Manajemen Transaksi <i class="fas fa-caret-down dropdown-icon"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_manage_bookings.php" class="<?= $current_page == 'admin_manage_bookings.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-book"></i> Pemesanan</a></li>
                    <li><a href="admin_manage_payments.php" class="<?= $current_page == 'admin_manage_payments.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-money-bill-wave"></i> Pembayaran</a></li>
                    <li><a href="admin_promotions.php" class="<?= $current_page == 'admin_promotions.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-tags"></i> Promo & Diskon</a></li>
                </ul>
            </li>

            <li class="sidebar-dropdown <?= is_parent_active($current_page, $management_user_pages) ? 'active' : ''; ?>" id="dropdown-user">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-fw fa-users"></i> Manajemen Pengguna <i class="fas fa-caret-down dropdown-icon"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_manage_users.php" class="<?= $current_page == 'admin_manage_users.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-user"></i> Pengguna</a></li>
                    <li><a href="admin_verify_documents.php" class="<?= $current_page == 'admin_verify_documents.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-file-alt"></i> Verifikasi</a></li>
                    <li><a href="admin_manage_reviews.php" class="<?= $current_page == 'admin_manage_reviews.php' ? 'active' : ''; ?>"><i class="fas fa-fw fa-star"></i> Ulasan</a></li>
                </ul>
            </li>

            <li>
                <a href="admin_reports.php" class="<?= $current_page == 'admin_reports.php' ? 'active' : ''; ?>">
                    <i class="fas fa-fw fa-chart-line"></i> Laporan & Statistik
                </a>
            </li>

            <li>
                <a href="admin_settings.php" class="<?= $current_page == 'admin_settings.php' ? 'active' : ''; ?>">
                    <i class="fas fa-fw fa-cogs"></i> Pengaturan Sistem
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggles = document.querySelectorAll(".sidebar-dropdown .dropdown-toggle");

    const openDropdowns = JSON.parse(localStorage.getItem("sidebar-open-dropdowns") || "[]");

    openDropdowns.forEach(id => {
        const dropdown = document.getElementById(id);
        if (dropdown) dropdown.classList.add("open");
    });

    dropdownToggles.forEach(function (toggle) {
        const parent = toggle.closest(".sidebar-dropdown");
        const id = parent.id;

        toggle.addEventListener("click", function (e) {
            e.preventDefault(); // Hindari scroll ke atas karena <a href="#">

            let current = JSON.parse(localStorage.getItem("sidebar-open-dropdowns") || "[]");

            parent.classList.toggle("open");

            if (parent.classList.contains("open")) {
                if (!current.includes(id)) current.push(id);
            } else {
                current = current.filter(item => item !== id);
            }

            localStorage.setItem("sidebar-open-dropdowns", JSON.stringify(current));
        });
    });
});
</script>