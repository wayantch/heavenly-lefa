<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location: /heavenly-store/login.php");
exit;

?>