<table class="table table-bordered" id="myTable">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Sub Menu</th>
            <th scope="col">Nama</th>
            <th scope="col">Url</th>
            <th scope="col" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($dropdown_menu as $dropdown) :
        ?>
            <tr id="tr-dropdown-menu">
                <th scope="row"><?= $no++; ?></th>
                <td><?= $dropdown['sub_menu']; ?></td>
                <td><?= $dropdown['dropdown_nama']; ?></td>
                <td><?= $dropdown['url']; ?></td>
                <td width="10px">
                    <a href="" data-id="<?= $dropdown['id']; ?>" class="delete-dropdown-menu"><i class="fa fa-trash"></i></a>
                </td>
                <td width="10px">
                    <a href="" data-id="<?= $dropdown['id']; ?>" class="btn-ubah-dropdown"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(".btn-ubah-dropdown").click(function(e) {
        $("#nama_dropdown").removeClass("is-invalid");
        $(".nama_dropdown_error").html('');

        $("#url_dropdown").removeClass("is-invalid");
        $(".url_dropdown_error").html('');

        const id = $(this).data('id');
        $(".tambah-dropdown").css("display", "none");
        $(".ubah-dropdown").removeAttr("style");
        $("#tambahDropdown").removeAttr("style");
        $.ajax({
            url: "<?= base_url(); ?>menu/get_dropdown_by_id",
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#id_dropdown").val(data.dropdown_by_id.id);
                $("#nama_dropdown").val(data.dropdown_by_id.dropdown_nama);
                $("#url_dropdown").val(data.dropdown_by_id.url);

                $(".ubah-dropdown").click(function(event) {
                    const id_dropdown = $("#id_dropdown").val();
                    const sub_menu_id = $("#sub_menu_id").val();
                    const nama_dropdown = $("#nama_dropdown").val();
                    const url_dropdown = $("#url_dropdown").val();

                    $.ajax({
                        url: "<?= base_url(); ?>menu/proses_ubah_dropdown",
                        type: "post",
                        data: {
                            id_dropdown: id_dropdown,
                            sub_menu_id: sub_menu_id,
                            nama_dropdown: nama_dropdown,
                            url_dropdown: url_dropdown
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.response == "success") {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });

                                function readDropdownMenu() {
                                    $.ajax({
                                        url: "http://localhost/spareparts-transaction-system/menu/ambilDataDropdownMenu",
                                        type: "get",
                                        data: {
                                            id_sub: $("#id-sub-menu").val(),
                                        },
                                        success: function(data) {
                                            $(".view-dropdown-menu").html(data);
                                            console.log(data);
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                        },
                                    });
                                }
                                readDropdownMenu();
                            }
                        }
                    });
                    event.preventDefault();
                });
            }
        });
        e.preventDefault();
    });

    $(".delete-dropdown-menu").click(function(e) {
        $(this).closest("#tr-dropdown-menu").addClass('hapus-dropdown-menu');
        const id = $(this).data("id");
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
                    url: "<?= base_url(); ?>menu/hapus_dropdown_menu",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.response == 'success') {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $(".hapus-dropdown-menu").fadeOut(1500);
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: 'Data gagal dihapus',
                                position: 'topRight'
                            });
                        }
                    }
                })
            }
        })
        e.preventDefault();
    });
</script>