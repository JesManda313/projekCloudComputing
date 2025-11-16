<?php 
session_start();
if (isset($_SESSION['error'])) {
    echo "<p class='text-red-600 text-center mb-4'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - FLYNOW</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-8">
            <a href="index.php" class="text-3xl font-bold text-blue-600">FLYNOW</a>
            <h2 class="text-2xl font-semibold text-gray-800 mt-2">Buat Akun Baru</h2>
            <p class="text-gray-600">Daftar gratis untuk mulai memesan tiket.</p>
        </div>

        <form action="backend/register_process.php" method="POST" class="space-y-6"> 
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="fullname" name="fullname" required 
                       class="mt-1 w-full p-3 border border-gray-300 rounded-md" 
                       placeholder="John Doe">
            </div>
            
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
            
            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       class="mt-1 w-full p-3 border border-gray-300 rounded-md" 
                       placeholder="••••••••">
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold text-lg px-6 py-3 rounded-md shadow-lg hover:bg-blue-700">
                    DAFTAR
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="login.php" class="text-blue-600 font-medium hover:underline">Login di sini</a>
            </p>
        </div>
    </div>

</body>
</html>