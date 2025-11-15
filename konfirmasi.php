<?php
$page_title = 'Konfirmasi Pesanan - FLYNOW';
require_once 'layouts/header.php'; 

// --- SIMULASI DATA PESANAN YANG BERHASIL ---
$data_pesanan = [
    'kode_booking' => 'FLYN123XYZ',
    'nama_penumpang' => 'John Doe',
    'maskapai' => 'Garuda Indonesia',
    'rute' => 'Jakarta (CGK) → Bali (DPS)',
    'tanggal' => 'Jumat, 20 Des 2025',
    'berangkat' => '08:00',
    'tiba' => '10:50',
    'status' => 'LUNAS (E-Ticket Terbit)'
];
?>

<div class="container mx-auto px-6 py-12">
    <div class="max-w-3xl mx-auto">

        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md mb-8" role="alert">
            <h2 class="text-xl font-bold">Pembayaran Berhasil!</h2>
            <p>E-Ticket Anda telah berhasil diterbitkan dan dikirim ke email Anda.</p>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h2 class="text-2xl font-bold">E-Ticket Penerbangan</h2>
            </div>
            
            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <div>
                        <div class="text-gray-500 text-sm">Kode Booking</div>
                        <div class="text-4xl font-bold text-blue-600"><?php echo $data_pesanan['kode_booking']; ?></div>
                    </div>
                    <div class="w-32 h-32 bg-gray-200 flex items-center justify-center text-gray-500 mt-4 md:mt-0">
                        QR Code
                    </div>
                </div>

                <div class="border-t border-dashed pt-6 mb-6">
                    <div class="text-gray-500 text-sm mb-1">Penumpang</div>
                    <div class="text-xl font-semibold"><?php echo $data_pesanan['nama_penumpang']; ?></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="text-gray-500 text-sm">Penerbangan</div>
                        <div class="text-lg font-medium"><?php echo $data_pesanan['maskapai']; ?></div>
                        <div class="text-lg"><?php echo $data_pesanan['rute']; ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Tanggal</div>
                        <div class="text-lg font-medium"><?php echo $data_pesanan['tanggal']; ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Berangkat</div>
                        <div class="text-lg font-medium"><?php echo $data_pesanan['berangkat']; ?></div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Tiba</div>
                        <div class="text-lg font-medium"><?php echo $data_pesanan['tiba']; ?></div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t text-center">
                    <span class="text-lg font-semibold text-green-600"><?php echo $data_pesanan['status']; ?></span>
                </div>
            </div>
        </div>

        <div class="text-center mt-8 space-x-4">
            <a href="#" class="bg-gray-700 text-white px-6 py-3 rounded-md hover:bg-gray-800">Download PDF</a>
            <a href="index.php" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700">Cari Penerbangan Lain</a>
        </div>

    </div>
</div>

<?php
require_once 'layouts/footer.php'; 
?>