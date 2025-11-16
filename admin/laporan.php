<?php 
require_once "../backend/akses_admin.php";

$admin_page_title = 'Laporan Penjualan';
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 

// --- SIMULASI DATA LAPORAN ---
$laporan = [
    ['rute' => 'Jakarta (CGK) → Bali (DPS)', 'tiket_terjual' => 120, 'total_pendapatan' => 150000000],
    ['rute' => 'Surabaya (SUB) → Kuala Lumpur (KUL)', 'tiket_terjual' => 85, 'total_pendapatan' => 66300000],
    ['rute' => 'Medan (KNO) → Jakarta (CGK)', 'tiket_terjual' => 95, 'total_pendapatan' => 90250000],
];
$total_pendapatan_semua = 306550000;
?>

<main class="flex-1 p-10">
    <h1 class="text-3xl font-bold mb-8"><?php echo $admin_page_title; ?></h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8 flex items-center space-x-4">
        <div>
            <label for="start_date" class="block text-sm font-medium">Dari Tanggal</label>
            <input type="date" id="start_date" class="mt-1 p-2 border rounded-md">
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium">Sampai Tanggal</label>
            <input type="date" id="end_date" class="mt-1 p-2 border rounded-md">
        </div>
        <button class="bg-blue-600 text-white px-5 py-2 rounded-md self-end">Tampilkan</button>
        <button class="bg-green-600 text-white px-5 py-2 rounded-md self-end">Export ke Excel</button>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rute Populer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tiket Terjual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($laporan as $report): ?>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo htmlspecialchars($report['rute']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlspecialchars($report['tiket_terjual']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900">Rp <?php echo number_format($report['total_pendapatan'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="2" class="px-6 py-4 text-right text-sm font-bold text-gray-900">TOTAL KESELURUHAN</td>
                    <td class="px-6 py-4 text-sm font-bold text-blue-600">Rp <?php echo number_format($total_pendapatan_semua, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>