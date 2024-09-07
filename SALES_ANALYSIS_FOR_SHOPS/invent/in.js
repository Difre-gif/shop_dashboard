document.addEventListener('DOMContentLoaded', (event) => {
    // Get modal elements
    const modal = document.getElementById('productModal');
    const closeModal = document.querySelector('.close');
    const addProductBtn = document.getElementById('addProductBtn');
    
    // Show modal when "Add New Product" button is clicked
    addProductBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Close modal when the close button (x) is clicked
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Function to filter products based on the search input
    window.searchProducts = function() {
        let input = document.getElementById('searchBar').value.toLowerCase();
        let table = document.getElementById('inventoryTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let productName = cells[0].textContent.toLowerCase();
            if (productName.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    };

    // Function to filter products by category
    window.filterCategory = function() {
        let category = document.getElementById('categoryFilter').value;
        let table = document.getElementById('inventoryTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let productCategory = cells[1].textContent;
            if (category === '' || productCategory === category) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    };

    // Function to update stock after a purchase
    function updateStock(productId, quantity) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_stock.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Stock updated successfully');
                // Refresh the inventory table to reflect changes
                location.reload();
            } else {
                console.error('Error updating stock: ' + xhr.responseText);
            }
        };
        xhr.send('product_id=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(quantity));
    }

    // Example usage of updateStock (to be called after a purchase)
    // updateStock(1, 5); // Example: reduce stock of product with ID 1 by 5 units
});
