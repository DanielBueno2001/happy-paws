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
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contrasena = $_POST['contrasena']; // Contraseña sin cifrar (como solicitaste)
    
    // Validar credenciales
    $sql = "SELECT id, nombre FROM usuarios WHERE correo = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Credenciales correctas
        $usuario = $result->fetch_assoc();
        
        // INICIAR SESIÓN - Aquí colocamos el código nuevo
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre']; // También guardamos el nombre para mostrarlo
        
        // Redirigir a video.php
        header("Location: video.php");
        exit();
    } else {
        $mensaje = "<div class='alert alert-danger'>Correo o contraseña incorrectos</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="veterinaria canina, login, cuidado perros, veterinario">
    <meta name="description" content="Inicio de sesión para clientes de veterinaria canina Happy Paws">
    <meta name="author" content="Veterinaria Canina Happy Paws">
    <title>Login | Veterinaria Canina Happy Paws</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e8cff;
            --secondary-color: #ff6b6b;
            --accent-color: #4ecdc4;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            background-image: url('https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(245, 245, 245, 0.9);
            min-height: 100vh;
        }
        
        .header_section {
            background-color: white !important;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            color: var(--dark-color) !important;
        }
        
        .navbar-brand img {
            transition: transform 0.3s;
        }
        
        .navbar-brand:hover img {
            transform: rotate(15deg);
        }
        
        .form-section {
            background-color: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 3rem auto;
            border: 1px solid rgba(0, 0, 0, 0.05);
            max-width: 600px;
        }
        
        .form-control {
            border: 1px solid #ddd;
            transition: all 0.3s;
            padding: 0.75rem 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 140, 255, 0.25);
        }
        
        .btn {
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border-radius: 50px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #3a7be0;
            border-color: #3a7be0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(78, 140, 255, 0.3);
        }
        
        .form-section h3 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .input-group-text {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }
        
        .form-title {
            position: relative;
            margin-bottom: 2rem;
        }
        
        .form-title:after {
            content: "";
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            margin: 0.5rem auto 0;
            border-radius: 2px;
        }
        
        .dog-paw {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }
        
        .dog-paw-1 {
            top: -20px;
            left: -20px;
            transform: rotate(-15deg);
            font-size: 5rem;
            color: var(--primary-color);
        }
        
        .dog-paw-2 {
            bottom: -30px;
            right: -20px;
            transform: rotate(25deg);
            font-size: 7rem;
            color: var(--accent-color);
        }
        
        .header-image {
            height: 250px;
            background-image: url('https://images.unsplash.com/photo-1583511655826-05700442b31b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 0 0 15px 15px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .header-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
        }
        
        .header-image-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            color: white;
        }
        
        .footer_section {
            background-color: var(--dark-color);
            padding: 2rem 0;
            color: white;
            margin-top: auto;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .header-image {
                height: 200px;
            }
            
            .form-section {
                padding: 1.5rem;
            }
        }
        
        /* Estilos para los alerts */
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.3);
            color: #28a745;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #dc3545;
        }
        
        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Header section -->
        <header class="header_section bg-light py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Logo Veterinaria" width="50" height="50" class="me-2">
                    <span class="fw-bold">Happy Paws</span>
                </a>
                <div class="d-none d-md-block">
                    <span class="me-3"><i class="fas fa-phone me-2"></i>(56)3185964245</span>
                    <span><i class="fas fa-map-marker-alt me-2"></i>Universidad Militar Nueva Granada</span>
                </div>
            </div>
        </header>
        
        <!-- Header image -->
        <div class="header-image">
            <div class="header-image-content">
                <h1 class="text-white fw-bold">Inicio de Sesión</h1>
                <p class="lead mb-0">Accede a tu cuenta para gestionar tus mascotas</p>
            </div>
        </div>
        
        <!-- Main content -->
        <main class="container flex-grow-1">
            <section class="form-section position-relative">
                <i class="fas fa-paw dog-paw dog-paw-1"></i>
                <i class="fas fa-paw dog-paw dog-paw-2"></i>
                
                <div class="form-title text-center">
                    <h2 class="fw-bold mb-2"><i class="fas fa-paw me-2"></i>Iniciar Sesión</h2>
                    <p class="lead">Ingresa tus credenciales para acceder a tu cuenta</p>
                </div>
                
                <?php if (!empty($mensaje)) echo $mensaje; ?>
                
                <form method="POST" action="" class="row g-4">
                    <!-- Correo electrónico -->
                    <div class="col-12">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="correo" name="correo" class="form-control shadow-sm rounded" placeholder="correo@ejemplo.com" required>
                        </div>
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="col-12">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="contrasena" name="contrasena" class="form-control shadow-sm rounded" placeholder="Contraseña" required>
                        </div>
                    </div>
                    
                    <!-- Botón de inicio de sesión -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </button>
                    </div>

                    <!-- Enlace de registro -->
                    <div class="col-12 register-link">
                        <p>¿Eres nuevo? <a href="index.php">Regístrate aquí</a></p>
                    </div>
                </form>
            </section>
        </main>

        <!-- Footer section -->
        <footer class="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5>Happy Paws</h5>
                        <p>La mejor atención veterinaria para tu mejor amigo desde 2015.</p>
                        <div class="social-icons">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5>Horario de Atención</h5>
                        <p>Lunes a Viernes: 8am - 8pm</p>
                        <p>Sábados: 9am - 6pm</p>
                        <p>Emergencias: 24/7</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Contacto</h5>
                        <p><i class="fas fa-phone me-2"></i>(57)3189564215</p>
                        <p><i class="fas fa-envelope me-2"></i>est.daniel.bueno@unimilitar.edu.co</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i>Universida Militar Nueva Granada</p>
                    </div>
                </div>
                <hr class="my-4 bg-light opacity-25">
                <div class="text-center">
                    <p class="mb-0">&copy; 2023 Happy Paws Veterinaria Canina. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
