<div class="card card-row card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Spareparts
        </h3>
    </div>
    <div class="card-body auto">
        <?php foreach ($jenis_spareparts as $spareparts) : ?>
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h5 class="card-title"><?= $spareparts['nama_spareparts']; ?></h5>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool tambah-sub-spareparts" title="Tambah Spareparts" data-idjenis="<?= $spareparts['id']; ?>" data-toggle="modal" data-target="#modal-form-sub">
                            <i class="fas fa-plus"></i>
                        </a>
                        <script>
                            $(".tambah-sub-spareparts").click(function() {
                                $("#sub-title").html("<i class='fas fa-plus'></i> Tambah Sub Spareparts");
                                $.ajax({
                                    url: "<?= base_url(); ?>spareparts/load_sub_spareparts",
                                    type: "get",
                                    data: {
                                        id_jenis_spareparts: $(this).data("idjenis")
                                    },
                                    success: function(data) {
                                        $(".form-sub-spareparts").html(data);
                                    }
                                })
                            });
                        </script>
                    </div>
                </div>
                <div class="card-body auto_sub">
                    <table class="table table-striped table-bordered table-sm" id="tab3">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Spareparts</th>
                                <th scope="col">Harga</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $this->db->select('tb_sub_spareparts.*');
                            $this->db->where('id_spareparts', $spareparts['id']);
                            $this->db->order_by('id', 'DESC');
                            $sub_spareparts = $this->db->get('tb_sub_spareparts')->result_array();

                            foreach ($sub_spareparts as $sub) :
                            ?>
                                <tr id="li-sub-spareparts">
                                    <th class="text-center"><?= $no++; ?></th>
                                    <td><?= $sub['nama_spareparts']; ?></td>
                                    <td><?= rupiah($sub['harga']); ?></td>
                                    <td class="text-center"><i class="fas fa-times hapus-sub-spareparts" data-idsub="<?= $sub['id']; ?>" title="Hapus"></i></td>
                                    <td class="text-center"><i class="fas fa-pencil-alt ubah-sub-spareparts" data-idjenis="<?= $spareparts['id']; ?>" data-idsub="<?= $sub['id']; ?>" data-toggle="modal" data-target="#modal-form-sub" title="Ubah"></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(".hapus-sub-spareparts").hover(function() {
        $(this).css("cursor", "pointer");
    });
    $(".ubah-sub-spareparts").hover(function() {
        $(this).css("cursor", "pointer");
    });
    $(".hapus-sub-spareparts").click(function() {
        $(this).closest("#li-sub-spareparts").addClass("hapus-sub");
        const id_sub = $(this).data("idsub");
        Swal.fire({
            title: 'Hapus data ini ?',
            text: 'Data yang terhapus tidak akan kembali !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url(); ?>spareparts/hapus_sub",
                    type: "post",
                    dataType: "json",
                    data: {
                        id_sub: id_sub
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $(".hapus-sub").fadeOut(1000);
                        } else {
                            iziToast.error({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                        }
                    }
                })
            }
        });
    });

    $(".ubah-sub-spareparts").click(function() {
        $("#sub-title").html("<i class='fas fa-edit'></i> Ubah Sub Spareparts");
        const id_sub_spareparts = $(this).data("idsub");
        const id_jenis_spareparts = $(this).data("idjenis");
        console.log(id_sub_spareparts);
        $.ajax({
            url: "<?= base_url(); ?>spareparts/load_ubah_sub_spareparts",
            type: "get",
            data: {
                id_jenis_spareparts: id_jenis_spareparts,
                id_sub_spareparts: id_sub_spareparts
            },
            success: function(data) {
                $(".form-sub-spareparts").html(data);
            }
        });
    });
</script>