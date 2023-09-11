<?php
session_start();
include('../db_connect.php');
include('../assets/css/admin_options.php');
include('../assets/css/admin.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
	// Fetch the schedule data including 'bus_seats' column
	$qry = $conn->query("SELECT sl.*, b.bus_seats FROM schedule_list sl
                        JOIN bus b ON sl.bus_id = b.id
                        WHERE sl.id = " . $_GET['id'])->fetch_array();

	if ($qry) {
		$meta = $qry; // Assign the fetched data to the $meta array

		// Calculate the total number of booked seats for the given schedule
        $countResult = $conn->query("SELECT COUNT(*) AS total_booked_seats FROM booked WHERE schedule_id = " . $meta['id'])->fetch_array();
        $count = $countResult['total_booked_seats'];

        // Calculate remaining space dynamically
        $remainingSpace = $meta['bus_seats'] - $count;


		// Fetch additional data
		$bus = $conn->query("SELECT * FROM bus WHERE id = " . $meta['bus_id'])->fetch_array();
		$from_location = $conn->query("SELECT id, city AS location FROM location WHERE id =" . $meta['from_location'])->fetch_array();
		$to_location = $conn->query("SELECT id, city AS location FROM location WHERE id = " . $meta['to_location'])->fetch_array();
	} else {
		echo "Failed to fetch schedule data.";
		exit;
	}
}
$bookedSeatsQuery = $conn->query("SELECT booked_seat FROM booked WHERE schedule_id = " . $meta['id']);
$bookedSeats = [];

if ($bookedSeatsQuery) {
    while ($row = $bookedSeatsQuery->fetch_assoc()) {
        $bookedSeats[] = $row['booked_seat'];
    }
}

// Encode the booked seat numbers as JSON
$bookedSeatsJSON = json_encode($bookedSeats);


if (isset($_SESSION['login_id']) && isset($_GET['bid'])) {
	$booked = $conn->query("SELECT * FROM booked where id=" . $_GET['bid'])->fetch_array();
	foreach ($booked as $k => $val) {
		$bmeta[$k] = $val;
	}
}
?>



<div class="container-fluid">
<form id="manage_book" >
    <div class="row">
        <div class="col-md-6">
            <p><b>Bus:</b>
                <?php echo $bus['bus_number'] . ' | ' . $bus['name'] ?>
            </p>
            <p><b>From:</b>
                <?php echo $from_location['location'] ?>
            </p>
            <p><b>To:</b>
                <?php echo $to_location['location'] ?>
            </p>
            <p><b>Departure Time</b>:
                <?php echo date('M d, Y h:i A', strtotime($meta['departure_time'])) ?>
            </p>
            <p><b>Estimated Time of Arrival:</b>
                <?php echo date('M d, Y h:i A', strtotime($meta['eta'])) ?>
            </p>
        </div>
        <div class="col-md-6">
            <?php if ($remainingSpace > 0 || isset($_SESSION['login_id'])): ?>
                <input type="hidden" class="form-control" id="sid" name="sid" value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
                <input type="hidden" class="form-control" id="bid" name="bid" value='<?php echo isset($_GET['bid']) ? $_GET['bid'] : '' ?>' required="">

                <div class="form-group">
                    <label for="first_name" class="control-label">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($bmeta['first_name']) ? $bmeta['first_name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($bmeta['last_name']) ? $bmeta['last_name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="location" class="control-label">Where are you based?</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?php echo isset($bmeta['location']) ? $bmeta['location'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="phone_number" class="control-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($bmeta['phone_number']) ? $bmeta['phone_number'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($bmeta['email']) ? $bmeta['email'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="ID_number" class="control-label">ID number</label>
                    <input type="number" class="form-control" id="ID_number" name="ID_number" value="<?php echo isset($bmeta['ID_number']) ? $bmeta['ID_number'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="age" class="control-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo isset($bmeta['age']) ? $bmeta['age'] : '' ?>">
                </div>
                <?php if (isset($_SESSION['login_id'])): ?>
                    <div class="form-group mb-2">
                        <label for="status" class="control-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" <?php echo isset($bmeta['status']) && $bmeta['status'] == 1 ? "selected" : '' ?>>
                                Paid
                            </option>
                            <option value="0" <?php echo isset($bmeta['status']) && $bmeta['status'] == 0 ? "selected" : '' ?>>
                                Unpaid
                            </option>
                        </select>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <h3>No Available seat</h3>
                <style>
                    .uni_modal .modal-footer .book_now {
                        display: none;
                    }
                </style>
            <?php endif; ?>
        </div>
       <!-- Seats Diagram -->
    




                            <div class="mb-3">
                                <table id="seatsDiagram">
                                <tr>
                                <td class="space">&nbsp;</td>
                                <td class="space">&nbsp;</td>
                                <td class="space">&nbsp;</td>
                                <td class="space">&nbsp;</td>
                                    <td id="seat-1" data-name="1">1</td>
                                    <td id="seat-2" data-name="2">2</td>
                                    
                                    <td id="seat-3" data-name="3">3</td>
                                    
                                    <td id="seat-4" data-name="4">4</td>
                                    <td id="seat-5" data-name="5">5</td>
                                    <td class="space">&nbsp;</td>
                                    <td id="seat-6" data-name="6">6</td>
                                    
                                    <td id="seat-7" data-name="7">7</td>
                                    <td id="seat-8" data-name="8">8</td>
                                
                                    <td id="seat-9" data-name="9">9</td>
                                    
                                    <td id="seat-10" data-name="10">10</td>
                                    <td class="space">&nbsp;</td>
                                    <td id="seat-11" data-name="11">11</td>
                                    <td id="seat-12" data-name="12">12</td>
                                    <td id="seat-131" data-name="13">13</td>
                                    
                                    <td id="seat-14" data-name="14">14</td>
                                    <td id="seat-15" data-name="15">15</td>
                                    <td class="space">&nbsp;</td>
                                    <td id="seat-16" data-name="16">16</td>
                                    <td id="seat-17" data-name="17">17</td>
                                    <td id="seat-18" data-name="18">18</td>
                                    
                                    <td id="seat-19" data-name="19">19</td>
                                    
                                    <td id="seat-20" data-name="20">20</td>
                                    <td class="space">&nbsp;</td> 
                                
                                    <td id="seat-21" data-name="21">21</td>
                                    <td id="seat-22" data-name="22">22</td>
                                    <td id="seat-23" data-name="23">23</td>
                                   
                                    <td id="seat-24" data-name="24">24</td>
                                    <td id="seat-25" data-name="25">25</td>
                                    <td class="space">&nbsp;</td> 
                                    <td id="seat-26" data-name="26">26</td>
                                    <td id="seat-27" data-name="27">27</td>
                                    
                                    <td id="seat-28" data-name="28">28</td>
                                  
                                    <td id="seat-29" data-name="29">29</td>
                               
                                    <td id="seat-30" data-name="30">30</td>
                                    <td class="space">&nbsp;</td> 
                                    <td id="seat-31" data-name="31">31</td>
                                    <td id="seat-32" data-name="32">32</td>`
                                       	
                                    <td id="seat-33" data-name="33">33</td>
                                    <td id="seat-34" data-name="34">34</td>
                                    <td id="seat-35" data-name="35">35</td>
                                    <td class="space">&nbsp;</td>   
                                    <td id="seat-36" data-name="36">36</td>
                                    <td id="seat-37" data-name="37">37</td>
                                    
                                    
                                    </tr>
                                </table>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                            <div class="col-auto">
                                    <label for="seats" class="col-form-label">Seat Number</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="booked_seat" class="form-control" name="booked_seat" readonly value="<?php echo isset($bmeta['booked_seat']) ? $bmeta['booked_seat'] : '' ?>">
                                </div>
                                <div class="col-auto">
                                    <span id="seatInfo" class="form-text">
                                        Select from the above figure, Maximum 1 seat.
                                    </span>
                                </div>
                            </div>
        </div>
    </div>
</form>
   
	<!-- Add this section on your main page -->
<div id="referenceSection" style="display: none;">
    <p><strong>Reference Number:</strong> <span id="referenceNumber"></span></p>
</div>

</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
$(document).ready(function () {
    var seatInputField = $('#booked_seat');
    var selectedSeats = [];

    // Fetch the list of booked seats from PHP as a JSON array
    var bookedSeats = <?php echo $bookedSeatsJSON; ?>;

    // Attach click event to the seats
    $('#seatsDiagram td:not(.space, .notAvailable)').on('click', function () {
        var seatNumber = $(this).data('name');

        // Check if the seat is already booked
        if (bookedSeats.includes(seatNumber)) {
            alert("This seat is already booked.");
            return;
        }

        // Check if the seat is already selected
        var seatIndex = selectedSeats.indexOf(seatNumber);
        if (seatIndex !== -1) {
            // Seat is already selected, deselect it
            $(this).removeClass('selected');
            selectedSeats.splice(seatIndex, 1); // Remove the seat from the selected seats array
        } else {
            // Check if maximum 1 seat is selected
            if (selectedSeats.length === 1) {
                alert("You can select only 1 seat.");
                return;
            }

            // If the seat is not selected and not booked, proceed with selection logic
            $(this).addClass('selected');
            selectedSeats.push(seatNumber);
        }

        // Update the hidden input field with the selected seat value(s)
        seatInputField.val(selectedSeats.join(', '));
    });

    // Disable and style booked seats as red and prevent them from being selected
    $.each(bookedSeats, function (index, seatNumber) {
        var $seat = $('#seat-' + seatNumber);

        $seat.addClass('booked').css('background-color', 'red');

        // Disable the click event for booked seats
        $seat.off('click');
    });
  // Update the form submission code here
  $('#manage_book').submit(function (e) {
        e.preventDefault();
        
        // Validate form data here, including selected seat

        if (selectedSeats.length !== 1) {
            alert("Please select exactly 1 seat.");
            return;
        }
        // Add more validation logic for other form fields as needed
        var firstName = $('#first_name').val().trim();
        var lastName = $('#last_name').val().trim();
        var location = $('#location').val().trim();
        var phone_number = $('#phone_number').val().trim();
        var email = $('#email').val().trim();
        var ID_number = $('#ID_number').val().trim();
        var age = $('#age').val().trim();
        // Add validation for other fields here...

        // Example validation for the first name field
        if (firstName === '') {
            alert("First Name is required.");
            return;
        }
        if (lastName === '') {
            alert("last Name is required.");
            return;
        }
        if (location === '') {
            alert("location Name is required.");
            return;
        }
        if (phone_number === '') {
            alert("Please enter your Phone Number.");
            return;
        }
        if (email === '') {
            alert("email is required.");
            return;
        }
        if (ID_number === '') {
            alert("ID_number is required.");
            return;
        }
        if (age === '') {
            alert("age is required.");
            return;
        }

        start_load();

        // Continue with the AJAX submission code as you had before
        console.log('Submitting form data...');
        $.ajax({
            url: 'book/book_now.php',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err);
                end_load();
                alert_toast('An error occurred', 'danger');
            },
            success: function (resp) {
                resp = JSON.parse(resp);
                if (resp.status == 1) {
                    end_load();
                    $('.modal').modal('hide');
                    var referenceNumber = resp.ref;
                    $('#referenceNumber').text(referenceNumber); // Update the reference number in the main page section
                    $('#referenceSection').show(); // Show the reference section
                    alert_toast('Data successfully saved. Reference Number: ' + referenceNumber, 'success');
                    if ('<?php echo !isset($_SESSION['login_id']) ?>' == 1) {
                        $('#book_modal .modal-body').html('<div class="text-center"><p><strong><h3>' + referenceNumber + '</h3></strong></p><small>Reference Number</small><br/><small>Copy or Capture your Reference number </small></div>');
                        $('#book_modal').modal('show');
                    } else {
                        load_booked();
                    }
                }
            }
        });
    });
});

	$('.datetimepicker').datetimepicker({
		format: 'Y/m/d H:i',
		minDate: new Date() // Set minimum selectable date to today
	});
	
</script>