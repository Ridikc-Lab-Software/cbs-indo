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
        sum(jumlah_voucher) as jumlah
    FROM
        data_penjualan_voucher
    WHERE
        tanggal_penjualan BETWEEN '$dari' AND '$sampai'
    GROUP BY
        DATE(tanggal_penjualan)
    ORDER BY
        date";




            // Generate graphs and tables
            buat_grafik_bulanan("Grafik Jumlah Penjualan", "Jumlah Penjualan", $query1, $dari, $sampai, true, 12);


            ?>
        </div>
    </div>
</div>
