<?php 
$admin_page_title = 'Manajemen Penerbangan';
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 

// --- SIMULASI DATA DARI DATABASE ---
$flights = [
    ['id' => 1, 'code' => 'GA-404', 'airline' => 'Garuda Indonesia', 'from' => 'Jakarta (CGK)', 'to' => 'Bali (DPS)', 'price' => 1250000, 'seats' => 150],
    ['id' => 2, 'code' => 'QZ-7510', 'airline' => 'AirAsia', 'from' => 'Surabaya (SUB)', 'to' => 'Kuala Lumpur (KUL)', 'price' => 780000, 'seats' => 180],
    ['id' => 3, 'code' => 'JT-015', 'airline' => 'Lion Air', 'from' => 'Medan (KNO)', 'to' => 'Jakarta (CGK)', 'price' => 950000, 'seats' => 200]
];
?>

<main class="flex-1 p-10">
    <h1 class="text-3xl font-bold mb-8"><?php echo $admin_page_title; ?> (Mengatur Harga)</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Tambah Penerbangan Baru</h2>
        <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium">Kode</label>
                <input type="text" name="code" placeholder="GA-123" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Maskapai</label>
                <input type="text" name="airline" placeholder="Garuda Indonesia" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Asal</label>
                <input type="text" name="from" placeholder="Jakarta (CGK)" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Tujuan</label>
                <input type="text" name="to" placeholder="Bali (DPS)" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Harga</label>
                <input type="number" name="price" placeholder="1000000" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Kuota Kursi</label>
                <input type="number" name="seats" placeholder="150" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan Penerbangan</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rute</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($flights as $flight): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($flight['code']); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($flight['airline']); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars($flight['from']); ?> → <?php echo htmlspecialchars($flight['to']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">
                            Rp <?php echo number_format($flight['price'], 0, ',', '.'); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars($flight['seats']); ?> kursi
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>