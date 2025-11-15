<?php
$page_title = 'Hasil Pencarian - FLYNOW';
require_once 'layouts/header.php'; 

// --- SIMULASI DATA HASIL PENCARIAN ---
$search_from = "Jakarta (CGK)";
$search_to = "Bali (DPS)";
$hasil_penerbangan = [
    [
        'maskapai_logo' => 'https://via.placeholder.com/100x30.png?text=Garuda',
        'maskapai_nama' => 'Garuda Indonesia',
        'waktu_berangkat' => '08:00',
        'bandara_asal' => 'CGK',
        'waktu_tiba' => '10:50',
        'bandara_tujuan' => 'DPS',
        'durasi' => '1h 50m',
        'harga' => 1450000
    ],
    [
        'maskapai_logo' => 'https://via.placeholder.com/100x30.png?text=AirAsia',
        'maskapai_nama' => 'AirAsia',
        'waktu_berangkat' => '09:30',
        'bandara_asal' => 'CGK',
        'waktu_tiba' => '12:20',
        'bandara_tujuan' => 'DPS',
        'durasi' => '1h 50m',
        'harga' => 980000
    ],
];
?>

<div class="container mx-auto px-6 py-8">
    
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold">Hasil Pencarian: <?php echo $search_from; ?> → <?php echo $search_to; ?></h1>
        <p class="text-gray-600">Jumat, 20 Des 2025 | 1 Penumpang</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        <aside class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Filter</h3>
                <div class="mb-4">
                    <h4 class="font-semibold mb-2">Maskapai</h4>
                    <label class="flex items-center space-x-2"><input type="checkbox" class="rounded"> <span>Garuda Indonesia</span></label>
                    <label class="flex items-center space-x-2"><input type="checkbox" class="rounded"> <span>AirAsia</span></label>
                </div>
            </div>
        </aside>

        <main class="w-full lg:w-3/4 space-y-6">
            <?php foreach ($hasil_penerbangan as $penerbangan): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row items-center">
                    <div class="p-4"><img src="<?php echo $penerbangan['maskapai_logo']; ?>" alt="<?php echo $penerbangan['maskapai_nama']; ?>" class="w-24"></div>
                    <div class="flex-1 p-4 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-4">
                            <div>
                                <div class="text-2xl font-bold"><?php echo $penerbangan['waktu_berangkat']; ?></div>
                                <div class="text-sm text-gray-600"><?php echo $penerbangan['bandara_asal']; ?></div>
                            </div>
                            <div class="text-gray-500">
                                <div>→</div>
                                <div class="text-xs"><?php echo $penerbangan['durasi']; ?></div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold"><?php echo $penerbangan['waktu_tiba']; ?></div>
                                <div class="text-sm text-gray-600"><?php echo $penerbangan['bandara_tujuan']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-auto p-4 bg-gray-50 md:bg-transparent text-center md:text-right">
                        <div class="text-2xl font-bold text-orange-600">Rp <?php echo number_format($penerbangan['harga'], 0, ',', '.'); ?></div>
                        <div class="text-sm text-gray-600 mb-2">/pax</div>
                        <a href="booking.php?flight_id=<?php echo $penerbangan['maskapai_nama']; // Simulasikan ID ?>" class="w-full md:w-auto bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                            PILIH
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
</div>

<?php
require_once 'layouts/footer.php'; 
?>