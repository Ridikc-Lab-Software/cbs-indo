<?php
// Get logged-in user's SPBU
$admin_username = '';
if (isset($_COOKIE['jenenge'])) {
    $admin_username = decrypt($_COOKIE['jenenge']);
}

$admin_nama_spbu = '';
if (!empty($admin_username)) {
    $admin_nama_spbu = baca_database('data_admin', 'nama_spbu', "SELECT nama_spbu FROM data_admin WHERE username='$admin_username'");
}

$default_spbu = '';
if (!empty($admin_nama_spbu)) {
    if (preg_match('/^([\d\.]+)/', $admin_nama_spbu, $matches)) {
        $default_spbu = $matches[1];
    } else {
        $default_spbu = $admin_nama_spbu;
    }
}

$default_start = date('Y-m-01');
$default_end = date('Y-m-t');

// Setup PHP fallback variables
$current_spbu = isset($_GET['spbu']) ? $_GET['spbu'] : $default_spbu;
$current_mulai = (!empty($_GET['mulai'])) ? $_GET['mulai'] : $default_start;
$current_sampai = (!empty($_GET['sampai'])) ? $_GET['sampai'] : $default_end;
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<body class="bg-white font-sans text-gray-800">
    <div id="loading-overlay" class="fixed inset-0 z-50 flex items-center justify-center bg-white bg-opacity-98">
        <div class="flex flex-col items-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-red-500"></div>
            <p class="mt-4 text-lg font-semibold text-red-500">Memuat Dashboard...</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white text-red-500 p-4 rounded-b-2xl mb-8 flex border border-red-500 justify-between items-center shadow-sm"
            style="background-color: red;color: white;">
            <h2 class="text-2xl font-bold m-0 ">DASHBOARD</h2>

            <p class="text-xl m-0">Smart Membercard CBS</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-md border-2 border-red-500 mb-6 p-4">
            <form action="" method="get" id='form-filter'>
                <div class="flex justify-start items-center gap-4">
                    <select name='spbu'
                        class="bg-white text-red-500 rounded-lg px-4 py-2 font-medium border-2 border-red-500 focus:ring-2 focus:ring-red-500 focus:border-transparent shadow-sm">
                        <option value="" <?php echo ($current_spbu == '') ? 'selected' : ''; ?>>Semua SPBU</option>
                        <?php
                        include_once "../../../include/koneksi/koneksi.php";
                        $spbu_query = mysql_query("SELECT * FROM data_spbu ORDER BY nama_spbu ASC");
                        if ($spbu_query) {
                            while ($row = mysql_fetch_assoc($spbu_query)) {
                                $nama_spbu = $row['nama_spbu'];
                                $spbu_value = preg_match('/^([\d\.]+)/', $nama_spbu, $m) ? $m[1] : $nama_spbu;
                                $selected = ($current_spbu == $spbu_value) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($spbu_value) . "' $selected>" . htmlspecialchars($nama_spbu) . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="text" readonly id="date_trigger_input"
                        class="bg-white text-gray-800 rounded-lg px-4 py-2 border-2 border-red-500 focus:ring-2 focus:ring-red-500 focus:border-transparent shadow-sm cursor-pointer hover:shadow-md transition-shadow"
                        value="<?php
                        if (!empty($current_mulai) && !empty($current_sampai)) {
                            echo date('d/m/Y', strtotime($current_mulai)) . ' - ' . date('d/m/Y', strtotime($current_sampai));
                        } else {
                            echo 'Rentang Waktu';
                        }
                        ?>" placeholder="Rentang Waktu">

                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter Data
                    </button>

                    <?php if (isset($_GET['spbu']) || isset($_GET['mulai']) || isset($_GET['sampai'])): ?>
                        <button type="button" id="reset_filter"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow-sm transition-all">
                            Reset Filter
                        </button>
                    <?php endif; ?>

                    <!-- Overlay + Modal Tailwind -->
                    <div id="date_modal_overlay"
                        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                        <div
                            class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">

                            <!-- Header -->
                            <div
                                class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-5 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-8 bg-gradient-to-b from-red-500 to-orange-500 rounded-full">
                                    </div>
                                    <h5 class="text-xl font-bold text-gray-800 m-0">Pilih Rentang Waktu</h5>
                                </div>
                                <button id="close_date_modal" type="button"
                                    class="text-gray-400 hover:text-red-600 hover:bg-red-100 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                                    ✕
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="p-8 pt-6">
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal
                                            Mulai</label>
                                        <div class="relative">
                                            <input type="date" name="mulai"
                                                value="<?php echo htmlspecialchars($current_mulai); ?>"
                                                class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal
                                            Sampai</label>
                                        <div class="relative">
                                            <input type="date" name="sampai"
                                                value="<?php echo htmlspecialchars($current_sampai); ?>"
                                                class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-6 p-3 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-800 font-medium">
                                    Rentang waktu akan berlaku setelah filter diterapkan
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="bg-gray-50 px-8 py-5 flex justify-end gap-3 border-t border-gray-200">
                                <button type="button" id="cancel_date_modal"
                                    class="px-6 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-full hover:bg-gray-300 transition">
                                    Batal
                                </button>
                                <button type="button" id="apply_date_modal"
                                    class="px-8 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-full shadow-lg hover:shadow-blue-500/30 hover:from-blue-600 hover:to-blue-700 hover:-translate-y-0.5 flex items-center gap-2 transition-all">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- Tabs -->
        <div class="mb-6 ">
            <ul class="flex border-b border-gray-300 p-0">
                <li class="">
                    <a class="inline-block py-2 px-4 bg-red-500 text-white font-semibold rounded-t-lg"
                        href="#">TRANSACTION SUMMARY</a>
                </li>
            </ul>
        </div>
        <!--------------------------Kerjakan Pertama------------------------------>


        <!-- Transaction Summary Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8" id='transaction_summary_cards'>
            <!-- Transaction Card -->
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    TRANSACTION
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/report.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="transaction_count">-</h4>
                    <div class="text-lg">Transaksi</div>
                </div>
            </div>

            <!-- Sales Card -->
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    SALES
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/promo.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="sales_rupiah">-</h4>
                    <div class="text-lg">Rupiah</div>
                </div>
            </div>

            <!-- Volume Card -->
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    VOLUME
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/user_check.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="volume_liter">-</h4>
                    <div class="text-lg">Liter</div>
                </div>
            </div>
        </div>

        <!-- Transaction Charts by BBM -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Chart 1: Transaksi By BBM -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Transaksi By BBM</p>
                <div class="relative h-80">
                    <canvas id="chartTransByBBM"></canvas>
                </div>
            </div>

            <!-- Chart 2: Sales SMC (Rupiah) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Sales SMC (Rupiah)</p>
                <div class="relative h-80">
                    <canvas id="chartSalesByBBM"></canvas>
                </div>
            </div>

            <!-- Chart 3: Sales SMC (Liter) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Sales SMC (Liter)</p>
                <div class="relative h-80">
                    <canvas id="chartVolumeByBBM"></canvas>
                </div>
            </div>
        </div>


        <div class="mb-6 ">
            <ul class="flex border-b border-gray-300 p-0">
                <li class="">
                    <a class="inline-block py-2 px-4 bg-red-500 text-white font-semibold rounded-t-lg" href="#">MEMBER
                        SUMMARY</a>
                </li>
            </ul>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mb-8" id='cards_row'>
            <!-- Total Member -->

            <!-- Total Member Aktif -->

            <!-- Promo Aktif SMC -->
        </div>


        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            <!-- Member category (n) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Member category (n)</p>
                <div class="relative h-80 flex flex-col items-center justify-center">
                    <div class="w-48 h-48 mx-auto">
                        <canvas id="memberCategory" class='w-full flex-1'></canvas>
                    </div>
                    <!-- Legenda tanpa margin atas besar -->
                    <div class="w-full max-w-xs mx-auto">
                        <table class="w-full text-sm text-left">
                            <tbody id="legend_memberCategory"></tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Transaction by category (n) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Transaction by category (n)</p>
                <div class="relative h-80 flex flex-col items-center justify-center">
                    <div class="w-48 h-48 mx-auto">
                        <canvas id="transCategory" class='w-full flex-1'></canvas>
                    </div>
                    <!-- Legenda Tabel -->
                    <div class="mt-1 w-full max-w-xs mx-auto">
                        <table class="w-full text-sm">
                            <tbody id="legend_transCategory">
                                <!-- Diisi oleh JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Active members -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Active members</p>
                <div class="relative h-80 flex flex-col items-center justify-center">
                    <div class="w-48 h-48 mx-auto">
                        <canvas id="activeMembers" class='w-full flex-1'></canvas>
                    </div>
                    <!-- Legenda Tabel -->
                    <div class="mt-1 w-full max-w-xs mx-auto">
                        <table class="w-full text-sm">
                            <tbody id="legend_activeMembers">
                                <!-- Diisi oleh JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>


        <div class="mb-6 ">
            <ul class="flex border-b border-gray-300 p-0">
                <li class="">
                    <a class="inline-block py-2 px-4 bg-blue-500 text-white font-semibold rounded-t-lg" href="#">PROMO
                        SUMMARY</a>
                </li>
            </ul>
        </div>


        <div class="mb-6 hidden">
            <ul class="flex border-b border-gray-300 p-0">
                <li class="">
                    <a class="inline-block py-2 px-4 bg-red-500 text-white font-semibold rounded-t-lg" href="#">REDEEM
                        PROMO</a>
                </li>
            </ul>
        </div>

        <!-- Redeem by Promo -->
        <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200 mb-8">
            <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Redeem by Promo</p>
            <div class="relative h-80">
                <canvas id="chartRedeemByPromo"></canvas>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 hidden">

            <!-- Sales SMC (Liter) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Sales SMC (Liter)</p>
                <div class="relative h-80 flex flex-col items-center justify-center">
                    <!-- Wrapper canvas dengan ukuran kecil & center -->
                    <div class="w-48 h-48 mx-auto">
                        <!-- Ubah w-48 h-48 jadi ukuran yang kamu mau, misal w-40 h-40 untuk lebih kecil -->
                        <canvas id="salesLiter" class='w-full flex-1'></canvas>
                    </div>

                    <!-- Legenda rapat di bawah -->
                    <div class="mt-1 w-full max-w-xs mx-auto"> <!-- mt-4 sesuaikan jarak -->
                        <table class="w-full text-sm text-left">
                            <tbody id="legend_salesLiter"></tbody>
                        </table>
                    </div>
                </div>
            </div>




            <!-- Transaksi SMC (n) -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-3 py-2 rounded">Transaksi SMC <span
                        id='ntotal'>(n)</span>
                </p>
                <div class="relative h-80 flex flex-col items-center justify-center">
                    <div class="w-48 h-48 mx-auto">
                        <canvas id="transaksiSmc" class='w-full flex-1'></canvas>
                    </div>
                    <!-- Legenda Tabel -->
                    <div class="mt-1 w-full max-w-xs mx-auto">
                        <table class="w-full text-sm">
                            <tbody id="legend_transaksiSmc">
                                <!-- Diisi oleh JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!-- Redeem point, Leaderboards, dll tetap sama -->
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-700 text-white px-2 py-2 rounded">Redeem point</p>
                <div class="relative h-80">
                    <canvas id="redeemPoint" class='w-full flex-1'></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-2 py-2 rounded">Transaction Leaderboard - operator
                </p>
                <div class="relative h-80">
                    <canvas id="trans_leaderboard"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-700 text-white px-2 py-2 rounded">Top 5 member - points</p>
                <div class="relative h-80">
                    <canvas id="top5_memberpoints"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="font-bold mb-4 bg-blue-500 text-white px-2 py-2 rounded">Top 5 member - transaction</p>
                <div class="relative h-80">
                    <canvas id="top5_member_transaction"></canvas>
                </div>
            </div>
        </div>





        <div class="grid lg:grid-cols-12 gap-6 mb-8 hidden">
            <!-- Left Side - Summary Table -->
            <div class="lg:col-span-8 bg-gray-100">

                <!-- Member Summary Section -->
                <div class="w-full bg-gray-300">
                    <div class="bg-red-500 text-white px-3 py-2 font-bold">
                        MEMBER SUMMARY
                    </div>
                    <table class=" bg-white w-full text-left">
                        <tbody class='p-4' id='detail_info'>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Side - Promo & Mitra -->
            <div class="lg:col-span-4 space-y-4">
                <!-- Promo List -->
                <div class="bg-blue-500 text-white text-center rounded-2xl p-2 shadow-lg">
                    <h5 class="text-lg font-bold m-0">PROMO</h5>

                </div>
                <div id='body_promo'
                    class="max-h-56 overflow-y-auto p-4 bg-white rounded-lg border-2 border-gray-300 space-y-3 shadow-md">

                    <!-- <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-400">
                        <span class="text-red-500 font-semibold">2</span>
                        <div class="text-red-500 font-semibold">Diskon 5000 Allys Coffee</div>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-400">
                        <span class="text-red-500 font-semibold">3</span>
                        <div class="text-red-500 font-semibold">Diskon DRG</div>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-400">
                        <span class="text-red-500 font-semibold">4</span>
                        <div class="text-red-500 font-semibold">Diskon Kecantikan</div>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-400">
                        <span class="text-red-500 font-semibold">5</span>
                        <div class="text-red-500 font-semibold">Diskon belanja di abc supermarket</div>
                    </div> -->
                </div>

                <!-- Sales Program -->
                <div class="bg-blue-700 text-white text-center rounded-2xl p-2 shadow-lg">
                    <h5 class="text-lg font-bold m-0">SALES PROGRAM</h5>

                </div>
                <div
                    class="max-h-56 overflow-y-auto p-2 bg-white rounded-lg border-2 border-gray-300 space-y-3 shadow-md">
                    <div class="flex justify-between items-center ps-3 pb-2 border-b border-dashed border-gray-400">
                        <span class="text-green-500 font-semibold">1</span>
                        <div class="text-green-500 font-semibold">Potongan harga BBM Rp 5000</div>
                    </div>
                    <div class="flex justify-between items-center ps-3 pb-2 border-b border-dashed border-gray-400">
                        <span class="text-green-500 font-semibold">2</span>
                        <div class="text-green-500 font-semibold">Diskon 5000 Allys Coffee</div>
                    </div>
                    <div class="flex justify-between items-center ps-3 pb-2 border-b border-dashed border-gray-400">
                        <span class="text-green-500 font-semibold">3</span>
                        <div class="text-green-500 font-semibold">Diskon DRG</div>
                    </div>
                    <div class="flex justify-between items-center ps-3 pb-2 border-b border-dashed border-gray-400">
                        <span class="text-green-500 font-semibold">4</span>
                        <div class="text-green-500 font-semibold">Diskon Kecantikan</div>
                    </div>
                    <div class="flex justify-between items-center ps-3 pb-2 border-b border-dashed border-gray-400">
                        <span class="text-green-500 font-semibold">5</span>
                        <div class="text-green-500 font-semibold">Diskon belanja di abc supermarket</div>
                    </div>
                </div>
                <!-- Mitra -->
                <div class="bg-blue-500 text-white text-center rounded-2xl p-2 shadow-lg">
                    <h5 class="text-xl font-bold m-0">MITRA</h5>
                </div>

                <!-- Images Mitra -->
                <div class="relative">
                    <div class="swiper mitraSlider">
                        <div class="swiper-wrapper" id="body_mitra">
                            <!-- Images akan diisi oleh JavaScript -->
                            <!-- Contoh statis (akan diganti JS):
            <div class="swiper-slide">
                <img src="https://www.yoonpak.com/wp-content/uploads/2025/08/ice-coffee.webp" 
                     alt="Mitra Ally's Coffee" 
                     class="w-full h-48 object-cover rounded-2xl shadow-lg border-4 border-white">
            </div>
            -->
                        </div>

                        <!-- Navigation Arrows -->
                        <div
                            class="custom-next absolute top-1/2 -translate-y-1 right-2 z-10  !bg-blue-600 hover:!bg-blue-700 !text-white !rounded-full !w-10 !h-10 flex items-center justify-center !shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <div
                            class="custom-prev absolute top-1/2 -translate-y-1 left-2 z-10 !bg-blue-600 hover:!bg-blue-700 !text-white !rounded-full !w-10 !h-10 flex items-center justify-center !shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </div>

                        <!-- Pagination Dots (opsional) -->
                        <div class="swiper-pagination mt-4"></div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Tren Charts -->
        <div class="grid md:grid-cols-3 gap-6 hidden">
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="bg-blue-500 text-white font-bold  mb-4 px-2 py-2 rounded">Tren Transaksi Bulanan</p>
                <div class="relative h-80">
                    <canvas id="chartTransaksi"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="bg-blue-700 text-white font-bold  mb-4 px-2 py-2 rounded">Tren Jumlah Member Aktif Bulanan
                </p>
                <div class="relative h-80">
                    <canvas id="chartMember"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-2 border border-gray-200">
                <p class="bg-blue-500 text-white font-bold  mb-4 px-2 py-2 rounded">Tren Redeem Bulanan</p>
                <div class="relative h-80">
                    <canvas id="chartRedeem"></canvas>
                </div>
            </div>
        </div>

        <!-- Day of Month Transaction -->
        <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-200 mt-8 mb-8">
            <p class="font-bold text-lg mb-4 text-gray-800">DAY OF MONTH TRANSACTION</p>
            <div class="relative h-96">
                <canvas id="chartDayOfMonth"></canvas>
            </div>

            <div class="overflow-x-auto mt-8 hidden">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-blue-50 text-blue-900 uppercase font-bold border-b-2 border-blue-200">
                        <tr>
                            <th class="px-4 py-3 text-center">DATE</th>
                            <th class="px-4 py-3 text-center">TRANSACTION</th>
                            <th class="px-4 py-3 text-center">REDEEM</th>
                            <th class="px-4 py-3 text-center">NEW MEMBER</th>
                        </tr>
                    </thead>
                    <tbody id="dayOfMonthTableBody" class="divide-y divide-gray-200">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
            </div>

        <!-- Leaderboard Table -->
        <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-200 mt-8 mb-8">
            <p class="font-bold text-lg mb-4 text-gray-800">LEADER BOARD</p>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-blue-50 text-blue-900 uppercase font-bold border-b-2 border-blue-200">
                        <tr>
                            <th class="px-4 py-3">NAMA PETUGAS</th>
                            <th class="px-4 py-3 text-center">TRANSAKSI</th>
                            <th class="px-4 py-3 text-center">NEW MEMBER</th>
                            <th class="px-4 py-3 text-center">REDEEM</th>
                            <th class="px-4 py-3 text-center">VOUCHER</th>
                            <th class="px-4 py-3 text-right">SALES</th>
                        </tr>
                    </thead>
                    <tbody id="leaderboardTableBody" class="divide-y divide-gray-200">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Print Button -->
        <div class="flex justify-end mt-4 mb-8">
            <button onclick="printGrafik()" id="btn-print-grafik"
                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Grafik
            </button>
        </div>
    </div>

    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 8mm 6mm;
            }

            /* Sembunyikan hanya elemen UI yang tidak perlu */
            #loading-overlay,
            #btn-print-grafik,
            #date_modal_overlay,
            .swiper-pagination,
            .swiper-button-next,
            .swiper-button-prev,
            #form-filter,
            #reset_filter { display: none !important; }

            /* Tampilkan semua konten dashboard */
            body, .max-w-7xl { display: block !important; visibility: visible !important; }

            /* Override Tailwind grid agar tetap multi-kolom saat print */
            .grid { display: grid !important; }
            .md\:grid-cols-2,
            [class*="md:grid-cols-2"] { grid-template-columns: 1fr 1fr !important; }
            .md\:grid-cols-3,
            [class*="md:grid-cols-3"],
            .lg\:grid-cols-3,
            [class*="lg:grid-cols-3"] { grid-template-columns: 1fr 1fr 1fr !important; }
            .grid-cols-1.md\:grid-cols-2,
            .grid-cols-1.md\:grid-cols-3 { display: grid !important; }

            canvas, img.print-chart-img {
                max-width: 100% !important;
                max-height: 180px !important;
                page-break-inside: avoid;
            }

            table { font-size: 8px; }
            th, td { padding: 2px 4px !important; }

            /* Swiper: tampilkan semua slide */
            .swiper-wrapper { transform: none !important; display: flex !important; flex-wrap: wrap !important; }
            .swiper-slide { width: auto !important; flex: 1 !important; }
        }
    </style>
    <!-- Tailwind CSS CDN (v3.4+) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // === VARIABEL FALLBACK & GLOBAL ===
        const defaultSpbu = <?php echo json_encode($current_spbu); ?>;
        const defaultMulai = <?php echo json_encode($current_mulai); ?>;
        const defaultSampai = <?php echo json_encode($current_sampai); ?>;

        const loadingOverlay = document.getElementById('loading-overlay');
        let charts = {}; // Simpan semua chart instance
        let mitraSwiper = null; // Instance Swiper mitra

        Chart.register(ChartDataLabels);
        Chart.defaults.set('plugins.datalabels', {
            display: function(context) {
                return ['bar', 'doughnut', 'pie'].includes(context.chart.config.type);
            },
            align: function(context) {
                if (context.chart.config.type === 'doughnut' || context.chart.config.type === 'pie') {
                    return 'center';
                }
                return context.chart.options.indexAxis === 'y' ? 'right' : 'top';
            },
            anchor: function(context) {
                if (context.chart.config.type === 'doughnut' || context.chart.config.type === 'pie') {
                    return 'center';
                }
                return 'end';
            },
            color: function(context) {
                if (context.chart.config.type === 'doughnut' || context.chart.config.type === 'pie') {
                    return '#ffffff';
                }
                return '#3b82f6';
            },
            font: {
                weight: 'bold',
                size: 11
            },
            formatter: function(value) {
                if (typeof value === 'number') {
                    if (Number.isInteger(value)) {
                        return value > 0 ? value.toLocaleString('id-ID') : '';
                    } else {
                        return value > 0 ? value.toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 2 }) : '';
                    }
                }
                return value > 0 ? Number(value).toLocaleString('id-ID') : '';
            }
        });
        Chart.defaults.layout.padding = { top: 20, right: 30 }; // Menghindari teks terpotong

        // === FUNGSI BANTU ===
        function showNoData(containerId, message = "Tidak ada data untuk periode ini") {
            const canvasEl = document.getElementById(containerId);
            if (!canvasEl) return;
            
            const container = canvasEl.closest('.relative.h-80') || canvasEl.parentElement;
            if (container) {
                canvasEl.style.display = 'none';
                let msgEl = container.querySelector('.no-data-msg');
                if (!msgEl) {
                    msgEl = document.createElement('p');
                    msgEl.className = 'no-data-msg text-center text-gray-600 text-lg mt-20';
                    container.appendChild(msgEl);
                }
                msgEl.innerText = message;
            }
        }

        function generateLegend(values, labels, colors, container, total, unit = '') {
            container.innerHTML = '';
            labels.forEach((label, i) => {
                container.innerHTML += `
            <tr>
                <td class="py-1 font-medium">${label}</td>
                <td class="py-1 px-3">:</td>
                <td class="py-1 text-right font-bold" style="color:${colors[i]};">
                    ${(values[i] || 0).toLocaleString()} ${unit}
                </td>
            </tr>
        `;
            });
            container.innerHTML += `
        <tr class="border-t border-gray-400 mt-2 pt-2">
            <td class="py-2 font-bold">Total</td>
            <td class="py-2 px-3"></td>
            <td class="py-2 text-right font-bold text-red-600">${total.toLocaleString()} ${unit}</td>
        </tr>
    `;
        }

        // === FETCH TRANSACTION SUMMARY ===
        async function fetchTransactionSummary() {
            const urlParams = new URLSearchParams(window.location.search);
            const params = {
                spbu: urlParams.get('spbu') !== null ? urlParams.get('spbu') : defaultSpbu,
                mulai: (urlParams.get('mulai') !== null && urlParams.get('mulai') !== '') ? urlParams.get('mulai') : defaultMulai,
                sampai: (urlParams.get('sampai') !== null && urlParams.get('sampai') !== '') ? urlParams.get('sampai') : defaultSampai
            };

            try {
                const res = await fetch(`../data_grafik/get_grafik_data.php?spbu=${encodeURIComponent(params.spbu)}&mulai=${encodeURIComponent(params.mulai)}&sampai=${encodeURIComponent(params.sampai)}`);
                const grafikData = await res.json();
                console.log('Transaction Summary Data:', grafikData);
                if (grafikData.debug_query) {
                    console.log('--- GRAFIK SQL DEBUG ---', grafikData.debug_query);
                }

                // Update Transaction Summary Cards
                const transactionCount = grafikData.total_transaksi_count || 0;
                const salesRupiah = grafikData.total_sales_rupiah || 0;
                const volumeLiter = grafikData.total_volume_liter || 0;

                document.getElementById('transaction_count').textContent = transactionCount.toLocaleString('id-ID');
                document.getElementById('sales_rupiah').textContent = Math.round(salesRupiah).toLocaleString('id-ID');
                document.getElementById('volume_liter').textContent = volumeLiter.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                // Create BBM Bar Charts
                console.log('BBM Labels:', grafikData.trans_by_bbm_labels);
                console.log('BBM Data:', grafikData.trans_by_bbm_data);
                if (grafikData.trans_by_bbm_labels && grafikData.trans_by_bbm_labels.length > 0) {
                    console.log('Creating BBM charts...');
                    createBarChart('chartTransByBBM', grafikData.trans_by_bbm_labels,
                        grafikData.trans_by_bbm_data, 'Transaksi', '#3b82f6');
                    createBarChart('chartSalesByBBM', grafikData.trans_by_bbm_labels,
                        grafikData.sales_by_bbm_data, 'Rupiah', '#3b82f6');
                    createBarChart('chartVolumeByBBM', grafikData.trans_by_bbm_labels,
                        grafikData.volume_by_bbm_data, 'Liter', '#3b82f6');
                } else {
                    console.log('No BBM data available');
                }
            } catch (err) {
                console.error('Error loading transaction summary:', err);
                document.getElementById('transaction_count').textContent = 'Error';
                document.getElementById('sales_rupiah').textContent = 'Error';
                document.getElementById('volume_liter').textContent = 'Error';
            }
        }

        // === CREATE BAR CHART HELPER ===
        function createBarChart(canvasId, labels, data, label, color) {
            const ctx = document.getElementById(canvasId);
            if (!ctx) return;

            // Destroy existing chart if exists
            if (charts[canvasId]) {
                charts[canvasId].destroy();
            }

            charts[canvasId] = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // === MAIN FETCH DATA ===
        async function loadDashboard() {
            loadingOverlay.style.display = 'flex';

            const urlParams = new URLSearchParams(window.location.search);
            const params = {
                spbu: urlParams.get('spbu') !== null ? urlParams.get('spbu') : defaultSpbu,
                mulai: (urlParams.get('mulai') !== null && urlParams.get('mulai') !== '') ? urlParams.get('mulai') : defaultMulai,
                sampai: (urlParams.get('sampai') !== null && urlParams.get('sampai') !== '') ? urlParams.get('sampai') : defaultSampai
            };

            try {
                // Fetch transaction summary
                await fetchTransactionSummary();

                const res = await fetch(`get_dashboard_data.php?spbu=${encodeURIComponent(params.spbu)}&mulai=${encodeURIComponent(params.mulai)}&sampai=${encodeURIComponent(params.sampai)}&_t=${Date.now()}`);
                const data = await res.json();
                console.log('Data dari server:', data);
                if (data.debug_query) {
                    console.log('--- DASHBOARD SQL DEBUG ---', data.debug_query);
                }

                loadingOverlay.style.display = 'none';

                // === CARD ROW ===
                document.getElementById('cards_row').innerHTML = `
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    TOTAL MEMBER
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/member.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="print_total_member">${data.total_member_overall.toLocaleString()}</h4>
                    <div class="text-lg">Member</div>
                </div>
            </div>
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    ACTIVE MEMBER
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/user_check.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="print_active_member">${data.member_aktif_filtered.toLocaleString()}</h4>
                    <div class="text-lg">Member</div>
                </div>
            </div>
            <div class="bg-white border-2 border-red-500 rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white text-center py-2 font-bold">
                    NEW MEMBER
                </div>
                <div class="text-center py-6">
                    <img src="../../../data/tmp/membercard/files/icon/member.png" width="50" class="mx-auto mb-2">
                    <h4 class="text-3xl font-bold text-red-500" id="print_new_member">${data.new_member_count_overall || 0}</h4>
                    <div class="text-lg">Member</div>
                </div>
            </div>
        `;

                // === DETAIL INFO TABLE ===
                document.getElementById('detail_info').innerHTML = `
            <tr class="border-b border-red/30"><th class="p-3">Jumlah transaksi</th><td class="text-center font-bold">${data.total_transaksi.toLocaleString()}</td></tr>
            <tr class="border-b border-red/30"><th class="p-3">Jumlah Redeem</th><td class="text-center font-bold">${data.total_redeem.toLocaleString()}</td></tr>
            <tr class="border-b border-red/30"><th class="p-3">Member </th><td class="text-center font-bold">${data.total_member_overall.toLocaleString()}</td></tr>
            <tr class="border-b border-red/30"><th class="p-3">Member Aktif</th><td class="text-center font-bold">${data.member_aktif_filtered.toLocaleString()}</td></tr>
        `;

                // === CHARTS ===
                destroyAllCharts();

                const safeExecute = (fn, name) => {
                    try {
                        fn(data);
                    } catch(e) {
                        console.error('Crash in ' + name + ':', e);
                        const errbox = document.createElement('div');
                        errbox.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-4';
                        errbox.innerHTML = `<strong class="font-bold">Error di fungsi ${name}:</strong> <span class="block sm:inline">${e.message}</span>`;
                        document.querySelector('.relative.min-h-screen')?.prepend(errbox) || document.body.prepend(errbox);
                    }
                };

                safeExecute(renderSalesLiterChart, 'renderSalesLiterChart');
                safeExecute(renderTransaksiSmcChart, 'renderTransaksiSmcChart');
                safeExecute(renderTransCategoryChart, 'renderTransCategoryChart');
                safeExecute(renderActiveMembersChart, 'renderActiveMembersChart');
                safeExecute(renderMemberCategoryChart, 'renderMemberCategoryChart');
                safeExecute(renderRedeemPointChart, 'renderRedeemPointChart');
                safeExecute(renderLeaderboards, 'renderLeaderboards');
                safeExecute(renderTrenCharts, 'renderTrenCharts');
                safeExecute(renderRedeemByPromoChart, 'renderRedeemByPromoChart');
                safeExecute(renderLeaderboardTable, 'renderLeaderboardTable');
                safeExecute(renderDayOfMonthChart, 'renderDayOfMonthChart');
                safeExecute(renderDayOfMonthTable, 'renderDayOfMonthTable');

                // === PROMO LIST ===
                safeExecute(renderPromoList, 'renderPromoList');

                // === MITRA SLIDER ===
                safeExecute(renderMitraSlider, 'renderMitraSlider');

                // Resize semua chart setelah DOM settle
                setTimeout(() => {
                    Object.values(charts).forEach(chart => chart?.resize());
                }, 500);

            } catch (err) {
                console.error('Error loading dashboard:', err);
                loadingOverlay.style.display = 'none';
            }
        }

        function destroyAllCharts() {
            // Preserve BBM charts and Redeem by Promo chart
            const preservedChartIds = ['chartTransByBBM', 'chartSalesByBBM', 'chartVolumeByBBM', 'chartRedeemByPromo'];
            Object.keys(charts).forEach(key => {
                if (!preservedChartIds.includes(key)) {
                    charts[key]?.destroy();
                    delete charts[key];
                }
            });
            if (mitraSwiper) {
                mitraSwiper.destroy(true, true);
                mitraSwiper = null;
            }

            // Bersihkan pesan no-data dan kembalikan canvas yang di-hide
            document.querySelectorAll('canvas').forEach(c => c.style.display = 'block');
            document.querySelectorAll('.no-data-msg').forEach(m => m.remove());
        }

        // === RENDER CHARTS ===
        function renderSalesLiterChart(data) {
            const hitungLiter = arr => arr.reduce((sum, item) => sum + (parseInt(item.jumlah || 0) / parseInt(item.harga || 1)), 0);
            const values = [
                hitungLiter(data.jenis_liter.PERTAMAX || []),
                hitungLiter(data.jenis_liter.TURBO || []),
                hitungLiter(data.jenis_liter.DEXLITE || []),
                hitungLiter(data.jenis_liter.PERTALITE || [])
            ];
            const total = values.reduce((a, b) => a + b, 0);

            if (total === 0) return showNoData('salesLiter', 'Tidak ada penjualan liter di periode ini');

            charts.salesLiter = new Chart(document.getElementById('salesLiter'), {
                type: 'doughnut',
                data: { labels: ['Pertamax', 'Turbo', 'Dexlite', 'Pertalite'], datasets: [{ data: values, backgroundColor: ['#1e40af', '#3b82f6', '#93c5fd', '#1e3a8a'] }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '60%', radius: '75%', plugins: { legend: { display: false } } }
            });

            generateLegend(values, ['Pertamax', 'Turbo', 'Dexlite', 'Pertalite'], ['#1e40af', '#3b82f6', '#93c5fd', '#1e3a8a'],
                document.getElementById('legend_salesLiter'), total, 'L');
        }

        function renderTransaksiSmcChart(data) {



            const items = data.per_jenis_transaksi || [];
            const total = items.reduce((sum, item) => sum + (parseInt(item.jml) || 0), 0);
            document.getElementById('ntotal').textContent = `(${total.toLocaleString()})`;

            if (total === 0) return showNoData('transaksiSmc');

            charts.transaksiSmc = new Chart(document.getElementById('transaksiSmc'), {
                type: 'doughnut',
                data: { labels: ['Pertamax', 'Turbo', 'Dexlite', 'Pertalite'], datasets: [{ data: items.map(x => x.jml || 0), backgroundColor: ['#1e40af', '#3b82f6', '#93c5fd', '#1e3a8a'] }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '60%', radius: '75%', plugins: { legend: { display: false } } }
            });

            generateLegend(items.map(x => x.jml || 0), ['Pertamax', 'Turbo', 'Dexlite', 'Pertalite'],
                ['#1e40af', '#3b82f6', '#93c5fd', '#1e3a8a'], document.getElementById('legend_transaksiSmc'), total);
        }

        function renderTransCategoryChart(data) {
            const vals = [data.jumlah_kategori.motor, data.jumlah_kategori.mobil, data.jumlah_kategori.jerigen, data.jumlah_kategori.niaga].map(v => v || 0);
            const total = vals.reduce((a, b) => a + b, 0);
            if (total === 0) return showNoData('transCategory');

            charts.transCategory = new Chart(document.getElementById('transCategory'), {
                type: 'doughnut',
                data: { labels: ['Motor', 'Mobil', 'Drigen', 'Truck/Niaga'], datasets: [{ data: vals, backgroundColor: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd'] }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '60%', radius: '75%', plugins: { legend: { display: false } } }
            });

            generateLegend(vals, ['Motor', 'Mobil', 'Drigen', 'Truck/Niaga'], ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd'],
                document.getElementById('legend_transCategory'), total);
        }

        function renderActiveMembersChart(data) {
            const aktif = data.member_aktif_filtered || 0;
            const tidak = data.member_tidak_aktif_filtered || 0;
            if (aktif + tidak === 0) return showNoData('activeMembers');

            charts.activeMembers = new Chart(document.getElementById('activeMembers'), {
                type: 'pie',
                data: { labels: ['Aktif', 'Tidak Aktif'], datasets: [{ data: [aktif, tidak], backgroundColor: ['#1d4ed8', '#93c5fd'] }] },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            formatter: (value, ctx) => {
                                const total = aktif + tidak;
                                if (total === 0) return '';
                                const percentage = (value / total) * 100;
                                return value.toLocaleString('id-ID') + ' (' + percentage.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '%)';
                            },
                            color: '#ffffff',
                            font: {
                                weight: 'bold',
                                size: 10
                            }
                        }
                    }
                }
            });

            const legend = document.getElementById('legend_activeMembers');
            legend.innerHTML = `
        <tr><td class="py-1 font-medium">Aktif</td><td>:</td><td class="text-right font-bold text-blue-700">${aktif.toLocaleString('id-ID')}</td></tr>
        <tr><td class="py-1 font-medium">Tidak Aktif</td><td>:</td><td class="text-right font-bold text-blue-300">${tidak.toLocaleString('id-ID')}</td></tr>
    `;
        }

        function renderMemberCategoryChart(data) {
            const items = data.per_kategori || [];
            const total = items.reduce((sum, item) => sum + (parseInt(item.jml) || 0), 0);
            if (total === 0) return showNoData('memberCategory');

            charts.memberCategory = new Chart(document.getElementById('memberCategory'), {
                type: 'doughnut',
                data: { labels: ['Motor', 'Mobil', 'Drigen', 'Truck/Niaga'], datasets: [{ data: items.map(x => x.jml || 0), backgroundColor: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd'] }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '60%', radius: '75%', plugins: { legend: { display: false } } }
            });

            generateLegend(items.map(x => x.jml || 0), ['Motor', 'Mobil', 'Drigen', 'Truck/Niaga'],
                ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd'], document.getElementById('legend_memberCategory'), total);
        }

        function renderRedeemPointChart(data) {
            if (!data.top_redeem?.length) return showNoData('redeemPoint');
            charts.redeemPoint = new Chart(document.getElementById('redeemPoint'), {
                type: 'bar',
                data: { labels: data.top_redeem.map(i => i.nama?.substring(0, 15) || ''), datasets: [{ data: data.top_redeem.map(i => i.jml), backgroundColor: '#3b82f6' }] },
                options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { display: false } } } }
            });
        }

        function renderLeaderboards(data) {
            // Leaderboard Operator
            if (!data.leader_operator?.length) showNoData('trans_leaderboard');
            else {
                charts.transLeaderboard = new Chart(document.getElementById('trans_leaderboard'), {
                    type: 'bar',
                    data: { labels: data.leader_operator.map(o => o.nama?.substring(0, 12) || ''), datasets: [{ data: data.leader_operator.map(o => o.jumlah_transaksi), backgroundColor: '#3b82f6' }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { display: false } } } }
                });
            }

            // Top Points & Transaction
            ['top5_memberpoints', 'top5_member_transaction'].forEach(id => {
                const key = id === 'top5_memberpoints' ? 'top_point' : 'top_transaksi';
                if (!data[key]?.length) showNoData(id);
                else {
                    charts[id] = new Chart(document.getElementById(id), {
                        type: 'bar',
                        data: { labels: data[key].map(i => i.nama?.substring(0, 12) || ''), datasets: [{ data: data[key].map(i => i.point || i.jml), backgroundColor: '#3b82f6' }] },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { display: false } } } }
                    });
                }
            });
        }

        function renderRedeemByPromoChart(data) {
            const items = data.redeem_by_promo || [];
            if (items.length === 0) return showNoData('chartRedeemByPromo');

            const labels = items.map(x => x.nama_promo);
            const values = items.map(x => x.jumlah);

            charts.chartRedeemByPromo = new Chart(document.getElementById('chartRedeemByPromo'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Redeem',
                        data: values,
                        backgroundColor: '#3b82f6', // blue-500
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, grid: { display: false } }
                    }
                }
            });
        }

        function renderTrenCharts(data) {
            const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            ['chartTransaksi', 'chartMember', 'chartRedeem'].forEach((id, idx) => {
                const datasetKey = ['tren_trans_bulan', 'tren_mem_bulan', 'tren_redeem_bulan'][idx];
                const values = data[datasetKey] || [];

                charts[id] = new Chart(document.getElementById(id), {
                    type: id === 'chartMember' ? 'bar' : 'line',
                    data: { labels: bulan, datasets: [{ data: values, backgroundColor: id === 'chartMember' ? '#3b82f6' : 'rgba(59,130,246,0.2)', borderColor: '#3b82f6', fill: id !== 'chartMember' }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { display: false } } } }
                });
            });
        }

        // === PROMO LIST ===
        function renderPromoList(data) {
            const container = document.getElementById('body_promo');
            container.innerHTML = '';
            const promos = data.promo_list || [];

            if (promos.length === 0) {
                container.innerHTML = `
            <div class="text-center py-6 text-gray-500">
                Tidak ada promo aktif saat ini
            </div>
        `;
                return;
            }

            promos.forEach((promo, index) => {
                const bgColors = ['bg-orange-500', 'bg-blue-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500'];
                const bgClass = bgColors[index % bgColors.length];

                container.innerHTML += `
            <div class="${bgClass} text-white rounded-xl shadow-md p-4 flex items-center justify-between min-w-[250px]">
                <div class="font-bold text-lg">${promo.nama_promo}</div>
            </div>
        `;
            });
        }

        function renderLeaderboardTable(data) {
            const tbody = document.getElementById('leaderboardTableBody');
            tbody.innerHTML = '';

            const items = data.leaderboard_full || [];

            if (items.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data leaderboard</td></tr>`;
                return;
            }

            let totalTransaksi = 0;
            let totalNewMember = 0;
            let totalRedeem = 0;
            let totalVoucher = 0;
            let totalSales = 0;

            items.forEach((item, index) => {
                const bgClass = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';

                totalTransaksi += parseInt(item.total_transaksi) || 0;
                totalNewMember += parseInt(item.new_member) || 0;
                totalRedeem += parseInt(item.total_redeem) || 0;
                totalVoucher += parseInt(item.total_voucher) || 0;
                totalSales += parseInt(item.total_sales) || 0;

                tbody.innerHTML += `
            <tr class="${bgClass} hover:bg-gray-100 transition-colors">
                <td class="px-4 py-3 font-semibold text-gray-800">${item.nama}</td>
                <td class="px-4 py-3 text-center text-blue-600 font-bold">${parseInt(item.total_transaksi).toLocaleString()}</td>
                <td class="px-4 py-3 text-center text-green-600 font-bold">${parseInt(item.new_member).toLocaleString()}</td>
                <td class="px-4 py-3 text-center text-orange-600 font-bold">${parseInt(item.total_redeem).toLocaleString()}</td>
                 <td class="px-4 py-3 text-center text-purple-600 font-bold">${parseInt(item.total_voucher).toLocaleString()}</td>
                <td class="px-4 py-3 text-right font-bold text-gray-900">${parseInt(item.total_sales).toLocaleString()}</td>
            </tr>
        `;
            });

            tbody.innerHTML += `
            <tr class="bg-blue-100 font-bold text-gray-900 border-t-2 border-blue-300">
                <td class="px-4 py-3 uppercase">TOTAL</td>
                <td class="px-4 py-3 text-center text-blue-800">${totalTransaksi.toLocaleString()}</td>
                <td class="px-4 py-3 text-center text-green-800">${totalNewMember.toLocaleString()}</td>
                <td class="px-4 py-3 text-center text-orange-800">${totalRedeem.toLocaleString()}</td>
                <td class="px-4 py-3 text-center text-purple-800">${totalVoucher.toLocaleString()}</td>
                <td class="px-4 py-3 text-right text-gray-900">${totalSales.toLocaleString()}</td>
            </tr>
        `;
        }

        // === MITRA SLIDER ===
        function renderMitraSlider(data) {
            const wrapper = document.querySelector('.mitraSlider');
            const container = document.getElementById('body_mitra');
            if (!container || !wrapper) return;

            container.innerHTML = '';

            if (!data.mitra_list?.length) {
                container.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada mitra</p>';
                return;
            }

            data.mitra_list.forEach(mitra => {
                container.innerHTML += `
            <div class="swiper-slide px-4">
                <img src="../../../upload/${mitra.gambar_logo}" alt="${mitra.nama_mitra || 'Mitra'}" 
                     class="w-full max-h-32 object-contain rounded-2xl shadow-xl border-4 border-white mx-auto">
            </div>
        `;
            });

            // Destroy instance lama
            if (mitraSwiper) {
                mitraSwiper.destroy(true, true);
            }

            // Init ulang dengan delay kecil
            setTimeout(() => {
                mitraSwiper = new Swiper('.mitraSlider', {
                    loop: data.mitra_list.length > 1,
                    autoplay: { delay: 3000, disableOnInteraction: false },
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    centeredSlides: true,
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.custom-next', prevEl: '.custom-prev' },
                    breakpoints: {
                        320: { slidesPerView: 1, centeredSlides: false },
                        640: { slidesPerView: 2 },
                        768: { slidesPerView: 2.5 },
                        1024: { slidesPerView: 3 }
                    }
                });
            }, 150);
        }

        // === DAY OF MONTH STATS ===
        function renderDayOfMonthChart(data) {
            const ctx = document.getElementById('chartDayOfMonth');
            if (!ctx) return;

            const stats = data.day_of_month_stats || [];
            const labels = stats.map(d => d.day_label || d.date || d.day);
            const transData = stats.map(d => d.transaction);
            const redeemData = stats.map(d => d.redeem);
            const memberData = stats.map(d => d.new_member);

            if (charts['dayOfMonth']) {
                charts['dayOfMonth'].destroy();
            }

            charts['dayOfMonth'] = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'TRANSACTION',
                            data: transData,
                            backgroundColor: 'rgba(147, 197, 253, 0.8)', // Light Blue
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'REDEEM',
                            data: redeemData,
                            backgroundColor: 'rgba(37, 99, 235, 0.8)', // Medium Blue
                            borderColor: 'rgba(37, 99, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'NEW MEMBER',
                            data: memberData,
                            backgroundColor: 'rgba(30, 64, 175, 0.8)', // Dark Blue
                            borderColor: 'rgba(30, 64, 175, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        title: { display: false },
                        legend: { position: 'bottom' }
                    }
                }
            });
        }

        function renderDayOfMonthTable(data) {
            const tbody = document.getElementById('dayOfMonthTableBody');
            if (!tbody) return;
            tbody.innerHTML = '';

            const stats = data.day_of_month_stats || [];

            if (stats.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data</td></tr>`;
                return;
            }

            let totalTrans = 0;
            let totalRedeem = 0;
            let totalNewMem = 0;

            stats.forEach((item, index) => {
                totalTrans += item.transaction || 0;
                totalRedeem += item.redeem || 0;
                totalNewMem += item.new_member || 0;

                const bgClass = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                tbody.innerHTML += `
                    <tr class="${bgClass} hover:bg-gray-100 transition-colors">
                        <td class="px-4 py-3 text-center font-bold text-gray-800">${item.day_label || item.date || item.day || '-'}</td>
                        <td class="px-4 py-3 text-center text-blue-400 font-bold">${(item.transaction || 0).toLocaleString()}</td>
                        <td class="px-4 py-3 text-center text-blue-600 font-bold">${(item.redeem || 0).toLocaleString()}</td>
                        <td class="px-4 py-3 text-center text-blue-800 font-bold">${(item.new_member || 0).toLocaleString()}</td>
                    </tr>
                `;
            });

            tbody.innerHTML += `
                <tr class="bg-blue-100 font-bold text-gray-900 border-t-2 border-blue-300">
                    <td class="px-4 py-3 text-center uppercase">TOTAL</td>
                    <td class="px-4 py-3 text-center text-blue-800">${totalTrans.toLocaleString()}</td>
                    <td class="px-4 py-3 text-center text-blue-800">${totalRedeem.toLocaleString()}</td>
                    <td class="px-4 py-3 text-center text-blue-800">${totalNewMem.toLocaleString()}</td>
                </tr>
            `;
        }

        // === MODAL FILTER TANGGAL ===
        document.getElementById('date_trigger_input')?.addEventListener('click', () => {
            document.getElementById('date_modal_overlay').classList.remove('hidden');
        });

        ['close_date_modal', 'cancel_date_modal'].forEach(id => {
            document.getElementById(id)?.addEventListener('click', () => {
                document.getElementById('date_modal_overlay').classList.add('hidden');
            });
        });

        document.getElementById('apply_date_modal')?.addEventListener('click', () => {
            const mulai = document.querySelector('input[name="mulai"]').value;
            const sampai = document.querySelector('input[name="sampai"]').value;
            if (mulai && sampai) {
                const formatLokal = d => d.split('-').reverse().join('/');
                document.getElementById('date_trigger_input').value = formatLokal(mulai) + ' - ' + formatLokal(sampai);
            }
            document.getElementById('date_modal_overlay').classList.add('hidden');
        });

        document.getElementById('date_modal_overlay')?.addEventListener('click', e => {
            if (e.target.id === 'date_modal_overlay') {
                e.target.classList.add('hidden');
            }
        });

        // === RESET FILTER BUTTON ===
        document.getElementById('reset_filter')?.addEventListener('click', () => {
            // Clear URL parameters and reload page
            window.location.href = window.location.pathname;
        });

        // === PRINT GRAFIK ===
        function printGrafik() {
            const chartDefs = [
                { id: 'chartTransByBBM',    title: 'Transaksi By BBM' },
                { id: 'chartSalesByBBM',    title: 'Sales SMC (Rupiah)' },
                { id: 'chartVolumeByBBM',   title: 'Sales SMC (Liter)' },
                { id: 'memberCategory',     title: 'Member Category (n)', legendId: 'legend_memberCategory' },
                { id: 'transCategory',      title: 'Transaction by Category (n)', legendId: 'legend_transCategory' },
                { id: 'activeMembers',      title: 'Active Members', legendId: 'legend_activeMembers' },
                { id: 'chartRedeemByPromo', title: 'Redeem by Promo' },
                { id: 'dayOfMonth',         title: 'Day of Month Transaction' },
            ];

            const chartImages = [];

            chartDefs.forEach(({ id, title, legendId }) => {
                // Coba dari charts object, fallback ke DOM
                let canvas = (charts[id] && charts[id].canvas) ? charts[id].canvas : document.getElementById(id);
                if (!canvas) return;

                const w = canvas.width  || canvas.offsetWidth  * (window.devicePixelRatio || 1);
                const h = canvas.height || canvas.offsetHeight * (window.devicePixelRatio || 1);
                if (!w || !h) return;

                // Gambar ke temporary canvas dengan background putih
                const tmp = document.createElement('canvas');
                tmp.width  = w;
                tmp.height = h;
                const ctx = tmp.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, w, h);
                ctx.drawImage(canvas, 0, 0, w, h);

                let legendHTML = '';
                if (legendId) {
                    const legendEl = document.getElementById(legendId);
                    if (legendEl) {
                        legendHTML = `<div style="padding:4px 8px;"><table>${legendEl.innerHTML}</table></div>`;
                    }
                }

                chartImages.push({ title, src: tmp.toDataURL('image/png'), legendHTML });
            });

            // Ambil data summary dari DOM saat ini
            const valTrans = document.getElementById('transaction_count')?.innerText || '0';
            const valSales = document.getElementById('sales_rupiah')?.innerText || '0';
            const valVol   = document.getElementById('volume_liter')?.innerText || '0';

            // Ambil data member summary dari DOM
            const valTotalMem  = document.getElementById('print_total_member')?.innerText || '0';
            const valActiveMem = document.getElementById('print_active_member')?.innerText || '0';
            const valNewMem    = document.getElementById('print_new_member')?.innerText || '0';

            // Ambil filter range dari URL
            const urlP    = new URLSearchParams(window.location.search);
            const fMulai  = urlP.get('mulai') || '';
            const fSampai = urlP.get('sampai') || '';
            const fmtTgl  = d => d ? d.split('-').reverse().join('/') : '';
            const filterInfo = (fMulai && fSampai)
                ? `Periode: ${fmtTgl(fMulai)} s/d ${fmtTgl(fSampai)}`
                : '';

            // Ambil tabel
            const lbHTML  = document.getElementById('leaderboardTableBody')?.closest('table')?.outerHTML || '';
            const domHTML  = document.getElementById('dayOfMonthTableBody')?.closest('table')?.outerHTML || '';
            const now      = new Date().toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric', hour:'2-digit', minute:'2-digit' });

            const win = window.open('', '_blank', 'width=1100,height=800');
            if (!win) { alert('Popup diblokir. Izinkan popup dari halaman ini.'); return; }

            // Row 1: chart 0-2, Row 2: chart 3-5, Row 3: chart 6+
            const makeRow = (items) => items.map(c =>
                `<div class="cb"><div class="ct">${c.title}</div><img src="${c.src}">${c.legendHTML || ''}</div>`
            ).join('');

            let html = `<!DOCTYPE html><html lang="id"><head>
<meta charset="UTF-8"><title>Print Grafik Dashboard</title>
<style>
  @page { size: A4 landscape; margin:10mm 8mm; }
  body  { font-family:Arial,sans-serif; font-size:10pt; margin:0; padding:0; }
  h1    { text-align:center; font-size:14pt; margin:0 0 2px; }
  .sub  { text-align:center; font-size:8pt; color:#888; margin:0 0 8px; }
  hr    { border:none; border-top:1px solid #ccc; margin:6px 0 15px; }
  .row  { display:grid; grid-template-columns:repeat(3,1fr); gap:6px; margin-bottom:8px; page-break-inside:avoid; }
  .row2 { display:grid; grid-template-columns:repeat(2,1fr); gap:6px; margin-bottom:8px; page-break-inside:avoid; }
  .full { margin-bottom:8px; page-break-inside:avoid; }
  .cb   { border:1px solid #ddd; border-radius:3px; overflow:hidden; }
  .ct   { background:#3b82f6; color:#fff; font-size:8pt; font-weight:bold; padding:3px 6px; }
  .cb img { width:100%; display:block; max-height:180px; object-fit:contain; }
  table { width:100%; border-collapse:collapse; font-size:7pt; margin-top:4px; }
  th { background:#dbeafe; padding:3px 5px; border:1px solid #93c5fd; text-align:center; }
  td { padding:2px 5px; border:1px solid #e5e7eb; }
  h2 { font-size:10pt; margin:10px 0 4px; }

  /* Summary Cards CSS */
  .summary-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-bottom:15px; page-break-inside:avoid; }
  .sum-card { border:1px solid #ef4444; border-radius:6px; overflow:hidden; text-align:center; }
  .sum-head { background:#ef4444; color:#fff; font-size:9pt; font-weight:bold; padding:6px; text-transform:uppercase; }
  .sum-body { padding:15px 5px; background:#fff; }
  .sum-val  { color:#ef4444; font-size:16pt; font-weight:bold; margin-bottom:2px; }
  .sum-lbl  { color:#4b5563; font-size:8pt; }
</style>
</head><body>
<h1>Laporan Grafik Dashboard CBS</h1>
<p class="sub">Dicetak: ${now}${filterInfo ? ' &nbsp;|&nbsp; <span style="color:#ef4444;font-weight:bold;">' + filterInfo + '</span>' : ''}</p><hr>

<!-- TRANSACTION SUMMARY -->
<h2 style="margin:0 0 6px; font-size:10pt;">Transaction Summary</h2>
<div class="summary-grid">
  <div class="sum-card">
    <div class="sum-head">TRANSACTION</div>
    <div class="sum-body">
      <div class="sum-val">${valTrans}</div>
      <div class="sum-lbl">Transaksi</div>
    </div>
  </div>
  <div class="sum-card">
    <div class="sum-head">SALES</div>
    <div class="sum-body">
      <div class="sum-val">${valSales}</div>
      <div class="sum-lbl">Rupiah</div>
    </div>
  </div>
  <div class="sum-card">
    <div class="sum-head">VOLUME</div>
    <div class="sum-body">
      <div class="sum-val">${valVol}</div>
      <div class="sum-lbl">Liter</div>
    </div>
  </div>
</div>

<div class="row">${makeRow(chartImages.slice(0, 3))}</div>

<!-- MEMBER SUMMARY -->
<h2 style="margin:10px 0 4px; font-size:10pt;">Member Summary</h2>
<div class="summary-grid">
  <div class="sum-card">
    <div class="sum-head">TOTAL MEMBER</div>
    <div class="sum-body">
      <div class="sum-val">${valTotalMem}</div>
      <div class="sum-lbl">Member</div>
    </div>
  </div>
  <div class="sum-card">
    <div class="sum-head">ACTIVE MEMBER</div>
    <div class="sum-body">
      <div class="sum-val">${valActiveMem}</div>
      <div class="sum-lbl">Member</div>
    </div>
  </div>
  <div class="sum-card">
    <div class="sum-head">NEW MEMBER</div>
    <div class="sum-body">
      <div class="sum-val">${valNewMem}</div>
      <div class="sum-lbl">Member</div>
    </div>
  </div>
</div>

<div class="row">${makeRow(chartImages.slice(3, 6))}</div>`;

            // chart 6 (Redeem) full width
            if (chartImages[6]) {
                html += `<div class="full"><div class="cb">
  <div class="ct">${chartImages[6].title}</div>
  <img src="${chartImages[6].src}" style="max-height:200px;">
</div></div>`;
            }

            // chart 7 (Day of Month)
            if (chartImages[7]) {
                html += `<div class="full"><div class="cb">
  <div class="ct">${chartImages[7].title}</div>
  <img src="${chartImages[7].src}" style="max-height:220px;">
</div></div>`;
            }

            // Leader Board tabel dipindah ke paling bawah setelah Day of Month
            if (lbHTML)  html += `<h2>Leader Board</h2>${lbHTML}`;

            html += `<script>window.onload=function(){window.print();setTimeout(function(){window.close();},2500);};<\/script></body></html>`;

            win.document.write(html);
            win.document.close();
        }

        // === JALANKAN SAAT PAGE LOAD ===
        document.addEventListener('DOMContentLoaded', loadDashboard);
    </script>
</body>