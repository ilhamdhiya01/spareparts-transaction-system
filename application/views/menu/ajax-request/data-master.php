<table class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Nama Service</th>
			<th scope="col">Harga</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $no = 1;
        foreach ($master as $service) :
        ?>
		<tr id="del-master">
			<th scope="row"><?= $no++; ?></th>
			<td><?= $service['nama_service']; ?></td>
			<td><?= rupiah($service['harga']); ?></td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default">Action</button>
					<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu" role="menu">
						<a class="dropdown-item delete-master" href="#" data-masterid="<?= $service['id']; ?>"><i
								class="fas fa-trash"></i> Delete</a>
						<a class="dropdown-item update-master" href="#" data-masterid="<?= $service['id']; ?>"><i
								class="fas fa-edit"></i> Update</a>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script>
	$('.delete-master').click(function () {
		$(this).closest("#del-master").addClass("hapus-master");
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
					url: "<?= base_url(); ?>master/delete_master",
					type: "post",
					dataType: "json",
					data: {
						master_id: $(this).data("masterid")
					},
					success: function (data) {
						if (data.status == 200) {
							iziToast.success({
								title: 'Success',
								message: data.message,
								position: 'topRight'
							});
							$(".hapus-master").fadeOut(1000);
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
	$('.update-master').click(function () {
		$('#tambah-service').modal('show');
		$('#modal-master-title').html('Ubah Data Master')
		$.get('<?= base_url() ?>master/formUbahMaster', {
			master_id: $(this).data('masterid')
		}, function (data) {
			$('.view-form-master').html(data);
		});
	});

</script>
