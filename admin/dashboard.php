<?php 
require_once "../backend/db.php";
require_once "../backend/akses_admin.php";
require_once "../backend/admin/get_stats.php";

// Set judul halaman
$admin_page_title = 'Dashboard';

// Panggil header, sidebar, dan footer
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 


// --- DATA STATISTIK HARIAN ---
$total_penjualan_hari_ini = getTotalSalesToday($conn);
$tiket_terjual_hari_ini = getTotalTicketsSoldToday($conn);
$total_pengguna = countTotalUsers($conn);

// --- DATA UNTUK GRAFIK 12 BULAN TERAKHIR ---
$data_grafik_penjualan = getSalesLast12Months($conn); 

// Ekstrak label bulan dan data penjualan untuk Chart.js
$labels = array_column($data_grafik_penjualan, 'label');
$sales_data = array_column($data_grafik_penjualan, 'penjualan');

// Konversi ke format JSON untuk digunakan di JavaScript
$labels_json = json_encode($labels);
$sales_data_json = json_encode($sales_data);

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
        <h3 class="text-xl font-semibold mb-4">Grafik Penjualan 12 Bulan Terakhir</h3>
        <div class="h-96"> <canvas id="salesChart"></canvas>
        </div>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>