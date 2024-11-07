<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="container mx-auto">
                <div class="mb-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <a href="index.php?modul=barang&fitur=add">Tambah Barang Baru</a>
                    </button>
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID Barang</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Nama Barang</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Jenis Barang</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Harga Barang</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php foreach ($barangs as $barang) : ?>
                                <tr class="text-center">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($barang->barang_id); ?></td>
                                    <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($barang->barang_name); ?></td>
                                    <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($barang->barang_jenis); ?></td>
                                    <td class="w-1/6 py-3 px-4"><?php echo htmlspecialchars($barang->barang_harga); ?></td>
                                    <td class="w-1/6 py-3 px-4">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=barang&fitur=edit&id=<?php echo htmlspecialchars($barang->barang_id); ?>">Ubah</a>
                                        </button>
                                        <button 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                        onclick="confirmDelete(<?php echo htmlspecialchars($barang->barang_id); ?>, this)">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(barangId, button) {
        if (!confirm("Apakah Anda yakin ingin menghapus Barang ini?")) return;
        const row = button.closest("tr");
        
        row.classList.add("fade-out");

        setTimeout(() => {
            window.location.href = `index.php?modul=barang&fitur=delete&id=${barangId}`;
        }, 500);
    }
    </script>
</body>
</html>
