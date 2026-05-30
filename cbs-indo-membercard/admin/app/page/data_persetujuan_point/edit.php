<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<form action="proses_update.php" enctype="multipart/form-data" method="post">
		<?php

		if (!isset($_GET['proses'])) {
			     ?>
			<script>
				alert("AKSES DITOLAK");
				location.href = "index.php";
			</script>
		<?php
			die();
		}
		$proses = decrypt(mysql_real_escape_string($_GET['proses']));
		$sql = mysql_query("SELECT * FROM data_persetujuan_point where id_persetujuan_point = '$proses'");
		$data = mysql_fetch_array($sql);

		$id_persetujuan_point = $data['id_persetujuan_point'];
		$jenis = $data['jenis'];
		?>
		<div class="row-fluid">
			<div class="span12">
				<div class="content-widgets gray">
					<div class="widget-head orange">
						<h3>Konfirmasi Update Point</h3>
					</div>
					<div class="col-md-12" style="display: flex">
						<div class="row" style="display:contents">
							<div class="col-md-6" style="display:-webkit-inline-box; width:50%">

								<div class="widget-container" style="padding:10px 20px 10px 20px">



									<div class="control-group" style="display:contents">

										<div class="controls">
											<div id="datetimepicker1" class="input-append date ">
												<tr>
													<label class="control-label" style="display:-webkit-box">Nama Member </label>

													<input type="%typepertama%" hidden name="id_member" value="<?php echo $data['id_member']; ?>" readonly id="id_member" required="required">

													<input readonly value="<?php echo baca_database('', 'nama', "select * from data_member where id_member='$idm'"); ?> " type="text">
												</tr>
											</div>
											<br>
											<div id="datetimepicker4" class="input-append">
												<label class="control-label" style="display:-webkit-box">Admin Pemohon </label>

												<input type="%typepertama%" hidden name="id_admin" value="<?php echo $idm = $data['id_admin']; ?>" readonly id="id_admin" required="required">

												<input readonly value="<?php echo baca_database('', 'username', "select * from data_admin where id_admin='$idm'"); ?> " type="text">

											</div>

											<br>
											<div id="datetimepicker4" class="input-append">
												<label class="control-label" style="display:-webkit-box">Tanggal Permintaan </label>

												<input type="datetime" name="tanggal_permintaan" value="<?php echo $data['tanggal_permintaan']; ?>" readonly id="id_persetujuan_point" required="required">

											</div>

										</div>

									</div>

								</div>
							</div>
							<div class="col-md-6" style="display: -webkit-inline-box; width:50%">
								<div class="widget-container" style="padding:10px 20px 10px 20px">



									<div class="control-group" style="display:contents">
										<?php
										if ($jenis == "edit poin") { ?>
											<div class="controls">
												<div id="datetimepicker1" class="input-append date ">
													<tr>
														<label class="control-label" style="display:-webkit-box">Point Awal </label>

														<input type="%typepertama%" hidden name="point_awal" id="point_awal" value="<?php echo $pa = $data['point_awal']; ?>" readonly id="id_member" required="required">

														<input readonly value="<?php echo $pa; ?> Point" type="text">
													</tr>
												</div>
												<br>
												<div id="datetimepicker4" class="input-append">
													<label class="control-label" style="display:-webkit-box">Point Update </label>
													<input readonly type="hidden" name="update_point" value="<?php echo $data['update_point']; ?>" readonly id="point_awal" required="required">

													<input readonly type="text" value="<?php echo $data['update_point']; ?> Point" readonly required="required">
												</div>
											</div>


										<?php } else { ?>
											<br>
											<h2>
												<?php echo $jenis; ?>
											</h2>

										<?php } ?>
										<Br>
										<Br>
										<a href="<?php index(); ?>/../proses_update.php?proses=<?php echo $proses; ?>&tipe=disetujui" type="submit" class="btn btn-inverse">Approve</a>

										<a href="<?php index(); ?>/../proses_update.php?proses=<?php echo $proses; ?>&tipe=ditolak" type="submit" class="btn btn-danger">Reject </a>

									</div>



								</div>






							</div>










						</div>
					</div>
				</div>
			</div>
		</div>


		<!--		 
<div class="content-box-content">
<div id="postcustom">	
<table <?php tabel_in(100, '%', 0, 'center');  ?>>	
	<tbody>
	
			  
				<input type="%typepertama%" hidden name="id_persetujuan_point" value="<?php echo $data['id_persetujuan_point']; ?>" readonly  id="id_persetujuan_point" required="required">		
			   
			 
			   
			   <input  type="datetime-local" name="tanggal_persetujuan" value="<?php echo $data['tanggal_persetujuan']; ?>" readonly  id="id_persetujuan_point" required="required">		
			   
				
				   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Id&nbsp;Member <font color="red">*</font></label>
			   </td>
				<td width="2%">:</td>
				<td>
				
				</td>
			   </tr>
				
				   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Id&nbsp;admin <font color="red">*</font></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="%typepertama%" name="id_admin" value="<?php echo $data['id_admin']; ?>" readonly  id="id_admin" required="required">		
				</td>
			   </tr>
				
				  <tr>
				<td width="25%" class="leftrowcms">					
				<label >Id&nbsp;Penyetuju <font color="red">*</font></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="%typepertama%" name="id_penyetuju" value="<?php echo $data['id_penyetuju']; ?>" readonly  id="id_penyetuju" required="required">		
				</td>
			   </tr>
			   
			
			    <tr>
				<td width="25%" class="leftrowcms">					
				<label >Point&nbsp;Awal <font color="red">*</font></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="%typepertama%" name="point_awal" value="<?php echo $data['point_awal']; ?>" readonly  id="point_awal" required="required">		
				</td>
			   </tr>
			   
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Point&nbsp;Update <span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input class='form-control'   required="required" type="text" name="update_point" id="update_point" placeholder="Point&nbsp;Update" value="<?php echo ($data['update_point']); ?>">

				</td>
			   </tr>
			   
			   
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Status <span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<select  class='form-control' data-live-search='true'   required="required" type="text" name="status" id="status" placeholder="Status" value="<?php echo ($data['status']); ?>">
<option value='<?php echo $data['status']; ?>'>- <?php echo $data['status']; ?> -</option><?php combo_enum('data_persetujuan_point', 'status', ''); ?>
</select>
				</td>
			   </tr>
			   
			   
			   
			   
	</tbody>
</table>
<div class="content-box-content">
<center>
<?php btn_update(' UPDATE'); ?>
</center>
</div>		
</div>
</div>
-->
	</form>
</div>