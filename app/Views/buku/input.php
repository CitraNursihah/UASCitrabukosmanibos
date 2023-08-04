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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kode_buku']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kode_buku">Kode Buku</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('kode_buku')) ? (empty($edit_data['kode_buku']) ? "" : $edit_data['kode_buku']) : set_value('kode_buku'); ?>" id="kode_buku" name="kode_buku">
                    </div>
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('judul_buku')) ? (empty($edit_data['judul_buku']) ? "" : $edit_data['judul_buku']) : set_value('judul_buku'); ?>" id="judul_buku" name="judul_buku">
                    </div>
                    <div class="form-group">
                        <label for="harga_buku">Harga Buku</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('harga_buku')) ? (empty($edit_data['harga_buku']) ? "" : $edit_data['harga_buku']) : set_value('harga_buku'); ?>" id="harga_buku" name="harga_buku">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('stok')) ? (empty($edit_data['stok']) ? "" : $edit_data['stok']) : set_value('stok'); ?>" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('kategori')) ? (empty($edit_data['kategori']) ? "" : $edit_data['kategori']) : set_value('kategori'); ?>" id="kategori" name="kategori">
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
