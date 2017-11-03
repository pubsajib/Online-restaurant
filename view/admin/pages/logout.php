<?php
include "../configuration.php";
$expire = time() - 60*60*24;
mysql_query("UPDATE admin SET session='$expire' WHERE email_id='$email_id'") or die(mysql_error());
$exit_session = md5($time);
setcookie('SESSION',"$exit_session",$expire);
header("Location: login.php?act=Logged_Out");
?>