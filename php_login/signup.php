<?php
    require 'db.php';
    $message = '';

    // Verifica si se ha seleccionado un rol
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['role'])) {
        $role = $_POST['role'];  // Captura el rol del usuario

        // Asegúrate de que el rol sea válido
        if ($role === 'tutor' || $role === 'student') {
            // Procesamiento del formulario de registro
            if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['confirm'])) {
                if ($_POST['pass'] === $_POST['confirm']) { // Verifica que las contraseñas coincidan
                    $sql = "INSERT INTO users (email, pass, role) VALUES (:email, :pass, :role)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':email', $_POST['email']);
                    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                    $stmt->bindParam(':pass', $password);
                    $stmt->bindParam(':role', $role);

                    if ($stmt->execute()) {
                        $message = 'Successfully created new user';
                    } else {
                        $message = 'Sorry there must have been an issue creating your account';
                    }
                } else {
                    $message = 'Passwords do not match.';
                }
            }
        } else {
            $message = 'Invalid role selected.';
        }
    } else {
        header("Location: select_role.php"); // Redirige si no hay rol seleccionado
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'; ?>

    <?php if (!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp as <?= htmlspecialchars($role) ?></h1>
    <span>or <a href="login.php">Login</a></span>
    
    <form action="signup.php" method="post">
        <input type="hidden" name="role" value="<?= htmlspecialchars($role) ?>">
        <input type="text" name="email" placeholder="Enter your email:" required>
        <input type="password" name="pass" placeholder="Enter your password:" required>
        <input type="password" name="confirm" placeholder="Enter your password to confirm:" required>
        <input type="submit" value="Send">
    </form>
</body>
</html>
