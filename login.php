<?php
session_start();
include "../includes/config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        
        header("Location: ../pages/users.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        
        .login-container h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }
        

        .input-field {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .input-field:focus {
            border-color: #667eea;
            box-shadow: 0px 4px 8px rgba(102, 126, 234, 0.2);
        }

    
        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            
        }

        .btn:hover {
            background: #764ba2;
        }

        .input-field {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 2px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
}


.input-field[name="password"] {
    margin-bottom: 15px;  
}


   
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .link {
            display: block;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #667eea;
            text-decoration: none;
            transition: 0.3s;
    
        }

        .link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

     
        .logout-link {
            display: block;
            margin-top: 10px;
            font-size: 0.9rem;
            color: red;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout-link:hover {
            text-decoration: underline;
            color: darkred;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>CRM Login</h2>

        <?php if (isset($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required class="input-field">
            <input type="password" name="password" placeholder="Enter your password" required class="input-field">
            <button type="submit" class="btn">Login</button>
        </form>

        <a href="register.php" class="link">Don't have an account? Register</a>
        <a href="login.php?logout=true" class="logout-link">Logout</a>
    </div>
</body>
</html>
