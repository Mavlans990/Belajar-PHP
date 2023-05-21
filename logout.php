<?php
session_start();

// Menonaktifkan Session
$_SESSION = [];
session_unset();
session_destroy();

// Menonaktifkan Cookie
setcookie('id', '', time() - 3600);
setcookie('user', '', time() - 3600);

header("Location: login.php");
