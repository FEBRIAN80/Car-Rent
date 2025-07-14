

<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

                <?php echo $message; ?>

                <?php if ($booking_data): ?>
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Detail Pemesanan #<?php echo htmlspecialchars($booking_data['booking_id'] ?? 'N/A'); ?></h3>
                        
                        <div class="detail-grid">
                            <div class="detail-section">
                                <h4>Info Pengguna</h4>
                                <table class="detail-table">
                                    <tr><th>Nama Lengkap</th><td><?php echo htmlspecialchars($booking_data['user_name'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Email</th><td><?php echo htmlspecialchars($booking_data['user_email'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>No. Telepon</th><td><?php echo htmlspecialchars($booking_data['user_phone'] ?? 'N/A'); ?></td></tr>
                                </table>
                            </div>

                            <div class="detail-section">
                                <h4>Info Mobil</h4>
                                <table class="detail-table">
                                    <tr><th>Merek</th><td><?php echo htmlspecialchars($booking_data['make'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Model</th><td><?php echo htmlspecialchars($booking_data['model'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Tahun</th><td><?php echo htmlspecialchars($booking_data['year'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Plat Nomor</th><td><?php echo htmlspecialchars($booking_data['license_plate'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Gambar Mobil</th>
                                        <td>
                                            <?php if (!empty($booking_data['car_image'])): ?>
                                                <img src="<?php echo htmlspecialchars($booking_data['car_image']); ?>" alt="Gambar Mobil" style="width: 150px; height: auto; border-radius: 5px;">
                                            <?php else: ?>
                                                Tidak Ada Gambar
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="detail-section">
                                <h4>Detail Pemesanan</h4>
                                <table class="detail-table">
                                    <tr><th>ID Pemesanan</th><td><?php echo htmlspecialchars($booking_data['booking_id'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Tanggal & Waktu Jemput</th><td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking_data['pickup_datetime'] ?? '')) ?: 'N/A'); ?></td></tr>
                                    <tr><th>Tanggal & Waktu Kembali</th><td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking_data['return_datetime'] ?? '')) ?: 'N/A'); ?></td></tr>
                                    <tr><th>Lokasi Jemput</th><td><?php echo htmlspecialchars($booking_data['pickup_location'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Lokasi Kembali</th><td><?php echo htmlspecialchars($booking_data['return_location'] ?? 'N/A'); ?></td></tr>
                                    <tr><th>Harga Harian (Saat Pemesanan)</th><td>Rp <?php echo number_format($booking_data['daily_rate'] ?? 0, 0, ',', '.'); ?></td></tr>
                                    <tr><th>Harga Dasar Sewa</th><td>Rp <?php echo number_format($booking_data['base_rental_price'] ?? 0, 0, ',', '.'); ?></td></tr>
                                    <tr><th>Biaya Tambahan</th><td>Rp <?php echo number_format($booking_data['extra_charges'] ?? 0, 0, ',', '.'); ?></td></tr>
                                    <tr><th>Diskon</th><td>Rp <?php echo number_format($booking_data['discount_amount'] ?? 0, 0, ',', '.'); ?></td></tr>
                                    <tr><th>Total Harga</th><td>Rp <?php echo number_format($booking_data['total_price'] ?? 0, 0, ',', '.'); ?></td></tr>
                                    <tr><th>Status Pemesanan</th>
                                        <td>
                                            <?php
                                            $booking_status_display = htmlspecialchars($booking_data['booking_status'] ?? 'N/A');
                                            $status_class = strtolower(str_replace(' ', '_', $booking_status_display));
                                            echo '<span class="status-badge ' . $status_class . '">' . $booking_status_display . '</span>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr><th>Status Pembayaran</th>
                                        <td>
                                            <?php
                                            $payment_status_display = htmlspecialchars($booking_data['payment_status'] ?? 'N/A');
                                            $payment_status_class = strtolower($payment_status_display);
                                            echo '<span class="status-badge ' . $payment_status_class . '">' . $payment_status_display . '</span>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr><th>Catatan</th><td><?php echo htmlspecialchars($booking_data['notes'] ?? 'Tidak ada'); ?></td></tr>
                                    <tr><th>Dibuat Pada</th><td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking_data['created_at'] ?? '')) ?: 'N/A'); ?></td></tr>
                                    <tr><th>Diperbarui Pada</th><td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking_data['updated_at'] ?? '')) ?: 'N/A'); ?></td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top: 20px;">
                            <a href="admin_manage_bookings.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pemesanan</a>
                            <a href="admin_manage_bookings.php?action=edit&id=<?php echo htmlspecialchars($booking_data['booking_id'] ?? ''); ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit Pemesanan Ini</a>
                        </div>
                    </div>
                <?php endif; ?>

<?php include 'includes/_admin_layout_end.php'; ?>

<style>
    /* Specific styles for detail page */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive columns */
        gap: 20px;
        margin-top: 20px;
    }

    .detail-section {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .detail-section h4 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table tr {
        border-bottom: 1px solid #e9ecef;
    }

    .detail-table tr:last-child {
        border-bottom: none;
    }

    .detail-table th, .detail-table td {
        padding: 8px 0;
        vertical-align: top;
    }

    .detail-table th {
        text-align: left;
        font-weight: 600;
        color: #555;
        width: 40%; /* Adjust as needed */
        padding-right: 15px;
    }

    .detail-table td {
        text-align: left;
    }

    .detail-table img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    /* Reuse status-badge from main CSS */
    .status-badge {
        padding: 5px 8px;
        border-radius: 4px;
        font-size: 0.85em;
        font-weight: bold;
        color: white;
        text-transform: capitalize;
    }

    /* Example status colors (ensure these are in your _html_head.php CSS or global CSS) */
    .status-badge.pending { background-color: #fd7e14; } /* Orange */
    .status-badge.confirmed { background-color: #007bff; } /* Blue */
    .status-badge.on_going { background-color: #28a745; } /* Green */
    .status-badge.completed { background-color: #6f42c1; } /* Purple */
    .status-badge.cancelled { background-color: #dc3545; } /* Red */
    .status-badge.paid { background-color: #28a745; } /* Green */
    .status-badge.refunded { background-color: #6c757d; } /* Grey */

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr; /* Stack on small screens */
        }
        .detail-table th {
            width: 50%; /* Adjust for better alignment on small screens */
        }
    }
</style>