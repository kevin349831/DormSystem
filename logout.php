<?php
session_start();
//將session清空
unset($_SESSION['username']);
header("Location: index.html")
?>

