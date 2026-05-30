<?php
session_start();

define("PASSWORD", "cbs-indo"); // Password tanpa enkripsi
define("MAIL_FILE", '../../../include/share_transaksi/mail.php');

// Cek login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === PASSWORD) {
        $_SESSION['authenticated'] = true;
    } else {
        $error = "Password salah!";
    }
}

// Simpan perubahan jika sudah login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code']) && isset($_SESSION['authenticated'])) {
    file_put_contents(MAIL_FILE, $_POST['code']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['authenticated'])) {
?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Masukkan Password</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                text-align: center;
                padding: 50px;
            }

            .card {
                background: white;
                padding: 20px;
                border-radius: 8px;
                display: inline-block;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            input {
                padding: 10px;
                margin: 10px;
                width: 80%;
            }

            button {
                background: #2d9998;
                color: white;
                padding: 10px 15px;
                border: none;
                cursor: pointer;
            }

            button:hover {
                background: #217878;
            }
        </style>
    </head>

    <body>
        <div class="card">
            <h2>Masukkan Password</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Masukkan password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>

    </html>
<?php
    exit;
}

// Jika login berhasil, baca konten email
$mail_content = file_get_contents(MAIL_FILE);
$mail_content = preg_replace('/<img src=["\'](.*?)["\']/', '<img src="$1" onerror="this.onerror=null;this.src=\'default.png\';"', $mail_content);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodePen-Like Editor</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.14/ace.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            height: 80vh;
            padding: 20px;
            gap: 20px;
        }

        .card {
            flex: 1;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background: #2d9998;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 1.2rem;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .editor {
            height: 100%;
        }

        .preview iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .btn-save {
            font-size: medium;
            padding: 10px 15px;
            background-color: #2d9998;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-save:hover {
            background-color: #217878;
        }
    </style>
</head>

<body>
    <form method="POST">
        <div class="container">
            <div class="card">
                <div class="card-header">Editor Kode</div>
                <div class="card-body">
                    <div class="editor" id="editor"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Pratinjau</div>
                <div class="card-body preview">
                    <iframe id="preview"></iframe>
                </div>
            </div>
        </div>
        <center>
            <a onclick="window.location.href='index.php'" class="btn-save">Close</a>
            <button type="submit" class="btn-save">Simpan Desain </button>
        </center>
        <input type="hidden" name="code" id="code">
    </form>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/html");
        editor.setValue(`<?php echo addslashes($mail_content); ?>`, -1);

        function updatePreview() {
            var previewFrame = document.getElementById("preview").contentWindow.document;
            previewFrame.open();
            previewFrame.write(editor.getValue());
            previewFrame.close();
        }
        editor.session.on('change', updatePreview);
        updatePreview();
        document.querySelector("form").addEventListener("submit", function() {
            document.getElementById("code").value = editor.getValue();
        });
    </script>
</body>

</html>