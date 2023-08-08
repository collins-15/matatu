<?php
session_start();
include('../db_connect.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM schedule_list where id = " . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $val) {
		$meta[$k] = $val;
	}
	$bus = $conn->query("SELECT * FROM bus where id = " . $meta['bus_id'])->fetch_array();
	$from_location = $conn->query("SELECT id, city as location FROM location where id =" . $meta['from_location'])->fetch_array();
	$to_location = $conn->query("SELECT id, city as location FROM location WHERE id = " . $meta['to_location'])->fetch_array();
	// Get the total number of booked seats for the given schedule_id
	$count = $conn->query("SELECT SUM(seats) as sum from booked where id =" . $meta['id'])->fetch_array()['sum'];

	// 	// Query to get the bus_id and available space for the specific schedule_id
// 	$scheduleQuery = $conn->query("SELECT bus_id, space_left FROM schedule_list WHERE id = " . $meta['id']);
// 	$scheduleData = $scheduleQuery->fetch_assoc();

	// 	// Check if there is no available space left and show the message
// 	if ($scheduleData) {
// 		$busId = $scheduleData['bus_id'];
// 		$availableSpace = $scheduleData['space_left'];

	// 		// Calculate the remaining available space after booking
// 		$remainingSpace = $availableSpace - $count;

	// 		// Ensure the remainingSpace is not negative (availability cannot be less than 0)
// 		$remainingSpace = max(0, $remainingSpace);

	// 		// Update the schedule_list table with the new available space
// 		$updateQuery = $conn->query("UPDATE schedule_list SET space_left = $remainingSpace WHERE id = " . $meta['id']);

	// 		// Check if the update was successful (optional)
// 		if ($updateQuery) {
// 			// The update was successful, you can perform any additional actions here if needed.
// 		} else {
// 			// The update failed, handle the error if required.
// 		}
// 	}

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
			<?php if (($count < $meta['space_left']) || isset($_SESSION['login_id'])): ?>
				<input type="hidden" class="form-control" id="sid" name="sid"
					value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
				<input type="hidden" class="form-control" id="sid" name="bid"
					value='<?php echo isset($_GET['bid']) ? $_GET['bid'] : '' ?>' required="">

				<div class="form-group mb-2">
					<label for="name" class="control-label">Name:</label>
					<input type="text" class="form-control" id="name" name="name"
						value="<?php echo isset($bmeta['name']) ? $bmeta['name'] : '' ?>">
				</div>
				<div class="form-group mb-2">
					<label for="seats" class="control-label">Number of seats</label>
					<input type="number" maxlength="4" class="form-control text-right" id="seats" name="seats"
						value="<?php echo isset($bmeta['seats']) ? $bmeta['seats'] : '' ?>">
				</div>
				<!-- <?php var_dump($count, $meta['space_left']); ?> -->
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