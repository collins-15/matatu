<?php
include('../db_connect.php');
$bus = $conn->query("SELECT * FROM bus where status = 1");
$location = $conn->query("SELECT id,city as location FROM location where status = 1");
?>

<div class="container-fluid">
	<form id="find_schedule">
		<div class="col-md-12">
			<div class="form-group mb-2">
				<input type="hidden" class="form-control" id="id" name="id"
					value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
				</select>
			</div>
			<div class="form-group mb-2">
				<label for="from_location" class="control-label">Departure</label>
				<select name="from_location" id="from_location" class="form-control" required>
					<option value="" <?php echo isset($meta['to_location']) && $meta['from_location'] > 0 ? '' : 'selected' ?> disabled="">Select Here</option>
					<?php while ($row = $location->fetch_assoc()) { ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($meta['from_location']) && $meta['from_location'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['location'] ?></option>
					<?php } ?>
				</select>
			</div>
			<?php
			$location = $conn->query("SELECT id, city as location FROM location where status = 1");
			?>
			<div class="form-group mb-2">
				<label for="to_location" class="control-label">Arrival</label>
				<select name="to_location" id="to_location" class="form-control" required>
					<option value="" <?php echo isset($meta['to_location']) && $meta['to_location'] > 0 ? '' : 'selected' ?> disabled="">Select Here</option>
					<?php while ($row2 = $location->fetch_assoc()) { ?>
							<option value="<?php echo $row2['id'] ?>" <?php echo isset($meta['to_location']) && $meta['to_location'] == $row['id'] ? 'selected' : '' ?>><?php echo $row2['location'] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group mb-2">
				<label for="departure_time" class="control-label">Departure Time</label>
				<input type="text" class="datetimepicker form-control" id="departure_time" name="departure_time"
					value="<?php echo isset($meta['departure_time']) ? date('Y/m/d', strtotime($meta['departure_time'])) : '' ?>"autocomplete="off">
			</div>
		</div>
	</form>
</div>
<script>
	$('#find_schedule').submit(function (e) {
		e.preventDefault()
		var get = '';
		$('input,select').each(function () {
			get += '&' + $(this).attr('name') + '=' + $(this).val();
		})
		location.replace("index.php?page=schedule/scheduled_list" + get)

	})

	$(document).ready(function () {
		$('.datetimepicker').datetimepicker({
			format: 'Y/m/d', // Set the format to show only the date without the time
			minDate: new Date() // Set minimum selectable date to today
		});
	});


</script>