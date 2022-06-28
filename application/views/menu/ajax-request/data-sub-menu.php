<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Menu</th>
			<th scope="col">Sub Menu</th>
			<th scope="col">Url</th>
			<th scope="col">Icon</th>
			<th scope="col">Status Menu</th>
			<th scope="col">Status Dropdown</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $no = 1;
        foreach ($sub_menu as $menu) :
        ?>
		<tr id="show-sub-menu">
			<th scope="row"><?= $no++; ?></th>
			<td><?= $menu['nama_menu'] ?></td>
			<td><?= $menu['sub_menu'] ?></td>
			<td><?= $menu['url'] ?></td>
			<td><?= $menu['icon'] ?></td>
			<td class="text-center">
				<div class="d-flex justify-content-center align-items-center">
					<div class="custom-control custom-switch">
						<input type="checkbox" name="is_active" <?=$menu['is_active'] == 1 ? 'checked' : ''; ?>
							value="<?=$menu['is_active']; ?>" class="custom-control-input"
							data-isactive="<?=$menu['is_active']; ?>" data-subid="<?=$menu['id']; ?>"
							id="is_active<?=$menu['id']; ?>">
						<label class="custom-control-label" for="is_active<?=$menu['id']; ?>"></label>
					</div>
					<span
						class="status_sub<?=$menu['id']; ?> badge <?=$menu['is_active'] == 1 ? 'badge-success' : 'badge-danger'; ?>"><?= $menu['is_active'] == 1 ? 'Active' : 'Inactive'; ?></span>
				</div>
			</td>
			<td class="text-center">
				<div class="d-flex justify-content-center align-items-center">
					<div class="custom-control custom-switch">
						<input type="checkbox" name="dropdown" <?=$menu['dropdown'] == 1 ? 'checked' : ''; ?>
							value="<?=$menu['dropdown']; ?>" class="custom-control-input"
							data-dropdown="<?=$menu['dropdown']; ?>" data-subid="<?=$menu['id']; ?>"
							id="dropdown<?=$menu['id']; ?>">
						<label class="custom-control-label" for="dropdown<?=$menu['id']; ?>"></label>
					</div>
					<span
						class="status_dropdown<?=$menu['id']; ?> badge <?=$menu['dropdown'] == 1 ? 'badge-success' : 'badge-danger'; ?>"><?= $menu['dropdown'] == 1 ? 'Active' : 'Inactive'; ?></span>
				</div>
			</td>
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
	$('[name="is_active"]').click(function () {
		const subid = $(this).data('subid');
		const isactive = $(this).data('isactive');
		if ($(this).is(':checked')) {
			$(`.status_sub${subid}`).html('Active');
			$(`.status_sub${subid}`).removeClass('badge-danger').addClass('badge-success');
			$.getJSON('<?= base_url() ?>menu/submenu_active', {
				subid: subid,
				isactive: isactive,
			}, function (data) {
				console.log(data);
			});
		} else {
			$(`.status_sub${subid}`).html('Inactive');
			$(`.status_sub${subid}`).removeClass('badge-success').addClass('badge-danger');
			$.getJSON('<?= base_url() ?>menu/submenu_inactive', {
				subid: subid,
				isactive: isactive,
			}, function (data) {
				console.log(data);
			});
		}
	});

	$('[name="dropdown"]').click(function () {
		const subid = $(this).data('subid');
		const dropdown = $(this).data('dropdown');
		if ($(this).is(':checked')) {
			$(`.status_dropdown${subid}`).html('Active');
			$(`.status_dropdown${subid}`).removeClass('badge-danger').addClass('badge-success');
			$.getJSON('<?= base_url() ?>menu/dropdown_active', {
				subid: subid,
				dropdown: dropdown,
			}, function (data) {
				console.log(data);
			});
		} else {
			$(`.status_dropdown${subid}`).html('Inactive');
			$(`.status_dropdown${subid}`).removeClass('badge-success').addClass('badge-danger');
			$.getJSON('<?= base_url() ?>menu/dropdown_inactive', {
				subid: subid,
				dropdown: dropdown,
			}, function (data) {
				console.log(data);
			});
		}
	});

</script>
