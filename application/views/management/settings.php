<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('management/update_setting') ?>" method="post">
                <?php if (isset($setting)): ?>  
                    <input type="hidden" name="id" value="<?= $setting->id_setting ?>">
                <?php else: ?>
                    <input type="hidden" name="id">
                <?php endif ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Client KEY (Midtrans)</label>
                        <?php if (isset($setting)): ?>
                            <input type="text" class="form-control" value="<?= $setting->client_key ?>" name="client_key" placeholder="Server Key Midtrans">
                        <?php else: ?>
                            <input type="text" class="form-control" name="client_key" placeholder="Server Key Midtrans">
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Server KEY (Midtrans)</label>
                        <?php if (isset($setting)): ?>
                            <input type="text" class="form-control" name="server_key" value="<?= $setting->server_key ?>" placeholder="Server Key Midtrans">
                        <?php else: ?>
                            <input type="text" class="form-control" name="server_key" placeholder="Server Key Midtrans">
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Nominal Biaya</label>
                        <?php if (isset($setting)): ?>
                            <input type="number" class="form-control" name="nominal" value="<?= $setting->nominal ?>" placeholder="Nominal Biaya">
                        <?php else: ?>
                            <input type="number" class="form-control" name="nominal" placeholder="Nominal Biaya">
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="reset" class="btn btn-warning btn-md">Reset</button>
                        &nbsp;&nbsp;
                        <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>

</script>