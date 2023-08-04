<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>

            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5><i class="icon fas fa-ban"></i>Alert!</h5>
                            <?php echo validation_list_errors(); ?>
                        </div>
                    <?php
                    } ?>
                    <?php
                    if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5><i class="fa-solid fa-circle-exclamation"></i> Error</h5>
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php
                    } ?>
                    <?php echo csrf_field(); ?>
                    <?php
                    if (current_url(true)->getSegment(2) == 'edit') {
                    ?>
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kode_kategori']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kode_kategori">Kode Kategori</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('kode_kategori')) ? (empty($edit_data['kode_kategori']) ? "" : $edit_data['kode_kategori']) : set_value('kode_kategori'); ?>" id="kode_kategori" name="kode_kategori">
                    </div>
                    <div class="form-group">
                        <label for="nama_rak">Nama Rak</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('nama_rak')) ? (empty($edit_data['nama_rak']) ? "" : $edit_data['nama_rak']) : set_value('nama_rak'); ?>" id="nama_rak" name="nama_rak">
                    </div>
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('nama_kategori')) ? (empty($edit_data['nama_kategori']) ? "" : $edit_data['nama_kategori']) : set_value('nama_kategori'); ?>" id="nama_kategori" name="nama_kategori">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_item">Jumlah Item</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('jumlah_item')) ? (empty($edit_data['jumlah_item']) ? "" : $edit_data['jumlah_item']) : set_value('jumlah_item'); ?>" id="jumlah_item" name="jumlah_item">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                        <a class="btn btn-danger float-right" href="javascript:history.back()"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php
    echo $this->endSection();
