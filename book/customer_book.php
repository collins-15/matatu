<?php
session_start();
include('../db_connect.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Fetch the schedule data including 'bus_seats' column
    $qry = $conn->query("SELECT sl.*, b.bus_seats FROM schedule_list sl
                        JOIN bus b ON sl.bus_id = b.id
                        WHERE sl.id = " . $_GET['id'])->fetch_array();

    if ($qry) {
        $meta = $qry; // Assign the fetched data to the $meta array

        // Calculate the total number of booked seats for the given schedule
        $countResult = $conn->query("SELECT SUM(seats) AS sum FROM booked WHERE schedule_id =" . $meta['id'])->fetch_array();
        $count = $countResult['sum'];

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




if (isset($_SESSION['login_id']) && isset($_GET['bid'])) {
    $booked = $conn->query("SELECT * FROM booked where id=" . $_GET['bid'])->fetch_array();
    foreach ($booked as $k => $val) {
        $bmeta[$k] = $val;
    }
}
?>



<div class="container-fluid">
	<form id="manage_book">
		<div class="col-md-12">
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
				<?php echo date('M d,Y h:i A', strtotime($meta['departure_time'])) ?>
			</p>
			<p><b>Estimated Time of Arrival:</b>
				<?php echo date('M d,Y h:i A', strtotime($meta['eta'])) ?>
			</p>
			<?php if ($remainingSpace > 0 || isset($_SESSION['login_id'])): var_dump($remainingSpace)?>
            
            <input type="hidden" class="form-control" id="sid" name="sid"
                value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
            <input type="hidden" class="form-control" id="bid" name="bid"
                value='<?php echo isset($_GET['bid']) ? $_GET['bid'] : '' ?>' required="">

            <div class="form-group mb-2">
                <label for="first_name" class="control-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="<?php echo isset($bmeta['first_name']) ? $bmeta['first_name'] : '' ?>">
            </div>
            <div class="form-group mb-2">
					<label for="last_name" class="control-label">Last Name</label>
					<input type="text" class="form-control text-right" id="last_name" name="last_name"
						value="<?php echo isset($bmeta['last_name']) ? $bmeta['last_name'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="location" class="control-label">Where are you based?</label>
					<input type="text" class="form-control text-right" id="location" name="location"
						value="<?php echo isset($bmeta['location']) ? $bmeta['location'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="phone_number" class="control-label">Phone Number</label>
					<input type="number" class="form-control text-right" id="phone_number" name="phone_number"
						value="<?php echo isset($bmeta['phone_number']) ? $bmeta['phone_number'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="email" class="control-label">Email Address</label>
					<input type="email" class="form-control text-right" id="email" name="email"
						value="<?php echo isset($bmeta['email']) ? $bmeta['email'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="ID_number" class="control-label">ID number</label>
					<input type="number" class="form-control text-right" id="ID_number" name="ID_number"
						value="<?php echo isset($bmeta['ID_number']) ? $bmeta['ID_number'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="age" class="control-label">Age</label>
					<input type="number"  class="form-control text-right" id="age" name="age"
						value="<?php echo isset($bmeta['age']) ? $bmeta['age'] : '' ?>">
				</div>
            <div class="form-group mb-2">
					<label for="seats" class="control-label">Number of seats</label>
					<input type="number" maxlength="4" class="form-control text-right" id="seats" name="seats"
						value="<?php echo isset($bmeta['seats']) ? $bmeta['seats'] : '' ?>">
				</div>
				<?php if (isset($_SESSION['login_id'])): ?>
					<div class="form-group mb-2">
						<label for="seats" class="control-label">Status</label>
						<select class="form-control" id="status" name="status"
							value="<?php echo isset($bmeta['seats']) ? $bmeta['seats'] : '' ?>">
							<option value="1" <?php echo isset($bmeta['status']) && $bmeta['status'] == 1 ? "selected" : '' ?>>
								Paid</option>
							<option value="0" <?php echo isset($bmeta['status']) && $bmeta['status'] == 0 ? "selected" : '' ?>>
								Unpaid</option>
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
	</form>
</div>


<script>
	$('#manage_book').submit(function (e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'book/book_now.php',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				end_load()
				alert_toast('An error occured', 'danger');
			},
			success: function (resp) {
				resp = JSON.parse(resp)
				if (resp.status == 1) {
					end_load()
					$('.modal').modal('hide')
					alert_toast('Data successfully saved', 'success');
					if ('<?php echo !isset($_SESSION['login_id']) ?>' == 1) {
						$('#book_modal .modal-body').html('<div class="text-center"><p><strong><h3>' + resp.ref + '</h3></strong></p><small>Reference Number</small><br/><small>Copy or Capture your Reference number </small></div>')
						$('#book_modal').modal('show')
					} else {
						load_booked();
					}
				}
			}
		})
	})
	$('.datetimepicker').datetimepicker({
		format: 'Y/m/d H:i',
		minDate: new Date() // Set minimum selectable date to today
	});
</script>