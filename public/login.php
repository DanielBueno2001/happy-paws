<?php
// Iniciar sesión (si es necesario)
session_start();

// Verificar si el usuario está autenticado
// Aquí deberías implementar tu lógica de verificación de sesión
// Por ejemplo:
/*
if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.php");
    exit();
}
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Happy Paws</title>
    <!-- Mismos estilos que las otras páginas -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Los mismos estilos CSS que en las otras páginas */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .video-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        /* Mantener los mismos estilos de header y footer */
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Mismo header que las otras páginas -->
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
        
        <!-- Contenido principal -->
        <main class="container flex-grow-1 py-4">
            <div class="video-container text-center">
                <h2><i class="fas fa-paw me-2"></i>Bienvenido a Happy Paws</h2>
                <p class="lead mb-4">Gracias por confiar en nosotros para el cuidado de tu mascota</p>
                
                <!-- Aquí puedes insertar tu video -->
                <div class="ratio ratio-16x9 mb-4">
                    <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="Video de Happy Paws" allowfullscreen></iframe>
                </div>
                
                <a href="index.php" class="btn btn-primary mt-3">
                    <i class="fas fa-home me-2"></i>Volver al inicio
                </a>
            </div>
        </main>
        
        <!-- Mismo footer que las otras páginas -->
        <footer class="footer_section mt-auto">
            <div class="container">
                <!-- Contenido del footer igual que en las otras páginas -->
            </div>
        </footer>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
