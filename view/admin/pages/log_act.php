<?php
require("../configuration.php");
$user = htmlspecialchars($_REQUEST['email']);
$pass = htmlspecialchars($_REQUEST['password']);

$session = md5($pass.$time);

if (!empty($user) && !empty($pass)) {
$check = mysql_fetch_array(mysql_query("SELECT COUNT(email_id) c FROM admin WHERE email_id='$user' AND password='$pass'")) or die(mysql_error());
if ((bool)$check['c']) {
	mysql_query("UPDATE admin SET session='$session', user_agent='$ua', ip_address='$ip', last_time='$time' WHERE email_id='$user'");
setcookie("SESSION","$session",time() + 24*3600);
header("Location: index.php");
}
else {
header("Location: login.php?response=error");
}}
else {
header("Location: login.php?response=error");
}
?>