<?php
// ==============================================
// 1. CONEXIÓN A LA BASE DE DATOS (RDS)
// ==============================================
require_once('../includes/config.php'); // Archivo con credenciales

$mensaje = "";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("<div class='alert alert-danger'>Error de conexión: " . $conn->connect_error . "</div>");
}

// ==============================================
// 2. PROCESAR FORMULARIO (POST)
// ==============================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y validar datos
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $edad = intval($_POST['edad']); // Convertir a entero
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    
    // Validaciones
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "<div class='alert alert-warning'>Correo no válido</div>";
    } elseif ($edad < 18 || $edad > 100) {
        $mensaje = "<div class='alert alert-warning'>Edad debe ser entre 18 y 100 años</div>";
    } else {
        // Encriptar contraseña
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        
        // Insertar con prepared statement
        $sql = "INSERT INTO usuarios (nombre, apellido, edad, correo, contrasena) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $nombre, $apellido, $edad, $correo, $contrasena);
        
        if ($stmt->execute()) {
            $mensaje = "<div class='alert alert-success'>¡Registro exitoso! Bienvenido/a, $nombre</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Happy Paws</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; }
        .form-container { background: white; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); padding: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4">Registro de Usuario</h2>
                <?php if (!empty($mensaje)) echo $mensaje; ?>
                
                <form method="POST" action="">
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required minlength="2">
                    </div>
                    
                    <!-- Apellido -->
                    <div class="mb-3">
                        <label class="form-label">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    
                    <!-- Edad -->
                    <div class="mb-3">
                        <label class="form-label">Edad:</label>
                        <input type="number" name="edad" class="form-control" min="18" max="100" required>
                    </div>
                    
                    <!-- Correo -->
                    <div class="mb-3">
                        <label class="form-label">Correo:</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input type="password" name="contrasena" class="form-control" required minlength="8">
                        <small class="text-muted">Mínimo 8 caracteres</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
