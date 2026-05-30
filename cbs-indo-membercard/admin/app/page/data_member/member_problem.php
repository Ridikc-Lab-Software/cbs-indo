<h2>Warning!! Khusus Developer</h2>
<?php
$querytabel = "SELECT * FROM data_member_problem";
$proses = mysql_query($querytabel);
$no = 0;
while ($data = mysql_fetch_array($proses)) { 
    $no = $no+1;
     $id_member = $data['id_member'];
     $spbu = $data['spbu'];
    
    echo $no.". Proses Update : ";
    echo $query = "UPDATE data_member SET spbu='$spbu' WHERE id_member = '$id_member'";
    mysql_query($query);
    
    
    echo "<br>";
}
            ?>
            <a class="btn btn-danger" href="kosongkan.php">Kosongkan</a>
            <a class="btn btn-warning" href="../home/?import=x">Import</a>