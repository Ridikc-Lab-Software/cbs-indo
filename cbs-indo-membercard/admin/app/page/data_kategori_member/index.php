<?php
$dir = "../../../";
$xmlPath = $dir . "include/settings/settings.xml";
$xml = simplexml_load_file($xmlPath);
$tmp = (string) $xml->users->tmp;
function location()
{
	return "tabel";
}

function tabelnomin()
{
	echo "Data kategori member";
}

include $dir . "data/tmp/" . $tmp . "/index.php";
