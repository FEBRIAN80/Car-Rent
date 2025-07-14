<

<style>
    .content {
        padding: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card h2 {
        color: #333;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.5em;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .car-list-for-tracker {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .btn-car-select {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9em;
        transition: background-color 0.3s ease, transform 0.2s ease;
        flex-grow: 1;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border: 1px solid #007bff;
    }

    .btn-car-select:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-car-select.active {
        background-color: #28a745;
        border-color: #28a745;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .map-container {
        height: 450px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 15px;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 8px;
    }

    .mt-30 {
        margin-top: 30px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .car-list-for-tracker {
            flex-direction: column;
        }

        .btn-car-select {
            flex-grow: unset;
            width: 100%;
        }
    }
</style>

<?php
include 'includes/_admin_layout_start.php';
?>

<main class="content">
    <h1><?php echo $page_title; ?></h1>

    <?php echo $message; ?>

    <div class="card">
        <h2>Pilih Mobil untuk Melihat Lokasi Terakhir</h2>
        <div class="car-list-for-tracker">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <a href="admin_car_tracker.php?car_id=<?php echo htmlspecialchars($car['car_id']); ?>"
                       class="btn-car-select <?php echo ($selectedCar && $selectedCar['car_id'] == $car['car_id']) ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' (' . $car['license_plate'] . ')'); ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada mobil terdaftar.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($selectedCar && $map_url): ?>
        <div class="card mt-30">
            <h2>Lokasi Terakhir: <?php echo htmlspecialchars($selectedCar['make'] . ' ' . $selectedCar['model'] . ' (' . $selectedCar['license_plate'] . ')'); ?></h2>
            <div class="map-container">
                <iframe
                    src="<?php echo $map_url; ?>"
                    allowfullscreen>
                </iframe>
            </div>
            <p class="mt-10">Koordinat: <?php echo htmlspecialchars($selectedCar['last_known_latitude'] ?? 'N/A'); ?>, <?php echo htmlspecialchars($selectedCar['last_known_longitude'] ?? 'N/A'); ?></p>
            <p><small>Peta ini menunjukkan lokasi terakhir yang tersimpan di database. Untuk pelacakan real-time, diperlukan perangkat GPS di mobil dan sistem backend yang lebih canggih.</small></p>
        </div>
    <?php endif; ?>
</main>

<?php
include 'includes/_admin_layout_end.php';
?>