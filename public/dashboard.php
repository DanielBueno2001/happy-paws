<?php
require '../includes/config.php';

// Redirigir si no está logueado
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <!-- Perfil del Usuario -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nombre'] . '+' . $user['apellido']) ?>&size=200" 
                         class="rounded-circle mb-3" width="120">
                    <h4><?= htmlspecialchars($user['nombre'] . ' ' . $user['apellido']) ?></h4>
                    <p class="text-muted">Miembro desde: <?= date('d/m/Y', strtotime('-1 month')) ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <!-- Contenido Principal -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Próximas Reservas</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        No tienes reservas activas. <a href="#" class="alert-link">¡Agenda ahora!</a>
                    </div>
                    
                    <!-- Historial -->
                    <h5 class="mt-4"><i class="fas fa-history me-2"></i>Historial</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Baño y grooming - 15/03/2024
                            <span class="badge bg-success rounded-pill">Completado</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
