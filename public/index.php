<?php include '../includes/header.php'; ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card card-form">
        <div class="card-body p-5">
          <h2 class="text-center mb-4">Registro de Dueño</h2>
          
          <form action="procesar_registro.php" method="POST" class="needs-validation" novalidate>
            <!-- Campos del formulario -->
            <div class="mb-3">
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>
            
            <!-- Más campos aquí... -->
            
            <button type="submit" class="btn btn-primary w-100 py-2 mt-3">
              Registrarse
            </button>
          </form>
          
          <div class="text-center mt-3">
            <a href="login.php" class="link-auth">¿Ya tienes cuenta? Inicia sesión</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include '../includes/footer.php'; ?>
