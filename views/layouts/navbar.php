<nav class="bg-white shadow-sm mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/saas1/" class="text-2xl font-bold text-blue-600">JasaBook</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/saas1/" class="text-gray-600 hover:text-blue-600">Beranda</a>
                <a href="/saas1/services" class="text-gray-600 hover:text-blue-600">Layanan</a>

                <?php if (isset($_SESSION['user'])): ?>
                    <span class="text-gray-800 font-medium">Hai, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                    <a href="/saas1/my-orders" class="text-gray-600 hover:text-blue-600">Pesanan Saya</a>
                    <a href="/saas1/logout" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Logout</a>
                <?php else: ?>
                    <a href="/saas1/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>