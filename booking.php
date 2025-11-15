<?php
$page_title = 'Detail Booking - FLYNOW';
require_once 'layouts/header.php'; 

// --- SIMULASI DATA PENERBANGAN YANG DIPILIH ---
$penerbangan_dipilih = [
    'maskapai_nama' => 'Garuda Indonesia', 'waktu_berangkat' => '08:00', 'tanggal' => 'Jumat, 20 Des 2025',
    'bandara_asal' => 'Jakarta (CGK)', 'waktu_tiba' => '10:50', 'bandara_tujuan' => 'Bali (DPS)',
    'harga' => 1450000, 'pajak' => 145000, 'total' => 1595000
];
?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6">Detail Pemesanan</h1>

    <form action="konfirmasi.php" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Detail Kontak (Pemesan)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_kontak" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="nama_kontak" class="mt-1 w-full p-2 border rounded-md" placeholder="John Doe">
                    </div>
                    <div>
                        <label for="email_kontak" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email_kontak" class="mt-1 w-full p-2 border rounded-md" placeholder="anda@email.com">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Detail Penumpang (Dewasa 1)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="titel_penumpang" class="block text-sm font-medium text-gray-700">Titel</label>
                        <select id="titel_penumpang" class="mt-1 w-full p-2 border rounded-md">
                            <option>Tn. (Tuan)</option>
                            <option>Ny. (Nyonya)</option>
                        </select>
                    </div>
                    <div>
                        <label for="nama_penumpang" class="block text-sm font-medium text-gray-700">Nama Lengkap (sesuai KTP)</label>
                        <input type="text" id="nama_penumpang" class="mt-1 w-full p-2 border rounded-md">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Metode Pembayaran</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-md">
                        <input type="radio" name="payment_method" value="va_bca" class="mr-3">
                        <span class="font-medium">Virtual Account BCA</span>
                    </label>
                    <label class="flex items-center p-4 border rounded-md">
                        <input type="radio" name="payment_method" value="credit_card" class="mr-3">
                        <span class="font-medium">Kartu Kredit</span>
                    </label>
                </div>
            </div>

        </div>

        <aside class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-md sticky top-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Ringkasan Pesanan</h2>
                
                <div class="mb-4">
                    <div class="font-semibold"><?php echo $penerbangan_dipilih['maskapai_nama']; ?></div>
                    <div class="text-sm text-gray-600"><?php echo $penerbangan_dipilih['tanggal']; ?></div>
                    <div class="text-sm text-gray-600">
                        <?php echo $penerbangan_dipilih['waktu_berangkat']; ?> (<?php echo $penerbangan_dipilih['bandara_asal']; ?>) → <?php echo $penerbangan_dipilih['waktu_tiba']; ?> (<?php echo $penerbangan_dipilih['bandara_tujuan']; ?>)
                    </div>
                </div>

                <div class="space-y-2 border-t pt-4">
                    <div class="flex justify-between">
                        <span>Harga Tiket (x1)</span>
                        <span>Rp <?php echo number_format($penerbangan_dipilih['harga'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pajak</span>
                        <span>Rp <?php echo number_format($penerbangan_dipilih['pajak'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between text-lg font-bold mt-2 pt-2 border-t">
                        <span>Total Bayar</span>
                        <span class="text-orange-600">Rp <?php echo number_format($penerbangan_dipilih['total'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold text-lg px-6 py-3 rounded-md shadow-lg hover:bg-blue-700 mt-6">
                    BAYAR SEKARANG
                </button>
            </div>
        </aside>

    </form>
</div>

<?php
require_once 'layouts/footer.php'; 
?>