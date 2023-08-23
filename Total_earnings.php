<!DOCTYPE html>
<html>
<head>
    <title>Driver Earnings</title>
    <!-- Include Bootstrap and other styles/scripts -->
</head>
<body>
<table id="driverEarningsTable" class="table">
    <thead>
        <tr>
            <th>Driver ID</th>
            <th>Driver Name</th>
            <th>Total Earnings</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
        <tr>
            <th colspan="2">Overall Total</th>
            <th id="overallTotal"></th>
        </tr>
    </tfoot>
</table>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    $.ajax({
        url: 'get_driver_earnings.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var data = response.data;
            var overallTotal = response.overall_total;
            
            var tableBody = $('#driverEarningsTable tbody');
            var overallTotalCell = $('#overallTotal');
            
            // Clear previous data
            tableBody.empty();
            
            // Populate the table with data
            for (var i = 0; i < data.length; i++) {
                var row = '<tr>' +
                            '<td>' + data[i].driver_id + '</td>' +
                            '<td>' + data[i].driver_name + '</td>' +
                            '<td>' + data[i].total_earnings + '</td>' +
                          '</tr>';
                tableBody.append(row);
            }
            
            // Display the overall total
            overallTotalCell.text(overallTotal);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

    </script>
</body>
</html>
