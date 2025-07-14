<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

<div class="content">
    <h1><?php echo $page_title; ?></h1>

    <?php echo $message; ?>

    <div class="form-container">
        <h2><?php echo ($editMaintenanceData ? 'Edit Data Perawatan' : 'Tambah Data Perawatan Baru'); ?></h2>
        <form action="admin_manage_maintenance.php" method="POST">
            <?php if ($editMaintenanceData): ?>
                <input type="hidden" name="maintenance_id" value="<?php echo htmlspecialchars($editMaintenanceData['maintenance_id']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="car_id">Mobil:</label>
                <select id="car_id" name="car_id" required>
                    <option value="">Pilih Mobil</option>
                    <?php foreach ($cars as $car): ?>
                        <option value="<?php echo htmlspecialchars($car['car_id']); ?>"
                            <?php echo ($editMaintenanceData && $editMaintenanceData['car_id'] == $car['car_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' (' . $car['license_plate'] . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="maintenance_date">Tanggal Perawatan:</label>
                <input type="date" id="maintenance_date" name="maintenance_date" 
                       value="<?php echo htmlspecialchars($editMaintenanceData['maintenance_date'] ?? date('Y-m-d')); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Perawatan:</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($editMaintenanceData['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="cost">Biaya (Rp):</label>
                <input type="number" id="cost" name="cost" step="0.01" min="0"
                       value="<?php echo htmlspecialchars($editMaintenanceData['cost'] ?? '0.00'); ?>" required>
            </div>

            <div class="form-group">
                <label for="next_maintenance_date">Tanggal Perawatan Berikutnya (opsional):</label>
                <input type="date" id="next_maintenance_date" name="next_maintenance_date" 
                       value="<?php echo htmlspecialchars($editMaintenanceData['next_maintenance_date'] ?? ''); ?>">
            </div>
            
            <button type="submit" name="<?php echo ($editMaintenanceData ? 'edit_maintenance' : 'add_maintenance'); ?>" class="btn-primary">
                <?php echo ($editMaintenanceData ? 'Perbarui Perawatan' : 'Tambah Perawatan'); ?>
            </button>
            <?php if ($editMaintenanceData): ?>
                <a href="admin_manage_maintenance.php" class="btn-secondary">Batal Edit</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="data-table-container">
        <h2>Daftar Perawatan Mobil</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mobil</th>
                    <th>Tanggal Perawatan</th>
                    <th>Deskripsi</th>
                    <th>Biaya</th>
                    <th>Perawatan Berikutnya</th>
                    <th>Dibuat Pada</th>
                    <th>Diperbarui Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($maintenanceRecords)): ?>
                    <?php foreach ($maintenanceRecords as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['maintenance_id']); ?></td>
                            <td><?php echo htmlspecialchars($record['make'] . ' ' . $record['model'] . ' (' . $record['license_plate'] . ')'); ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y', strtotime($record['maintenance_date']))); ?></td>
                            <td><?php echo htmlspecialchars($record['description']); ?></td>
                            <td>Rp <?php echo number_format($record['cost'], 0, ',', '.'); ?></td>
                            <td><?php echo !empty($record['next_maintenance_date']) ? htmlspecialchars(date('d M Y', strtotime($record['next_maintenance_date']))): 'N/A'; ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($record['created_at']))); ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($record['updated_at']))); ?></td>
                            <td class="actions">
                                <a href="admin_manage_maintenance.php?action=edit&id=<?php echo htmlspecialchars($record['maintenance_id']); ?>" class="btn-edit">Edit</a>
                                <a href="admin_manage_maintenance.php?action=delete&id=<?php echo htmlspecialchars($record['maintenance_id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan perawatan ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">Tidak ada data perawatan mobil.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'includes/_admin_layout_end.php';
?>