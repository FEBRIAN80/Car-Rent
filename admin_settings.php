

// Memanggil file header HTML utama (berisi <head>, <title>, dll.)
include 'includes/_html_head.php';
?>

<style>
    /* Umum */
    .content {
        padding: 20px;
    }
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    .card h2 {
        color: #333;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.5em;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        font-size: 1em;
    }
    /* Checkbox specific styling */
    .form-group input[type="checkbox"] {
        width: auto; /* Overrides 100% width for text inputs */
        margin-right: 10px;
    }
    .form-group.checkbox-group label {
        display: inline-block; /* Aligns label with checkbox */
        font-weight: normal; /* Less bold for checkbox label */
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="number"]:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #218838;
    }

    /* Pesan Status */
    .message {
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }
    .message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<?php
// Memanggil bagian awal layout admin (biasanya berisi <body>, sidebar, navbar, dll.)
include 'includes/_admin_layout_start.php';
?>

<main class="content">
    <h1><?php echo $page_title; ?></h1>

    <?php echo $message; // Tampilkan pesan ?>

    <div class="card">
        <h2>General Settings</h2>
        <form action="admin_settings.php" method="POST">
            <div class="form-group">
                <label for="setting_app_name">Nama Aplikasi/Situs:</label>
                <input type="text" id="setting_app_name" name="setting_app_name" 
                       value="<?php echo htmlspecialchars($settings['app_name'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="setting_contact_email">Email Kontak Sistem:</label>
                <input type="email" id="setting_contact_email" name="setting_contact_email" 
                       value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="setting_default_currency">Mata Uang Default:</label>
                <input type="text" id="setting_default_currency" name="setting_default_currency" 
                       value="<?php echo htmlspecialchars($settings['default_currency'] ?? 'IDR'); ?>" 
                       placeholder="Contoh: IDR, USD" required>
                <small>Gunakan kode mata uang internasional (misal: IDR untuk Rupiah Indonesia).</small>
            </div>

            <div class="form-group">
                <label for="setting_default_tax_rate">Tingkat Pajak Default (%):</label>
                <input type="number" id="setting_default_tax_rate" name="setting_default_tax_rate" 
                       value="<?php echo htmlspecialchars($settings['default_tax_rate'] ?? '0.00'); ?>" 
                       step="0.01" min="0" max="100" required>
                <small>Masukkan nilai persentase (misal: 10.00 untuk 10%).</small>
            </div>

            <hr> <h2>Rental Business Settings</h2>

            <div class="form-group">
                <label for="setting_default_overdue_fine_per_day">Denda Keterlambatan Default (per hari):</label>
                <input type="number" id="setting_default_overdue_fine_per_day" name="setting_default_overdue_fine_per_day" 
                       value="<?php echo htmlspecialchars($settings['default_overdue_fine_per_day'] ?? '50000.00'); ?>" 
                       step="1000" min="0" required>
                <small>Dalam format angka (misal: 50000 untuk Rp 50.000).</small>
            </div>

            <div class="form-group">
                <label for="setting_minimum_rental_duration_days">Durasi Rental Minimum (hari):</label>
                <input type="number" id="setting_minimum_rental_duration_days" name="setting_minimum_rental_duration_days" 
                       value="<?php echo htmlspecialchars($settings['minimum_rental_duration_days'] ?? '1'); ?>" 
                       min="1" required>
                <small>Jumlah hari minimal mobil dapat disewa.</small>
            </div>
            
            <hr>

            <h2>User & Booking Settings</h2>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="setting_enable_user_registration" name="setting_enable_user_registration" 
                       <?php echo (isset($settings['enable_user_registration']) && $settings['enable_user_registration'] == '1') ? 'checked' : ''; ?>>
                <label for="setting_enable_user_registration">Aktifkan Pendaftaran Pengguna Baru</label>
                <small style="display: block; margin-top: 5px;">Izinkan pengguna mendaftar akun baru melalui halaman pendaftaran.</small>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="setting_require_doc_verification_for_booking" name="setting_require_doc_verification_for_booking" 
                       <?php echo (isset($settings['require_doc_verification_for_booking']) && $settings['require_doc_verification_for_booking'] == '1') ? 'checked' : ''; ?>>
                <label for="setting_require_doc_verification_for_booking">Wajib Verifikasi Dokumen untuk Pemesanan</label>
                <small style="display: block; margin-top: 5px;">Pengguna harus memiliki status verifikasi dokumen 'Verified' untuk dapat membuat pemesanan.</small>
            </div>

            <button type="submit" name="save_settings" class="btn-submit">Simpan Pengaturan</button>
        </form>
    </div>
</main>

<?php
// Memanggil bagian penutup layout admin (biasanya berisi </div> penutup dan </body>, </html>)
include 'includes/_admin_layout_end.php';
?>