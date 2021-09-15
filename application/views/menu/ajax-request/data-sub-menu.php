<table id="table-sub-menu" class="table table-striped table-bordered view-data" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>User Menu</th>
            <th>Sub Menu</th>
            <th>Url</th>
            <th>Icon</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($sub_menu as $sub_menu) :
        ?>
            <tr id="tr-sub-menu">
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $sub_menu['nama_menu']; ?></td>
                <td><?= $sub_menu['sub_menu']; ?></td>
                <td><?= $sub_menu['url']; ?></td>
                <td><?= $sub_menu['icon']; ?></td>
                <td class="text-center">
                    <?php
                    switch ($sub_menu['is_active']) {
                        case 1:
                            echo '<span class="badge badge badge-success">Aktif</span>';
                            break;
                        case 0:
                            echo '<span class="badge badge badge-danger">Tidak Aktif</span>';
                            break;
                        default:
                            'tidak ada';
                    }
                    ?>
                </td>
                <td class="text-center">
                    <a href="" data-id="<?= $sub_menu['id']; ?>" class="badge badge-danger delete-sub-menu">Delete</a>
                    <a href="<?= base_url(); ?>menu/get_subMenuById/<?= $sub_menu['id']; ?>" class="badge badge-info ubah-sub-menu">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    // $('.ubah-sub-menu').click(function() {
    //     readFormUbahSubMenu();
    // });

    // function readFormUbahSubMenu() {
    //     $.ajax({
    //         url: 'http://localhost/spareparts-transaction-system/menu/formUbahSubMenu',
    //         type: 'get',
    //         success: function(data) {
    //             $('.view-ubah-sub-menu').html(data);
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     })
    // }
    // ubah sub menu
    // $('.ubah-sub-menu').click(function(e) {
    //     $('#btn-form').removeClass('tambah-sub-menu');
    //     $('#btn-form').addClass('ubah-sub-menu');
    //     let id = $(this).data('id');
    //     let id_menu = $('.option').val();
    //     $("#sub-menu-title").html("Ubah Sub Menu");
    //     $.ajax({
    //         url: "<?= base_url(); ?>menu/get_subMenuById",
    //         type: "post",
    //         dataType: "json",
    //         data: {
    //             id: id
    //         },
    //         success: function(data) {
    //             console.log(id_menu);
    //             if (data.response == 'success') {
    //                 $("#id-sub-menu").val(data.sub_menu_by_id.id);
    //                 $("#sub_menu").val(data.sub_menu_by_id.sub_menu);
    //                 $("#url").val(data.sub_menu_by_id.url);
    //                 $("#icon").val(data.sub_menu_by_id.icon);
    //                 if (data.sub_menu_by_id.is_active == 1) {
    //                     $("#is_active").attr("checked", "checked");
    //                 } else {
    //                     $("#is_active").removeAttr("checked", "checked");
    //                 }
    //                 if (data.sub_menu_by_id.dropdown > 0) {
    //                     $("#dropdown").attr("checked", "checked");
    //                 } else {
    //                     $("#dropdown").removeAttr("checked", "checked");
    //                 }
    //                 $(".ubah-sub-menu").click(function(e) {
    //                     $(".option").change(function() {
    //                         let id = $("#id-sub-menu").val();
    //                         let user_menu = $(this).val();
    //                         let sub_menu = $("#sub_menu").val();
    //                         let url = $("#url").val();
    //                         let icon = $("#icon").val();
    //                         let is_active = $("#is_active");
    //                         let dropdown = $("#dropdown").val();
    //                         $.ajax({
    //                             url: "<?= base_url(); ?>menu/proses_ubahSubMenu",
    //                             type: "poost",
    //                             data: {
    //                                 id : id,
    //                                 user_menu : user_menu,
    //                                 sub_menu : sub_menu,
    //                                 url : url,
    //                                 icon : icon,
    //                                 is_active : is_active,
    //                                 dropdown : dropdown
    //                             },
    //                             success : function(data){
    //                                 console.log('ok');
    //                             }
    //                         })
    //                     })
    //                     e.preventDefault();
    //                 });
    //                 $(".close").click(function() {
    //                     document.location.href = "<?= base_url(); ?>menu/dropdown_subMenu";
    //                 });
    //             } else {
    //                 $("#url").val(data.response);
    //             }
    //             console.log(data.sub_menu_by_id);
    //         }
    //     })
    //     e.preventDefault();
    // });
    // delete sub menu
    $('.delete-sub-menu').click(function(e) {
        $(this).closest('#tr-sub-menu').addClass('hapus-sub-menu');
        let id = $(this).data('id');
        swal({
                title: 'Hapus data ini ?',
                text: 'Data yang terhapus tidak akan kembali !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url(); ?>menu/delete_subMenu',
                        method: 'post',
                        dataType: 'json',
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
                                $('.hapus-sub-menu').fadeOut(1500);
                                // setTimeout(() => {
                                //     document.location.href = '<?= base_url(); ?>menu/dropdown_subMenu';
                                // }, 2000)
                            } else {
                                iziToast.warning({
                                    title: 'Failed',
                                    message: data.message,
                                    position: 'topRight'
                                });
                            }
                        }
                    })
                } else {
                    swal('Membatalkan penghapusan data');
                }
            });
        e.preventDefault();
    });
</script>