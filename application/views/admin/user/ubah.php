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
                <form action="<?php echo base_url('user/simpan_perubahan'); ?>" method="post">

                  <input type="hidden" class="form-control" name="user_id" value="<?php echo $list->usr_email ?>">

                  <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $list->usr_nama ?>">
                    <?php echo form_error('nama') ?>
                  </div>

                  <div class="form-group">
                    <label>User Group</label>
                    <select name="user_group" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <?php foreach($usergroup as $u) : ?>
                        <option value="<?php echo $u->ug_id ?>" <?php if($u->ug_id == $list->usr_group) { echo 'selected'; } ?> ><?php echo $u->ug_group ?></option>
                      <?php endforeach ?>
                    </select>
                    <?php echo form_error('user_group') ?>
                  </div>

                  <div class="form-group">
                    <label>Prodi</label>
                    <select name="prodi" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="0"  <?php if($list->usr_prodi == '0')  { echo 'selected';}  ?>>Tidak ada Prodi</option>
                      <option value="11" <?php if($list->usr_prodi == '11') { echo 'selected';} ?>>Teknik Sipil</option>
                      <option value="12" <?php if($list->usr_prodi == '12') { echo 'selected';} ?>>Arsitektur</option>
                      <option value="21" <?php if($list->usr_prodi == '21') { echo 'selected';} ?>>Teknik Elektro</option>
                      <option value="31" <?php if($list->usr_prodi == '31') { echo 'selected';} ?>>Sistem Informasi</option>
                      <option value="32" <?php if($list->usr_prodi == '32') { echo 'selected';} ?>>Teknologi Informasi</option>
                      <option value="41" <?php if($list->usr_prodi == '41') { echo 'selected';} ?>>Manajemen</option>
                      <option value="42" <?php if($list->usr_prodi == '42') { echo 'selected';} ?>>Akuntansi</option>
                      <option value="53" <?php if($list->usr_prodi == '53') { echo 'selected';} ?>>Magister Manajemen</option>
                      <option value="55" <?php if($list->usr_prodi == '55') { echo 'selected';} ?>>Pariwisata</option>
                      <option value="51" <?php if($list->usr_prodi == '51') { echo 'selected';} ?>>Ilmu Hukum</option>
                      <option value="52" <?php if($list->usr_prodi == '52') { echo 'selected';} ?>>Magister Hukum</option>
                      <option value="56" <?php if($list->usr_prodi == '56') { echo 'selected';} ?>>Pendidikan Bahasa Inggris</option>
                    </select>
                    <?php echo form_error('prodi') ?>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="y" <?php if($list->usr_isaktif == 'y') { echo 'selected';} ?>>Aktif</option>
                      <option value="n" <?php if($list->usr_isaktif == 'n') { echo 'selected';} ?>>Non Aktif</option>
                    </select>
                    <?php echo form_error('status') ?>
                  </div>

                  <button class="btn btn-success" type="submit">Ubah</button>
                  <a href="<?php echo base_url('user') ?>" class="btn btn-danger">Kembali</a>
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