
<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

            <main class="content">
                <?php echo $message; ?>

                <div class="form-section">
                    <h3><i class="fas fa-tags"></i> <?php echo ($editPromotionData ? 'Edit' : 'Tambah') . ' Promo'; ?></h3>
                    <form action="admin_promotions.php" method="POST">
                        <?php if ($editPromotionData): ?>
                            <input type="hidden" name="promotion_id" value="<?php echo htmlspecialchars($editPromotionData['promotion_id']); ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="promo_code">Kode Promo:</label>
                            <input type="text" id="promo_code" name="promo_code" value="<?php echo htmlspecialchars($editPromotionData['promo_code'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="discount_type">Tipe Diskon:</label>
                            <select id="discount_type" name="discount_type" required>
                                <option value="percentage" <?php echo (($editPromotionData['discount_type'] ?? '') == 'percentage' ? 'selected' : ''); ?>>Persentase</option>
                                <option value="fixed" <?php echo (($editPromotionData['discount_type'] ?? '') == 'fixed' ? 'selected' : ''); ?>>Fixed Amount</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discount_value">Nilai Diskon (Persentase atau Jumlah):</label>
                            <input type="number" id="discount_value" name="discount_value" value="<?php echo htmlspecialchars($editPromotionData['discount_value'] ?? '0'); ?>" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="min_rental_price">Harga Sewa Minimum untuk Aplikasi (Rp):</label>
                            <input type="number" id="min_rental_price" name="min_rental_price" value="<?php echo htmlspecialchars($editPromotionData['min_rental_price'] ?? '0'); ?>" step="0.01" min="0">
                        </div>
                        <div class="form-group">
                            <label for="max_discount_amount">Maksimal Diskon (Rp, opsional):</label>
                            <input type="number" id="max_discount_amount" name="max_discount_amount" value="<?php echo htmlspecialchars($editPromotionData['max_discount_amount'] ?? ''); ?>" step="0.01" min="0">
                            <small>Biarkan kosong jika tidak ada batasan maksimal.</small>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($editPromotionData['start_date'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai:</label>
                            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($editPromotionData['end_date'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usage_limit">Batas Penggunaan (opsional):</label>
                            <input type="number" id="usage_limit" name="usage_limit" value="<?php echo htmlspecialchars($editPromotionData['usage_limit'] ?? ''); ?>" min="0">
                            <small>Jumlah total kali promo ini dapat digunakan. Biarkan kosong jika tidak ada batasan.</small>
                        </div>
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="is_active" name="is_active" value="1" <?php echo (($editPromotionData['is_active'] ?? 0) == 1 ? 'checked' : ''); ?>>
                            <label for="is_active">Aktif</label>
                        </div>

                        <div class="form-actions">
                            <?php if ($editPromotionData): ?>
                                <button type="submit" name="edit_promotion" class="btn-primary"><i class="fas fa-save"></i> Perbarui Promo</button>
                                <a href="admin_promotions.php" class="btn-secondary"><i class="fas fa-times"></i> Batal Edit</a>
                            <?php else: ?>
                                <button type="submit" name="add_promotion" class="btn-primary"><i class="fas fa-plus"></i> Tambah Promo</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <div class="table-container">
                    <h3><i class="fas fa-list-alt"></i> Daftar Promo</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Promo</th>
                                <th>Tipe Diskon</th>
                                <th>Nilai Diskon</th>
                                <th>Min Sewa</th>
                                <th>Maks Diskon</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Batas Penggunaan</th>
                                <th>Digunakan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($promotions)): ?>
                                <?php foreach ($promotions as $promo): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($promo['promotion_id'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($promo['promo_code'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($promo['discount_type'] ?? 'N/A'); ?></td>
                                        <td>
                                            <?php 
                                            echo htmlspecialchars(number_format($promo['discount_value'] ?? 0, 0, ',', '.')) . 
                                            (($promo['discount_type'] ?? '') == 'percentage' ? '%' : ' Rp'); 
                                            ?>
                                        </td>
                                        <td>Rp <?php echo htmlspecialchars(number_format($promo['min_rental_price'] ?? 0, 0, ',', '.')); ?></td>
                                        <td>
                                            <?php echo !empty($promo['max_discount_amount']) ? 'Rp ' . htmlspecialchars(number_format($promo['max_discount_amount'], 0, ',', '.')) : 'Tidak Ada'; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars(date('d M Y', strtotime($promo['start_date'] ?? '')) ?: 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars(date('d M Y', strtotime($promo['end_date'] ?? '')) ?: 'N/A'); ?></td>
                                        <td>
                                            <?php echo !empty($promo['usage_limit']) ? htmlspecialchars($promo['usage_limit']) : 'Tidak Ada'; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($promo['times_used'] ?? '0'); ?></td>
                                        <td>
                                            <?php
                                            $current_date = date('Y-m-d');
                                            $status_class = '';
                                            $status_text = 'Tidak Aktif';

                                            if (($promo['is_active'] ?? 0) == 1 && $current_date >= ($promo['start_date'] ?? '') && $current_date <= ($promo['end_date'] ?? '')) {
                                                $status_class = 'active';
                                                $status_text = 'Aktif';
                                            } else {
                                                $status_class = 'inactive';
                                                $status_text = 'Tidak Aktif';
                                            }
                                            // Override status text if usage limit reached
                                            if (!empty($promo['usage_limit']) && ($promo['times_used'] ?? 0) >= ($promo['usage_limit'] ?? 0)) {
                                                $status_class = 'inactive';
                                                $status_text = 'Batas Penggunaan Tercapai';
                                            }
                                            ?>
                                            <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                        </td>
                                        <td class="actions">
                                            <a href="admin_promotions.php?action=edit&id=<?php echo htmlspecialchars($promo['promotion_id'] ?? ''); ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="admin_promotions.php?action=delete&id=<?php echo htmlspecialchars($promo['promotion_id'] ?? ''); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus promo ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">Tidak ada data promo.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </main>

            <footer class="footer">
                <p>&copy; <?php echo date('Y'); ?> Aplikasi Rental Mobil. Semua Hak Dilindungi.</p>
            </footer>
        </div>
    </div>
</body>
</html>