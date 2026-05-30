<?php include '../../../include/all_include.php';

if (!isset($_POST['id_admin'])) {
	     ?>
	<script>
		alert("AKSES DITOLAK");
		location.href = "index.php";
	</script>
	<?php
	die();
}

$id_admin = xss($_POST['id_admin']);

$password_validasi = decrypt($_POST['password_validasi']);
$password_lama = MD5($_POST['password_lama']);
$password = ($_POST['password']);
if ($password_lama == "" or $password == "") {
	$password = decrypt($_POST['password_validasi']);
} else {
	if ($password_lama == $password_validasi) {
		$password = MD5($_POST['password']);
	} else {
	?>
		<script>
			alert("password Lama tidak sesuai, Gagal Mengganti password.");
			window.history.back();
		</script>
	<?php
		die();
	}
}

$query = mysql_query("update data_admin set 
password='$password'
where id_admin='$id_admin' ") or die(mysql_error());

if ($query) {
	?>
	<script>
		alert("Password Berhasil Diubah");
		location.href = "../home";
	</script>
<?php
} else {
	echo "GAGAL DIPROSES";
}
?>