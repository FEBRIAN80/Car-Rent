<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

                <?php echo $message; ?>

                <div class="form-section">
                    <h3><i class="fas fa-user-plus"></i> <?php echo $editUserData ? 'Edit Data Pengguna' : 'Tambah Pengguna Baru'; ?></h3>
                    <form action="admin_manage_users.php" method="POST" enctype="multipart/form-data">
                        <?php if ($editUserData): ?>
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($editUserData['user_id']); ?>">
                            <input type="hidden" name="current_profile_picture_url" value="<?php echo htmlspecialchars($editUserData['profile_picture_url'] ?? ''); ?>">
                            <input type="hidden" name="current_id_card_image_url" value="<?php echo htmlspecialchars($editUserData['id_card_image_url'] ?? ''); ?>">
                            <input type="hidden" name="current_driver_license_image_url" value="<?php echo htmlspecialchars($editUserData['driver_license_image_url'] ?? ''); ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="full_name">Nama Lengkap:</label>
                            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($editUserData['full_name'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($editUserData['email'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">No. Telepon:</label>
                            <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($editUserData['phone_number'] ?? ''); ?>" required>
                        </div>
                        <?php if (!$editUserData): ?>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="role">Role Pengguna:</label>
                            <select id="role" name="role" required>
                                <option value="customer" <?php echo ($editUserData && $editUserData['role'] === 'customer') ? 'selected' : ''; ?>>Customer</option>
                                <option value="staff" <?php echo ($editUserData && $editUserData['role'] === 'staff') ? 'selected' : ''; ?>>Staff</option>
                                <option value="admin" <?php echo ($editUserData && $editUserData['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="document_verification_status">Status Verifikasi Dokumen:</label>
                            <select id="document_verification_status" name="document_verification_status" required>
                                <option value="pending" <?php echo ($editUserData && $editUserData['document_verification_status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="verified" <?php echo ($editUserData && $editUserData['document_verification_status'] === 'verified') ? 'selected' : ''; ?>>Verified</option>
                                <option value="rejected" <?php echo ($editUserData && $editUserData['document_verification_status'] === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" id="nik" name="nik" value="<?php echo htmlspecialchars($editUserData['nik'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="birth_place">Tempat Lahir:</label>
                            <input type="text" id="birth_place" name="birth_place" value="<?php echo htmlspecialchars($editUserData['birth_place'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Tanggal Lahir:</label>
                            <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($editUserData['birth_date'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin:</label>
                            <select id="gender" name="gender">
                                <option value="">Pilih</option>
                                <option value="male" <?php echo ($editUserData && $editUserData['gender'] === 'male') ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="female" <?php echo ($editUserData && $editUserData['gender'] === 'female') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="religion">Agama:</label>
                            <input type="text" id="religion" name="religion" value="<?php echo htmlspecialchars($editUserData['religion'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="marital_status">Status Perkawinan:</label>
                            <input type="text" id="marital_status" name="marital_status" value="<?php echo htmlspecialchars($editUserData['marital_status'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="occupation">Pekerjaan:</label>
                            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($editUserData['occupation'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Kewarganegaraan:</label>
                            <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($editUserData['nationality'] ?? 'WNI'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_card_expiry">Masa Berlaku KTP (Opsional):</label>
                            <input type="date" id="id_card_expiry" name="id_card_expiry" value="<?php echo htmlspecialchars($editUserData['id_card_expiry'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat:</label>
                            <textarea id="address" name="address"><?php echo htmlspecialchars($editUserData['address'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="driver_license_number">Nomor SIM:</label>
                            <input type="text" id="driver_license_number" name="driver_license_number" value="<?php echo htmlspecialchars($editUserData['driver_license_number'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="driver_license_expiry">Masa Berlaku SIM:</label>
                            <input type="date" id="driver_license_expiry" name="driver_license_expiry" value="<?php echo htmlspecialchars($editUserData['driver_license_expiry'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="verification_notes">Catatan Verifikasi Admin:</label>
                            <textarea id="verification_notes" name="verification_notes"><?php echo htmlspecialchars($editUserData['verification_notes'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture_url">Foto Profil:</label>
                            <input type="file" id="profile_picture_url" name="profile_picture_url" accept="image/*">
                            <?php if ($editUserData && $editUserData['profile_picture_url']): ?>
                                <small>Saat ini: <a href="<?php echo htmlspecialchars($editUserData['profile_picture_url']); ?>" target="_blank">Lihat Foto</a></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="id_card_image_url">Gambar KTP:</label>
                            <input type="file" id="id_card_image_url" name="id_card_image_url" accept="image/*,.pdf">
                            <?php if ($editUserData && $editUserData['id_card_image_url']): ?>
                                <small>Saat ini: <a href="<?php echo htmlspecialchars($editUserData['id_card_image_url']); ?>" target="_blank">Lihat Dokumen</a></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="driver_license_image_url">Gambar SIM:</label>
                            <input type="file" id="driver_license_image_url" name="driver_license_image_url" accept="image/*,.pdf">
                            <?php if ($editUserData && $editUserData['driver_license_image_url']): ?>
                                <small>Saat ini: <a href="<?php echo htmlspecialchars($editUserData['driver_license_image_url']); ?>" target="_blank">Lihat Dokumen</a></small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" name="<?php echo $editUserData ? 'edit_user' : 'add_user'; ?>" class="btn-submit">
                            <i class="fas <?php echo $editUserData ? 'fa-save' : 'fa-user-plus'; ?>"></i> <?php echo $editUserData ? 'Perbarui Pengguna' : 'Tambah Pengguna'; ?>
                        </button>
                        <?php if ($editUserData): ?>
                            <a href="admin_manage_users.php" class="btn-secondary"><i class="fas fa-times"></i> Batal Edit</a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="table-container">
                    <h3><i class="fas fa-users-cog"></i> Daftar Pengguna</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Profil</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Role</th>
                                <th>Verifikasi Dokumen</th>
                                <th>NIK</th>
                                <th>No. SIM</th>
                                <th>Gambar KTP</th>
                                <th>Gambar SIM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                        <td>
                                            <?php if ($user['profile_picture_url'] && file_exists($user['profile_picture_url'])): ?>
                                                <img src="<?php echo htmlspecialchars($user['profile_picture_url']); ?>" alt="Profil" class="profile-img">
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['phone_number'] ?? '-'); ?></td>
                                        <td>
                                            <span class="status-badge <?php echo htmlspecialchars($user['role']); ?>">
                                                <?php echo htmlspecialchars($user['role']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge <?php echo htmlspecialchars($user['document_verification_status']); ?>">
                                                <?php echo htmlspecialchars($user['document_verification_status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['nik'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['driver_license_number'] ?? '-'); ?></td>
                                        <td>
                                            <?php if ($user['id_card_image_url'] && file_exists($user['id_card_image_url'])): ?>
                                                <a href="<?php echo htmlspecialchars($user['id_card_image_url']); ?>" target="_blank" class="doc-link">Lihat Dokumen</a>
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($user['driver_license_image_url'] && file_exists($user['driver_license_image_url'])): ?>
                                                <a href="<?php echo htmlspecialchars($user['driver_license_image_url']); ?>" target="_blank" class="doc-link">Lihat Dokumen</a>
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td class="actions">
                                            <a href="admin_manage_users.php?action=edit&id=<?php echo htmlspecialchars($user['user_id']); ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="admin_manage_users.php?action=delete&id=<?php echo htmlspecialchars($user['user_id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Semua data terkait (termasuk pemesanan) akan ikut terhapus!');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">Tidak ada data pengguna.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

<?php include 'includes/_admin_layout_end.php'; ?>