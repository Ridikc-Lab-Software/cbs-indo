<?php 
$name = $_GET['name'];
$email = $_GET['email'];
$subject = $_GET['subject'];
$nammessagee = $_GET['message'];

?>

<Script>
window.location = "mailto:<?php echo $email;?>?subject=<?php echo $subject;?>&body=<?php echo $nammessagee;?>";
</Script>
<?php


?>