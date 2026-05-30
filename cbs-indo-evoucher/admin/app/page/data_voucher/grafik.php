<?php
function buat_grafik_bulanan($judul, $label, $query, $dari, $sampai, $tabel, $kolom)
{

    $kode = rand(100000, 999999); // Use rand() for PHP 5.6
    $result = mysql_query($query);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }

    // Initialize the date range
    $startDate = new DateTime($dari);
    $endDate = new DateTime($sampai);
    $days = [];
    $transactions = [];

    // Fill the days array with each date in the range
    while ($startDate <= $endDate) {
        $day = $startDate->format('Y-m-d');
        $days[] = $day;
        $transactions[$day] = 0;
        $startDate->modify('+1 day');
    }

    // Fetch transaction data and populate the transactions array
    while ($row = mysql_fetch_assoc($result)) {
        $date = $row['date'];
        $transactions[$date] = (int) $row['jumlah'];
    }

    // Calculate the total transactions
    $totalTransactions = array_sum($transactions);

    // Convert PHP arrays to JSON
    $days_json = json_encode($days);
    $transactions_json = json_encode(array_values($transactions));

    ?>
    <div class="col-xl-<?php echo $kolom; ?>">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1"><?php echo $judul; ?></span>
                    <span class="text-muted fw-bold fs-7">Waktu: <?php echo format_indo($dari); ?> s/d
                        <?php echo format_indo($sampai); ?></span>
                </h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="grafik<?php echo $kode; ?>"></canvas>
                </div>

                <script type="text/javascript">
                    document.addEventListener('DOMContentLoaded', function () {
                        var days = <?php echo $days_json; ?>;
                        var transactions = <?php echo $transactions_json; ?>;
                        var ctx = document.getElementById('grafik<?php echo $kode; ?>').getContext('2d');

                        // Create the Chart.js chart
                        var transactionChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: days,
                                datasets: [{
                                    label: '<?php echo $label; ?>',
                                    data: transactions,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Tanggal'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: '<?php echo $label; ?>'
                                        }
                                    }
                                },
                                onClick: function (evt) {
                                    var activePoints = transactionChart.getElementsAtEventForMode(evt, 'nearest', {
                                        intersect: true
                                    }, true);

                                    if (activePoints.length > 0) {
                                        var firstPoint = activePoints[0];
                                        var label = transactionChart.data.labels[firstPoint.index];

                                        // Redirect to a URL based on the label (date)
                                        window.location.href = '../data_voucher/?input=penjualan&date=' + label;
                                    }
                                }
                            }
                        });
                    });
                </script>

                <?php if ($tabel) { ?>
                    <div class="table-responsive mt-5">
                        <table class="table table-striped" border="1">
                            <thead>
                                <tr style="background-color: #56c9c947;">
                                    <th style="padding: 10px;"><b>TANGGAL</b></th>
                                    <th><b><?php echo strtoupper($label); ?></b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($days as $day) {
                                    $amount = isset($transactions[$day]) ? $transactions[$day] : 0;
                                    // Only display rows where the amount is greater than 0
                                    if ($amount > 0) {
                                        echo '<tr>';
                                        echo '<td style="padding: 10px;">' . format_indo($day) . '</td>';
                                        echo '<td>' . $amount . ' Voucher</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr style="background-color: #56c9c947;">
                                    <td style="padding: 10px;"><strong>TOTAL</strong></td>
                                    <td><strong><?php echo $totalTransactions; ?> Voucher</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <?php
}
?>
<?php
function buat_grafik_bulanan_3_garis($judul, $query, $dari, $sampai)
{
    $kode = rand(100000, 999999);
    $result = mysql_query($query);

    // Initialize the date range
    $startDate = new DateTime($dari);
    $endDate = new DateTime($sampai);
    $days = [];
    $jenisTransaksiData = [];
    $totalPerDay = [];
    $totalPerJenisTransaksi = [];

    // Fill the days array with each date in the range
    while ($startDate <= $endDate) {
        $day = $startDate->format('Y-m-d');
        $days[] = $day;
        $totalPerDay[$day] = 0;
        $startDate->modify('+1 day');
    }

    // Fetch transaction data and populate the jenisTransaksiData array
    while ($row = mysql_fetch_assoc($result)) {
        $date = date('Y-m-d', strtotime($row['date']));
        $jenisTransaksi = $row['jenis_transaksi'];
        $amount = $row['jumlah'];

        if (!isset($jenisTransaksiData[$jenisTransaksi])) {
            $jenisTransaksiData[$jenisTransaksi] = array_fill_keys($days, 0);
        }

        if (isset($jenisTransaksiData[$jenisTransaksi][$date])) {
            $jenisTransaksiData[$jenisTransaksi][$date] += $amount;
        }

        if (isset($totalPerDay[$date])) {
            $totalPerDay[$date] += $amount;
        }
    }

    // Calculate totals per jenis_transaksi
    foreach ($jenisTransaksiData as $jenisTransaksi => $data) {
        $totalPerJenisTransaksi[$jenisTransaksi] = array_sum($data);
    }

    // Calculate overall total
    $overallTotal = array_sum($totalPerDay);

    // Convert PHP arrays to JSON
    $daysJson = json_encode($days);
    $datasets = [];

    foreach ($jenisTransaksiData as $jenisTransaksi => $data) {
        $datasets[] = [
            'label' => $jenisTransaksi,
            'data' => array_values($data),
            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'borderWidth' => 1,
            'fill' => false
        ];
    }

    $datasetsJson = json_encode($datasets);
    $totalPerDayJson = json_encode($totalPerDay);
    $totalPerJenisTransaksiJson = json_encode($totalPerJenisTransaksi);
    $overallTotalJson = json_encode($overallTotal);
    ?>

    <div class="col-xl-12">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1"><?php echo $judul; ?></span>
                    <span class="text-muted fw-bold fs-7">Waktu: <?php echo format_indo($dari); ?> s/d
                        <?php echo format_indo($sampai); ?></span>
                </h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 400px;">
                    <canvas id="grafik<?php echo $kode; ?>"></canvas>
                </div>

                <script type="text/javascript">
                    document.addEventListener('DOMContentLoaded', function () {
                        var days = <?php echo $daysJson; ?>;
                        var datasets = <?php echo $datasetsJson; ?>;
                        var ctx = document.getElementById('grafik<?php echo $kode; ?>').getContext('2d');

                        // Create the Chart.js chart
                        var transactionChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: days,
                                datasets: datasets
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Tanggal'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Jumlah'
                                        }
                                    }
                                },
                                onClick: function (evt) {
                                    var activePoints = transactionChart.getElementsAtEventForMode(evt, 'nearest', {
                                        intersect: true
                                    }, true);

                                    if (activePoints.length > 0) {
                                        var firstPoint = activePoints[0];
                                        var label = transactionChart.data.labels[firstPoint.index];

                                        // Redirect to a URL based on the label (date)
                                        window.location.href = '../data_voucher/?input=penjualan&date=' + label;
                                    }
                                }
                            }
                        });
                    });
                </script>

                <!-- Display the table with jenis_transaksi summary -->
                <div class="table-responsive mt-5">
                    <table class="table table-striped" border="1">
                        <thead>
                            <tr style="background-color: #56c9c947;">
                                <th style="padding: 10px;"><b>TANGGAL</b></th>
                                <?php
                                foreach ($jenisTransaksiData as $jenisTransaksi => $data) {
                                    echo '<th style="padding: 10px;"><b>' . htmlspecialchars($jenisTransaksi) . '</b></th>';
                                }
                                ?>
                                <th style="padding: 10px;"><b>TOTAL</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalPerDay = json_decode($totalPerDayJson, true);
                            $hasData = false;

                            foreach ($days as $day) {
                                // Check if there is any data for the current day
                                $rowHasData = false;
                                foreach ($jenisTransaksiData as $jenisTransaksi => $data) {
                                    if (isset($data[$day]) && $data[$day] > 0) {
                                        $rowHasData = true;
                                        break;
                                    }
                                }

                                // Also check if the total for the day is greater than zero
                                if (isset($totalPerDay[$day]) && $totalPerDay[$day] > 0) {
                                    $rowHasData = true;
                                }

                                // Display row only if there is data
                                if ($rowHasData) {
                                    $hasData = true;
                                    echo '<tr>';
                                    echo '<td style="padding: 10px;">' . format_indo($day) . '</td>';

                                    foreach ($jenisTransaksiData as $jenisTransaksi => $data) {
                                        echo '<td>' . (isset($data[$day]) ? $data[$day] : 0) . '</td>';
                                    }

                                    echo '<td>' . (isset($totalPerDay[$day]) ? $totalPerDay[$day] : 0) . '</td>';
                                    echo '</tr>';
                                }
                            }

                            // Display a message if no data is found
                            if (!$hasData) {
                                echo '<tr><td colspan="' . (count($jenisTransaksiData) + 2) . '" style="text-align: center;">No data available</td></tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #56c9c947;">
                                <td style="padding: 10px;"><strong>TOTAL</strong></td>
                                <?php
                                $totalPerJenisTransaksi = json_decode($totalPerJenisTransaksiJson, true);
                                foreach ($totalPerJenisTransaksi as $totalAmount) {
                                    echo '<td>' . $totalAmount . '</td>';
                                }
                                ?>
                                <td><strong><?php echo json_decode($overallTotalJson); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <?php
}
?>


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row g-5 g-xl-8">
            <?php


            // Generate dates for the current month
            $currentDate = new DateTime();
            $dari = $request_start_date->isValid() ? $request_start_date->getValue() : $currentDate->modify('first day of this month')->format('Y-m-d');
            $sampai = $request_end_date->isValid() ? $request_end_date->getValue() : $currentDate->modify('last day of this month')->format('Y-m-d');

            // Queries for the current month
            $query1 = "
    SELECT
        DATE(tanggal_penjualan) AS date,
        sum(jumlah_voucher) AS jumlah
    FROM
        data_penjualan_voucher
    WHERE
        tanggal_penjualan BETWEEN '$dari' AND '$sampai'
    GROUP BY
        DATE(tanggal_penjualan)
    ORDER BY
        date";

            $query2 = "
    SELECT
        DATE(tanggal_transaksi) AS date,
        COUNT(*) AS jumlah
    FROM
        data_transaksi_voucher
    WHERE
        tanggal_transaksi BETWEEN '$dari' AND '$sampai'
    GROUP BY
        DATE(tanggal_transaksi)
    ORDER BY
        date";


            $query3 = "
        SELECT
            DATE(t.tanggal_transaksi) AS date,
            j.jenis_transaksi,
            count(t.id_transaksi) AS jumlah
        FROM
            data_transaksi_voucher t
        JOIN
            data_jenis_transaksi j ON t.jenis_bbm = j.jenis_transaksi
        WHERE
            t.tanggal_transaksi BETWEEN '$dari' AND '$sampai'
        GROUP BY
            DATE(t.tanggal_transaksi), j.jenis_transaksi
        ORDER BY
            date, j.jenis_transaksi";

            // Generate graphs and tables
            buat_grafik_bulanan("Grafik Jumlah Penjualan", "Jumlah Penjualan", $query1, $dari, $sampai, true, 12);
            buat_grafik_bulanan("Grafik Jumlah Transaksi", "Jumlah Transaksi", $query2, $dari, $sampai, true, 12);
            buat_grafik_bulanan_3_garis("Grafik Jumlah Transaksi per Jenis BBM", $query3, $dari, $sampai);


            ?>
        </div>
    </div>
</div>
