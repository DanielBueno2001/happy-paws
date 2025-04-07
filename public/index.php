<?php
// ==============================================
// 1. CONEXIÓN A LA BASE DE DATOS (RDS)
// ==============================================
require_once('../includes/config.php'); // Archivo con credenciales

$mensaje = "";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("<div class='error-message'>Error de conexión: " . $conn->connect_error . "</div>");
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
        $mensaje = "<div class='alert error'>Correo no válido</div>";
    } elseif ($edad < 18 || $edad > 100) {
        $mensaje = "<div class='alert error'>Edad debe ser entre 18 y 100 años</div>";
    } else {
        // NO se encripta la contraseña (como solicitaste)
        $contrasena = $_POST['contrasena'];
        
        // Insertar con prepared statement
        $sql = "INSERT INTO usuarios (nombre, apellido, edad, correo, contrasena) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $nombre, $apellido, $edad, $correo, $contrasena);
        
        if ($stmt->execute()) {
            $mensaje = "<div class='alert success'>¡Registro exitoso! Bienvenido/a, $nombre</div>";
        } else {
            $mensaje = "<div class='alert error'>Error: " . $stmt->error . "</div>";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e60ff;
            --primary-light: #f3f4ff;
            --success: #57c279;
            --error: #fd6d6d;
            --text: #2b2b43;
            --text-light: #83859c;
            --background: #f8f9ff;
            --white: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: var(--background);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
        }
        
        .form-container {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .form-header {
            grid-column: span 2;
            text-align: center;
        }
        
        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-header p {
            color: var(--text-light);
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d9dbe1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }
        
        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn:hover {
            background-color: #3a4bff;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            grid-column: span 2;
        }
        
        .success {
            background-color: rgba(87, 194, 121, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 194, 121, 0.3);
        }
        
        .error {
            background-color: rgba(253, 109, 109, 0.1);
            color: var(--error);
            border: 1px solid rgba(253, 109, 109, 0.3);
        }
        
        .form-image {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-image img {
            max-width: 100%;
            height: auto;
        }
        
        .form-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
            
            .form-header, .alert {
                grid-column: span 1;
            }
            
            .form-image {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>Registro de Usuario</h2>
                <p>Únete a nuestra comunidad y disfruta de todos los beneficios</p>
                <?php if (!empty($mensaje)) echo $mensaje; ?>
            </div>
            
            <div class="form-image">
                <img src="https://cdn-icons-png.flaticon.com/512/4205/4205843.png" alt="Registro">
            </div>
            
            <div class="form-content">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required minlength="2">
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" id="edad" name="edad" class="form-control" min="18" max="100" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" id="correo" name="correo" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" class="form-control" required minlength="8">
                        <small style="color: var(--text-light); font-size: 12px;">Mínimo 8 caracteres</small>
                    </div>
                    
                    <button type="submit" class="btn">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
