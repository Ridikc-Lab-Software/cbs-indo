
<?php
$read = simplexml_load_file("../../../include/settings/settings.xml");  
$exe = new SimpleXMLElement($read->asXML()); 
$rows = count($exe);
for($i=0;$i<$rows;$i++)
	 if($exe->users[$i]->id == '1'){
		$tmp =  ($exe->users[$i]->tmp);		 
	}
function location() { return "tabel"; }
function tabelnomin(){ echo "Backup Restore";};
include "../../../data/tmp/".$tmp."/index.php";
?>
