<table class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Nama Pegawai</th>
			<th scope="col">Posisi</th>
			<th scope="col">Level</th>
			<th scope="col">User Aktivasi</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $no = 1;
        foreach ($access_menu as $access) :
        ?>
		<tr id="del-user">
			<th scope="row"><?= $no++; ?></th>
			<td><?= $access['nama_pegawai']; ?></td>
			<td><?= $access['nama_posisi']; ?></td>
			<td><?= $access['level']; ?></td>
			<td>
				<div class="d-flex justify-content-center align-items-center">
					<div class="custom-control custom-switch">
						<input type="checkbox" name="is_active" <?= $access['is_active'] == 1 ? 'checked' : ''; ?>
							value="<?= $access['is_active']; ?>" class="custom-control-input"
							data-isactive="<?= $access['is_active']; ?>" data-userid="<?= $access['id']; ?>"
							id="customSwitch<?= $access['id']; ?>">
						<label class="custom-control-label" for="customSwitch<?= $access['id']; ?>"></label>
					</div>
					<span
						class="status<?= $access['id']; ?> badge <?= $access['is_active'] == 1 ? 'badge-success' : 'badge-danger'; ?>"><?= $access['is_active'] == 1 ? 'Active' : 'Inactive'; ?></span>
				</div>
			</td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default">Action</button>
					<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu" role="menu">
						<a class="dropdown-item delete-user" href="#" data-userid="<?= $access['id']; ?>"><i
								class="fas fa-trash"></i> Delete</a>
						<a class="dropdown-item update-spareparts" href="#" data-userid="<?= $access['id']; ?>"><i
								class="fas fa-edit"></i> Update</a>
						<a class="dropdown-item add-access" data-toggle="modal" data-target="#add-access" href="#"
							data-levelid="<?= $access['level_id']; ?>"><i class="fas fa-plus"></i> Add Access</a>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="add-access" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body data-accsess-menu">
			</div>
		</div>
	</div>
</div>
<script>
	$('[name="is_active"]').click(function () {
		const userid = $(this).data('userid');
		const isactive = $(this).data('isactive');
		if ($(`#customSwitch${userid}`).is(':checked')) {
			$(`.status${userid}`).html('Active');
			$(`.status${userid}`).removeClass('badge-danger').addClass('badge-success');
			$.getJSON('<?= base_url() ?>menu/user_active', {
				userid: userid,
				isactive: isactive,
			}, function (data) {
				console.log(data);
			});
		} else {
			$(`.status${userid}`).html('Inactive');
			$(`.status${userid}`).removeClass('badge-success').addClass('badge-danger');
			$.getJSON('<?= base_url() ?>menu/user_inactive', {
				userid: userid,
				isactive: isactive,
			}, function (data) {
				console.log(data);
			});
		}
	});

	$('.delete-user').click(function () {
		$(this).closest("#del-user").addClass("hapus-user");
		Swal.fire({
			title: 'Hapus data ini ?',
			text: 'Data yang terhapus tidak akan kembali !',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "<?= base_url(); ?>menu/delete_access_menu",
					type: "post",
					dataType: "json",
					data: {
						userid: $(this).data("userid")
					},
					success: function (data) {
						if (data.response == 'success') {
							iziToast.success({
								title: 'Success',
								message: data.message,
								position: 'topRight'
							});
							$(".hapus-user").fadeOut(1000);
						} else {
							iziToast.error({
								title: 'Error',
								message: data.message,
								position: 'topRight'
							});
						}
					}
				})
			}
		});
	});

	$('.add-access').click(function () {
		$('#add-access .modal-title').html('Add Access User')
		$.ajax({
			url : '<?= base_url() ?>menu/userAccess',
			type: 'get',
			data: {
				level_id: $(this).data('levelid'),
			},
			success: (data) => {
				$('.data-accsess-menu').html(data);
			}
		});
	});

</script>
