<div class="row" style="display: block;">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2 id="form-title"><i class="fas fa-table"></i> Tabel Sub Menu</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fas fa-times"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="btn-sub-menu">
                <ul>
                    <li><a href="" data-toggle="modal" data-target="#tambah-sub-menu" class="btn btn-primary btn-sm" id="modal-tambah-sub-menu"><i class="fa fa-plus-square"></i> Tambah Sub Menu</a></li>
                    <li><a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a></li>
                    <li><a href="<?= base_url(); ?>menu/dropdown_subMenu" class="btn btn-light btn-sm"><i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" id="view-sub-menu">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah-sub-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-sub-menu-title">Tambah Sub Menu</h5>
                <button type="button" class="close" style="outline:none;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body view-form-sub-menu">

            </div>
        </div>
    </div>
</div>