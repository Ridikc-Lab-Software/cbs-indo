<?php
include '../../../include/all_include.php';
mysql_query("delete from data_member_problem ");
?>
<script>
alert("Berhasil dikosongkan");
    window.location.href="index.php?input=member_problem";
</script>