<!-- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">

<!-- JavaScript -->
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js">
	$(document).ready(function () {
		$('#schedule-field').DataTable({
			scrollY: '300px', // Set the height of the scrollable area
			scrollCollapse: true, // Enable collapsing the table height when there's less data
			paging: false // Disable pagination if you don't want it
		});
	});
</script>
<style>
	.card-body {
		max-height: 600px;
		/* Set the desired maximum height */
		overflow-y: auto;
		/* Enable vertical scroll */
	}
</style>

<section id="bg-bus" class="d-flex align-items-center">
	<main id="main">
		<div class="container-fluid">
			<div class="col-lg-12">
				<?php if (isset($_SESSION['login_id'])): ?>
						<div class="row">
							<div class="col-md-12">
								<button class="float-right btn btn-primary btn-sm" type="button" id="new_schedule">Add New <i
										class="fa fa-plus"></i></button>
							</div>
						</div>
				<?php endif; ?>
				<div class="row">
					&nbsp;
				</div>
				<div class="row">
					<div class="card col-md-12">

						<div class="card-body">
							<table class="table table-striped table-bordered" id="schedule-field">
								<colgroup>
									<col width="5%">
									<col width="10%">
									<col width="15%">
									<col width="20%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
								</colgroup>
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Date</th>
										<th class="text-center">Bus</th>
										<th class="text-center">Location</th>
										<th class="text-center">Departure</th>
										<th class="text-center">ETA</th>
										<th class="text-center">Space left</th>
										<th class="text-center">Price</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>
</section>
<script>
	$('#new_schedule').click(function () {
		uni_modal('Add New Schedule', 'schedule/manage_schedule.php')
	})

	window.load_schedule = function () {
		$('#schedule-field').dataTable().fnDestroy();
		$('#schedule-field tbody').html('<tr><td colspan="7" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url: 'schedule/fetch_schedules.php',
			error: err => {
				console.log(err)
				alert_toast('An error occured.', 'danger');
			},
			success: function (resp) {
				if (resp) {
					resp = JSON.parse(resp);
					if (Object.keys(resp).length > 0) {
						$('#schedule-field tbody').html('');
						var i = 1;
						Object.keys(resp).map(k => {
							var tr = $('<tr></tr>');
							tr.append('<td class="text-center">' + (i++) + '</td>');
							tr.append('<td class="">' + resp[k].date + '</td>');
							tr.append('<td class="">' + resp[k].bus + '</td>');
							tr.append('<td class="">' + resp[k].from_location + ' - ' + resp[k].to_location + '</td>');
							tr.append('<td>' + resp[k].departure_time + '</td>');
							tr.append('<td>' + resp[k].eta + '</td>');
							tr.append('<td>' + resp[k].available_space + '</td>');
							tr.append('<td>' + resp[k].price + '</td>');

							// Check if the space_left is 0, and hide the "Book Now" button
							if (resp[k].available_space <= -1) {
								tr.append('<td><center>No Available Seat</center></td>');
							} else {
								// If space_left is not 0, show the "Book Now" button
								if ('<?php echo isset($_SESSION['login_id']) ? 1 : 0 ?>' == 1) {
									tr.append('<td><center><button class="btn btn-sm btn-primary edit_schedule mr-2" data-id="' + resp[k].id + '">Edit</button><button class="btn btn-sm btn-danger remove_schedule" data-id="' + resp[k].id + '">Delete</button></center></td>');
								} else {
									tr.append('<td><center><button class="btn btn-sm btn-primary mr-2 text-white  book_now" data-id="' + resp[k].id + '"><strong>Book Now</strong></button></center></td>');
								}
							}
							$('#schedule-field tbody').append(tr);
						});
					} else {
						$('#schedule-field tbody').html('<tr><td colspan="7" class="text-center">No booking available.</td></tr>');
					}
				}
			},

			complete: function () {
				$('#schedule-field').dataTable()
				manage();
				$('.book_now').click(function () {
					uni_modal('Book Details', 'book/customer_book.php?id=' + $(this).attr('data-id'), 1)
				})
			}
		})
	}
	function manage() {
		// Use event delegation for the click event on elements with class 'edit_schedule'
		$(document).on('click', '.edit_schedule', function () {
			uni_modal('Edit New Schedule', 'schedule/manage_schedule.php?id=' + $(this).attr('data-id'))
		});

		// Use event delegation for the click event on elements with class 'remove_schedule'
		$(document).on('click', '.remove_schedule', function () {
			_conf('Are you sure to delete this data?','schedule/remove_schedule', [$(this).attr('data-id')])
		});
	}
	function remove_schedule(id = '') {
    start_load(); // Add a semicolon here

    $.ajax({
        url: 'schedule/delete_schedule.php',
        method: 'POST',
        data: { id: id }, // Correct the variable name to 'id'
        error: err => {
            console.log(err);
            alert_toast("An error occurred", "danger");
            end_load();
        },
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", "success");
                end_load();
                $('.modal').modal('hide');
                load_schedule();
            }
        }
    });
}

	$(document).ready(function () {
		load_schedule()
	})
</script>