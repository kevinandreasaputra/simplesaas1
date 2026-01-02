<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

    <?php include __DIR__ . '/../../views/layouts/navbar.php'; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Pilih Layanan Kami</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($services as $service): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="<?= htmlspecialchars($service['image_url']) ?>" alt="<?= htmlspecialchars($service['name']) ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($service['name']) ?></h3>
                        <p class="text-gray-600 text-sm mb-4 h-12 overflow-hidden"><?= htmlspecialchars($service['description']) ?></p>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-600 font-bold text-lg">Rp <?= number_format($service['price'], 0, ',', '.') ?></span>
                            <form action="/saas1/booking/process" method="POST">
                                <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                <input type="hidden" name="booking_date" value="<?= date('Y-m-d') ?>">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>