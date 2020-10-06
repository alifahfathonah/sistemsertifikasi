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
                <form action="<?php echo base_url('user/simpan'); ?>" method="post">
                  
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo set_value('email') ?>">
                    <?php echo form_error('email') ?>
                  </div>

                  <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama') ?>">
                    <?php echo form_error('nama') ?>
                  </div>

                  <div class="form-group">
                    <label>User Group</label>
                    <select name="user_group" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <?php foreach($usergroup as $u) : ?>
                        <option value="<?php echo $u->ug_id ?>" <?php echo set_value('user_group') == $u->ug_id ? 'selected' : null ?>><?php echo $u->ug_group ?></option>
                      <?php endforeach ?>
                    </select>
                    <?php echo form_error('user_group') ?>
                  </div>

                  <div class="form-group">
                    <label>Prodi</label>
                    <select name="prodi" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="0"  <?php echo set_value('prodi') == '0' ? 'selected' : null ?>>Tidak ada Prodi</option>
                      <option value="11" <?php echo set_value('prodi') == '11' ? 'selected' : null ?>>Teknik Sipil</option>
                      <option value="12" <?php echo set_value('prodi') == '12' ? 'selected' : null ?>>Arsitektur</option>
                      <option value="21" <?php echo set_value('prodi') == '21' ? 'selected' : null ?>>Teknik Elektro</option>
                      <option value="31" <?php echo set_value('prodi') == '31' ? 'selected' : null ?>>Sistem Informasi</option>
                      <option value="32" <?php echo set_value('prodi') == '32' ? 'selected' : null ?>>Teknologi Informasi</option>
                      <option value="41" <?php echo set_value('prodi') == '41' ? 'selected' : null ?>>Manajemen</option>
                      <option value="42" <?php echo set_value('prodi') == '42' ? 'selected' : null ?>>Akuntansi</option>
                      <option value="53" <?php echo set_value('prodi') == '53' ? 'selected' : null ?>>Magister Manajemen</option>
                      <option value="55" <?php echo set_value('prodi') == '55' ? 'selected' : null ?>>Pariwisata</option>
                      <option value="51" <?php echo set_value('prodi') == '51' ? 'selected' : null ?>>Ilmu Hukum</option>
                      <option value="52" <?php echo set_value('prodi') == '52' ? 'selected' : null ?>>Magister Hukum</option>
                      <option value="56" <?php echo set_value('prodi') == '56' ? 'selected' : null ?>>Pendidikan Bahasa Inggris</option>
                    </select>
                    <?php echo form_error('prodi') ?>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="y" <?php echo set_value('status') == 'y' ? 'selected' : null ?>>Aktif</option>
                      <option value="n" <?php echo set_value('status') == 'n' ? 'selected' : null ?>>Non Aktif</option>
                    </select>
                    <?php echo form_error('status') ?>
                  </div>

                  <button class="btn btn-success" type="submit">Tambah</button>
                  <a href="<?php echo base_url('user') ?>" class="btn btn-secondary">Kembali</a>
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