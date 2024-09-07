<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Report</title>
    <link rel="stylesheet" href="rep.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Shop Report</h1>
        <nav>
            <a href="../home/home.php">Home</a>
            <a href="../settings/settings.php">Settings</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section class="summary">
            <div class="summary-item">
                <h2>Total Sales</h2>
                <p id="total-sales">$0.00</p>
            </div>
            <div class="summary-item">
                <h2>Total Purchases</h2>
                <p id="total-purchases">0</p>
            </div>
            <div class="summary-item">
                <h2>Total Revenue</h2>
                <p id="total-revenue">$0.00</p>
            </div>
        </section>

        <section class="charts">
            <div class="chart-container">
                <h2>Sales Trends</h2>
                <canvas id="salesTrendsChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Top Selling Products</h2>
                <canvas id="topSellingProductsChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Stock Status</h2>
                <canvas id="stockStatusChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Payment Status Distribution</h2>
                <canvas id="paymentStatusChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Revenue by Category</h2>
                <canvas id="revenueByCategoryChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Customer Demographics</h2>
                <canvas id="customerDemographicsChart"></canvas>
            </div>
        </section>

        <section class="data-table">
            <h2>Detailed Sales Data</h2>
            <div class="filters">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" value="<?php echo htmlspecialchars($start_date); ?>">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" value="<?php echo htmlspecialchars($end_date); ?>">
                <button id="filter-btn">Apply Filters</button>
            </div>
            <table id="sales-data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Customer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales_data as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['product']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>Contact us: support@shop.com</p>
    </footer>

    <script src="report.js"></script>
</body>
</html>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle date filtering
$start_date = $_GET['start_date'] ?? '1970-01-01';
$end_date = $_GET['end_date'] ?? date('Y-m-d');

// Fetch sales data
$sales_data = [];
$sql = "SELECT date, product_name AS product, quantity, total_amount, customer_name AS customer 
        FROM sales 
        WHERE date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $sales_data[] = $row;
}

$stmt->close();
$conn->close();
?>
