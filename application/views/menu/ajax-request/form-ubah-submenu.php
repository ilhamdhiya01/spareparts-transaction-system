<form action="" id="ubah-sub-menu">
	<input type="hidden" name="sub_id" value="<?= $sub_by_id['id'] ?>" id="">
	<div class="form-group">
		<label for="exampleFormControlSelect1">Menu</label>
		<select class="form-control" name="menu_id" id="exampleFormControlSelect1">
			<?php foreach($user_menu as $menu): ?>
			<option value="<?= $menu['id'] ?>" <?= $sub_by_id['menu_id'] == $menu['id'] ? 'selected' : ''; ?>>
				<?= $menu['nama_menu'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="sub_menu">Sub Menu</label>
		<input type="text" class="form-control" value="<?= $sub_by_id['sub_menu'] ?>" name="sub_menu" id="sub_menu">
		<div class="invalid-feedback sub_menu_error">
		</div>
	</div>
	<div class="form-group">
		<label for="url">Url</label>
		<input type="text" class="form-control" value="<?= $sub_by_id['url'] ?>" name="url" id="url">
		<div class="invalid-feedback url_error">
		</div>
	</div>
	<div class="form-group">
		<label for="icon">Icon</label>
		<input type="text" class="form-control" value="<?= $sub_by_id['icon'] ?>" name="icon" id="icon">
		<div class="invalid-feedback icon_error">
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Ubah</button>
</form>
<script>
	$('#ubah-sub-menu').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/proses_ubahSubMenu',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.response == 'success') {
					iziToast.success({
						title: 'Success',
						message: data.message,
						position: 'topRight',
						timeout: 1000
					});
					$("#tambah-sub-menu").modal('hide');
					$.get('<?= base_url() ?>menu/ambilDataSubMenu', function (data) {
						$('#view-sub-menu').html(data);
					});
				}
			}
		});
		e.preventDefault();
	});

</script>
