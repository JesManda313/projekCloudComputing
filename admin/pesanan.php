<?php 
$admin_page_title = 'Manajemen Pesanan';
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 

// Simulasi data pesanan
$orders = [
    ['id' => 1, 'booking_code' => 'FLYN123XYZ', 'customer' => 'John Doe', 'email' => 'john@example.com', 'route' => 'CGK-DPS', 'total' => 1595000, 'status' => 'LUNAS', 'tanggal' => '2025-11-10'],
    ['id' => 2, 'booking_code' => 'FLYN456ABC', 'customer' => 'Jane Smith', 'email' => 'jane@example.com', 'route' => 'SUB-KUL', 'total' => 780000, 'status' => 'LUNAS', 'tanggal' => '2025-11-11'],
    ['id' => 3, 'booking_code' => 'FLYN789DEF', 'customer' => 'Robert Brown', 'email' => 'robert@example.com', 'route' => 'CGK-SIN', 'total' => 2100000, 'status' => 'MENUNGGU', 'tanggal' => '2025-11-12'],
];

// Logika Search (Sederhana)
$search_query = $_GET['search_query'] ?? '';
$display_orders = $orders;
if (!empty($search_query)) {
    $display_orders = array_filter($display_orders, function($order) use ($search_query) {
        $query = strtolower($search_query);
        return (stripos(strtolower($order['booking_code']), $query) !== false ||
                stripos(strtolower($order['customer']), $query) !== false ||
                stripos(strtolower($order['email']), $query) !== false);
    });
}
?>

<main class="flex-1 p-10"
      x-data="{ 
          showModal: false, 
          detailData: {} 
      }">

    <h1 class="text-3xl font-bold mb-8"><?php echo $admin_page_title; ?></h1>
    
    <div class="mb-8">
        <form action="pesanan.php" method="GET">
            <div class="flex">
                <input type="text" name="search_query" placeholder="Cari Kode Booking, Nama, atau Email..." 
                       class="w-full md:w-1/2 p-2 border rounded-l-md" 
                       value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Cari</button>
                <a href="pesanan.php" class="text-gray-600 ml-4 self-center hover:underline">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Detail Pesanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($display_orders)): ?>
                    <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($display_orders as $order): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($order['booking_code']); ?></div>
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($order['route']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($order['customer']); ?></div>
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($order['email']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                Rp <?php echo number_format($order['total'], 0, ',', '.'); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if ($order['status'] == 'LUNAS'): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">LUNAS</span>
                                <?php else: ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">MENUNGGU</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button 
                                    @click="showModal = true; detailData = <?php echo htmlspecialchars(json_encode($order)); ?>"
                                    class="text-blue-600 hover:text-blue-900">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div 
        x-show="showModal" x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        x-show="showModal" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;">

        <div @click.outside="showModal = false" 
             class="bg-white w-full max-w-lg p-6 rounded-lg shadow-xl"
             x-show="showModal" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100">
            
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-2xl font-semibold">Detail Pesanan</h2>
                <button @click="showModal = false" class="text-gray-500 hover:text-gray-800 text-3xl">&times;</button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Kode Booking</label>
                    <p class="text-lg font-semibold text-blue-600" x-text="detailData.booking_code"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Pelanggan</label>
                    <p class="text-lg" x-text="detailData.customer"></p>
                    <p class="text-sm text-gray-600" x-text="detailData.email"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Rute</label>
                    <p class="text-lg" x-text="detailData.route"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Total Pembayaran</label>
                    <p class="text-lg font-semibold text-green-600" 
                       :text="'Rp ' + Number(detailData.total).toLocaleString('id-ID')"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Status</label>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                          :class="{ 'bg-green-100 text-green-800': detailData.status == 'LUNAS', 'bg-yellow-100 text-yellow-800': detailData.status != 'LUNAS' }"
                          x-text="detailData.status">
                    </span>
                </div>
                <div class="pt-4 mt-4 border-t">
                    <button @click="showModal = false" class="w-full bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>