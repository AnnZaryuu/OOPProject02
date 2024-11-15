<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
        .bg-custom {
            background-image: url('assets/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-custom font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-sky-950 rounded-lg shadow-lg m-6">
            <!-- Konten utama -->
            <div class="container mx-auto">

                <!-- Tabel Daftar Peran -->
                <div class="bg-gray-900 shadow-md rounded my-6">
                    <table class="min-w-full bg-gray grid-cols-1">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID Peran</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Nama Peran</th>
                                <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Deskripsi Peran</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status Peran</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-200">
                            <!-- Baris Data Dinamis -->
                                    <?php foreach ($roles as $role) : ?>
                                        <tr class="text-center">
                                            <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($role->role_id); ?></td>
                                            <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($role->role_name); ?></td>
                                            <td class="w-1/3 py-3 px-4"><?php echo htmlspecialchars($role->role_description); ?></td>
                                            <td class="w-1/6 py-3 px-4"><?php echo htmlspecialchars($role->role_status); ?></td>
                                            <td class="w-1/6 py-3 px-4">
                                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                                    <a href="index.php?modul=role&fitur=edit&id=<?php echo htmlspecialchars($role->role_id); ?>">Ubah</a>
                                                </button>
                                                <button 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                                onclick="confirmDelete(<?php echo htmlspecialchars($role->role_id); ?>, this)">Hapus</button>
                                        </td>
                                        </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <!-- Tombol untuk menambah peran baru -->
        <div class="mb-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-6">
                <a href="view/role_input.php">Tambah Peran Baru</a>
            </button>
    </div>

    <script>
    function confirmDelete(roleId, button) {
        if (!confirm("Apakah Anda yakin ingin menghapus Peran ini?")) return;
        const row = button.closest("tr");
        
        row.classList.add("fade-out");

        setTimeout(() => {
            window.location.href = `index.php?modul=role&fitur=delete&id=${roleId}`;
        }, 500);
    }
</script>
</body>
</html>