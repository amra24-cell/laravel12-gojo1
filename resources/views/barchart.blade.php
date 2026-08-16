<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Price Comparison Chart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Charts Library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Product Price Comparison</h1>
        <div id="product-bar-chart" style="width: 100%; height: 500px;"></div>
    </div>

    <script>
        // Load Google Charts
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });

        // Fetch data from Laravel API
        async function fetchProductData() {
            try {
                const response = await fetch(
                    "{{ url('api/product') }}"); // Replace with your Laravel API endpoint
                const products = await response.json();
                drawChart(products);
            } catch (error) {
                console.error("Error fetching product data:", error);
            }
        }

        // Draw the bar chart with fetched data
        function drawChart(products) {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Product Name');
            data.addColumn('number', 'Price');

            products.forEach(product => {
                // data.addRow([product.name, product.price]);
                data.addRow([product.name, parseFloat(product.price)]);
            });


            const options = {
                title: 'Product Price Comparison',
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Price',
                    minValue: 0
                },
                vAxis: {
                    title: 'Product'
                },
                bars: 'horizontal' // Horizontal bar chart
            };

            const chart = new google.visualization.BarChart(document.getElementById('product-bar-chart'));
            chart.draw(data, options);
        }

        // Initialize chart rendering
        google.charts.setOnLoadCallback(fetchProductData);
    </script>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>