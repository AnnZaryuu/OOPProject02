<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Main Container for Transactions -->
            <div class="container mx-auto">
                <!-- Transaksi Table -->
                <div class="bg-white shadow-md rounded my-6 overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">ID Transaksi</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Customer</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Kasir</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Total</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php if (!empty($transaksis)) {
                                foreach ($transaksis as $transaksi) { ?>
                                    <tr class="text-center border-b border-gray-300 hover:bg-gray-200">
                                        <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($transaksi->idTransaksi); ?></td>
                                        <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->customer->user_nama); ?></td>
                                        <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->kasir->user_nama); ?></td>
                                        <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->total); ?></td>
                                        <td class="py-3 px-4">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" onclick="openModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5" class="py-3 px-4 text-center">Tidak ada data transaksi tersedia.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk detail transaksi -->
    <?php if (!empty($transaksis)) {
        foreach ($transaksis as $transaksi) {
            $formatted_date = date('d-m-Y', strtotime($transaksi->tgl_transaksi));
    ?>
            <div id="modal-<?php echo $transaksi->idTransaksi; ?>" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Transaksi: <?php echo htmlspecialchars($transaksi->idTransaksi); ?></h3>
                        <p class="mt-2 text-gray-700">Tanggal Transaksi: <?php echo htmlspecialchars($formatted_date); ?></p> <!-- Menampilkan tanggal dalam format DD-MM-YYYY -->
                        <div class="mt-2">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="py-3 px-4 uppercase font-semibold text-sm">Barang</th>
                                        <th class="py-3 px-4 uppercase font-semibold text-sm">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    <?php foreach ($transaksi->barangs as $index => $barang) { ?>
                                        <tr class="text-center border-b border-gray-300 hover:bg-gray-50">
                                            <td class="py-3 px-4"><?php echo htmlspecialchars($barang->barang_name); ?></td>
                                            <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->jumlahs[$index]); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="closeModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } ?>



    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>

</body>



</html>