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
               <form action="<?php echo base_url('pelatih_subsertifikasi/simpan_perubahan'); ?>" method="post">

                 <input type="hidden" name="batch_id" value="<?php echo $pelatih->ps_batch ?>">
                 <input type="hidden" name="pelatih_id" value="<?php echo $pelatih->ps_email ?>">

                 <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $pelatih->ps_nama ?>">
                  <?php echo form_error('nama') ?>
                </div>

                <div class="form-group">
                  <label>Asal Institusi <small>Isi Jika ada</small></label>
                  <input type="text" class="form-control" name="asal_institusi" value="<?php echo $pelatih->ps_institusi ?>">
                </div>

                <div class="form-group">
                  <label>Sebagai <small>Isi Jika ada</small></label>
                  <input type="text" class="form-control" name="sebagai" value="<?php echo $pelatih->ps_sebagai ?>">
                </div>

                <button class="btn btn-success" type="submit">Ubah</button>
                <a href="<?php echo base_url('pelatih_subsertifikasi') ?>" class="btn btn-danger">Kembali</a>
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