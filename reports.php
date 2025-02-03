<?php
session_start();
include "../includes/config.php";


$salesQuery = "SELECT COUNT(*) AS total_sales FROM sales";
$salesResult = $conn->query($salesQuery);
$total_sales = $salesResult->fetch_assoc()['total_sales'];


$customersQuery = "SELECT COUNT(*) AS total_customers FROM customers";
$customersResult = $conn->query($customersQuery);
$total_customers = $customersResult->fetch_assoc()['total_customers'];


$leadsQuery = "SELECT COUNT(*) AS total_leads FROM leads";
$leadsResult = $conn->query($leadsQuery);
$total_leads = $leadsResult->fetch_assoc()['total_leads'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex">


    <aside class="w-64 h-screen bg-blue-600 text-white flex flex-col p-6 fixed">
        <h2 class="text-2xl font-bold mb-6">CRM Dashboard</h2>
        <nav>
            <ul class="space-y-4">
                <li><a href="dashboard.php" class="text-lg">Dashboard</a></li>
                <li><a href="reports.php" class="text-lg font-bold">Reports & Analytics</a></li>
                
            </ul>
        </nav>
    </aside>

    
    <main class="ml-64 w-full p-6">
        <h1 class="text-3xl font-bold mb-6">Reports & Analytics</h1>

        <div class="grid grid-cols-3 gap-6">
        
            <div class="bg-white shadow-md rounded-lg p-6">
                <h4 class="text-lg font-semibold mb-2">Total Sales</h4>
                <p class="text-2xl font-bold text-green-600"><?php echo $total_sales; ?></p>
            </div>

            
            <div class="bg-white shadow-md rounded-lg p-6">
                <h4 class="text-lg font-semibold mb-2">Total Customers</h4>
                <p class="text-2xl font-bold text-blue-600"><?php echo $total_customers; ?></p>
            </div>

    
            <div class="bg-white shadow-md rounded-lg p-6">
                <h4 class="text-lg font-semibold mb-2">Total Leads</h4>
                <p class="text-2xl font-bold text-yellow-600"><?php echo $total_leads; ?></p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h4 class="text-lg font-semibold mb-4">Sales Overview</h4>
            <canvas id="salesChart"></canvas>
        </div>
    </main>

    <script>
        var ctx = document.getElementById("salesChart").getContext("2d");
        var salesChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                datasets: [{
                    label: "Sales",
                    data: [10, 20, 15, 25, 30],
                    backgroundColor: "rgba(54, 162, 235, 0.6)"
                }]
            }
        });
    </script>
</body>
</html>
