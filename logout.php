<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('zxclementxuan', '', time() -3600);
setcookie('gregorithxclement', '', time() -3600);

header("Location: auth.php");
exit;
?>