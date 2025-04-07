<?php
require 'config.php';

// Destruir sesión completamente
$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

header("Location: /login.php?logout=1");
exit;
?>
