<?php
session_start();
include "../includes/config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash password

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        $error = "Email already exists!";
    } else {
        // Insert user into the database
        $query = "INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$hashed_password', '$phone')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_email'] = $email;
            $_SESSION['user_phone'] = $phone;

            header("Location: ../dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Registration failed! Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Background gradient */
        body {
            background: linear-gradient(135deg,rgb(3, 5, 11), #764ba2);
        }

        /* Glassmorphic card */
        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Input field styles */
        .input-field {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transition: 0.3s;
        }

        .input-field::placeholder {
            color: rgb(0, 0, 0);
        }

        .input-field:focus {
            border-color:rgb(238, 228, 228);
            box-shadow: 0 0 10px rgba(148, 95, 95, 0.4);
        }

        /* Button style */
        .btn {
            width: 100%;
            background:rgb(19, 31, 24);
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }
        

        .btn:hover {
            background:rgb(215, 39, 39);
        }

        /* Error message */
        .error-message {
            color: #ff6961;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body class="flex justify-center items-center h-screen">

    <div class="card w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-white">Create an Account</h2>

        <?php if (isset($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="register.php" method="POST" class="mt-4">
            <div>
                <label class="block text-white">Full Name</label>
                <input type="text" name="name" required class="input-field" placeholder="Enter your name">
            </div>
            <div class="mt-4">
                <label class="block text-white">Email</label>
                <input type="email" name="email" required class="input-field" placeholder="Enter your email">
            </div>
            <div class="mt-4">
                <label class="block text-white">Password</label>
                <input type="password" name="password" required class="input-field" placeholder="Enter your password">
            </div>
            <div class="mt-4">
                <label class="block text-white">Phone</label>
                <input type="text" name="phone" required class="input-field" placeholder="Enter your phone number">
            </div>
            <button type="submit" class="btn mt-4">Register</button>
        </form>

        <p class="text-center text-white mt-4">Already have an account? <a href="login.php" class="text-blue-300 hover:text-blue-500">Login</a></p>
    </div>

</body>
</html>
