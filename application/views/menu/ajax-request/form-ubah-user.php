<form action="" id="form-ubah-user">
    <input type="hidden" name="id" value="<?= $user['id']; ?>">
	<div class="form-group">
		<label for="nama_pegawai">Nama</label>
		<input type="text" class="form-control" value="<?= $user['nama_pegawai']; ?>" name="nama_pegawai"
			id="nama_pegawai">
		<div class="invalid-feedback nama_pegawai_error">
		</div>
	</div>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Posisi</label>
		<select class="form-control" name="id_posisi" id="exampleFormControlSelect1">
			<?php foreach($posisi as $jabatan): ?>
			<option value="<?= $jabatan['id'] ?>" <?= $user['id_posisi'] == $jabatan['id'] ? 'selected' : ''; ?>>
				<?= $jabatan['nama_posisi'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" readonly value="<?= $user['username']; ?>" name="username"
			id="username">
		<div class="invalid-feedback username_error">
		</div>
	</div>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Level User</label>
		<select class="form-control" name="level_id" id="exampleFormControlSelect1">
			<?php foreach($level_user as $level): ?>
			<option value="<?= $level['id'] ?>" <?= $user['level_id'] == $level['id'] ? 'selected' : ''; ?>>
				<?= $level['level'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Ubah</button>
</form>
<script>
	$('#form-ubah-user').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/proses_ubahUser',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.status == 200) {
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
				}
			}
		});
        e.preventDefault();
	});

</script>
