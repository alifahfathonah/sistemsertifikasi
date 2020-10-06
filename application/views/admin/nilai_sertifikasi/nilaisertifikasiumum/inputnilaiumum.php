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
               <form action="<?php echo base_url('input_nilai_sertifikasi/simpan_umum'); ?>" method="post">

                 <input type="hidden" name="id_subsertifikasiumum" value="<?php echo $list->ssu_id ?>">
                 <input type="hidden" name="id_sertifikasiumum" value="<?php echo $list->ssu_sertifikasi_umum ?>">
                 <input type="hidden" name="id_batch" value="<?php echo $list->ssu_batch ?>">

                 <div class="form-group">
                   <label>Skor *</label>
                   <input type="text" class="form-control" name="skor" value="<?php echo $this->input->post('skor') ?? $list->ssu_skor  ?>">
                   <?php echo form_error('skor') ?>
                 </div>

                 <div class="form-group">
                   <label>Tanggal Sertifikasi *</label>
                   <input type="date" class="form-control" name="tanggal_sertifikasi" value="<?php echo $this->input->post('tanggal_sertifikasi') ?? $list->ssu_tanggal_sertifikasi  ?>">
                   <?php echo form_error('tanggal_sertifikasi') ?>
                 </div>

                 <button class="btn btn-success" type="submit">Simpan</button>
                 <a href="<?php echo base_url('input_nilai_sertifikasi/nilai_umum/' . $list->ssu_batch) ?>" class="btn btn-danger">Kembali</a>
               </form>
             </div>
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