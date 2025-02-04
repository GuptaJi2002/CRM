<?php
include "../includes/config.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lead_name = mysqli_real_escape_string($conn, $_POST['lead_name']);
    $lead_email = mysqli_real_escape_string($conn, $_POST['lead_email']);
    $lead_phone = mysqli_real_escape_string($conn, $_POST['lead_phone']);
    $lead_source = mysqli_real_escape_string($conn, $_POST['lead_source']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO leads (lead_name, lead_email, lead_phone, lead_source, status, created_at) 
              VALUES ('$lead_name', '$lead_email', '$lead_phone', '$lead_source', '$status', NOW())";

    if (mysqli_query($conn, $query)) {
        header("Location: leads.php");
        exit();
    } else {
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
<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">🚀 Add New Lead</h2>
        
        <?php if (!empty($error)) : ?>
            <div class="mb-4 text-red-600 text-center font-semibold bg-red-100 p-3 rounded">❌ <?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="add_leads.php" method="POST" class="space-y-4">
            <div>
                <label for="lead_name" class="block text-gray-700 font-medium">Lead Name</label>
                <input type="text" id="lead_name" name="lead_name" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-indigo-300" required>
            </div>
            <div>
                <label for="lead_email" class="block text-gray-700 font-medium">Lead Email</label>
                <input type="email" id="lead_email" name="lead_email" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-indigo-300" required>
            </div>
            <div>
                <label for="lead_phone" class="block text-gray-700 font-medium">Lead Phone</label>
                <input type="text" id="lead_phone" name="lead_phone" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-indigo-300" required>
            </div>
            <div>
                <label for="lead_source" class="block text-gray-700 font-medium">Lead Source</label>
                <input type="text" id="lead_source" name="lead_source" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-indigo-300" required>
            </div>
            <div>
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select id="status" name="status" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-indigo-300">
                    <option value="New">🆕 New</option>
                    <option value="Contacted">📞 Contacted</option>
                    <option value="Converted">✅ Converted</option>
                    <option value="Lost">❌ Lost</option>
                </select>
            </div>
            <div class="flex justify-between">
                <a href="leads.php" class="text-blue-500 hover:underline">⬅ Back to Lead List</a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded-lg shadow-lg">➕ Add Lead</button>
            </div>
        </form>
    </div>
</body>
</html>
