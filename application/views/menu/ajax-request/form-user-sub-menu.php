<form action="" id="user-sub-menu">
	<div class="form-group">
		<label for="exampleFormControlSelect1">Menu</label>
		<select class="form-control" name="menu_id" id="exampleFormControlSelect1">
			<?php foreach($user_menu as $menu): ?>
			<option value="<?= $menu['id'] ?>"><?= $menu['nama_menu'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="sub_menu">Sub Menu</label>
		<input type="text" class="form-control" value="" name="sub_menu" id="sub_menu">
		<div class="invalid-feedback sub_menu_error">
		</div>
	</div>
	<div class="form-group">
		<label for="url">Url</label>
		<input type="text" class="form-control" value="" name="url" id="url">
		<div class="invalid-feedback url_error">
		</div>
	</div>
	<div class="form-group">
		<label for="icon">Icon</label>
		<input type="text" class="form-control" value="" name="icon" id="icon">
		<div class="invalid-feedback icon_error">
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-menu">Tambah</button>
</form>
<script>
	$('#user-sub-menu').submit(function (e) {
		$.ajax({
			url: '<?= base_url() ?>menu/tambah_subMenu',
			type: 'post',
			data: $(this).serialize(),
			dataType: 'json',
			success: (data) => {
				if (data.error) {
					if (data.error.sub_menu) {
						$("[name='sub_menu']").addClass("is-invalid");
						$(".sub_menu_error").html(data.error.sub_menu);
					} else {
						$("[name='sub_menu']").removeClass("is-invalid");
						$(".sub_menu_error").html("");
					}
					if (data.error.url) {
						$("[name='url']").addClass("is-invalid");
						$(".url_error").html(data.error.url);
					} else {
						$("[name='url']").removeClass("is-invalid");
						$(".url_error").html("");
					}
					if (data.error.icon) {
						$("[name='icon']").addClass("is-invalid");
						$(".icon_error").html(data.error.icon);
					} else {
						$("[name='icon']").removeClass("is-invalid");
						$(".icon_error").html("");
					}
				} else {
					if (data.status == 200) {
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
			}
		});
		e.preventDefault();
	});

</script>
