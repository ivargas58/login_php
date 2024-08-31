<!-- select_role.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Selecciona tu rol</title>
    <style>
        .role-selection-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .role-card {
            margin: 20px;
            text-align: center;
            cursor: pointer;
        }

        .role-card img {
            width: 200px;
            height: auto;
            transition: transform 0.2s;
        }

        .role-card:hover img {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="role-selection-container">
        <!-- Opción para Tutor -->
        <div class="role-card" onclick="selectRole('tutor')">
            <img src="imagen/tutor.png" alt="Tutor">
            <h3>Tutor</h3>
        </div>

        <!-- Opción para Estudiante -->
        <div class="role-card" onclick="selectRole('student')">
            <img src="imagen/estudiante.avif" alt="Estudiante">
            <h3>Estudiante</h3>
        </div>
    </div>

    <!-- Formulario oculto para redirigir al usuario con el rol seleccionado -->
    <form id="roleForm" method="POST" action="signup.php" style="display:none;">
        <input type="hidden" name="role" id="roleInput">
    </form>

    <script>
        function selectRole(role) {
            document.getElementById('roleInput').value = role;
            document.getElementById('roleForm').submit();
        }
    </script>
</body>
</html>
