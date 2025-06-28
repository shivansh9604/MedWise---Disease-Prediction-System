<?php
session_start();
include "config.php"; // Ensure this connects to your database

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $query = "SELECT id FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        header("Location: index.php"); // Redirect to home page
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .form-control {
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .btn-custom {
            background: #2575fc;
            color: white;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #6a11cb;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
        .register-link {
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if ($error_message): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-custom">Login</button>
    </form>

    <a href="register.php" class="register-link">Don't have an account? Register</a>
</div>

</body>
</html>
