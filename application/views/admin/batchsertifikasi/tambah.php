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
                <form action="<?php echo base_url('batch_sertifikasi/simpan'); ?>" method="post" enctype="multipart/form-data">

                 <div class="form-group">
                   <label>Nama Sub Sertifikasi *</label>
                   <select name="sub_sertifikasi" class="form-control">
                    <option value="">Pilih Salah Satu</option>
                    <?php foreach($subsertifikasi as $s) : ?>
                      <option value="<?php echo $s->scert_id ?>" <?php echo set_value('sub_sertifikasi') == $s->scert_id ? "selected" : null ?> ><?php echo $s->scert_subsertifikasi ?></option>
                    <?php endforeach ?>
                  </select>
                  <?php echo form_error('sub_sertifikasi') ?>
                </div>

                <div class="form-group">
                 <label>Jumlah Pertemuan *</label>
                 <input type="text" class="form-control" name="jumlah_pertemuan" value="<?php echo set_value('jumlah_pertemuan') ?>">
                 <?php echo form_error('jumlah_pertemuan') ?>
               </div>

               <div class="form-group">
                 <label>Tanggal Daftar *</label>
                 <input type="date" class="form-control" name="tanggal_daftar" value="<?php echo set_value('tanggal_daftar') ?>">
                 <?php echo form_error('tanggal_daftar') ?>
               </div>

               <div class="form-group">
                 <label>Tanggal Terakhir Daftar *</label>
                 <input type="date" class="form-control" name="tanggal_terakhir" value="<?php echo set_value('tanggal_terakhir') ?>">
                 <?php echo form_error('tanggal_terakhir') ?>
               </div>

               <div class="form-group">
                 <label>Biaya Mahasiswa *</label>
                 <input type="text" class="form-control uang" name="biaya_mhs" value="<?php echo set_value('biaya_mhs') ?>">
                 <?php echo form_error('biaya_mhs') ?>
               </div>

               <div class="form-group">
                 <label>Biaya Umum *</label>
                 <input type="text" class="form-control uang" name="biaya_umum" value="<?php echo set_value('biaya_umum') ?>">
                 <?php echo form_error('biaya_umum') ?>
               </div>

               <div class="form-group">
                 <label>Jumlah Max Peserta *</label>
                 <input type="text" class="form-control input-rupiah" name="jumlah_max_peserta" value="<?php echo set_value('jumlah_max_peserta') ?>">
                 <?php echo form_error('jumlah_max_peserta') ?>
               </div>

               <div class="form-group">
                 <label>Jumlah Min Peserta *</label>
                 <input type="text" class="form-control" name="jumlah_min_peserta" value="<?php echo set_value('jumlah_min_peserta') ?>">
                 <?php echo form_error('jumlah_min_peserta') ?>
               </div>

               <div class="form-group">
                 <label>Banner *</label>
                 <input type="file" class="form-control" name="banner">
                 <?php echo form_error('banner') ?>
               </div>

               <div class="form-group">
                 <label>Keterangan *</label>
                 <textarea name="keterangan" class="form-control" rows="10" cols="80"><?php echo set_value('keterangan') ?></textarea>
                 <?php echo form_error('keterangan') ?>
               </div>

               <button class="btn btn-success" type="submit">Tambah</button>
               <a href="<?php echo base_url('batch_sertifikasi') ?>" class="btn btn-danger">Kembali</a>
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