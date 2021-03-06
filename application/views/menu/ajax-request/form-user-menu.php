<form action="" id="user-menu">
	<div class="form-group">
		<label for="nama_menu">Nama Menu</label>
		<input type="text" class="form-control" value="" name="nama_menu" id="nama_menu">
		<div class="invalid-feedback nama_menu_error">
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Tambah</button>
</form>
<script>
	$('#user-menu').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/tambah_userMenu',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.response == 'success') {
					$.get('<?= base_url() ?>menu/ambilDataUserMenu', function (data) {
						$('.view-user-menu').html(data);
					});
					$('[name="nama_menu"]').val('');
				}
			}
		});
		e.preventDefault();
	});
</script>
