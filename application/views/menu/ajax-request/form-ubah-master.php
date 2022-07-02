<form action="" id="form-ubah-master">
    <input type="hidden" name="id" value="<?= $master['id']; ?>">
	<div class="form-group">
		<label for="nama_service">Service</label>
		<input type="text" class="form-control" value="<?= $master['nama_service']; ?>" name="nama_service" id="nama_service">
		<div class="invalid-feedback nama_service_error">
		</div>
	</div>
	<div class="form-group">
		<label for="harga">Harga</label>
		<input type="text" class="form-control" value="<?= $master['harga']; ?>" name="harga" id="harga">
		<div class="invalid-feedback harga_error">
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Ubah</button>
</form>
<script>
	$('#form-ubah-master').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>master/update_master',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.error) {
					if (data.error.nama_service) {
						$("[name='nama_service']").addClass("is-invalid");
						$(".nama_service_error").html(data.error.nama_service);
					} else {
						$("[name='nama_service']").removeClass("is-invalid");
						$(".nama_service_error").html("");
					}
					if (data.error.harga) {
						$("[name='harga']").addClass("is-invalid");
						$(".harga_error").html(data.error.harga);
					} else {
						$("[name='harga']").removeClass("is-invalid");
						$(".harga_error").html("");
					}
				} else {
					$("[name='nama_service']").removeClass("is-invalid");
					$(".nama_service_error").html("");
					$("[name='harga']").removeClass("is-invalid");
					$(".harga_error").html("");
					if (data.status == 200) {
						iziToast.success({
							title: 'Success',
							message: data.message,
							position: 'topRight',
							timeout: 1000
						});
						$('#tambah-service').modal('hide')
						$.get('<?= base_url() ?>master/data_master', function (data) {
							$('.view-master').html(data);
						});
					} else {
						iziToast.error({
							title: 'Error',
							message: 'Data gagal di tambah',
							position: 'topRight',
							timeout: 1000
						});
					}
				}
			}
		});
		e.preventDefault();
	});
</script>
