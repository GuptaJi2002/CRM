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
    <style>
       
        .glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0px 8px 32px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass:hover {
            transform: translateY(-10px);
            box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.3);
        }

       
        .sidebar {
            width: 80px;
            transition: width 0.3s ease;
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar:hover h2 {
            opacity: 1;
        }

        .sidebar h2 {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.2);
        }

       
        .btn-hover {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-hover:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="text-gray-100 flex">

    <!-- Sidebar -->
    <aside class="sidebar h-screen bg-white bg-opacity-10 text-white fixed p-4 flex flex-col items-center">
        <h2 class="text-xl font-bold mb-6">CRM</h2>
        <nav class="space-y-6 w-full text-center">
            <a href="dashboard.php" class="flex items-center justify-center p-4 rounded-lg transition hover:bg-white hover:bg-opacity-20 btn-hover">
                <i class="fas fa-tachometer-alt"></i>
            </a>
            <a href="customers.php" class="flex items-center justify-center p-4 rounded-lg transition hover:bg-white hover:bg-opacity-20 btn-hover">
                <i class="fas fa-users"></i>
            </a>
            <a href="leads.php" class="flex items-center justify-center p-4 rounded-lg transition hover:bg-white hover:bg-opacity-20 btn-hover">
                <i class="fas fa-clipboard-list"></i>
            </a>
            <a href="reports.php" class="flex items-center justify-center p-4 rounded-lg transition hover:bg-white hover:bg-opacity-20 btn-hover">
                <i class="fas fa-chart-line"></i>
            </a>
            <a href="login.php" class="flex items-center justify-center p-4 rounded-lg transition hover:bg-white hover:bg-opacity-20 btn-hover">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-24 w-full p-8">
        <h1 class="text-4xl font-bold mb-6 text-center text-white">Dashboard Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Dashboard Overview -->
            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-xl font-semibold mb-4">Total Customers</h4>
                <h5 class="text-4xl font-bold text-blue-300"><?php echo $total_customers; ?></h5>
            </div>

            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-xl font-semibold mb-4">Total Sales</h4>
                <h5 class="text-4xl font-bold text-green-300"><?php echo $total_sales; ?></h5>
            </div>

            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-xl font-semibold mb-4">Total Leads</h4>
                <h5 class="text-4xl font-bold text-yellow-300"><?php echo $total_leads; ?></h5>
            </div>

            <!-- Leads Management -->
            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-lg font-semibold mb-2">Leads Management</h4>
                <p class="text-sm opacity-80">Track and manage leads here.</p>
                <a href="leads.php" class="text-blue-300 mt-2 inline-block btn-hover">View Leads</a>
            </div>

            <!-- Customer Management -->
            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-lg font-semibold mb-2">Customer Management</h4>
                <p class="text-sm opacity-80">Manage customer details.</p>
                <a href="customers.php" class="text-blue-300 mt-2 inline-block btn-hover">View Customers</a>
            </div>

            <!-- Reports & Analytics -->
            <div class="glass p-6 rounded-lg shadow-lg text-center card-hover">
                <h4 class="text-lg font-semibold mb-2">Reports & Analytics</h4>
                <p class="text-sm opacity-80">View sales, customers, and performance stats.</p>
                <a href="reports.php" class="text-blue-300 mt-2 inline-block btn-hover">View Reports</a>
            </div>
        </div>
    </main>

</body>
</html>