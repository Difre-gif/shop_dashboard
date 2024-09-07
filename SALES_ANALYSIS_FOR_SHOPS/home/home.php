<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Dashboard</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <h1 class="brand">Shop Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="../Hhome/home.php">Home</a></li>
                    <li><a href="../add/add.php">Add Purchase</a></li>
                    <li><a href="../invent/in.php">Inventory</a></li>
                    <li><a href="../reports/rep.php">Reports</a></li>
                    <li><a href="../settings/set.php">Settings</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="dashboard">
            <div class="container">
                <h2>Welcome to your Shop Dashboard</h2>
                <div class="card-grid">
                    <!-- Add Purchase Card -->
                    <div class="card">
                        <div class="card-icon">
                            <img src="4379542.png" alt="Add Purchase">
                        </div>
                        <h3>Add Purchase</h3>
                        <p>Record a new purchase made by a customer.</p>
                        <a href="../add/add.php" class="btn">Add</a>
                    </div>

                    <!-- Inventory Card -->
                    <div class="card">
                        <div class="card-icon">
                            <img src="10469240.png" alt="Inventory">
                        </div>
                        <h3>Inventory</h3>
                        <p>Manage your shop's inventory and stock levels.</p>
                        <a href="../invent/in.php" class="btn">Manage</a>
                    </div>

                    <!-- Reports Card -->
                    <div class="card">
                        <div class="card-icon">
                            <img src="images.png" alt="Reports">
                        </div>
                        <h3>Reports</h3>
                        <p>View detailed sales and purchase reports.</p>
                        <a href="../reports/rep.php" class="btn">View</a>
                    </div>

                    <!-- Settings Card -->
                    <div class="card">
                        <div class="card-icon">
                            <img src="images (1).png" alt="Settings">
                        </div>
                        <h3>Settings</h3>
                        <p>Adjust your shop preferences and user settings.</p>
                        <a href="../settings/set.php" class="btn">Adjust</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
