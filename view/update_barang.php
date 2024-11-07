<!DOCTYPE html>
<html lang="en">

<?php
require_once 'model/model_barang.php';
$idBarang = $_GET['id'];

$objectBarang = new Model_barang();

// Mendapatkan data barang berdasarkan ID
$barang = $objectBarang->GetBarangById($idBarang);

if (!$barang) {
    die("Barang tidak ditemukan.");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Update Barang -->
            <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Update Barang</h2>
                <form action="../index.php?modul=barang&fitur=update&id=<?php echo htmlspecialchars($barang->barang_id); ?>" method="POST">
                    <!-- Nama Barang -->
                    <div class="mb-6">
                        <label for="barang_name" class="block text-gray-700 font-semibold mb-2">Nama Barang:</label>
                        <input type="text" id="barang_name" name="barang_name" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($barang->barang_name); ?>" required>
                    </div>

                    <!-- Jenis Barang -->
                    <div class="mb-6">
                        <label for="barang_jenis" class="block text-gray-700 font-semibold mb-2">Jenis Barang:</label>
                        <input type="text" id="barang_jenis" name="barang_jenis" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($barang->barang_jenis); ?>" required>
                    </div>

                    <!-- Harga Barang -->
                    <div class="mb-6">
                        <label for="barang_harga" class="block text-gray-700 font-semibold mb-2">Harga Barang:</label>
                        <input type="number" id="barang_harga" name="barang_harga" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($barang->barang_harga); ?>" required>
                    </div>

                    <!-- Button Submit dan Kembali -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Perubahan
                        </button>
                        <a href="index.php?modul=barang" class="text-gray-600 hover:text-gray-800 font-semibold underline">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
