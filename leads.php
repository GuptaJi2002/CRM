<?php
include "../includes/config.php";

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all leads from the database
$query = "SELECT id, lead_name, lead_email, lead_phone, lead_source, status, created_at FROM leads ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lead Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Lead Management</h2>

        <!-- Button to Add New Lead -->
        <a href="add_leads.php" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded">Add New Lead</a>

        <!-- Display Leads -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Source</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Created At</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="border p-2"><?php echo $row['id']; ?></td>
                            <td class="border p-2"><?php echo htmlspecialchars($row['lead_name']); ?></td>
                            <td class="border p-2"><?php echo htmlspecialchars($row['lead_email']); ?></td>
                            <td class="border p-2"><?php echo htmlspecialchars($row['lead_phone']); ?></td>
                            <td class="border p-2"><?php echo htmlspecialchars($row['lead_source']); ?></td>
                            <td class="border p-2"><?php echo htmlspecialchars($row['status']); ?></td>
                            <td class="border p-2"><?php echo $row['created_at']; ?></td>
                            <td class="border p-2">
                                <a href="edit_lead.php?id=<?php echo $row['id']; ?>" class="text-blue-600">Edit</a> |
                                <a href="delete_lead.php?id=<?php echo $row['id']; ?>" class="text-red-600" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="border p-2 text-center text-gray-600">No leads found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
