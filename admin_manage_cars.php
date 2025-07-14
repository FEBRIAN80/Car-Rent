<

<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

                <?php echo $message; ?>

                <div class="form-section">
                    <h3><i class="fas fa-car-plus"></i> <?php echo ($editCarData ? 'Edit' : 'Tambah') . ' Mobil'; ?></h3>
                    <form action="admin_manage_cars.php" method="POST">
                        <?php if ($editCarData): ?>
                            <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($editCarData['car_id']); ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="make">Merek:</label>
                            <input type="text" id="make" name="make" value="<?php echo htmlspecialchars($editCarData['make'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Model:</label>
                            <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($editCarData['model'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Tahun:</label>
                            <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($editCarData['year'] ?? ''); ?>" required min="1900" max="<?php echo date('Y') + 1; ?>">
                        </div>
                        <div class="form-group">
                            <label for="license_plate">Plat Nomor:</label>
                            <input type="text" id="license_plate" name="license_plate" value="<?php echo htmlspecialchars($editCarData['license_plate'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="daily_rate">Harga Sewa Harian (Rp):</label>
                            <input type="number" id="daily_rate" name="daily_rate" value="<?php echo htmlspecialchars($editCarData['daily_rate'] ?? ''); ?>" required step="0.01" min="0">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" required>
                                <option value="available" <?php echo (($editCarData['status'] ?? '') == 'available' ? 'selected' : ''); ?>>Tersedia</option>
                                <option value="rented" <?php echo (($editCarData['status'] ?? '') == 'rented' ? 'selected' : ''); ?>>Disewa</option>
                                <option value="maintenance" <?php echo (($editCarData['status'] ?? '') == 'maintenance' ? 'selected' : ''); ?>>Perawatan</option>
                                <option value="unavailable" <?php echo (($editCarData['status'] ?? '') == 'unavailable' ? 'selected' : ''); ?>>Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi:</label>
                            <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($editCarData['description'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url">URL Gambar Mobil:</label>
                            <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($editCarData['image_url'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_maintenance_date">Tanggal Perawatan Terakhir:</label>
                            <input type="date" id="last_maintenance_date" name="last_maintenance_date" value="<?php echo htmlspecialchars($editCarData['last_maintenance_date'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="next_maintenance_date">Tanggal Perawatan Berikutnya:</label>
                            <input type="date" id="next_maintenance_date" name="next_maintenance_date" value="<?php echo htmlspecialchars($editCarData['next_maintenance_date'] ?? ''); ?>">
                        </div>
                        <div class="form-actions">
                            <?php if ($editCarData): ?>
                                <button type="submit" name="edit_car" class="btn-primary"><i class="fas fa-save"></i> Perbarui Mobil</button>
                                <a href="admin_manage_cars.php" class="btn-secondary"><i class="fas fa-times"></i> Batal Edit</a>
                            <?php else: ?>
                                <button type="submit" name="add_car" class="btn-primary"><i class="fas fa-plus"></i> Tambah Mobil</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <div class="table-container">
                    <h3><i class="fas fa-list"></i> Daftar Mobil</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Merek</th>
                                <th>Model</th>
                                <th>Tahun</th>
                                <th>Plat Nomor</th>
                                <th>Harga Harian</th>
                                <th>Status</th>
                                <th>Perawatan Terakhir</th>
                                <th>Perawatan Berikutnya</th>
                                <th>Aksi</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($cars)): ?>
                                <?php foreach ($cars as $car): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                                        <td>
                                            <?php if (!empty($car['image_url'])): ?>
                                                <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" style="width: 80px; height: auto; border-radius: 5px;">
                                            <?php else: ?>
                                                Tidak Ada Gambar
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($car['make']); ?></td>
                                        <td><?php echo htmlspecialchars($car['model']); ?></td>
                                        <td><?php echo htmlspecialchars($car['year']); ?></td>
                                        <td><?php echo htmlspecialchars($car['license_plate']); ?></td>
                                        <td>Rp <?php echo number_format($car['daily_rate'], 0, ',', '.'); ?></td>
                                        <td>
                                            <?php
                                            $status_class = strtolower(htmlspecialchars($car['status']));
                                            echo '<span class="status-badge ' . $status_class . '">' . htmlspecialchars($car['status']) . '</span>';
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($car['last_maintenance_date'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($car['next_maintenance_date'] ?? 'N/A'); ?></td>
                                        <td class="actions">
                                            <a href="admin_manage_cars.php?action=edit&id=<?php echo htmlspecialchars($car['car_id']); ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="admin_manage_cars.php?action=delete&id=<?php echo htmlspecialchars($car['car_id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini dan semua dokumennya?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                        <td>
                                            <a href="admin_manage_documents.php?car_id=<?php echo htmlspecialchars($car['car_id']); ?>" class="btn-primary btn-small"><i class="fas fa-folder-open"></i> Kelola Dokumen</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">Tidak ada data mobil.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

<?php include 'includes/_admin_layout_end.php'; ?>