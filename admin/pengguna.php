<?php
require_once "../backend/akses_admin.php"; 

// 1. (LOGIKA PHP)
// ===================================
session_start();
$admin_page_title = 'Manajemen Pengguna';
require_once '../layouts/admin_header.php'; 
require_once '../layouts/admin_sidebar.php'; 

// Inisialisasi data pengguna jika belum ada
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'nama' => 'Jevelyn Calista', 'email' => 'jevelyn@example.com', 'tgl_daftar' => '2025-01-10', 'role' => 'admin'],
        ['id' => 2, 'nama' => 'Jesica Amanda', 'email' => 'jesica@example.com', 'tgl_daftar' => '2025-01-11', 'role' => 'user'],
        ['id' => 3, 'nama' => 'Maria Gabriella', 'email' => 'maria@example.com', 'tgl_daftar' => '2025-01-12', 'role' => 'user'],
    ];
}

// Logika Hapus
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    foreach ($_SESSION['users'] as $key => $user) {
        if ($user['id'] == $delete_id) { unset($_SESSION['users'][$key]); break; }
    }
    header('Location: pengguna.php'); 
    exit;
}

// Logika Tambah / Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password']; // Password (opsional saat edit)

    if (isset($_POST['update_id'])) { // Update
        $update_id = $_POST['update_id'];
        foreach ($_SESSION['users'] as $key => $user) {
            if ($user['id'] == $update_id) {
                $_SESSION['users'][$key]['nama'] = $nama;
                $_SESSION['users'][$key]['email'] = $email;
                $_SESSION['users'][$key]['role'] = $role;
                // Hanya update password jika diisi
                if (!empty($password)) {
                    // Di aplikasi nyata, Anda harus HASH password ini!
                    // $_SESSION['users'][$key]['password'] = password_hash($password, PASSWORD_DEFAULT);
                    echo "Password di-update (simulasi)";
                }
                break;
            }
        }
    } else { // Tambah
        $new_user = [
            'id' => time(), 
            'nama' => $nama, 
            'email' => $email,
            'tgl_daftar' => date('Y-m-d'),
            'role' => $role
            // Simpan password (HARUS DI-HASH)
        ];
        $_SESSION['users'][] = $new_user;
    }
    header('Location: pengguna.php');
    exit;
}

// Logika Search
$all_users_data = $_SESSION['users'];
$search_query = $_GET['search_query'] ?? '';
$display_users = $all_users_data;

if (!empty($search_query)) {
    $display_users = array_filter($display_users, function($user) use ($search_query) {
        $query = strtolower($search_query);
        return (stripos(strtolower($user['nama']), $query) !== false ||
                stripos(strtolower($user['email']), $query) !== false);
    });
}
$display_users = array_values($display_users);
// ===================================
// (AKHIR LOGIKA PHP)
// ===================================
?>

<main class="flex-1 p-10" 
      x-data="{ 
          showModal: false, 
          modalMode: 'add', 
          editData: { id: '', nama: '', email: '', role: 'user', password: '' } 
      }">

    <h1 class="text-3xl font-bold mb-8"><?php echo $admin_page_title; ?></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <form action="pengguna.php" method="GET">
            <div class="flex">
                <input type="text" name="search_query" placeholder="Cari Nama atau Email..." 
                       class="w-full p-2 border rounded-l-md" 
                       value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Cari</button>
                <a href="pengguna.php" class="text-gray-600 ml-4 self-center hover:underline">Reset</a>
            </div>
        </form>
        <div class="text-right">
            <button 
                @click="showModal = true; modalMode = 'add'; editData = { id: '', nama: '', email: '', role: 'user', password: '' }"
                class="bg-green-600 text-white px-5 py-2 rounded-md shadow-lg hover:bg-green-700">
                + Tambah Pengguna Baru
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($display_users)): ?>
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($display_users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['nama']); ?></div>
                                <div class="text-sm text-gray-500">Bergabung: <?php echo htmlspecialchars($user['tgl_daftar']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button 
                                    @click="
                                        showModal = true; 
                                        modalMode = 'edit'; 
                                        editData = <?php echo htmlspecialchars(json_encode($user + ['password' => ''])); ?>
                                    "
                                    class="text-blue-600 hover:text-blue-900">
                                    Edit
                                </button>
                                <a href="pengguna.php?delete_id=<?php echo $user['id']; ?>" 
                                   class="text-red-600 hover:text-red-900 ml-4"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div 
        x-show="showModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;">

        <div @click.outside="showModal = false" 
             class="bg-white w-full max-w-lg p-6 rounded-lg shadow-xl"
             x-show="showModal" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">
                    <span x-text="(modalMode === 'edit') ? 'Edit Pengguna' : 'Tambah Pengguna Baru'"></span>
                </h2>
                <button @click="showModal = false" class="text-gray-500 hover:text-gray-800 text-3xl">&times;</button>
            </div>

            <form action="pengguna.php" method="POST" class="space-y-4">
            
                <template x-if="modalMode === 'edit'">
                    <input type="hidden" name="update_id" :value="editData.id">
                </template>

                <div>
                    <label class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="nama" x-model="editData.nama" 
                           class="w-full mt-1 p-2 border rounded-md" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" x-model="editData.email" 
                           class="w-full mt-1 p-2 border rounded-md" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" x-model="editData.password" 
                           class="w-full mt-1 p-2 border rounded-md" 
                           :placeholder="(modalMode === 'edit') ? 'Kosongkan jika tidak diubah' : 'Password Wajib Diisi'"
                           :required="modalMode === 'add'">
                </div>
                <div>
                    <label class="block text-sm font-medium">Role</label>
                    <select name="role" x-model="editData.role" class="w-full mt-1 p-2 border rounded-md">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        <span x-text="(modalMode === 'edit') ? 'Update Pengguna' : 'Simpan Pengguna'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php 
require_once '../layouts/admin_footer.php'; 
?>