<!DOCTYPE html>
<html>
<head>
   <?php include('header.php')?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

</head>
<body>  
<table id="driverEarningsTable" class="table">
    <thead>
        <tr>
            <th>Schedule ID</th>
            <th>Bus Name</th>
            <th>From Location </th>
            <th>To location</th>
            <th>Total Earnings</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
        <br>
        <tr>
            <th colspan="4">Overall Total</th>
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

            // Clear previous data
            tableBody.empty();

            // Populate the table with data
            for (var i = 0; i < data.length; i++) {
                var row = '<tr>' +
                          '<td>' + data[i].schedule_id + '</td>' +
                          '<td>' + data[i].driver_id + '</td>' +
                          '<td>' + data[i].from_location + '</td>' +
                          '<td>' + data[i].to_location + '</td>' +
                          '<td>' + data[i].total_earnings + '</td>' +
                          '</tr>';
                tableBody.append(row);
            }

            // Display the overall total
            overallTotalCell.text(overallTotal);

            // // Append the "Overall Total" row to the tbody
            // var overallRow = '<tr>' +
            //                  '<td colspan="2">Overall Total</td>' +
            //                 //  '<td>' + overallTotal + '</td>' +
            //                  '</tr>';
            // tableBody.append(overallRow);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});


    </script>
</body>
</html>
