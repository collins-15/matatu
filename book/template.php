
<?php include('header.php') ?>
    <title>Bus Booking Invoice</title>
    <style>
          body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-container {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
        }
        .info-value {
            flex-basis: 60%;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }
    
    </style>
</head>
<body>
    <div class="container">
        <h1 class="logo mr-auto">SUPER METRO</h1>
        <h1 class="text-center">Bus Booking Invoice</h1>
        
        <div class="info-container">
            <div class="info-row">
                <div class="info-label">Ticket Number:</div>
                <div class="info-value">{{ ref_no }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Booked:</div>
                <div class="info-value">{{ bus_booked }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Registration Number:</div>
                <div class="info-value">{{ registration_number }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Driver's Name:</div>
                <div class="info-value">{{ driver_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Driver's Phone Number:</div>
                <div class="info-value">{{ driver_number }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Conductor's Name:</div>
                <div class="info-value">{{ conductor_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bus Conductor's Phone Number:</div>
                <div class="info-value">{{ conductor_number }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">From:</div>
                <div class="info-value">{{ from_location }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">To:</div>
                <div class="info-value">{{ to_location }}</div>
            </div>
        </div>
        
        <!-- Add other info rows here -->

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Passenger's Name</th>
                    <th>ID Number</th>
                    <th>Location Based</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Number of Seats</th>
                    <th>Price to Pay</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ first_name }} {{ last_name }}</td>
                    <td>{{ ID_number }}</td>
                    <td>{{ location }}</td>
                    <td>{{ phone_number }}</td>
                    <td>{{ email }}</td>
                    <td>{{ age }}</td>
                    <td>{{ seats }}</td>
                    <td>{{ total_price }}</td>
                    <td>{{ status }}</td>
                   
                </tr>
               
            </tbody>
        </table>
        
        <div class="footer">
           Have a safe journey.
        </div>
    </div>
</body>
</html>
