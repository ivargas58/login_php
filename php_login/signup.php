<?php
    require 'db.php';
    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $sql = "INSERT INTO users (email, pass) VALUES (:email, :pass)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $stmt->bindParam(':pass', $password);

        if ($stmt->execute()) {
            $message = 'Successfully created new user';
        } else {
            $message = 'Sorry there must have been an issue creating your account';
        }
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
    <?php
     require 'partials/header.php' 
    ?>
    <?php if(!empty($message)):?>
    <p><?= $message ?></p>
    <?php endif;?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your email:">
        <input type="password" name="pass" placeholder="Enter your password:">
        <input type="password" name="confirm" placeholder="Enter your password to confirm">
        <input type="submit" value="send">
    </form>
</body>
</html>