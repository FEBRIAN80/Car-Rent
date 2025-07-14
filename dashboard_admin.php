
<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

                <h2>Selamat Datang, <?php echo htmlspecialchars($greeting_name); ?>!</h2>
                
                <div class="summary-cards">
                    <div class="card">
                        <h4><i class="fas fa-car"></i> Total Mobil</h4>
                        <div class="value neutral"><?php echo number_format($total_cars); ?></div>
                    </div>
                    <div class="card">
                        <h4><i class="fas fa-check-circle"></i> Mobil Tersedia</h4>
                        <div class="value neutral"><?php echo number_format($available_cars); ?></div>
                    </div>
                    <div class="card">
                        <h4><i class="fas fa-users"></i> Total Pengguna</h4>
                        <div class="value neutral"><?php echo number_format($total_users); ?></div>
                    </div>
                    <div class="card">
                        <h4><i class="fas fa-book-open"></i> Total Pemesanan</h4>
                        <div class="value neutral"><?php echo number_format($total_bookings); ?></div>
                    </div>
                    <div class="card">
                        <h4><i class="fas fa-hourglass-half"></i> Pemesanan Tertunda</h4>
                        <div class="value neutral"><?php echo number_format($pending_bookings); ?></div>
                    </div>
                </div>

                <?php if (!empty($document_notifications)): ?>
                    <div class="document-notifications message error">
                        <h3><i class="fas fa-exclamation-triangle"></i> Peringatan Dokumen Jatuh Tempo!</h3>
                        <ul>
                            <?php foreach ($document_notifications as $notification): ?>
                                <li>Dokumen **<?php echo htmlspecialchars($notification['document_type']); ?>** untuk mobil **<?php echo htmlspecialchars($notification['make'] . ' ' . $notification['model']); ?>** (Plat: <?php echo htmlspecialchars($notification['license_plate']); ?>) akan jatuh tempo pada **<?php echo htmlspecialchars(date('d M Y', strtotime($notification['expiry_date']))); ?>** (Sisa <?php echo htmlspecialchars($notification['days_left']); ?> hari). <a href="admin_manage_cars.php?edit_car_id=<?php echo $notification['car_id']; ?>">Kelola Mobil</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="car-status-section form-section">
                    <h3><i class="fas fa-car-alt"></i> Status Mobil Saat Ini</h3>
                    <div class="summary-cards">
                        <div class="card">
                            <h4>Tersedia</h4>
                            <div class="value available"><?php echo number_format($car_statuses['available']); ?></div>
                        </div>
                        <div class="card">
                            <h4>Disewa</h4>
                            <div class="value rented"><?php echo number_format($car_statuses['rented']); ?></div>
                        </div>
                        <div class="card">
                            <h4>Perawatan</h4>
                            <div class="value maintenance"><?php echo number_format($car_statuses['maintenance']); ?></div>
                        </div>
                        <div class="card">
                            <h4>Tidak Tersedia</h4>
                            <div class="value unavailable"><?php echo number_format($car_statuses['unavailable']); ?></div>
                        </div>
                    </div>
                </div>

                <div class="recent-activity-section table-container">
                    <h3><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_activities)): ?>
                                <?php foreach ($recent_activities as $activity): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($activity['type']); ?></td>
                                    <td><?php echo htmlspecialchars($activity['description']); ?></td>
                                    <td><?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($activity['activity_time']))); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Tidak ada aktivitas terbaru yang ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

<?php include 'includes/_admin_layout_end.php'; ?>