<?php

$xml = simplexml_load_file("../../../include/settings/settings.xml"); 
$sxe = new SimpleXMLElement($xml->asXML()); 
$rows = count($sxe);
for($i=0;$i<$rows;$i++)
	 if($sxe->users[$i]->id == '1'){
		$tmp =  ($sxe->users[$i]->tmp);		 
	}
	
function tabelnomin(){ echo "Data Produk";};
include "../../../data/tmp/$tmp/index.php";
?>
