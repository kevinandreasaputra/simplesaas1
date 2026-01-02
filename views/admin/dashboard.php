<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
        <nav class="bg-gray-800 shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-white">Admin Panel</span>
            <div class="space-x-4">
                <a href="/saas1/" class="text-gray-300 hover:text-white">Lihat Website</a>
                <a href="/saas1/logout" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Semua Pesanan</h1>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Layanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Saat Ini</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $booking['booking_date'] ?></td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($booking['user_name'] ?? 'User ID: ' . $booking['user_id']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($booking['service_name']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-2 text-xs leading-5 font-semibold rounded-full 
                                <?= $booking['status'] == 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($booking['status'] == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>">
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <form action="/saas1/admin/update-status" method="POST" class="flex gap-2">
                                <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                
                                <?php if ($booking['status'] == 'pending'): ?>
                                    <button name="status" value="completed" class="text-green-600 hover:text-green-900 font-bold">✓ Terima</button>
                                    <button name="status" value="cancelled" class="text-red-600 hover:text-red-900 font-bold">✗ Tolak</button>
                                <?php else: ?>
                                    <span class="text-gray-400">Selesai</span>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>