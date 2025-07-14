

?>

<?php include 'includes/_html_head.php'; // Panggil bagian <head> ?>
<?php include 'includes/_admin_layout_start.php'; // Panggil pembuka layout ?>

<div class="main-content">
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <?php echo $message; ?>

        <div class="form-container">
            <h2><?php echo $editBookingData ? 'Edit Pemesanan' : 'Tambah Pemesanan Baru'; ?></h2>
            <form action="admin_manage_bookings.php" method="POST">
                <?php if ($editBookingData): ?>
                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($editBookingData['booking_id']); ?>">
                    <input type="hidden" name="original_car_id" value="<?php echo htmlspecialchars($editBookingData['car_id']); ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="user_id">Pengguna:</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">Pilih Pengguna</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>"
                                <?php echo (($editBookingData['user_id'] ?? '') == $user['user_id'] ? 'selected' : ''); ?>>
                                <?php echo htmlspecialchars($user['full_name'] . ' (' . $user['email'] . ')'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="car_id">Mobil:</label>
                    <select id="car_id" name="car_id" required>
                        <option value="">Pilih Mobil</option>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo htmlspecialchars($car['car_id']); ?>"
                                data-daily-rate="<?php echo htmlspecialchars($car['daily_rate']); ?>"
                                <?php echo (($editBookingData['car_id'] ?? '') == $car['car_id'] ? 'selected' : ''); ?>>
                                <?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' (' . $car['license_plate'] . ')'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" id="daily_rate_hidden" name="daily_rate_hidden" value="<?php echo htmlspecialchars($editBookingData['daily_rate'] ?? '0'); ?>">
                </div>

                <div class="form-group">
                    <label for="pickup_location_id">Lokasi Pengambilan:</label>
                    <select id="pickup_location_id" name="pickup_location_id" required>
                        <option value="">Pilih Lokasi</option>
                        <?php foreach ($locations as $loc): ?>
                            <option value="<?php echo htmlspecialchars($loc['location_id']); ?>"
                                <?php echo (($editBookingData['pickup_location_id'] ?? '') == $loc['location_id'] ? 'selected' : ''); ?>>
                                <?php echo htmlspecialchars($loc['location_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="return_location_id">Lokasi Pengembalian:</label>
                    <select id="return_location_id" name="return_location_id" required>
                        <option value="">Pilih Lokasi</option>
                        <?php foreach ($locations as $loc): ?>
                            <option value="<?php echo htmlspecialchars($loc['location_id']); ?>"
                                <?php echo (($editBookingData['return_location_id'] ?? '') == $loc['location_id'] ? 'selected' : ''); ?>>
                                <?php echo htmlspecialchars($loc['location_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup_datetime">Tanggal & Waktu Pengambilan:</label>
                    <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" value="<?php echo htmlspecialchars(isset($editBookingData['pickup_datetime']) ? date('Y-m-d\TH:i', strtotime($editBookingData['pickup_datetime'])) : ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="return_datetime">Tanggal & Waktu Pengembalian:</label>
                    <input type="datetime-local" id="return_datetime" name="return_datetime" value="<?php echo htmlspecialchars(isset($editBookingData['return_datetime']) ? date('Y-m-d\TH:i', strtotime($editBookingData['return_datetime'])) : ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="daily_rate_display">Tarif Harian:</label>
                    <input type="text" id="daily_rate_display" value="Rp 0" readonly>
                </div>

                <div class="form-group">
                    <label for="rental_days_display">Durasi Sewa:</label>
                    <input type="text" id="rental_days_display" value="0 Hari" readonly>
                </div>

                <div class="form-group">
                    <label for="base_rental_price">Harga Sewa Dasar:</label>
                    <input type="text" id="base_rental_price_display" value="Rp 0" readonly>
                    <input type="hidden" id="base_rental_price_hidden" name="base_rental_price_hidden" value="<?php echo htmlspecialchars($editBookingData['base_rental_price'] ?? '0'); ?>">
                </div>

                <div class="form-group">
                    <label for="extra_charges">Biaya Tambahan:</label>
                    <input type="number" id="extra_charges" name="extra_charges" step="0.01" value="<?php echo htmlspecialchars($editBookingData['extra_charges'] ?? '0'); ?>" min="0">
                </div>

                <div class="form-group">
                    <label for="discount_amount">Jumlah Diskon:</label>
                    <input type="number" id="discount_amount" name="discount_amount" step="0.01" value="<?php echo htmlspecialchars($editBookingData['discount_amount'] ?? '0'); ?>" min="0">
                </div>
                
                <div class="form-group">
                    <label for="total_price_display">Total Harga:</label>
                    <input type="text" id="total_price_display" value="Rp 0" readonly>
                    <input type="hidden" id="total_price_hidden" name="total_price_hidden" value="<?php echo htmlspecialchars($editBookingData['total_price'] ?? '0'); ?>">
                </div>

                <div class="form-group">
                    <label for="booking_status">Status Pemesanan:</label>
                    <select id="booking_status" name="booking_status" required>
                        <option value="pending" <?php echo (($editBookingData['booking_status'] ?? '') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="confirmed" <?php echo (($editBookingData['booking_status'] ?? '') == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                        <option value="rented" <?php echo (($editBookingData['booking_status'] ?? '') == 'rented' ? 'selected' : ''); ?>>Rented</option>
                        <option value="completed" <?php echo (($editBookingData['booking_status'] ?? '') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                        <option value="cancelled" <?php echo (($editBookingData['booking_status'] ?? '') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment_status">Status Pembayaran:</label>
                    <select id="payment_status" name="payment_status" required>
                        <option value="pending" <?php echo (($editBookingData['payment_status'] ?? '') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="paid" <?php echo (($editBookingData['payment_status'] ?? '') == 'paid' ? 'selected' : ''); ?>>Paid</option>
                        <option value="refunded" <?php echo (($editBookingData['payment_status'] ?? '') == 'refunded' ? 'selected' : ''); ?>>Refunded</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="notes">Catatan:</label>
                    <textarea id="notes" name="notes" rows="3"><?php echo htmlspecialchars($editBookingData['notes'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="<?php echo $editBookingData ? 'edit_booking' : 'add_booking'; ?>" class="btn-submit">
                        <?php echo $editBookingData ? 'Perbarui Pemesanan' : 'Tambah Pemesanan'; ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="data-table-container">
            <h2>Daftar Pemesanan</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pengguna</th>
                        <th>Mobil</th>
                        <th>Pengambilan</th>
                        <th>Pengembalian</th>
                        <th>Total Harga</th>
                        <th>Status Pemesanan</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                                <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['make'] . ' ' . $booking['model'] . ' (' . $booking['license_plate'] . ')'); ?></td>
                                <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking['pickup_datetime']))); ?><br><small>(<?php echo htmlspecialchars($booking['pickup_location_name'] ?? 'N/A'); ?>)</small></td>
                                <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($booking['return_datetime']))); ?><br><small>(<?php echo htmlspecialchars($booking['return_location_name'] ?? 'N/A'); ?>)</small></td>
                                <td class="col-nowrap"><strong>Rp <?php echo number_format($booking['total_price'], 0, ',', '.'); ?></strong></td>
                                <td class="col-nowrap">
                                    <?php
                                    $status_class = strtolower(htmlspecialchars($booking['booking_status']));
                                    echo '<span class="status-badge ' . $status_class . '">' . htmlspecialchars($booking['booking_status']) . '</span>';
                                    ?>
                                </td>
                                <td class="col-nowrap">
                                    <?php
                                    $payment_status_class = strtolower(htmlspecialchars($booking['payment_status']));
                                    echo '<span class="status-badge ' . $payment_status_class . '">' . htmlspecialchars($booking['payment_status']) . '</span>';
                                    ?>
                                </td>
                                <td class="actions">
                                    <a href="admin_booking_details.php?id=<?php echo htmlspecialchars($booking['booking_id']); ?>" class="btn-detail">Detail</a>
                                    <a href="admin_manage_bookings.php?action=edit&id=<?php echo htmlspecialchars($booking['booking_id']); ?>" class="btn-edit">Edit</a>
                                    <a href="admin_manage_bookings.php?action=delete&id=<?php echo htmlspecialchars($booking['booking_id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Tidak ada data pemesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    // JavaScript for dynamic price calculation
    document.addEventListener('DOMContentLoaded', function() {
        const carSelect = document.getElementById('car_id');
        const pickupDatetimeInput = document.getElementById('pickup_datetime');
        const returnDatetimeInput = document.getElementById('return_datetime');
        const extraChargesInput = document.getElementById('extra_charges');
        const discountAmountInput = document.getElementById('discount_amount');

        const dailyRateDisplay = document.getElementById('daily_rate_display');
        const dailyRateHidden = document.getElementById('daily_rate_hidden');
        const rentalDaysDisplay = document.getElementById('rental_days_display');
        const baseRentalPriceDisplay = document.getElementById('base_rental_price_display');
        const baseRentalPriceHidden = document.getElementById('base_rental_price_hidden');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceHidden = document.getElementById('total_price_hidden');

        // Parse cars JSON data passed from PHP
        const carsData = <?php echo $cars_json; ?>;

        function updatePrices() {
            const selectedCarId = carSelect.value;
            const pickupDatetime = new Date(pickupDatetimeInput.value);
            const returnDatetime = new Date(returnDatetimeInput.value);
            const extraCharges = parseFloat(extraChargesInput.value) || 0;
            const discountAmount = parseFloat(discountAmountInput.value) || 0;

            let dailyRate = 0;
            if (selectedCarId) {
                const selectedCar = carsData.find(car => car.car_id == selectedCarId);
                if (selectedCar) {
                    dailyRate = parseFloat(selectedCar.daily_rate);
                }
            }

            // Calculate rental days
            let rentalDays = 0;
            if (pickupDatetimeInput.value && returnDatetimeInput.value && returnDatetime > pickupDatetime) {
                const timeDiff = Math.abs(returnDatetime.getTime() - pickupDatetime.getTime());
                rentalDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Round up to nearest day
            }

            // Calculate prices
            const calculatedBaseRentalPrice = dailyRate * rentalDays;
            const finalTotalPrice = (calculatedBaseRentalPrice + extraCharges) - discountAmount;

            // Update display fields
            dailyRateDisplay.value = formatRupiah(dailyRate);
            rentalDaysDisplay.value = rentalDays + ' Hari';
            baseRentalPriceDisplay.value = formatRupiah(calculatedBaseRentalPrice); // Display formatted
            totalPriceDisplay.value = formatRupiah(finalTotalPrice);

            // Update hidden fields for submission
            dailyRateHidden.value = dailyRate.toFixed(2);
            baseRentalPriceHidden.value = calculatedBaseRentalPrice.toFixed(2);
            totalPriceHidden.value = finalTotalPrice.toFixed(2);
        }

        // Helper for Rupiah formatting
        function formatRupiah(amount) {
            return 'Rp ' + parseFloat(amount).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }

        // Add event listeners
        carSelect.addEventListener('change', updatePrices);
        pickupDatetimeInput.addEventListener('change', updatePrices);
        returnDatetimeInput.addEventListener('change', updatePrices);
        extraChargesInput.addEventListener('input', updatePrices);
        discountAmountInput.addEventListener('input', updatePrices);

        // Initial calculation when page loads (especially for edit mode)
        updatePrices(); // Call directly, as DOMContentLoaded might have already fired if script is deferred
    });
</script>

<?php include 'includes/_admin_layout_end.php'; // Panggil penutup layout ?>