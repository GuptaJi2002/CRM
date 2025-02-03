<?php
include "../includes/config.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Insert into the database
    $query = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if (mysqli_query($conn, $query)) {
        // Redirect to the customer list page after successful insert
        header("Location: customers.php");
        exit();
    } else {
        // Error message if the insert fails
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
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add New Customer</h2>

        <?php if (isset($error)) : ?>
            <div class="mb-4 text-red-600"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Add New Customer Form -->
        <form action="customers.php" method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Customer</button>
            </div>
        </form>

        <a href="customers.php" class="mt-4 inline-block text-blue-600">Back to Customer List</a>
    </div>
</body>
</html>
