<form action="" id="form-add-user">
	<div class="form-group">
		<label for="nama_pegawai">Nama</label>
		<input type="text" class="form-control" value="" name="nama_pegawai" id="nama_pegawai">
		<div class="invalid-feedback nama_pegawai_error">
		</div>
	</div>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Posisi</label>
		<select class="form-control" name="id_posisi" id="exampleFormControlSelect1">
			<?php foreach($posisi as $jabatan): ?>
			<option value="<?= $jabatan['id'] ?>"><?= $jabatan['nama_posisi'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" value="" name="username" id="username">
		<div class="invalid-feedback username_error">
		</div>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" value="" name="password" id="password">
		<div class="invalid-feedback password_error">
		</div>
	</div>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Level User</label>
		<select class="form-control" name="level_id" id="exampleFormControlSelect1">
			<?php foreach($level_user as $level): ?>
			<option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Tambah</button>
</form>
<script>
	$('#form-add-user').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/add_user',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.error) {
					if (data.error.nama_pegawai) {
						$("[name='nama_pegawai']").addClass("is-invalid");
						$(".nama_pegawai_error").html(data.error.nama_pegawai);
					} else {
						$("[name='nama_pegawai']").removeClass("is-invalid");
						$(".nama_pegawai_error").html("");
					}
					if (data.error.username) {
						$("[name='username']").addClass("is-invalid");
						$(".username_error").html(data.error.username);
					} else {
						$("[name='username']").removeClass("is-invalid");
						$(".username_error").html("");
					}

					if (data.error.password) {
						$("[name='password']").addClass("is-invalid");
						$(".password_error").html(data.error.password);
					} else {
						$("[name='password']").removeClass("is-invalid");
						$(".password_error").html("");
					}
				} else {
					$("[name='nama_pegawai']").removeClass("is-invalid");
					$(".nama_pegawai_error").html("");
					$("[name='username']").removeClass("is-invalid");
					$(".username_error").html("");
					$("[name='password']").removeClass("is-invalid");
					$(".password_error").html("");
					if (data.response == 'success') {
						iziToast.success({
							title: 'Success',
							message: data.message,
							position: 'topRight',
							timeout: 1000
						});
						$("#tambah-user").modal('hide');
						$.get('<?= base_url() ?>menu/ambilDataAccessMenu', function (data) {
							$('.view-access-menu').html(data);
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
