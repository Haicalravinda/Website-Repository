<?php
session_start();

// Hancurkan sesi pengguna
session_unset();
session_destroy();

// Arahkan pengguna ke halaman index.php
header("Location: login.php");
exit();
?>
