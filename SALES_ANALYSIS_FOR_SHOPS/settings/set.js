document.addEventListener('DOMContentLoaded', (event) => {
    // Handle form submissions
    document.getElementById('accountForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Account settings updated successfully.');
    });

    document.getElementById('notificationsForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Notification preferences updated successfully.');
    });

    document.getElementById('displayForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Display settings applied successfully.');
    });
});
