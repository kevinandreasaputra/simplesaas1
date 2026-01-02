<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login - JasaBook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">Login JasaBook</h1>

        <!-- Form mengirim data ke /login dengan method POST -->
        <form action="/saas1/login" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Masuk
            </button>
        </form>
        <p class="mt-4 text-center text-sm">
            Belum punya akun? <a href="#" class="text-blue-600">Daftar</a>
        </p>
    </div>
</body>

</html>