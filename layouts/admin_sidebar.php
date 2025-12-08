<?php
// Tentukan nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);

// Logika khusus: Jika file index.php dibuka, anggap itu dashboard.php
if ($current_page === "index.php") {
    $current_page = "dashboard.php";
}

// Logika Halaman Aktif: 
// Jika halaman detail dibuka, tandai halaman induknya (pesanan.php) sebagai aktif.
$active_page = $current_page;
if ($current_page === 'detail_pesanan.php') {
    $active_page = 'pesanan.php'; // Tandai 'pesanan.php' sebagai halaman yang aktif secara visual
}
?>

<aside class="w-64 bg-gray-800 text-white p-5 min-h-screen">
    <div class="text-2xl font-bold mb-8">FLYNOW ADMIN</div>
    <nav class="space-y-1">

        <a href="dashboard.php"
            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
            <?php echo ($active_page === 'dashboard.php') ? 'bg-gray-700' : ''; ?>">
            Dashboard
        </a>

        <a href="penerbangan.php"
            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
            <?php echo ($active_page === 'penerbangan.php') ? 'bg-gray-700' : ''; ?>">
            Manajemen Penerbangan
        </a>

        <a href="pesanan.php"
            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
            <?php echo ($active_page === 'pesanan.php') ? 'bg-gray-700' : ''; ?>">
            Manajemen Pesanan
        </a>

        <a href="pengguna.php"
            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
            <?php echo ($active_page === 'pengguna.php') ? 'bg-gray-700' : ''; ?>">
            Manajemen Pengguna
        </a>

        <a href="laporan.php"
            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
            <?php echo ($active_page === 'laporan.php') ? 'bg-gray-700' : ''; ?>">
            Laporan
        </a>

        <a href="../backend/logout.php"
            class="text-red-300 block py-2.5 px-4 rounded transition duration-200 hover:bg-red-900">
            Logout
        </a>

    </nav>
</aside>