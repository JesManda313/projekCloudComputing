<?php
$page_title = 'FLYNOW - Pesan Tiket Pesawat';
require_once 'layouts/header.php'; 
?>

<header class="bg-blue-600 text-white">
    <div class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl font-bold mb-4">Temukan Penerbangan Terbaik Anda</h1>
        <p class="text-lg mb-8">Cari dan pesan tiket dengan mudah ke seluruh penjuru dunia.</p>

        <div class="bg-white text-gray-800 p-8 rounded-lg shadow-xl max-w-4xl mx-auto">
            <form action="hasil_pencarian.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="text-left">
                    <label for="from" class="block text-sm font-medium text-gray-700 mb-1">Dari (Asal)</label>
                    <input type="text" id="from" name="from" placeholder="Jakarta (CGK)" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                </div>

                <div class="text-left">
                    <label for="to" class="block text-sm font-medium text-gray-700 mb-1">Ke (Tujuan)</label>
                    <input type="text" id="to" name="to" placeholder="Bali (DPS)" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                </div>

                <div class="text-left">
                    <label for="departure" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berangkat</label>
                    <input type="date" id="departure" name="departure" class="w-full px-4 py-3 border border-gray-300 rounded-md" value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="text-left">
                    <label for="passengers" class="block text-sm font-medium text-gray-700 mb-1">Penumpang</label>
                    <select id="passengers" name="passengers" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                        <option value="1">1 Dewasa</option>
                        <option value="2">2 Dewasa</option>
                        <option value="3">3 Dewasa</option>
                    </select>
                </div>

                <div class="lg:col-span-4 mt-4">
                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold text-lg px-6 py-4 rounded-md shadow-lg">
                        CARI PENERBANGAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>

<div class="container mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Promo Spesial Untuk Anda</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x250.png?text=Promo+Bali" alt="Promo Bali" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">Diskon 20% ke Bali</h3>
                <p class="text-gray-600">Nikmati liburan tak terlupakan dengan diskon spesial.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x250.png?text=Promo+Singapura" alt="Promo Singapura" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">Cashback Singapura</h3>
                <p class="text-gray-600">Terbang ke Singapura dan dapatkan cashback hingga 500rb.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x250.png?text=Promo+Jepang" alt="Promo Jepang" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">Terbang ke Jepang</h3>
                <p class="text-gray-600">Musim semi di Tokyo? Kenapa tidak!</p>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'layouts/footer.php'; 
?>