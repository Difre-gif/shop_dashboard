document.addEventListener('DOMContentLoaded', function() {
    // Initialize charts
    const ctxSalesTrends = document.getElementById('salesTrendsChart').getContext('2d');
    const ctxTopSellingProducts = document.getElementById('topSellingProductsChart').getContext('2d');
    const ctxStockStatus = document.getElementById('stockStatusChart').getContext('2d');
    const ctxPaymentStatus = document.getElementById('paymentStatusChart').getContext('2d');

    // Example data, replace with actual data from your server

    // Sales Trends Chart
    const salesTrendsChart = new Chart(ctxSalesTrends, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April'], // Replace with dynamic data
            datasets: [{
                label: 'Sales Trends',
                data: [1500, 2000, 1800, 2200], // Replace with dynamic data
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Top Selling Products Chart
    const topSellingProductsChart = new Chart(ctxTopSellingProducts, {
        type: 'bar',
        data: {
            labels: ['Product A', 'Product B', 'Product C'], // Replace with dynamic data
            datasets: [{
                label: 'Top Selling Products',
                data: [300, 250, 200], // Replace with dynamic data
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Stock Status Chart
    const stockStatusChart = new Chart(ctxStockStatus, {
        type: 'pie',
        data: {
            labels: ['In Stock', 'Low Stock', 'Out of Stock'], // Replace with dynamic data
            datasets: [{
                data: [60, 25, 15], // Replace with dynamic data
                backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
                borderColor: ['#fff', '#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Payment Status Chart
    const paymentStatusChart = new Chart(ctxPaymentStatus, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending'], // Replace with dynamic data
            datasets: [{
                data: [80, 20], // Replace with dynamic data
                backgroundColor: ['#4CAF50', '#FFC107'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Handle date filtering and table data
    document.getElementById('filter-btn').addEventListener('click', function() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;

        fetch(`get_sales_data.php?start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#sales-data-table tbody');
                tableBody.innerHTML = '';
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${row.date}</td>
                        <td>${row.product}</td>
                        <td>${row.quantity}</td>
                        <td>${row.total_amount}</td>
                        <td>${row.customer}</td>
                    `;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
});
