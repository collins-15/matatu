<?php
include('../db_connect.php');


// Initialize the $meta array to avoid undefined variable notice
$meta = array();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM location WHERE id = " . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $val) {
		$meta[$k] = $val;
	}
}
?>
<div class="container-fluid">
	<form id="manage_location">
		<div class="col-md-12">
			<div class="form-group mb-2">
				<label for="City" class="control-label">City</label>
				<input type="hidden" class="form-control" id="id" name="id"
					value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
				<input type="text" class="form-control" id="City" name="City" required=""
					value="<?php echo isset($meta['City']) ? $meta['City'] : '' ?>">
			</div>
		</div>
	</form>
</div>

<script>
	$('#manage_location').submit(function (e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'location/save_location.php',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				end_load()
				alert_toast('An error occured', 'danger');
			},
			success: function (resp) {
				if (resp == 1) {
					end_load()
					$('.modal').modal('hide')
					alert_toast('Data successfully saved', 'success');
					load_location()
				}
			}
		})
	})
</script>