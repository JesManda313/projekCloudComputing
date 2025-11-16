<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo "<div class='mb-4 p-3 bg-red-100 text-red-700 rounded-md'>".$_SESSION['login_error']."</div>";
    unset($_SESSION['login_error']); // clear once shown
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FLYNOW</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-8">
            <a href="index.php" class="text-3xl font-bold text-blue-600">FLYNOW</a>
            <h2 class="text-2xl font-semibold text-gray-800 mt-2">Selamat Datang Kembali</h2>
            <p class="text-gray-600">Silakan login ke akun Anda.</p>
        </div>

        <form action="backend/login_process.php" method="POST" class="space-y-6"> 
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 w-full p-3 border border-gray-300 rounded-md" 
                       placeholder="anda@email.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required 
                       class="mt-1 w-full p-3 border border-gray-300 rounded-md" 
                       placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold text-lg px-6 py-3 rounded-md shadow-lg hover:bg-blue-700">
                    LOGIN
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="register.php" class="text-blue-600 font-medium hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>

</body>
</html>