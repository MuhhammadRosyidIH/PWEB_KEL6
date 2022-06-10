<?php
// Mematikan SESSION
session_start();
session_unset();
session_destroy();
header("Location: data.php");
// header("Location: ../../../PWEB/");
exit;
?>