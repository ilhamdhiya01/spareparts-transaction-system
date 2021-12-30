<table class="table table-striped table-bordered table-sm" id="tab2">
    <thead>
        <tr class="text-center text-sm">
            <th scope="col">No</th>
            <th scope="col">Kode Sparepart</th>
            <th scope="col">Nama Spareparts</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($jenis_spareparts as $spareparts) :
        ?>
            <tr class="text-center text-sm" id="tr-spareparts">
                <th><?= $no++; ?></th>
                <td><?= $spareparts['kd_spareparts']; ?></td>
                <td><?= $spareparts['nama_spareparts']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item delete-spareparts" href="#" data-idspareparts="<?= $spareparts['id']; ?>"><i class="fas fa-trash"></i> Hapus Spareparts</a>
                            <a class="dropdown-item update-spareparts" href="#" data-idspareparts="<?= $spareparts['id']; ?>"><i class="fas fa-edit"></i> Ubah Spareparts
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    // delete spareparts
    $(".delete-spareparts").click(function(e) {
        const id_spareparts = $(this).data("idspareparts");
        $(this).closest("#tr-spareparts").addClass("hapus-spareparts");
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
                    url: "<?= base_url(); ?>spareparts/hapus_data_spareparts",
                    type: "post",
                    data: {
                        id_spareparts: id_spareparts
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $(".hapus-spareparts").fadeOut(1000);
                            $.ajax({
                                url: "<?= base_url(); ?>spareparts/load_form_spareparts",
                                type: "get",
                                success: function(data) {
                                    $(".form-spareparts").html(data);
                                }
                            });
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: 'Data gagal di hapus',
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        });
        e.preventDefault();
    });

    // update spareparts
    $(".update-spareparts").click(function(e) {
        $(".proses-tambah-spareparts").attr("style", "display:none;");
        $(".proses-ubah-spareparts").removeAttr("style");
        const id_spareparts = $(this).data("idspareparts");
        // ambil data berdasarkan id
        $.ajax({
            url: "<?= base_url(); ?>spareparts/ambil_data_spareparts",
            type: "post",
            data: {
                id_spareparts: id_spareparts
            },
            dataType: "json",
            success: function(data) {
                $("[name='kd_spareparts']").val(data.data_by_id.kd_spareparts);
                $("[name='nama_spareparts']").val(data.data_by_id.nama_spareparts);
                // proses ubah
                $(".proses-ubah-spareparts").click(function(e) {
                    $.ajax({
                        url: "<?= base_url(); ?>spareparts/proses_ubah_spareparts",
                        type: "post",
                        data: {
                            id_spareparts: id_spareparts,
                            kd_spareparts: $("[name='kd_spareparts']").val(),
                            nama_spareparts: $("[name='nama_spareparts']").val()
                        },
                        dataType: "json", 
                        beforeSend: function() {
                            $(".proses-ubah-spareparts").attr('disable', 'disabled');
                            $(".proses-ubah-spareparts").html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $(".proses-ubah-spareparts").removeAttr('disable');
                            $(".proses-ubah-spareparts").html('Ubah');
                        },
                        success: function(data) {
                            if (data.status == 200) {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });
                                $.ajax({
                                    url: "<?= base_url(); ?>spareparts/load_form_spareparts",
                                    type: "get",
                                    success: function(data) {
                                        $(".form-spareparts").html(data);
                                    }
                                });
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Data gagal di ubah',
                                    position: 'topRight'
                                });
                            }

                        }
                    });
                    e.preventDefault();
                });
            }
        });
        e.preventDefault();
    });
</script>