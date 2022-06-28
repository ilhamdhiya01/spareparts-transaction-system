<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Menu</th>
			<th scope="col">Access</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $no = 1;
        foreach ($user_menu as $menu) :
        ?>
		<tr id="show-menu">
			<th scope="row"><?= $no++; ?></th>
			<td><?= $menu['nama_menu'] ?></td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default">Action</button>
					<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu" role="menu">
						<a class="dropdown-item delete-menu" href="#" data-menuid="<?= $menu['id']; ?>"><i
								class="fas fa-trash"></i> Delete</a>
						<a class="dropdown-item update-menu" href="#" data-menuid="<?= $menu['id']; ?>"><i
								class="fas fa-edit"></i> Update</a>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script>
	$('.delete-menu').click(function () {
		$(this).closest('#show-menu').addClass('hide-menu');
		$.getJSON('<?= base_url() ?>menu/delete_userMenu', {
			menu_id: $(this).data('menuid')
		}, function (data) {
			if (data.response == 'success') {
				$('.hide-menu').fadeOut(800);
			}
		});
	});

	$('.update-menu').click(function () {
		$.get('<?= base_url() ?>menu/formUbahMenu', function (data) {
			$('.view-form-user-menu').html(data);
		});
        $.getJSON('<?= base_url() ?>menu/get_userMenuById', {
            menu_id: $(this).data('menuid')
        }, function (data) {
            $("#ubah_nama_menu").val(data.menu.nama_menu);
            $("#menu_id").val(data.menu.id);
        });
	});

</script>
