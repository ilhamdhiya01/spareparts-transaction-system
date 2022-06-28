<form action="" id="form-ubah-menu">
	<input type="hidden" name="menu_id" value="" id="menu_id">
	<div class="form-group">
		<label for="nama_menu">Nama Menu</label>
		<input type="text" class="form-control" value="" name="nama_menu" id="ubah_nama_menu">
		<div class="invalid-feedback nama_menu_error">
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah</button>
</form>
<script>
	$('#form-ubah-menu').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/proses_ubahUserMenu',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.response == 'success') {
					$.get('<?= base_url() ?>menu/ambilDataUserMenu', function (data) {
						$('.view-user-menu').html(data);
					});
					$.get('<?= base_url() ?>menu/formUserMenu', function (data) {
						$('.view-form-user-menu').html(data);
					});
				}
			}
		});
		e.preventDefault();
	});

</script>
