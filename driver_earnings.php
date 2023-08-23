<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Earnings</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Driver Earnings</h1>
        <div id="earnings-container">
            <!-- Earnings will be displayed here -->
        </div>
    </div>

    <!-- Add Bootstrap JS scripts and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Make an AJAX request to fetch the driver's earnings
            $.ajax({
                url: 'earrning_driver.php', // Update with the actual PHP file name
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the HTML content with the earnings information
                    var earningsContainer = $('#earnings-container');
                    var earningsHtml = '<h2>Total Earnings for Driver ID ' + data.driver_id + ': ksh ' + data.total_earnings + '</h2>';
                    earningsContainer.html(earningsHtml);
                },
                error: function() {
                    // Handle error if the request fails
                    var earningsContainer = $('#earnings-container');
                    earningsContainer.html('<p>Error fetching earnings data.</p>');
                }
            });
        });
    </script>
</body>
</html>
