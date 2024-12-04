<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige a la página de presentación
echo "<script>
        alert('Sesión cerrada exitosamente.');
        window.location.href = 'login.php';
      </script>";
?>
