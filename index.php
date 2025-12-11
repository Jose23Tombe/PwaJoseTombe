<?php
// Puedes agregar aquí conexión a BD, sesiones, etc. si lo necesitas.
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soporte TI - Sistema de Tickets</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="manifest" href="manifest.json">
  <link rel="icon" href="icons/icon-192.png" type="image/png">
  <link rel="apple-touch-icon" href="icons/icon-512.png">
  <meta name="theme-color" content="#0d6efd">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="icons/icon-192.png" alt="Logo" width="40" height="40" class="me-2">
        <span>Centro de Soporte TI</span>
      </a>
    </div>
  </nav>

  <main class="flex-fill">
    <div class="container mt-4">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">Sistema de Registro de Tickets</h2>
        <p class="lead text-secondary mt-3">
          Bienvenido al portal de soporte técnico.  
          Aquí podrás registrar tus incidencias y reportar problemas de tu equipo o red.
        </p>
      </div>

      <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">

          <!-- 🔹 FORMULARIO ENVIADO A guardar_ticket.php -->
          <form action="guardar_ticket.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="nombre_usuario" class="form-label fw-semibold">👤 Nombre completo</label>
              <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                placeholder="Ej. Juan Calabazin" required>
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label fw-semibold">📧 Correo electrónico</label>
              <input type="email" class="form-control" id="correo" name="correo"
                placeholder="Ej. usuario@empresa.com" required>
            </div>

            <div class="mb-3">
              <label for="descripcion" class="form-label fw-semibold">🛠️ Descripción del problema</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                placeholder="Describe brevemente el problema" required></textarea>
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label fw-semibold">📸 Adjuntar imagen (opcional)</label>
              <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">
                📩 Enviar Ticket
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-primary text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 Departamento de Tecnología - Soporte TI</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('service-worker.js')
          .then(reg => console.log('✅ Service Worker registrado:', reg))
          .catch(err => console.error('❌ Error al registrar el Service Worker:', err));
      });
    }
  </script>

</body>
</html>


