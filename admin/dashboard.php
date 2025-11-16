<?php 
require_once "../backend/akses_admin.php";

// Set judul halaman
$admin_page_title = 'Dashboard';

// Panggil header, sidebar, dan footer
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 

// --- SIMULASI DATA STATISTIK ---
$total_penjualan_hari_ini = 15200000;
$tiket_terjual_hari_ini = 12;
$total_pengguna = 450;
?>

<main class="flex-1 p-10">
    <h1 class="text-3xl font-bold mb-8"><?php echo $admin_page_title; ?></h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-600">Penjualan Hari Ini</h3>
            <p class="text-3xl font-bold text-blue-600">Rp <?php echo number_format($total_penjualan_hari_ini, 0, ',', '.'); ?></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-600">Tiket Terjual Hari Ini</h3>
            <p class="text-3xl font-bold text-green-600"><?php echo $tiket_terjual_hari_ini; ?></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-600">Total Pengguna</h3>
            <p class="text-3xl font-bold text-purple-600"><?php echo $total_pengguna; ?></p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-4">Grafik Penjualan 7 Hari Terakhir</h3>
        <div class="h-64 bg-gray-200 flex items-center justify-center rounded-md">
            <p class="text-gray-500">[Placeholder untuk Grafik]</p>
        </div>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>