<?php
include "../includes/config.php";

$query = "SELECT id, name, email, phone, created_at FROM customers ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Customer List</h2>

        <!-- Back to Add Customer -->
        <a href="add_customers.php" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Add New Customer</a>

        <!-- Display Customers -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Created At</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td class="border p-2"><?php echo $row['id']; ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td class="border p-2"><?php echo $row['created_at']; ?></td>
                        <td class="border p-2">
                            <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="text-blue-600">Edit</a> |
                            <a href="delete_customer.php?id=<?php echo $row['id']; ?>" class="text-red-600" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
