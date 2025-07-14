
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Rental Mobil</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5; /* Light grey background */
            color: #333;
            display: flex;
            min-height: 100vh;
            flex-direction: column; /* Untuk menempatkan footer di bagian bawah */
        }

        .dashboard-wrapper {
            display: flex;
            width: 100%;
            flex-grow: 1; /* Agar wrapper mengisi ruang yang tersedia */
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #3498db; /* Blue for customer sidebar */
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            position: fixed; /* Sidebar tetap di tempat */
            height: 100%;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-logo {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .sidebar-header h2 {
            font-size: 1.5em;
            margin: 0;
            color: #ecf0f1;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav ul li a {
            display: block;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-left: 5px solid transparent;
        }

        .sidebar-nav ul li a:hover {
            background-color: #2980b9; /* Darker blue on hover */
            color: #fff;
        }

        .sidebar-nav ul li a.active {
            background-color: #ffffff; /* White for active item */
            color: #3498db; /* Blue text for active item */
            border-left-color: #3498db;
            font-weight: bold;
        }

        /* Main Content Panel */
        .main-panel {
            margin-left: 250px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .navbar-user span {
            margin-right: 15px;
            color: #555;
        }

        .btn-logout {
            background-color: #e74c3c; /* Red for logout */
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        /* Main Content Area */
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f9fbfd;
        }

        .content h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        /* Dashboard Summary Cards */
        .dashboard-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .summary-card {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.2s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        .summary-card h3 {
            color: #3498db; /* Blue for customer theme */
            font-size: 1.4em;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .summary-card p {
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin: 0 0 15px 0;
        }

        .summary-card a {
            display: inline-block;
            background-color: #ecf0f1; /* Light grey button */
            color: #3498db;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        .summary-card a:hover {
            background-color: #bdc3c7;
        }

        /* General Section Styling (for Notifications, etc.) */
        .dashboard-section {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .dashboard-section h3 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .dashboard-section ul {
            list-style: none;
            padding: 0;
        }

        .dashboard-section ul li {
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            color: #555;
        }

        .dashboard-section ul li:last-child {
            border-bottom: none;
        }

        /* Footer Styling */
        .footer {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            color: #777;
            font-size: 0.9em;
            border-top: 1px solid #eee;
            margin-top: auto; /* Untuk menempatkan footer di paling bawah */
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }
            .main-panel {
                margin-left: 200px;
            }
            .navbar {
                padding: 15px 20px;
            }
            .content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                padding: 15px 0;
            }
            .sidebar-header {
                display: none;
            }
            .sidebar-nav ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
            }
            .sidebar-nav ul li {
                margin: 0 5px;
            }
            .sidebar-nav ul li a {
                padding: 10px 15px;
                border-left: none;
                border-bottom: 3px solid transparent;
            }
             .sidebar-nav ul li a.active {
                border-left-color: transparent;
                border-bottom-color: #3498db;
            }
            .main-panel {
                margin-left: 0;
            }
            .dashboard-summary {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 15px;
            }
            .navbar-brand {
                font-size: 1.2em;
            }
            .navbar-user span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="assets/logo.png" alt="Logo Perusahaan" class="sidebar-logo">
                <h2>Pelanggan Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="customer_dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="customer_browse_cars.php">Cari Mobil</a></li>
                    <li><a href="customer_my_bookings.php">Pemesanan Saya</a></li>
                    <li><a href="customer_profile.php">Profil Saya</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-panel">
            <header class="navbar">
                <div class="navbar-brand">Dashboard Pelanggan</div>
                <div class="navbar-user">
                    <span>Halo, <?php echo htmlspecialchars($customerFullName); ?>!</span>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </header>

            <main class="content">
                <h2>Ringkasan Akun Anda</h2>
                <p>Informasi dan status terkini mengenai aktivitas Anda.</p>

                <div class="dashboard-summary">
                    <div class="summary-card">
                        <h3>Pemesanan Sedang Berlangsung</h3>
                        <p><?php echo $totalOngoingBookings; ?></p>
                        <a href="customer_my_bookings.php">Lihat Pemesanan</a>
                    </div>
                    <div class="summary-card">
                        <h3>Pemesanan Selesai</h3>
                        <p><?php echo $totalCompletedBookings; ?></p>
                        <a href="customer_my_bookings.php">Riwayat Pemesanan</a>
                    </div>
                    <div class="summary-card">
                        <h3>Status Verifikasi Dokumen</h3>
                        <p><?php echo $pendingVerifications; ?></p>
                        <a href="customer_profile.php">Perbarui Dokumen</a>
                    </div>
                    <div class="summary-card">
                        <h3>Cari Mobil Baru</h3>
                        <p>🎉</p>
                        <a href="customer_browse_cars.php">Mulai Sewa</a>
                    </div>
                </div>

                <div class="dashboard-section">
                    <h3>Notifikasi & Pesan</h3>
                    <ul>
                        <li>Pemesanan Anda untuk Avanza B 1234 CD akan dimulai besok.</li>
                        <li>Dokumen SIM Anda sedang dalam proses verifikasi.</li>
                        <li>Ada promo diskon 10% untuk sewa minimal 3 hari!</li>
                    </ul>
                </div>

                <div class="dashboard-section">
                    <h3>Mobil Rekomendasi</h3>
                    <p>Temukan mobil yang cocok untuk perjalanan Anda.</p>
                    <div style="background-color: #f5f5f5; border: 1px dashed #ccc; padding: 50px; text-align: center; color: #888;">
                        Area untuk Daftar Mobil Rekomendasi
                    </div>
                </div>
            </main>

            <footer class="footer">
                <p>&copy; <?php echo date('Y'); ?> Aplikasi Rental Mobil. Semua Hak Dilindungi.</p>
            </footer>
        </div>
    </div>
</body>
</html>