<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="in.css">
</head>
<body>
    <header>
        <h1>Shop Inventory</h1>
        <div class="header-buttons">
            <button id="addProductBtn">Add New Product</button>
            <button onclick="window.location.href='../HOME/home.php'">Back to Dashboard</button>
        </div>
    </header>

    <div class="search-filter-container">
        <input type="text" id="searchBar" placeholder="Search products..." onkeyup="searchProducts()">
        <select id="categoryFilter" onchange="filterCategory()">
            <option value="">All Categories</option>
            <option value="Electronics">Electronics</option>
            <option value="Groceries">Groceries</option>
            <option value="Clothing">Clothing</option>
        </select>
    </div>

    <table id="inventoryTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Enable error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop_inventory";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if form data is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_name = $_POST['productName'];
                $category = $_POST['productCategory'];
                $stock = $_POST['productStock'];
                $price = $_POST['productPrice'];

                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO products (product_name, category, stock, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssii", $product_name, $category, $stock, $price);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<p>New product added successfully</p>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }

                // Close statement
                $stmt->close();
            }

            // Fetch and display products
            $sql = "SELECT product_name, category, stock, price FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["category"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["stock"]) . "</td>";
                    echo "<td>$" . htmlspecialchars($row["price"]) . "</td>";
                    echo "<td>
                            <button class='edit-btn'>Edit</button>
                            <button class='delete-btn'>Delete</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Modal for Adding New Product -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Product</h2>
            <form id="addProductForm" action="" method="POST">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productCategory">Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="Electronics">Electronics</option>
                    <option value="Groceries">Groceries</option>
                    <option value="Clothing">Clothing</option>
                </select>

                <label for="productStock">Stock:</label>
                <input type="number" id="productStock" name="productStock" required>

                <label for="productPrice">Price:</label>
                <input type="number" step="0.01" id="productPrice" name="productPrice" required>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <script src="in.js"></script>
</body>
</html>
