

<?php include 'includes/_html_head.php'; // Panggil bagian <head> ?>
<?php include 'includes/_admin_layout_start.php'; // Panggil pembuka layout ?>

                <h2>Verifikasi Dokumen Pengguna</h2>

                <?php echo $message; // Tampilkan pesan feedback ?>

                <div class="table-container">
                    <p>Daftar pengguna dengan dokumen yang perlu diverifikasi atau sudah diverifikasi:</p>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>NIK</th>
                                <th>Gambar KTP</th>
                                <th>No. SIM</th>
                                <th>Gambar SIM</th>
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users_for_verification) > 0): ?>
                                <?php foreach ($users_for_verification as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['phone_number'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['nik'] ?? '-'); ?></td>
                                        <td>
                                            <?php if ($user['id_card_image_url'] && file_exists($user['id_card_image_url'])): ?>
                                                <?php $file_ext_ktp = strtolower(pathinfo($user['id_card_image_url'], PATHINFO_EXTENSION)); ?>
                                                <?php if (in_array($file_ext_ktp, ['jpg', 'png', 'jpeg', 'gif'])): ?>
                                                    <img src="<?php echo htmlspecialchars($user['id_card_image_url']); ?>" alt="KTP" class="doc-img-thumbnail">
                                                <?php endif; ?>
                                                <a href="<?php echo htmlspecialchars($user['id_card_image_url']); ?>" target="_blank" class="doc-link">Lihat Dokumen (<?php echo strtoupper($file_ext_ktp); ?>)</a>
                                            <?php else: ?>
                                                Tidak Ada
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['driver_license_number'] ?? '-'); ?></td>
                                        <td>
                                            <?php if ($user['driver_license_image_url'] && file_exists($user['driver_license_image_url'])): ?>
                                                <?php $file_ext_sim = strtolower(pathinfo($user['driver_license_image_url'], PATHINFO_EXTENSION)); ?>
                                                <?php if (in_array($file_ext_sim, ['jpg', 'png', 'jpeg', 'gif'])): ?>
                                                    <img src="<?php echo htmlspecialchars($user['driver_license_image_url']); ?>" alt="SIM" class="doc-img-thumbnail">
                                                <?php endif; ?>
                                                <a href="<?php echo htmlspecialchars($user['driver_license_image_url']); ?>" target="_blank" class="doc-link">Lihat Dokumen (<?php echo strtoupper($file_ext_sim); ?>)</a>
                                            <? else: ?>
                                                Tidak Ada
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="status-badge <?php echo htmlspecialchars($user['document_verification_status']); ?>">
                                                <?php echo htmlspecialchars($user['document_verification_status']); ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <form action="admin_verify_documents.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                                <select name="new_document_verification_status" required>
                                                    <option value="pending" <?php echo ($user['document_verification_status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="verified" <?php echo ($user['document_verification_status'] === 'verified') ? 'selected' : ''; ?>>Verified</option>
                                                    <option value="rejected" <?php echo ($user['document_verification_status'] === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                                </select>
                                                <button type="submit" name="update_verification_status">Update Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">Tidak ada pengguna untuk diverifikasi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

<?php include 'includes/_admin_layout_end.php'; // Panggil penutup layout ?>