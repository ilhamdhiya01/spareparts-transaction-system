<table class="table table-bordered">
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
        foreach ($user_access as $menu) :
        ?>
		<tr>
			<th scope="row"><?= $no++; ?></th>
			<td><?= $menu['nama_menu'] ?></td>
			<td>
				<div class="custom-control custom-switch">
					<?php
                        $data = [
                            'level_id' => $level_id,
                            'menu_id' => $menu['id'],
                        ];
                        $cek_access = $this->db->get_where('tb_user_access_menu', $data)->num_rows();
                    ?>
					<input type="checkbox" name="level_id" data-levelid="<?= $level_id ?>"
						data-menuid="<?= $menu['id']; ?>" value="<?= $menu['id']; ?>" class="custom-control-input"
						id="access<?= $menu['id']; ?>" <?= $cek_access > 0 ? 'checked' : ''; ?>>
					<label class="custom-control-label" for="access<?= $menu['id']; ?>"></label>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script>
	$('[name="level_id"]').click(function () {
		const level_id = $(this).data('levelid');
		const menu_id = $(this).data('menuid');
		if ($(this).is(':checked')) {
			$.getJSON('<?= base_url() ?>menu/add_access', {
				level_id: level_id,
				menu_id: menu_id
			}, function (data) {
				console.log(data);
			});
		} else {
			$.getJSON('<?= base_url() ?>menu/add_access', {
				level_id: level_id,
				menu_id: menu_id
			}, function (data) {
				console.log(data);
			});
		}
	});

</script>
