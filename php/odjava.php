<?php
session_start();

setcookie('username', $_SESSION['userename'], time()-7*60);

session_destroy();

header("Location: index.php");


?>