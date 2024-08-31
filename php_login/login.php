<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /php_login');
    exit();
}
require 'db.php'; 

if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    $records = $conn->prepare('SELECT id, email, pass, role FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if ($results && password_verify($_POST['pass'], $results['pass'])) {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['role'] = $results['role']; // Guardar el rol en la sesión
        
        // Redirigir según el rol
        if ($results['role'] == 'tutor') {
            header("Location: /php_login/tutor_dashboard.php");
        } elseif ($results['role'] == 'student') {
            header("Location: /php_login/student_dashboard.php");
        } else {
            $message = 'Sorry, your role is not recognized';
        }
        exit(); 
    } else {
        $message = 'Sorry, those credentials do not match'; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'; ?>
    <h1>Login</h1>
    <span>or <a href="signup.php">Signup</a></span>

    <?php if (!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email:">
        <input type="password" name="pass" placeholder="Enter your password:">
        <input type="submit" value="Send">
    </form>
</body>
</html>
