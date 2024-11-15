<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
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

<body class="bg-gray-900 text-gray-100 font-sans leading-normal tracking-normal bg-custom">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Main Container for Transactions -->
            <div class="container mx-auto">
                <!-- Transaksi Table -->
                <div class="bg-gray-800 shadow-lg rounded-lg my-6 overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-700 text-gray-300">
                            <tr>
                                <th class="py-4 px-6 uppercase font-semibold text-sm">ID Transaksi</th>
                                <th class="py-4 px-6 uppercase font-semibold text-sm">Customer</th>
                                <th class="py-4 px-6 uppercase font-semibold text-sm">Kasir</th>
                                <th class="py-4 px-6 uppercase font-semibold text-sm">Total</th>
                                <th class="py-4 px-6 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-200">
                            <?php if (!empty($transaksis)) {
                                foreach ($transaksis as $transaksi) { ?>
                                    <tr class="text-center border-b border-gray-700 hover:bg-gray-600">
                                        <td class="py-4 px-6 text-blue-400"><?php echo htmlspecialchars($transaksi->idTransaksi); ?></td>
                                        <td class="py-4 px-6"><?php echo htmlspecialchars($transaksi->customer->user_nama); ?></td>
                                        <td class="py-4 px-6"><?php echo htmlspecialchars($transaksi->kasir->user_nama); ?></td>
                                        <td class="py-4 px-6"><?php echo htmlspecialchars($transaksi->total); ?></td>
                                        <td class="py-4 px-6">
                                            <button class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg" onclick="openModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5" class="py-4 px-6 text-center text-gray-400">Tidak ada data transaksi tersedia.</td>
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
            <div id="modal-<?php echo $transaksi->idTransaksi; ?>" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 border border-gray-700 w-1/2 shadow-lg rounded-lg bg-gray-800">
                    <div class="text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-100">Detail Transaksi: <?php echo htmlspecialchars($transaksi->idTransaksi); ?></h3>
                        <p class="mt-2 text-gray-400">Tanggal Transaksi: <?php echo htmlspecialchars($formatted_date); ?></p>
                        <div class="mt-4">
                            <table class="min-w-full bg-gray-800">
                                <thead class="bg-gray-700 text-gray-300">
                                    <tr>
                                        <th class="py-3 px-6 uppercase font-semibold text-sm">Barang</th>
                                        <th class="py-3 px-6 uppercase font-semibold text-sm">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-200">
                                    <?php foreach ($transaksi->barangs as $index => $barang) { ?>
                                        <tr class="text-center border-b border-gray-700 hover:bg-gray-700">
                                            <td class="py-3 px-6"><?php echo htmlspecialchars($barang->barang_name); ?></td>
                                            <td class="py-3 px-6"><?php echo htmlspecialchars($transaksi->jumlahs[$index]); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-6 rounded-lg" onclick="closeModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
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
