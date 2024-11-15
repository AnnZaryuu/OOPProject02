<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.8s forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .bg-custom {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 font-sans leading-normal tracking-normal bg-custom fade-in">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-gray-800 bg-opacity-90 rounded-lg shadow-lg w-full max-w-2xl p-8">
            <!-- Form Transaksi -->
            <h2 class="text-3xl font-bold mb-6 text-center">Transaksi Baru</h2>
            <form action="index.php?modul=transaksi&fitur=add" method="POST" id="transaksiForm">

                <!-- Dropdown Customer -->
                <div class="mb-6">
                    <label for="customer" class="block text-gray-400">Customer</label>
                    <select id="customer" name="customer" class="mt-1 p-3 border border-gray-700 rounded bg-gray-700 text-gray-200 w-full" required>
                        <option value="" disabled selected>Pilih Customer</option>
                        <?php if (!empty($customers)) {
                            foreach ($customers as $customer) {
                                echo "<option value='{$customer->user_id}'>{$customer->user_nama}</option>";
                            }
                        } ?>
                    </select>
                </div>

                <!-- Dropdown Kasir -->
                <div class="mb-6">
                    <label for="kasir" class="block text-gray-400">Kasir</label>
                    <select id="kasir" name="kasir" class="mt-1 p-3 border border-gray-700 rounded bg-gray-700 text-gray-200 w-full" required>
                        <option value="" disabled selected>Pilih Kasir</option>
                        <?php if (!empty($kasirs)) {
                            foreach ($kasirs as $kasir) {
                                echo "<option value='{$kasir->user_id}'>{$kasir->user_nama}</option>";
                            }
                        } ?>
                    </select>
                </div>

                <!-- Detail Barang -->
                <h3 class="text-2xl font-semibold mb-4 text-center">Detail Barang</h3>
                <div id="barangContainer">
                    <!-- Template Barang -->
                    <div class="barang-item mb-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="barang[]" class="block text-gray-400">Barang</label>
                                <select name="barang[]" class="mt-1 p-3 border border-gray-700 rounded bg-gray-700 text-gray-200 w-full" required>
                                    <option value="" disabled selected>Pilih Barang</option>
                                    <?php foreach ($barangs as $barang) {
                                        echo "<option value='{$barang->barang_id}'>{$barang->barang_name} - Rp{$barang->barang_harga}</option>";
                                    } ?>
                                </select>
                            </div>
                            <div>
                                <label for="jumlah[]" class="block text-gray-400">Jumlah</label>
                                <input type="number" name="jumlah[]" class="mt-1 p-3 border border-gray-700 rounded bg-gray-700 text-gray-200 w-full" min="1" required>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="button" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded remove-item transition duration-200">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="addBarangBtn" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4 w-full transition duration-200">
                    Tambah Barang
                </button>

                <div class="mt-8 text-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-8 rounded transition duration-200">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk menambah dan menghapus item barang
        document.getElementById('addBarangBtn').addEventListener('click', function() {
            const barangContainer = document.getElementById('barangContainer');
            const newBarang = document.querySelector('.barang-item').cloneNode(true);
            newBarang.querySelector('select[name="barang[]"]').value = '';
            newBarang.querySelector('input[name="jumlah[]"]').value = '';
            barangContainer.appendChild(newBarang);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-item')) {
                if (document.querySelectorAll('.barang-item').length > 1) {
                    event.target.closest('.barang-item').remove();
                } else {
                    alert('Minimal satu barang harus ada dalam transaksi.');
                }
            }
        });
    </script>
</body>

</html>
