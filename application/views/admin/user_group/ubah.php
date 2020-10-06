       <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->

              <div class="card-body">
                <form action="<?php echo base_url('usergroup/simpan_perubahan'); ?>" method="post">

                  <input type="hidden" name="usergroup_id" value="<?php echo $list->ug_id ?>">
                  <div class="form-group">
                    <label>Nama Group</label>
                    <input type="text" class="form-control" name="nama_group" value="<?php echo $list->ug_group ?>">
                    <?php echo form_error('nama_group') ?>
                  </div>

                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" cols="8" rows="8" name="keterangan"><?php echo $list->ug_keterangan ?></textarea>
                    <?php echo form_error('keterangan') ?>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="y" <?php if($list->ug_isaktif == 'y') { echo 'selected'; } ?>>Aktif</option>
                      <option value="n" <?php if($list->ug_isaktif == 'n') { echo 'selected'; } ?>>Tidak Aktif</option>
                    </select>
                    <?php echo form_error('status') ?>
                  </div>

                  <button class="btn btn-success" type="submit">Ubah</button>
                  <a href="<?php echo base_url('user_group') ?>" class="btn btn-danger">Kembali</a>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
  <!-- /.content -->