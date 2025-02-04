<?php
include "../includes/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $query = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if (mysqli_query($conn, $query)) {
        header("Location: customers.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        input:focus {
            outline: none;
            border-color: #4C51BF;
            box-shadow: 0 0 10px rgba(76, 81, 191, 0.5);
        }

        .btn-hover:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body class="flex justify-center items-center h-screen">
    <div class="glass-card max-w-lg w-full">
        <h2 class="text-3xl font-extrabold text-white text-center mb-6">📝 Add New Customer</h2>

        <?php if (isset($error)) : ?>
            <div class="mb-4 text-red-400 text-center bg-white px-4 py-2 rounded-md"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="customers.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-lg font-semibold text-white">Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2" required>
            </div>
            <div>
                <label for="email" class="block text-lg font-semibold text-white">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2" required>
            </div>
            <div>
                <label for="phone" class="block text-lg font-semibold text-white">Phone</label>
                <input type="text" id="phone" name="phone" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn-hover bg-indigo-600 text-white px-6 py-3 rounded-full font-bold text-lg shadow-lg">
                    ➕ Add Customer
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="customers.php" class="text-white font-semibold hover:underline">⬅ Back to Customer List</a>
        </div>
    </div>
</body>
</html>
