<section id="bg-bus" class="d-flex align-items-center">
	<main id="main">
		<div class="container">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-md-12">
						<button class="float-right btn btn-primary btn-sm" type="button" id="new_bus">Add New <i
								class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="row">
					&nbsp;
				</div>
				<div class="row">
					<div class="card col-md-12">

						<div class="card-body">
							<table class="table table-striped table-bordered" id="bus-field">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Driver Name</th>
										<th class="text-center">Bus Name</th>
										<th class="text-center">Registration Number</th>
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
	$('#new_bus').click(function () {
		uni_modal('Add New Bus', 'bus/manage_bus.php')
	})
	window.load_bus = function () {
		$('#bus-field').dataTable().fnDestroy();
		$('#bus-field tbody').html('<tr><td colspan="4" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url: 'bus/load_bus.php',
			error: err => {
				console.log(err)
				alert_toast('An error occured.', 'danger');
			},
			success: function (resp) {
				if (resp) {
					if (typeof (resp) != undefined) {
						resp = JSON.parse(resp)
						if (Object.keys(resp).length > 0) {
							$('#bus-field tbody').html('')
							var i = 1;
							Object.keys(resp).map(k => {
								var tr = $('<tr></tr>');
								tr.append('<td class="text-center">' + (i++) + '</td>')
								tr.append('<td class="text-center">' + resp[k].driver_name + '</td>')
								tr.append('<td>' + resp[k].name + '</td>')
								tr.append('<td>' + resp[k].registration_number + '</td>')
								tr.append('<td><center><button class="btn btn-sm btn-primary edit_bus mr-2" data-id="' + resp[k].id + '">Edit</button><button class="btn btn-sm btn-danger remove_bus" data-id="' + resp[k].id + '">Delete</button></center></td>')
								$('#bus-field tbody').append(tr)

							})

						} else {
							$('#bus-field tbody').html('<tr><td colspan="4" class="text-center">No data.</td></tr>')
						}
					}
				}
			},
			complete: function () {
				$('#bus-field').dataTable()
				manage();
			}
		})
	}
	function manage() {
		// Use event delegation for the click event on elements with class 'edit_bus'
		$(document).on('click', '.edit_bus', function () {
			uni_modal('Edit New Bus', 'bus/manage_bus.php?id=' + $(this).attr('data-id'));
		});

		// Use event delegation for the click event on elements with class 'remove_bus'
		$(document).on('click', '.remove_bus', function () {
			_conf('Are you sure to delete this data?', 'bus/remove_bus', [$(this).attr('data-id')]);
		});
	}

	function remove_bus($id = '') {
		start_load()
		$.ajax({
			url: 'bus/delete_bus.php',
			method: 'POST',
			data: { id: $id },
			error: err => {
				console.log(err)
				alert_toast("An error occured", "danger");
				end_load()
			},
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data succesfully deleted", "success");
					end_load()
					$('.modal').modal('hide')
					load_bus()
				}
			}
		})
	}
	$(document).ready(function () {
		load_bus()
	})
</script>