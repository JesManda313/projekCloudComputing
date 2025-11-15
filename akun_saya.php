<?php
$page_title = 'Akun Saya - FLYNOW';
require_once 'layouts/header.php'; 

// --- SIMULASI DATA PENGGUNA YANG LOGIN ---
$user = [
    'nama' => 'Jesica Amanda',
    'email' => 'jesica.amanda@example.com',
    'telepon' => '081234567890'
];
?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-8">Akun Saya</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <ul class="space-y-1">
                    <li><a href="#" class="block px-4 py-2 bg-blue-100 text-blue-700 font-semibold rounded-md">Edit Profil</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">Ubah Password</a></li>
                    <li><a href="login.php" class="block px-4 py-2 text-red-600 hover:bg-red-50 rounded-md">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6">Edit Profil</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="fullname" name="fullname" 
                               class="mt-1 w-full p-3 border border-gray-300 rounded-md"
                               value="<?php echo htmlspecialchars($user['nama']); ?>">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" 
                               class="mt-1 w-full p-3 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                               value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                        <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
                    </div>
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="tel" id="telepon" name="telepon" 
                               class="mt-1 w-full p-3 border border-gray-300 rounded-md"
                               value="<?php echo htmlspecialchars($user['telepon']); ?>">
                    </div>
                    <div>
                        <button type="submit"
                                class="w-auto bg-blue-600 text-white font-bold px-6 py-3 rounded-md shadow-lg hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php
require_once 'layouts/footer.php'; 
?>