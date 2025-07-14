
<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

            <main class="content">
                <h2>Laporan Pendapatan & Pemesanan</h2>

                <?php if (!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>

                <div class="report-filters">
                    <form action="admin_reports.php" method="GET" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                        <div class="form-group">
                            <label for="start_date">Dari Tanggal:</label>
                            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($startDate); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Sampai Tanggal:</label>
                            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>" required>
                        </div>
                        <button type="submit" class="btn-filter">Filter Laporan</button>
                    </form>
                </div>

                <div class="summary-cards">
                    <div class="card">
                        <h4>Total Pendapatan (Paid)</h4>
                        <div class="value revenue">
                            Rp <?php echo number_format($totalRevenue, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Pemesanan Selesai</h4>
                        <div class="value neutral">
                            <?php echo number_format($completedBookingsCount, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Pemesanan Berjalan</h4>
                        <div class="value neutral">
                            <?php echo number_format($onGoingBookingsCount, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Pemesanan Pending</h4>
                        <div class="value neutral">
                            <?php echo number_format($pendingBookingsCount, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Pemesanan Dibatalkan</h4>
                        <div class="value neutral">
                            <?php echo number_format($cancelledBookingsCount, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Total Pemesanan</h4>
                        <div class="value neutral">
                            <?php echo number_format($totalBookingsCount, 0, ',', '.'); ?>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <h3>Detail Pemesanan (Periode Ini)</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Mobil (Plat)</th>
                                <th>Tgl Ambil</th>
                                <th>Tgl Kembali</th>
                                <th>Lokasi Jemput</th>
                                <th>Lokasi Kembali</th>
                                <th>Harga Harian</th>
                                <th>Harga Dasar</th>
                                <th>Biaya Tambahan</th>
                                <th>Diskon</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['booking_id'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($booking['user_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars(($booking['make'] ?? 'N/A') . ' ' . ($booking['model'] ?? 'N/A') . ' (' . ($booking['license_plate'] ?? 'N/A') . ')'); ?></td>
                                        <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking['pickup_datetime'] ?? '')) ?: 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking['return_datetime'] ?? '')) ?: 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($booking['pickup_location_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($booking['return_location_name'] ?? 'N/A'); ?></td>
                                        <td>Rp <?php echo number_format($booking['daily_rate'] ?? 0, 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($booking['base_rental_price'] ?? 0, 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($booking['extra_charges'] ?? 0, 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($booking['discount_amount'] ?? 0, 0, ',', '.'); ?></td>
                                        <td><strong>Rp <?php echo number_format($booking['total_price'] ?? 0, 0, ',', '.'); ?></strong></td>
                                        <td>
                                            <?php
                                            $status = htmlspecialchars($booking['booking_status'] ?? 'unknown');
                                            $status_class = strtolower(str_replace(' ', '_', $status));
                                            echo '<span class="status-badge ' . $status_class . '">' . $status . '</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $payment_status = htmlspecialchars($booking['payment_status'] ?? 'unknown');
                                            $payment_status_class = strtolower(str_replace(' ', '_', $payment_status));
                                            echo '<span class="status-badge ' . $payment_status_class . '">' . $payment_status . '</span>';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="14">Tidak ada data pemesanan pada periode ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </main>

<?php include 'includes/_admin_layout_end.php'; ?>