<?php
include "../../../include/all_include.php";

$id = decrypt($_GET['id']);
$q = mysql_query("SELECT * FROM data_petugas WHERE id_petugas='$id'");
$data = mysql_fetch_array($q);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print ID Card</title>

    <style>
        @page {
            size: 53.98mm 85.6mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f2f2f2;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .print-panel {
            text-align: center;
            margin: 10px;
            font-size: 13px;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .card {
            width: 53.98mm;
            height: 85.6mm;
            background: #ffffff;
            border-radius: 0px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.25);
            box-sizing: border-box;
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, #0d6efd, #084298);
            color: #fff;
            padding: 6mm 4mm;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }

        .content {
            padding: 6mm 4mm;
            text-align: center;
        }

        .qr img {
            width: 28mm;
            height: 28mm;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 2mm;
        }

        .nama {
            margin-top: 5mm;
            font-size: 12px;
            font-weight: 600;
            color: #222;
        }

        .spbu {
            font-size: 10px;
            color: #555;
            margin-top: 1mm;
        }

        .id {
            margin-top: 4mm;
            font-size: 9px;
            color: #777;
        }

        @media print {
            body {
                background: none;
            }
            .print-panel {
                display: none;
            }
            .wrapper {
                padding: 0;
            }
            .card {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

<!-- PANEL KONTROL -->
<div class="print-panel">

    <button onclick="window.print()">🖨 Print</button>
    <br><br>

    <label>
        Judul:
        <input type="text" id="judulText" value="PETUGAS SPBU" onkeyup="updateJudul()" style="width:160px">
    </label>
    <br><br>

    <label><input type="checkbox" checked onchange="toggleEl('judul')"> Tampilkan Judul</label> |
    <label><input type="checkbox" checked onchange="toggleEl('nama')"> Nama</label> |
    <label><input type="checkbox" checked onchange="toggleEl('spbu')"> SPBU</label> |
    <label><input type="checkbox" checked onchange="toggleEl('idpetugas')"> ID</label>

</div>

<!-- CARD -->
<div class="wrapper">
    <div class="card">

        <div class="header judul" id="judulCard">
            PETUGAS SPBU
        </div>

        <div class="content">

            <div class="qr">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= urlencode($data['id_petugas']); ?>">
            </div>

            <div class="nama nama">
                <?= $data['nama']; ?>
            </div>

            <div class="spbu spbu">
                SPBU <?= $data['nama_spbu']; ?>
            </div>

            <div class="id idpetugas">
                ID: <?= str_replace("PET","",$data['id_petugas']); ?>
            </div>

        </div>
    </div>
</div>

<script>
function toggleEl(className){
    document.querySelectorAll('.'+className).forEach(el=>{
        el.style.display = el.style.display === 'none' ? '' : 'none';
    });
}

function updateJudul(){
    document.getElementById('judulCard').innerText =
        document.getElementById('judulText').value;
}
</script>

</body>
</html>