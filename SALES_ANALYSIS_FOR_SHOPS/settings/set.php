<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="set.css">
</head>
<body>
    <header>
        <h1>Settings</h1>
        <button onclick="window.location.href='../home/home.php'">Back to Dashboard</button>
    </header>

    <main>
        <section class="settings-section">
            <h2>Account Settings</h2>
            <form id="accountForm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Save Changes</button>
            </form>
        </section>

        <section class="settings-section">
            <h2>Notification Preferences</h2>
            <form id="notificationsForm">
                <label>
                    <input type="checkbox" id="emailNotifications" name="emailNotifications">
                    Email Notifications
                </label>
                <label>
                    <input type="checkbox" id="smsNotifications" name="smsNotifications">
                    SMS Notifications
                </label>
                <button type="submit">Update Preferences</button>
            </form>
        </section>

        <section class="settings-section">
            <h2>Display Settings</h2>
            <form id="displayForm">
                <label for="theme">Theme:</label>
                <select id="theme" name="theme">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                </select>

                <label for="language">Language:</label>
                <select id="language" name="language">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                </select>

                <button type="submit">Apply Settings</button>
            </form>
        </section>
    </main>

    <footer>
        <p>© 2024 Shop Dashboard</p>
    </footer>

    <script src="settings-scripts.js"></script>
</body>
</html>
