<?php
	if(!empty($halaman)){
		echo "ini home";
	}
	else
	{
		if(!empty($_GET['input'])){
				$input = mysql_real_escape_string($_GET['input']);
		
				if ($input=='tampil')
				{
					//TAMPIL
					include 'tampil.php'; 
				}
				
				else
				{
					//LAINNYA
					echo "";
				}
		}
		else
		{
			//TAMPIL
			include 'tampil.php';
		}
	}
	?>