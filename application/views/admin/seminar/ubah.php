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
                <form action="<?php echo base_url('seminar/simpan_perubahan'); ?>" method="post" enctype="multipart/form-data">
                 
                 <input type="hidden" name="seminar_id" value="<?php echo $seminar->smr_id ?>">

                 <div class="form-group">
                   <label>Nama Seminar *</label>
                   <input type="text" class="form-control" name="nama_seminar" value="<?php echo $seminar->smr_acara ?>">
                   <?php echo form_error('nama_seminar') ?>
                 </div>

                 <div class="form-group">
                   <label>Tanggal Pelaksanaan *</label>
                   <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo $seminar->smr_tanggal ?>">
                   <?php echo form_error('tanggal_pelaksanaan') ?>
                 </div>

                 <div class="form-group">
                   <label>Tempat Pelaksanaan *</label>
                   <input type="text" class="form-control" name="tempat_pelaksanaan" value="<?php echo $seminar->smr_tempat ?>">
                   <?php echo form_error('tempat_pelaksanaan') ?>
                 </div>

                 <div class="form-group">
                   <label>Jam Mulai *</label>
                   <input type="time" class="form-control" name="jam_mulai" value="<?php echo $seminar->smr_jam_mulai ?>">
                   <?php echo form_error('jam_mulai') ?>
                 </div>

                 <div class="form-group">
                   <label>Jam Selesai *</label>
                   <input type="time" class="form-control" name="jam_selesai" value="<?php echo $seminar->smr_jam_selesai ?>">
                   <?php echo form_error('jam_selesai') ?>
                 </div>

                 <div class="form-group">
                   <label>Nama Moderator *</label>
                   <input type="text" class="form-control" name="nama_moderator" value="<?php echo $seminar->smr_moderator ?>">
                   <?php echo form_error('nama_moderator') ?>
                 </div>

                 <div class="form-group">
                   <label>Biaya Mahasiswa *</label>
                   <input type="text" class="form-control" name="biaya_mhs" value="<?php echo $seminar->smr_biaya_mhs ?>">
                   <?php echo form_error('biaya_mhs') ?>
                 </div>

                 <div class="form-group">
                   <label>Biaya Umum *</label>
                   <input type="text" class="form-control" name="biaya_umum" value="<?php echo $seminar->smr_biaya_umum ?>">
                   <?php echo form_error('biaya_umum') ?>
                 </div>

                 <div class="form-group">
                   <label>Link Online</label>
                   <input type="text" class="form-control" name="link" value="<?php echo $seminar->smr_link_online ?>">
                 </div>

                 <div class="form-group">
                   <label>Jumlah Max Peserta *</label>
                   <input type="text" class="form-control" name="jumlah_max_peserta" value="<?php echo $seminar->smr_jumlahmax ?>">
                   <?php echo form_error('jumlah_max_peserta') ?>
                 </div>

                 <div class="form-group">
                   <label>Banner</label>
                   <br>
                   <img width="20%" src="<?php echo base_url('assets/banner_seminar/' . $seminar->smr_banner); ?>">
                   <br>
                   <small class="text-danger">File Sebelumnya</small>
                   <input type="file" class="form-control" name="gambar">
                   <input type="hidden" name="oldfile" value="<?php echo $seminar->smr_banner ?>">
                 </div>

                 <div class="form-group">
                   <label>Keterangan</label>
                   <textarea name="keterangan" class="form-control" rows="10" cols="80"><?php echo $seminar->smr_keterangan ?></textarea>
                 </div>

                 <div class="form-group">
                   <label>Model Sertifikat</label>
                   <select name="model_sertifikat" class="form-control">
                     <option value="">Pilih Salah Satu</option>
                     <?php foreach ($model as $m) { ?>
                       <option value="<?php echo $m->ms_id ?>" <?php if ($m->ms_id == $seminar->smr_model_sertifikat) {
                        echo 'selected';
                      } ?>><?php echo $m->ms_model ?></option>
                    <?php } ?>
                  </select>
                  <?php echo form_error('model_sertifikat') ?>
                </div>

                <button class="btn btn-success" type="submit">Ubah</button>
                <a href="<?php echo base_url('seminar') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </table>
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