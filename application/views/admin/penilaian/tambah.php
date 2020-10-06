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

               <form action="<?php echo base_url('penilaian/simpan'); ?>" method="post">

                <div class="form-group">
                  <label>Sertifikasi</label>
                  <select name="sertifikasi" class="form-control">
                    <option value="">Pilih Salah Satu</option>
                    <?php foreach($sertifikasi as $s) : ?>
                      <option value="<?php echo $s->cert_id ?>" <?php echo set_value('sertifikasi') == $s->cert_id ? 'selected' : null ?>><?php echo $s->cert_sertifikasi ?></option>
                    <?php endforeach ?>
                  </select>
                  <?php echo form_error('sertifikasi') ?>
                </div>

                <div class="form-group">
                  <label>Nilai Minimal</label>
                  <input type="text" name="nilai_min" class="form-control" value="<?php echo set_value('nilai_min') ?>">
                  <?php echo form_error('nilai_min') ?>
                </div>

                <div class="form-group">
                  <label>Nilai Maximal</label>
                  <input type="text" name="nilai_max" class="form-control" value="<?php echo set_value('nilai_max') ?>">
                  <?php echo form_error('nilai_max') ?>
                </div>

                <div class="form-group">
                  <label>Grade</label>
                  <input type="text" name="grade" class="form-control" value="<?php echo set_value('grade') ?>">
                  <?php echo form_error('grade') ?>
                </div>

                <div class="form-group">
                  <label>Penghargaan</label>
                  <input type="text" name="penghargaan" class="form-control" value="<?php echo set_value('penghargaan') ?>">
                  <?php echo form_error('penghargaan') ?>
                </div>

                <div class="form-group">
                  <label>Lembaga Sertifikat</label>
                  <input type="text" name="lembaga" class="form-control" value="<?php echo set_value('lembaga') ?>">
                  <?php echo form_error('lembaga') ?>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="">Pilih Salah Satu</option>
                    <option value="Lulus" <?php echo set_value('status') == 'Lulus' ? 'selected' : null ?>>Lulus</option>
                    <option value="Tidak Lulus" <?php echo set_value('status') == 'Tidak Lulus' ? 'selected' : null ?>>Tidak Lulus</option>
                  </select>
                  <?php echo form_error('status') ?>
                </div>

                <button class="btn btn-success" type="submit">Tambah</button>
                <a href="<?php echo base_url('penilaian') ?>" class="btn btn-danger">Kembali</a>
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