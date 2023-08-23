<?php include('header.php') ?>


<title>Check Booking Details</title>
<style>
   
span {
    text-transform: uppercase;
}

</style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Check Booking Details</h3>
                <form id="checkBookingForm">
                    <div class="form-group">
                        <label for="refNumber">Enter Reference Number:</label>
                        <input type="text" class="form-control" id="refNumber" name="refNumber" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Booking</button>
                </form>
                <div id="bookingDetails" class="mt-4" style="display: none;">
    <div class="row">
        <div class="col-md-12 text-center"> <!-- Center-aligned heading -->
            <h3>Booking Details:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Ticket Number:</strong> <span id="ref_no"></span></p>
            <p><strong>Bus Booked:</strong> <span id="bus_booked"></span></p>
            <p><strong>Bus Registration Number:</strong> <span id="registration_number"></span></p>
            <p><strong>Bus Driver's Name:</strong> <span id="driver_name"></span></p>
            <p><strong>Bus Driver's Phone Number:</strong> <span id="driver_number"></span></p>
            <p><strong>Bus Conductor's Name:</strong> <span id="conductor_name"></span></p>
            <p><strong>Bus Conductor's Phone Number:</strong> <span id="conductor_number"></span></p>
            <p><strong>From:</strong> <span id="from_location"></span></p>
            <p><strong>To:</strong> <span id="to_location"></span></p>
        </div>
        <div class="col-md-6">
            <p><strong>First Name:</strong> <span id="first_name"></span></p>
            <p><strong>Last Name:</strong> <span id="last_name"></span></p>
            <p><strong>ID Number:</strong> <span id="ID_number"></span></p>
            <p><strong>Location Based:</strong> <span id="location"></span></p>
            <p><strong>Phone Number:</strong> <span id="phone_number"></span></p>
            <p><strong>Email:</strong> <span id="email"></span></p>
            <p><strong>Age:</strong> <span id="age"></span></p>
            <p><strong>Number of Seats:</strong> <span id="seats"></span></p>
            <p><strong>Price to Pay:</strong> <span id="totalPrice"></span></p>
            <p><strong>Status:</strong> <span id="status"></span></p>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <!-- Add the "Pay" button -->
            <button id="payButton" class="btn btn-success btn-block">Pay</button>
        </div>
       

    </div>
    <div class="row justify-content-center mt-3">
    <div class="col-md-6">
    <!-- Add the "download" button -->
    <button id="generatePDF" class="btn btn-success btn-block" style="display: none;">DOWNLOAD YOUR TICKET</button>
