<?php
ob_start();

if (isset($_POST["login"])) {

	$username = mysql_real_escape_string($_POST['username']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	$r = mysql_query("SELECT * FROM data_member WHERE username='$username' AND password='$password'");
	$data = mysql_fetch_array($r);

	// Default pesan gagal
	$modal_class = "modal-danger";
	$redirect_url = "index.php?p=login";

	if (empty($username) && empty($password)) {
		$modal_title = "Gagal!";
		$modal_message = "Username dan Password tidak boleh kosong.";
	} else if (empty($username)) {
		$modal_title = "Gagal!";
		$modal_message = "Username tidak boleh kosong.";
	} else if (empty($password)) {
		$modal_title = "Gagal!";
		$modal_message = "Password tidak boleh kosong.";
	} else if (mysql_num_rows($r) == 1) {
		// Login sukses
		$kodene = encrypt($data['id_member']);
		setcookie('kodene', $kodene, time() + (6000 * 6000), '/');

		$ip = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$token = sha1($ip . $useragent . $key);
		$token = crypt($token, $key);
		setcookie('token_user', $token, time() + (6000 * 6000), '/');

		$modal_title = "Berhasil!";
		$modal_message = "Login berhasil, selamat datang " . htmlspecialchars($data['nama']);
		$modal_class = "modal-success";
		$redirect_url = "index.php?p=profil";
	} else {
		$modal_title = "Gagal!";
		$modal_message = "Username atau Password salah.";
	}

	// Tampilkan modal Bootstrap
?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content <?php echo $modal_class; ?>">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo $modal_title; ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php echo $modal_message; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="modalOkBtn">OK</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		var myModal = new bootstrap.Modal(document.getElementById('messageModal'), {});
		myModal.show();

		document.getElementById('modalOkBtn').addEventListener('click', function() {
			myModal.hide();
			window.location.href = '<?php echo $redirect_url; ?>';
		});
	</script>
<?php
}

// Logout
if (isset($_GET['action']) && $_GET['action'] == "logout") {

?>
	<script>
		window.location.href = 'index.php?p=login';
	</script>

<?php
}
?>