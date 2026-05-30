
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Background</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 340px;

        }
        .card img {
            width: 100%;
            border-radius: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-upload {
            background: #2d9998;
            color: white;
        }
        .btn-close {
            background: #2d9998;
            color: white;
        }



    </style>
</head>
<body>
    <div class="card">
       
        
        <?php
$targetDir = "";
$originalFile = $targetDir . "back2.png";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $uploadFile = $_FILES["image"];
    $fileType = strtolower(pathinfo($uploadFile["name"], PATHINFO_EXTENSION));
    
    // Cek format gambar harus sama
    if ($fileType != "png") {
        echo "Hanya file PNG yang diperbolehkan.";
    } else {
        if (file_exists($originalFile)) {
            $backupFile = $targetDir . "backup/back2.png - backup (" . date("YmdHis") . ").png";
            rename($originalFile, $backupFile);
        }
        
        // Pindahkan file yang diunggah ke lokasi tujuan
        if (move_uploaded_file($uploadFile["tmp_name"], $originalFile)) {
            echo "<h2>Gambar berhasil diperbarui.</h2>";
        } else {
            echo "<h2>Gagal mengunggah gambar.</h2>";
        }
    }
}
else
{
    echo " <h2>Upload & Ganti Background</h2>";
}
?>



        <img src="back2.png?v=<?php echo date('Ymdhis');?>" alt="Background">
        <form action="upload_background.php" method="post" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <button type="submit" class="btn btn-upload">Upload & Ganti</button> <a href="../home/index.php" class="btn btn-close">Close</a>
        </form>
       
    </div>
</body>
</html>
