<?php  
session_start();
include "../includes/config.php";

$query = "SELECT COUNT(*) as total_customers FROM customers";
$result = $conn->query($query);
$total_customers = $result->fetch_assoc()['total_customers'];

$query = "SELECT COUNT(*) as total_leads FROM leads";
$result = $conn->query($query);
$total_leads = $result->fetch_assoc()['total_leads'];

$query = "SELECT COUNT(*) as total_sales FROM sales";
$result = $conn->query($query);
$total_sales = $result->fetch_assoc()['total_sales'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-900 flex">

    <aside class="w-64 bg-white shadow-lg min-h-screen p-5">
        <h2 class="text-2xl font-bold text-gray-800">CRM</h2>
        <nav class="mt-6 space-y-4">
            <a href="dashboard.php" class="block p-3 bg-blue-500 text-white rounded-lg text-center">Dashboard</a>
            <a href="customers.php" class="block p-3 bg-green-500 text-white rounded-lg text-center">Customers</a>
            <a href="leads.php" class="block p-3 bg-yellow-500 text-white rounded-lg text-center">Leads</a>
            <a href="reports.php" class="block p-3 bg-red-500 text-white rounded-lg text-center">Reports</a>
            <a href="login.php" class="block p-3 bg-gray-700 text-white rounded-lg text-center">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold">Total Customers</h4>
                <p class="text-3xl font-bold text-blue-500"> <?php echo $total_customers; ?> </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold">Total Sales</h4>
                <p class="text-3xl font-bold text-green-500"> <?php echo $total_sales; ?> </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold">Total Leads</h4>
                <p class="text-3xl font-bold text-yellow-500"> <?php echo $total_leads; ?> </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold">Leads Management</h4>
                <p class="text-sm text-gray-600">Track and manage leads.</p>
                <a href="leads.php" class="block text-blue-500 mt-2">View Leads</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold">Customer Management</h4>
                <p class="text-sm text-gray-600">Manage customer details.</p>
                <a href="customers.php" class="block text-green-500 mt-2">View Customers</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold">Reports & Analytics</h4>
                <p class="text-sm text-gray-600">View sales and performance stats.</p>
                <a href="reports.php" class="block text-red-500 mt-2">View Reports</a>
            </div>
        </div>
    </main>
</body>
</html>
