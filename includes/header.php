<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= ($current_page == 'index.php') ? 'Registro | Happy Paws' : 
           (($current_page == 'login.php') ? 'Login | Happy Paws' : 'Dashboard | Happy Paws') ?>
    </title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar Dinámico -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-paw me-2"></i>Happy Paws
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/includes/logout.php"><i class="fas fa-sign-out-alt me-1"></i> Salir</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?= ($current_page == 'index.php') ? 'active' : '' ?>">
                            <a class="nav-link" href="/index.php"><i class="fas fa-user-plus me-1"></i> Registro</a>
                        </li>
                        <li class="nav-item <?= ($current_page == 'login.php') ? 'active' : '' ?>">
                            <a class="nav-link" href="/login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1">
