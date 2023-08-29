<!DOCTYPE html>
<html>
<head>
   <?php include('header.php')?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

</head>
<body>
<canvas id="driverEarningsChart" style="width: 100%; height: 300px;"></canvas>
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
            // Create data arrays for the chart
            var driverNames = [];
            var earnings = [];

            for (var i = 0; i < data.length; i++) {
                driverNames.push(data[i].driver_name);
                earnings.push(data[i].total_earnings);
            }

            // Create the bar chart
            var ctx = document.getElementById('driverEarningsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: driverNames,
                    datasets: [{
                        label: 'Earnings',
                        data: earnings,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
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
