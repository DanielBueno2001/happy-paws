<?php
// Evitar acceso directo
defined('BASE_PATH') or die('Acceso denegado');

// Configuración RDS
define('DB_HOST', 'tu-endpoint.rds.amazonaws.com');
define('DB_USER', 'usuario-seguro');
define('DB_PASS', 'TuContraseña!2024');
define('DB_NAME', 'happy_paws_db');

// Iniciar sesión segura
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure'   => true,
    'cookie_httponly' => true
]);

// Conexión MySQLi con manejo de errores
try {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $mysqli->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log("Error de conexión: " . $e->getMessage());
    die("Error en el sistema. Por favor intente más tarde.");
}
?>
