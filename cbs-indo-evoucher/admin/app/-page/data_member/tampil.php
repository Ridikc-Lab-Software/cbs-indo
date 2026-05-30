


    <form name="formcari" id="formcari" action="" method="get">
        <fieldset> 
            <table>
                <tbody>
                    <tr>
                        <td>Berdasarkan</td>	
                        <td>:</td>	
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > --> 
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
                                <?php
                                $sql = "desc data_member";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {
                                    echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                }
                                ?>
                            </select>							
                        </td>
                    </tr>

                    <tr>
                        <td>Pencarian</td>	
                        <td>:</td>	
                        <td>							
                                <!--<input class="form-control" type="text" name="isi" value="" >--> <input  type="text" name="isi" value="" >
                            <?php btn_cari('Cari'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>									
        </fieldset>
    </form>

    <div style="overflow-x:auto;">
        <table <?php tabel(100, '%', 1, 'left'); ?> >
            <tr>								  
              
                <th>No</th>
                <!--h <th>Id Member </th> h-->
                <th align="center" class="th_border cell"  >Nik </th>
                <th align="center" class="th_border cell"  >Nama </th>
                <th align="center" class="th_border cell"  >Alamat </th>
                <th align="center" class="th_border cell"  >No Telepon </th>
                <th align="center" class="th_border cell"  >Jenis Kelamin </th>
                <th align="center" class="th_border cell"  >Tanggal Terdaftar </th>
                <th align="center" class="th_border cell"  >Kategori Member </th>
                <th align="center" class="th_border cell"  >Kode Rfid </th>
                <th align="center" class="th_border cell"  >Point </th>
                <th align="center" class="th_border cell"  >Username </th>
                <th align="center" class="th_border cell"  >Password </th>
                <th align="center" class="th_border cell"  >Tanggal Lahir </th>
                <th align="center" class="th_border cell"  >Agama </th>
                <th align="center" class="th_border cell"  >Status Perkawinan </th>
                <th align="center" class="th_border cell"  >Pekerjaan </th>
                <th align="center" class="th_border cell"  >Admin Daftar </th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_member where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_member where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_member  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_member";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                    ?>
                    <tr class="event2">	
                        
                      
                        
                        <td align="center" width="50"><?php $no = (($no + 1) ); echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_member']; ?></td> h-->
                        <td align="center"><?php echo $data['nik']; ?></td>
                        <td align="center"><?php echo $data['nama']; ?></td>
                        <td align="center"><?php echo $data['alamat']; ?></td>
                        <td align="center"><?php echo $data['no_telepon']; ?></td>
                        <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
                        <td align="center"><?php echo format_indo($data['tanggal_terdaftar']); ?></td>
                        <td align="center"><?php echo baca_database("","kategori_member","select * from data_kategori_member where id_kategori_member='$data[id_kategori_member]'")  ?></td>
                        <td align="center"><?php echo $data['kode_rfid']; ?></td>
                        <td align="center"><?php echo $data['point']; ?></td>
                        <td align="center"><?php echo $data['username']; ?></td>
                        <td align="center"><?php echo $data['password']; ?></td>
                        <td align="center"><?php echo format_indo($data['tanggal_lahir']); ?></td>
                        <td align="center"><?php echo $data['agama']; ?></td>
                        <td align="center"><?php echo $data['status_perkawinan']; ?></td>
                        <td align="center"><?php echo $data['pekerjaan']; ?></td>
                        <td align="center"><?php echo baca_database("","hak_akses","select * from data_admin where id_admin='$data[id_admin]'")  ?></td>

                    
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

   <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>
