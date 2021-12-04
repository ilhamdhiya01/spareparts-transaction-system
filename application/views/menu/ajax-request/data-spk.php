<table class="table table-bordered" id="spk">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kd_service</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">Tipe Mobil</th>
            <th scope="col">Tanggal Service</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="tr-spk">
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#spk').DataTable({
            "serverSide": true,
            "ajax": {
                url: '<?= base_url(); ?>service/data_spk',
                type: 'post',
                dataType: "json",
                success: function(data) {
                    console.log(data.data_service[0].kd_service);
                    const no = 1;
                    for (let i = 0; i < data.data_service.length; i++) {
                        const html = ` <tr>
                                            <th>${no}</th>
                                            <td>${data.data_service[i].kd_service}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>`;
                        $("#tr-spk").html(html);
                    }
                }
            }
        });
    });
</script>