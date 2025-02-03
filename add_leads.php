<?php
include "../includes/config.php";

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize error variable
$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lead_name = mysqli_real_escape_string($conn, $_POST['lead_name']);
    $lead_email = mysqli_real_escape_string($conn, $_POST['lead_email']);
    $lead_phone = mysqli_real_escape_string($conn, $_POST['lead_phone']);
    $lead_source = mysqli_real_escape_string($conn, $_POST['lead_source']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Insert into the database with current timestamp
    $query = "INSERT INTO leads (lead_name, lead_email, lead_phone, lead_source, status, created_at) 
              VALUES ('$lead_name', '$lead_email', '$lead_phone', '$lead_source', '$status', NOW())";

    if (mysqli_query($conn, $query)) {
        // Redirect to leads.php after successful insert to prevent duplicate submissions
        header("Location: leads.php");
        exit();
    } else {
        // Capture error message
        $error = "Error inserting data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Lead</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add New Lead</h2>

        <?php if (!empty($error)) : ?>
            <div class="mb-4 text-red-600"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Add New Lead Form -->
        <form action="add_leads.php" method="POST" class="space-y-4">
            <div>
                <label for="lead_name" class="block text-sm font-medium text-gray-700">Lead Name</label>
                <input type="text" id="lead_name" name="lead_name" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="lead_email" class="block text-sm font-medium text-gray-700">Lead Email</label>
                <input type="email" id="lead_email" name="lead_email" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="lead_phone" class="block text-sm font-medium text-gray-700">Lead Phone</label>
                <input type="text" id="lead_phone" name="lead_phone" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="lead_source" class="block text-sm font-medium text-gray-700">Lead Source</label>
                <input type="text" id="lead_source" name="lead_source" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 p-2 w-full border border-gray-300 rounded">
                    <option value="New">New</option>
                    <option value="Contacted">Contacted</option>
                    <option value="Converted">Converted</option>
                    <option value="Lost">Lost</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Lead</button>
            </div>
        </form>

        <a href="leads.php" class="mt-4 inline-block text-blue-600">Back to Lead List</a>
    </div>
</body>
</html>
