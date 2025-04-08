<?php
session_start();
require_once('../includes/config.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener información del usuario
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$nombre_usuario = $usuario['nombre'];
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="veterinaria canina, cuidado perros, video educativo">
    <meta name="description" content="Video educativo sobre el cuidado de perros - Happy Paws">
    <meta name="author" content="Veterinaria Canina Happy Paws">
    <title>Cuidado de Mascotas | Happy Paws</title>
    
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
        
        .content-section {
            background-color: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            border: 1px solid rgba(0, 0, 0, 0.05);
            max-width: 900px;
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
        
        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .welcome-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .video-container {
            margin: 2rem 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        
        .footer_section {
            background-color: var(--dark-color);
            padding: 2rem 0;
            color: white;
            margin-top: auto;
        }
        
        @media (max-width: 768px) {
            .content-section {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
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
        
        <!-- Main content -->
        <main class="container flex-grow-1 py-4">
            <section class="content-section position-relative">
                <i class="fas fa-paw dog-paw dog-paw-1"></i>
                <i class="fas fa-paw dog-paw dog-paw-2"></i>
                
                <div class="text-center mb-4">
                    <h2 class="fw-bold"><i class="fas fa-paw me-2"></i>Cómo cuidar a tu perro</h2>
                    <p class="lead">Aprende las mejores prácticas para el cuidado de tu mascota</p>
                </div>
                
                <div class="welcome-message">
                    <p>¡Bienvenido de nuevo, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>!</p>
                </div>
                
                <div class="section-title">
                    <h3><i class="fas fa-video me-2"></i>Video Educativo</h3>
                </div>
                
                <!-- Contenedor del video -->
                <div class="video-container">
                    <!-- Reemplaza "ruta/a/tu/video.mp4" con la ubicación real de tu video -->
                    <video controls width="100%" poster="https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80">
                        <source src="assets/videos/cuidado-perros.mp4" type="video/mp4">
                        Tu navegador no soporta el elemento de video.
                    </video>
                </div>
                
                <div class="action-buttons">
                    <!-- Botón para descargar el video -->
                    <a href="assets/videos/cuidado-perros.mp4" download="Cuidado-de-Perros-Happy-Paws.mp4" class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Descargar Video
                    </a>
                    
                    <!-- Botón para volver al inicio -->
                    <a href="index.php" class="btn btn-outline-primary">
                        <i class="fas fa-home me-2"></i>Volver al Inicio
                    </a>
                </div>
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
