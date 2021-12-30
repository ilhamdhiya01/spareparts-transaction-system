<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-dark">
    <div class="p-2 m-3">
        <h4 class="pb-2 text-white">Form Registration</h4>
        <form method="POST" action="<?= base_url(); ?>auth/registration">
            <div class="form-group">
                <label for="name" class="text-white">Nama</label>
                <input id="name" type="text" class="form-control" name="nama_pegawai">
            </div>
            <div class="form-group">
                <label for="posisi" class="text-white">Posisi</label>
                <select class="form-control selectric" name="posisi">
                    <option>-- Pilih --</option>
                    <?php foreach ($posisi as $data) : ?>
                        <option value="<?= $data['id']; ?>"><?= $data['nama_posisi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="username" class="text-white">Username</label>
                <input id="username" type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label text-white">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password">
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label text-white">Konfirmasi Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="konfirmasi-password">
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    Registration
                </button>
            </div>
        </form>
    </div>
</div>