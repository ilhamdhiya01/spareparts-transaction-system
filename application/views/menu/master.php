<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0"><?= $judul; ?></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>menu">Home</a></li>
					<li class="breadcrumb-item active"><?= $judul; ?></li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><i class="fas fa-table"></i> </h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse"
										title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive view-master">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<div class="modal fade" id="tambah-service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-master-title">Tambah Service</h5>
				<button type="button" class="close" style="outline:none;" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body view-form-master">
			</div>
		</div>
	</div>
</div>
<script>
	$.get('<?= base_url() ?>master/data_master', function (data) {
		$('.view-master').html(data);
	});
	$('#modal-tambah-master').click(function () {
        $('#tambah-service').modal('show')
		$.get('<?= base_url() ?>master/formAddMaster', function (data) {
			$('.view-form-master').html(data);
		});
	});
</script>