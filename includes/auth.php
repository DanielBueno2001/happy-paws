<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Consulta preparada con hash SHA-256
    $stmt = $mysqli->prepare("SELECT id, nombre, apellido FROM dueños WHERE correo = ? AND password = SHA2(?, 256)");
    $stmt->bind_param("ss", $email, $password);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Regenerar ID de sesión para prevenir fixation
            session_regenerate_id(true);
            
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'apellido' => $user['apellido'],
                'last_login' => time()
            ];
            
            header("Location: /dashboard.php");
            exit;
        }
    }
    
    // Fallo de autenticación
    header("Location: /login.php?error=1");
    exit;
}
?>
