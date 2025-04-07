<?php include '../includes/header.php'; ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="card card-form">
        <div class="card-body p-4">
          <h2 class="text-center mb-4">Iniciar Sesión</h2>
          
          <form action="../includes/auth.php" method="POST">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Correo" required>
            </div>
            
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>
            
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember">
              <label class="form-check-label" for="remember">Recordar sesión</label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
          </form>
          
          <div class="text-center mt-3">
            <a href="index.php" class="link-auth">¿No tienes cuenta? Regístrate</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include '../includes/footer.php'; ?>
