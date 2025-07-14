
<?php include 'includes/_html_head.php'; ?>
<?php include 'includes/_admin_layout_start.php'; ?>

            <main class="content">
                <?php if ($carInfo): ?>
                    <div class="breadcrumb">
                        <a href="admin_manage_cars.php">Manajemen Aset</a> &gt;
                        Dokumen Mobil: **<?php echo htmlspecialchars($carInfo['make'] . ' ' . $carInfo['model'] . ' (' . $carInfo['license_plate'] . ')'); ?>**
                    </div>
                <?php endif; ?>

                <h2>Kelola Dokumen untuk Mobil: <?php echo htmlspecialchars($carInfo['make'] . ' ' . $carInfo['model'] . ' (' . $carInfo['license_plate'] . ')'); ?></h2>

                <?php if (!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>

                <div class="form-section">
                    <h3><?php echo $editDocumentData ? 'Edit Dokumen' : 'Tambah Dokumen Baru'; ?></h3>
                    <form action="admin_manage_documents.php?car_id=<?php echo htmlspecialchars($car_id); ?>" method="POST" enctype="multipart/form-data">
                        <?php if ($editDocumentData): ?>
                            <input type="hidden" name="document_id" value="<?php echo htmlspecialchars($editDocumentData['document_id']); ?>">
                            <input type="hidden" name="current_document_file" value="<?php echo htmlspecialchars($editDocumentData['document_file'] ?? ''); ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="document_type">Jenis Dokumen:</label>
                            <input type="text" id="document_type" name="document_type" value="<?php echo htmlspecialchars($editDocumentData['document_type'] ?? ''); ?>" required placeholder="Contoh: STNK, Pajak, Asuransi, KIR, BPKB">
                        </div>
                        <div class="form-group">
                            <label for="document_file">Upload File Dokumen:</label>
                            <input type="file" id="document_file" name="document_file" <?php echo ($editDocumentData && empty($editDocumentData['document_file'])) ? 'required' : ''; ?>>
                            <small>Format: JPG, JPEG, PNG, PDF. Ukuran maks: 5MB.</small>
                            <?php if ($editDocumentData && !empty($editDocumentData['document_file'])): ?>
                                <p>File saat ini: <a href="<?php echo htmlspecialchars($upload_dir . $editDocumentData['document_file']); ?>" target="_blank"><?php echo htmlspecialchars($editDocumentData['document_file']); ?></a></p>
                                <small>Biarkan kosong jika tidak ingin mengubah file.</small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="issue_date">Tanggal Terbit:</label>
                            <input type="date" id="issue_date" name="issue_date" value="<?php echo htmlspecialchars($editDocumentData['issue_date'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Tanggal Kadaluarsa:</label>
                            <input type="date" id="expiry_date" name="expiry_date" value="<?php echo htmlspecialchars($editDocumentData['expiry_date'] ?? ''); ?>">
                        </div>

                        <button type="submit" name="<?php echo $editDocumentData ? 'update_document' : 'add_document'; ?>" class="btn-primary"><i class="fas fa-plus"></i>
                            <?php echo $editDocumentData ? 'Perbarui Dokumen' : 'Tambah Dokumen'; ?>
                        </button>
                        <?php if ($editDocumentData): ?>
                            <a href="admin_manage_documents.php?car_id=<?php echo htmlspecialchars($car_id); ?>" class="btn-secondary">Batal Edit</a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="table-container">
                    <h3>Daftar Dokumen Mobil</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID Dokumen</th>
                                <th>Jenis Dokumen</th>
                                <th>File Dokumen</th>
                                <th>Tanggal Terbit</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Diunggah Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($documents) > 0): ?>
                                <?php foreach ($documents as $doc): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($doc['document_id'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($doc['document_type'] ?? 'N/A'); ?></td>
                                        <td>
                                            <?php if (!empty($doc['document_file'])): ?>
                                                <a href="<?php echo htmlspecialchars($upload_dir . $doc['document_file']); ?>" target="_blank">Lihat Dokumen</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo !empty($doc['issue_date']) ? htmlspecialchars(date('d M Y', strtotime($doc['issue_date']))) : '-'; ?></td>
                                        <td><?php echo !empty($doc['expiry_date']) ? htmlspecialchars(date('d M Y', strtotime($doc['expiry_date']))) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($doc['uploaded_at'] ?? ''))); ?></td>
                                        <td class="actions">
                                            <a href="admin_manage_documents.php?car_id=<?php echo htmlspecialchars($car_id); ?>&action=edit_doc&doc_id=<?php echo htmlspecialchars($doc['document_id']); ?>" class="btn-edit">Edit</a>
                                            <a href="admin_manage_documents.php?car_id=<?php echo htmlspecialchars($car_id); ?>&action=delete_doc&doc_id=<?php echo htmlspecialchars($doc['document_id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini? File fisik juga akan dihapus.');">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">Tidak ada dokumen untuk mobil ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </main>

<?php include 'includes/_admin_layout_end.php'; ?>