</div>
</div>
</div>


                <!-- The modal markup -->
                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                    aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="paymentForm">
                                    <h5>LIPA NA M-PESA:</h5>
                                    <!-- Your payment form goes here -->
                                    <form id="paymentDetailsForm">
                                        <div class="form-group">
                                            <label for="phone_number">Phone number:</label>
                                            <input type="text" class="form-control" id="phone_number"
                                                name="phone_number" required>
                                        </div>
                                        <!-- Display the fixed price -->
                                        <p><strong>Amount:</strong> KSH<span id="fixedPrice"></span></p>

                                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add a loading message or spinner -->
                <div id="loadingMessage" style="display: none;">Loading...</div>
                <!-- Add an error message container -->
                <div id="errorMessage" style="display: none;"></div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#checkBookingForm').submit(function (e) {
            e.preventDefault();
            var refNumber = $('#refNumber').val();

            // Show loading message or spinner while waiting for the AJAX response
            $('#loadingMessage').show();

            // Clear any previous error messages
            $('#errorMessage').text('').hide();

            $.ajax({
                url: 'book/load_book.php',
                method: 'POST',
                data: { refNumber: refNumber },
                dataType: 'json',
                success: function (data) {
                    // Hide loading message or spinner after successful AJAX response
                    $('#loadingMessage').hide();

                    if (data && Object.keys(data).length > 0) {
                        // Update the HTML with the fetched booking details
                        $('#ref_no').text(data.ref_no);
                        $('#bus_booked').text(data.bus_booked);
                        $('#bookingName').text(data.name);
                        $('#seats').text(data.seats);
                        // $('#priceToPay').text(data.price);
                        $('#from_location').text(data.from_location);
                        $('#to_location').text(data.to_location);
                        $('#totalPrice').text(data.total_price);
                        $('#first_name').text(data.first_name);
                        $('#last_name').text(data.last_name);
                        $('#ID_number').text(data.ID_number);
                        $('#location').text(data.location);
                        $('#phone_number').text(data.phone_number);
                        $('#email').text(data.email);
                        $('#age').text(data.age);
                        $('#registration_number').text(data.registration_number);
                        $('#driver_name').text(data.driver_name);
                        $('#driver_number').text(data.driver_number);
                        $('#conductor_name').text(data.conductor_name);
                        $('#conductor_number').text(data.conductor_number);
                        

                        // Update the status display based on the 'status' value
                        if (parseInt(data.status) === 1) {
                            $('#status').text('Paid');
                            // Hide the 'Pay' button if the status is 'paid' (1)
                            $('#payButton').hide();
                        } else {
                            $('#status').text('Not Paid');
                            // Show the 'Pay' button if the status is not 'paid' (0)
                            $('#payButton').show();
                        }

                        // Show the booking details section
                        $('#bookingDetails').show();
                    } else {
                        // Display an error message if the reference number is not found
                        $('#errorMessage').text('Booking not found. Please check the reference number.').show();
                        // Hide the booking details section
                        $('#bookingDetails').hide();
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors, if any, in the AJAX request
                    console.log(xhr.responseText);
                    $('#errorMessage').text('An error occurred while fetching booking details.').show();
                    // Hide the booking details section
                    $('#bookingDetails').hide();
                    // Hide loading message or spinner in case of an error
                    $('#loadingMessage').hide();
                }
            });

            // Handle the "Pay" button click
            $('#payButton').click(function () {
                // Get the fixed price from the fetched booking details
                var fixedPrice = parseFloat($('#totalPrice').text());
                // Update the fixed price in the payment form
                $('#fixedPrice').text(fixedPrice.toFixed(2)); // Display fixed price with two decimal places

                // Show the modal with the payment form
                $('#paymentModal').modal('show');
            });
        });

        // Handle form submission for payment
        $('#paymentDetailsForm').submit(function (e) {
            e.preventDefault();

            // Get the credit card number and other payment details here
            var phone_number = $('#phone_number').val();
            // Get other payment-related input values as needed

            // Process the payment here (you can use AJAX to send payment details to the server)

            // For demonstration purposes, show a success message (remove this in your actual implementation)
            alert('Payment successful!');
            // Show the "Download" button after successful payment
            $('#generatePDF').show();

           // Add event listener for the "Download" button click
          // Add event listener for the "Download" button click
$('#generatePDF').click(function () {
    var refNumber = $('#refNumber').val(); // Get the reference number from the input field

    // Make an AJAX request to generate the PDF
    $.ajax({
        url: 'book/generate_pdf.php?ref_no=' + refNumber, // Pass the reference number as a parameter
        method: 'GET',
        success: function () {
            // Once the AJAX request is successful, trigger the download
            window.location.href = 'book/generate_pdf.php?ref_no=' + refNumber; // Update the filename if needed
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});

            // You can also hide the payment form after successful payment

            $('#paymentForm').hide();

            // Now update the payment status to 1 (success) via AJAX
            var refNumber = $('#refNumber').val();
            var paymentDetails = {
                refNumber: refNumber,
                paymentStatus: 1
            };

            $.ajax({
                url: 'book/update_payment.php',
                method: 'POST',
                data: paymentDetails,
                dataType: 'json',
                success: function (data) {
                    // Handle the server response if needed
                    console.log(data);

                    // After updating the payment status, you can refresh the booking details to reflect the changes
                    // You can trigger the form submission again or update the booking details section directly
                    // For example, you can call the form submission again after a short delay:
                    setTimeout(function() {
                        $('#checkBookingForm').submit();
                    }, 1000); // 1 second delay before resubmitting the form (adjust as needed)
                },
                error: function (xhr, status, error) {
                    // Handle errors, if any, in the AJAX request
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
