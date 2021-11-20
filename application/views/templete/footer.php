<!-- /.content -->
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
    </div>
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <a href="#" class="nav-link sign-out" style="border-bottom:1px solid #494E54;">
        <i class="nav-icon fas fa-sign-out-alt"></i> Sign out
    </a>
    <script>
        $(".sign-out").click(function() {
            Swal.fire({
                title: 'Keluar dari sistem ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sign out'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url(); ?>auth/sign_out",
                        type: "post",
                        dataType: "json",
                        success: function(data) {
                            if(data.response == 'success'){
                                Swal.fire({
                                    title: data.message,
                                    icon: data.response,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url(); ?>"
                                    }
                                })
                            }
                        }
                    })
                }
            })
        });
    </script>
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- JS Libraries -->
<!-- iziToast -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/izitoast/dist/js/iziToast.min.js"></script>
<!-- sweetalert2 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- smartWizard -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- select2 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<!-- smartWizard -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/jquery-smartwizard-master/dist/js/jquery.smartWizard.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- dataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-autofill/js/dataTables.autoFill.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/AdminLTE/dist/js/adminlte.js"></script>
<!-- my js -->
<script src="<?= base_url(); ?>assets/js/ajax-request.js"></script>
<!-- detec mobile or browser -->
<script src="<?= base_url(); ?>assets/js/detectmobilebrowser.js"></script>
</body>

</html>