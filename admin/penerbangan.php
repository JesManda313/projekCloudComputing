<?php
require_once "../backend/akses_admin.php";
require_once "../backend/db.php";

$admin_page_title = 'Manajemen Penerbangan';
require_once '../layouts/admin_header.php';
require_once '../layouts/admin_sidebar.php';

// Ambil maskapai
$airlines = $conn->query("SELECT * FROM airlines ORDER BY airline_name ASC");

// Ambil asal & tujuan
$airports1 = $conn->query("SELECT * FROM airports ORDER BY city ASC");
$airports2 = $conn->query("SELECT * FROM airports ORDER BY city ASC");
?>

<main class="flex-1 p-10">

    <!-- ALERT ERROR -->
    <?php if (isset($_SESSION['error'])): ?>
        <div id="alert-error"
            class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg shadow">
            <div class="flex justify-between items-center">
                <span class="font-semibold"><?= $_SESSION['error']; ?></span>
                <button onclick="$('#alert-error').fadeOut();" class="text-red-600 font-bold text-xl">&times;</button>
            </div>
        </div>
    <?php unset($_SESSION['error']);
    endif; ?>

    <!-- ALERT SUCCESS -->
    <?php if (isset($_SESSION['success'])): ?>
        <div id="alert-success"
            class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow">
            <div class="flex justify-between items-center">
                <span class="font-semibold"><?= $_SESSION['success']; ?></span>
                <button onclick="$('#alert-success').fadeOut();" class="text-green-700 font-bold text-xl">&times;</button>
            </div>
        </div>
    <?php unset($_SESSION['success']);
    endif; ?>


    <div id="deleteModal"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">

        <div class="bg-white p-6 rounded-lg shadow-lg w-80">
            <h3 class="text-lg font-semibold mb-4 text-center">Delete Flight</h3>
            <p class="text-sm text-gray-700 text-center mb-6">
                Are you sure you want to delete this flight?
            </p>

            <div class="flex justify-center gap-3">
                <button id="btn_cancel_delete"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-sm">
                    Cancel
                </button>

                <form id="deleteForm" action="../backend/admin/flight_delete.php" method="POST">
                    <input type="hidden" name="id_flight" id="delete_flight_id">
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>




    <h1 class="text-3xl font-bold mb-8">Manajemen Penerbangan</h1>

    <!-- ========== FORM TAMBAH FLIGHT ========== -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Tambah Penerbangan Baru</h2>

        <form action="../backend/admin/flight_add.php" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- MASKAPAI -->
            <div class="md:col-span-3">
                <label class="block text-sm font-medium">Maskapai</label>
                <select name="airline_id" id="airline_select"
                    class="w-full mt-1 p-2 border rounded-md text-sm" required>
                    <option value="">-- Pilih Maskapai --</option>
                    <?php while ($a = $airlines->fetch_assoc()): ?>
                        <option value="<?= $a['id_airline']; ?>" data-code="<?= $a['airline_code']; ?>">
                            <?= $a['airline_name']; ?> (<?= $a['airline_code']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- KODE FLIGHT -->
            <div>
                <label class="block text-sm font-medium">Kode Penerbangan</label>
                <div class="flex">
                    <input type="text" id="airline_prefix" class="w-14 p-2 border rounded-l-md bg-gray-100 text-center text-sm" disabled placeholder="XX">
                    <input type="number" name="flight_number" class="flex-1 p-2 border rounded-r-md text-sm" placeholder="123" required>
                </div>
            </div>

            <!-- ASAL -->
            <div>
                <label class="block text-sm font-medium">Asal</label>
                <select name="origin_airport" class="w-full mt-1 p-2 border rounded-md text-sm" required>
                    <option value="">-- Pilih Asal --</option>
                    <?php while ($o = $airports1->fetch_assoc()): ?>
                        <option value="<?= $o['id_airport']; ?>"><?= $o['city']; ?> (<?= $o['airport_code']; ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- TUJUAN -->
            <div>
                <label class="block text-sm font-medium">Tujuan</label>
                <select name="destination_airport" class="w-full mt-1 p-2 border rounded-md text-sm" required>
                    <option value="">-- Pilih Tujuan --</option>
                    <?php while ($d = $airports2->fetch_assoc()): ?>
                        <option value="<?= $d['id_airport']; ?>"><?= $d['city']; ?> (<?= $d['airport_code']; ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm font-medium">Tanggal Keberangkatan</label>
                <input type="date" name="departure_date" class="w-full mt-1 p-2 border rounded-md text-sm" required>
            </div>

            <!-- WAKTU -->
            <div>
                <label class="block text-sm font-medium">Waktu Keberangkatan</label>
                <input type="time" name="departure_time" class="w-full mt-1 p-2 border rounded-md text-sm" required>
            </div>

            <!-- DURASI -->
            <div>
                <label class="block text-sm font-medium">Durasi (menit)</label>
                <input type="number" name="travel_duration" placeholder="120" class="w-full mt-1 p-2 border rounded-md text-sm" required>
            </div>

            <!-- HARGA -->
            <div>
                <label class="block text-sm font-medium">Harga</label>
                <input type="number" name="price" placeholder="1000000" class="w-full mt-1 p-2 border rounded-md text-sm" required>
            </div>

            <!-- KUOTA -->
            <div>
                <label class="block text-sm font-medium">Kuota Kursi</label>
                <input type="number" name="seats" placeholder="150" class="w-full mt-1 p-2 border rounded-md text-sm" required>
            </div>

            <div class="md:col-span-3 flex gap-2">
                <button type="submit"
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                    Simpan Penerbangan
                </button>

                <!-- Tombol Cancel Edit -->
                <button type="button" id="btn_cancel_edit"
                    class="w-full bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm hidden">
                    Cancel Edit
                </button>
            </div>

        </form>
    </div>


    <?php
    // formatting date menjadi teks
    function formatTanggal($date)
    {
        return date("d F Y", strtotime($date));
    }

    // remove detik dari time
    function cutTime($time)
    {
        return date("H:i", strtotime($time));
    }

    // badge status
    function statusTag($status)
    {
        switch ($status) {
            case "Upcoming":
                return '<span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">' . $status . '</span>';
            case "Ongoing":
                return '<span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">' . $status . '</span>';
            default:
                return '<span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">' . $status . '</span>';
        }
    }
    ?>

    <div class="bg-white rounded-lg shadow-md p-6">

        <!-- FILTER -->
        <div class="flex items-center gap-3 mb-6 text-sm">
            <label class="font-medium w-32">Filter Date:</label>
            <input type="date" id="filter_date" class="p-2 border rounded-md text-sm">
            <button id="btn_filter" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                Filter
            </button>
            <button id="btn_reset" class="px-4 py-2 bg-gray-500 text-white rounded-md text-sm hover:bg-gray-600">
                Reset
            </button>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Maskapai</th>
                        <th class="px-4 py-3">Rute</th>
                        <th class="px-4 py-3">Jadwal</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Kuota</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody id="flight_table" class="divide-y divide-gray-200">
                    <!-- AJAX LOAD -->
                </tbody>

            </table>
        </div>
    </div>


    <script>
        function formatTanggalText(dateStr) {
            const d = new Date(dateStr);
            const options = {
                day: "numeric",
                month: "long",
                year: "numeric"
            };
            return d.toLocaleDateString("en-US", options);
        }

        function cutTime(t) {
            return t.substring(0, 5);
        }

        function statusBadge(status) {
            const map = {
                "Upcoming": "bg-blue-100 text-blue-700",
                "Ongoing": "bg-yellow-100 text-yellow-700",
                "Arrived": "bg-green-100 text-green-700"
            };
            return `<span class="px-3 py-1 rounded-full text-xs ${map[status]}">${status}</span>`;
        }

        function openDeleteModal(id) {
            $("#delete_flight_id").val(id);
            $("#deleteModal").removeClass("hidden");
        }

        function loadFlights(date = "") {
            $.ajax({
                url: "../backend/admin/flight_fetch.php",
                type: "GET",
                data: {
                    date: date
                },
                dataType: "json",
                success: function(res) {

                    $("#flight_table").html("");

                    res.forEach(f => {

                        let isLocked = (f.status === "Ongoing" || f.status === "Arrived");

                        let editBtn = `
                        <button ${isLocked ? "disabled" : `onclick="editFlight(${f.id_flight})"`}
                            class="px-3 py-1 rounded-md text-xs 
                            ${isLocked ? "bg-gray-300 text-gray-500 cursor-not-allowed" : "bg-blue-600 text-white hover:bg-blue-700"}">
                            Edit
                        </button>`;

                        let deleteBtn = `
                        <button ${isLocked ? "disabled" : `onclick="openDeleteModal(${f.id_flight})"`}
                            class="px-3 py-1 rounded-md text-xs 
                            ${isLocked ? "bg-gray-300 text-gray-500 cursor-not-allowed" : "bg-red-600 text-white hover:bg-red-700"}">
                            Delete
                        </button>`;

                        let html = `
                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 align-middle font-medium">${f.flight_code}</td>
                    <td class="px-4 py-3 align-middle">${f.airline_name}</td>

                    <td class="px-4 py-3 align-middle">
                        ${f.origin_city} (${f.origin_code}) → ${f.dest_city} (${f.dest_code})
                    </td>

                    <td class="px-4 py-3 align-middle">
                        ${formatTanggalText(f.departure_date)}<br>
                        <span class="font-semibold">${cutTime(f.departure_time)} - ${cutTime(f.arrival_time)}</span><br>
                        <span class="text-xs text-gray-500">(${f.travel_duration} minutes)</span>
                    </td>

                    <td class="px-4 py-3 align-middle">Rp ${Number(f.price).toLocaleString("id-ID")}</td>
                    <td class="px-4 py-3 align-middle">${f.seat_quota}</td>
                    <td class="px-4 py-3 align-middle">${statusBadge(f.status)}</td>

                    <td class="px-4 py-3 align-middle">
                        <div class="flex items-center justify-center gap-2 h-full">
                            ${editBtn}
                            ${deleteBtn}
                        </div>
                    </td>

                </tr>
                `;

                        $("#flight_table").append(html);
                    });
                }
            });
        }


        function editFlight(id) {
            $.ajax({
                url: "../backend/admin/flight_get.php",
                type: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(f) {

                    // Ubah judul
                    $("h2").text("Edit Penerbangan");

                    // Ubah action form
                    $("form").attr("action", "../backend/admin/flight_update.php");

                    // Tambah hidden input ID flight jika belum ada
                    if ($("#flight_id").length === 0) {
                        $("form").prepend(`<input type="hidden" name="id_flight" id="flight_id">`);
                    }

                    $("#flight_id").val(f.id_flight);

                    // Maskapai
                    $("#airline_select").val(f.airline_id).trigger("change");

                    // Prefix airline supaya muncul di input kiri
                    $("#airline_prefix").val(f.airline_code);

                    // Nomor flight
                    $("input[name='flight_number']").val(f.flight_number);

                    // Asal & Tujuan
                    $("select[name='origin_airport']").val(f.origin_airport);
                    $("select[name='destination_airport']").val(f.destination_airport);

                    // Date & Time
                    $("input[name='departure_date']").val(f.departure_date);
                    $("input[name='departure_time']").val(f.departure_time);

                    // Durasi
                    $("input[name='travel_duration']").val(f.travel_duration);

                    // Price
                    $("input[name='price']").val(f.price);

                    // Seats
                    $("input[name='seats']").val(f.seat_quota);

                    $("#btn_cancel_edit").removeClass("hidden");

                    // Scroll ke atas
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                }
            });
        }


        $(document).ready(function() {
            loadFlights();

            $("#airline_select").on("change", function() {
                let prefix = $(this).find(":selected").data("code");
                $("#airline_prefix").val(prefix);
            });

            setTimeout(() => {
                $("#alert-error, #alert-success").fadeOut();
            }, 3000);

            $("#btn_filter").click(() => loadFlights($("#filter_date").val()));
            $("#btn_reset").click(() => {
                $("#filter_date").val("");
                loadFlights();
            });

            $("#btn_cancel_edit").click(function() {
                $("h2").text("Tambah Penerbangan Baru");
                $("form").attr("action", "../backend/admin/flight_add.php");

                $("form")[0].reset();
                $("#airline_prefix").val("");

                $("#btn_cancel_edit").addClass("hidden");
                $("#flight_id").remove();
            });

            $("#btn_cancel_delete").click(function () {
                $("#deleteModal").addClass("hidden");
            });
        });
    </script>


    <?php require_once "../layouts/admin_footer.php"; ?>