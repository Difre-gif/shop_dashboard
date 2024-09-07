<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Purchase</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <header>
        <h1>Add New Purchase</h1>
        <button onclick="window.location.href='../home/home.php'">Back to Dashboard</button>
    </header>

    <div class="form-container">
        <form action="" method="POST">
            <!-- Customer Information -->
            <div class="form-group">
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer-name" placeholder="Enter customer name" required>
            </div>

            <div class="form-group">
                <label for="customer-phone">Customer Phone</label>
                <input type="tel" id="customer-phone" name="customer-phone" placeholder="Enter customer phone" required>
            </div>

            <!-- Product Information -->
            <div class="form-group">
                <label for="product-name">Product Name</label>
                <select id="product-name" name="product-name" required>
                    <option value="" disabled selected>Select a product</option>
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

                    // Fetch products
                    $sql = "SELECT product_id, product_name FROM products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row["product_id"]) . "'>" . htmlspecialchars($row["product_name"]) . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="1" required>
            </div>

            <div class="form-group">
                <label for="payment-status">Payment Status</label>
                <select id="payment-status" name="payment-status" required>
                    <option value="" disabled selected>Select payment status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn-submit">Add Purchase</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $customer_name = $_POST['customer-name'];
        $customer_phone = $_POST['customer-phone'];
        $product_id = $_POST['product-name'];
        $quantity = $_POST['quantity'];
        $payment_status = $_POST['payment-status'];

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

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Insert purchase details
            $stmt = $conn->prepare("INSERT INTO purchases (customer_name, customer_phone, product_id, quantity, payment_status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiss", $customer_name, $customer_phone, $product_id, $quantity, $payment_status);
            $stmt->execute();
            $stmt->close();

            // Update product stock
            $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ?");
            $stmt->bind_param("ii", $quantity, $product_id);
            $stmt->execute();
            $stmt->close();

            // Commit transaction
            $conn->commit();
            echo "<p class='success'>Purchase added successfully</p>";
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
