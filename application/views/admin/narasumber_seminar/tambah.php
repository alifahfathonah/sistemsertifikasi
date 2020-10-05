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
               <form action="<?php echo base_url('narasumberseminar/simpan'); ?>" method="post">

                 <div class="form-group">
                   <label>Nama Seminar *</label>
                   <select name="nama_seminar" class="form-control">
                    <option value="">Pilih Salah satu</option>
                    <?php foreach($seminar as $s) : ?>
                      <option value="<?php echo $s->smr_id ?>" <?php echo set_value('nama_seminar') == $s->smr_id ? "selected" : null  ?> ><?php echo $s->smr_acara ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('nama_seminar') ?>
                </div>

                <div class="form-group">
                 <label>Nama Narasumber *</label>
                 <input type="text" class="form-control" name="nama_narasumber" value="<?php echo set_value('nama_narasumber') ?>">
                 <?php echo form_error('nama_narasumber') ?>
               </div>

               <div class="form-group">
                 <label>Asal Institusi *</label>
                 <input type="text" class="form-control" name="asal_institusi" value="<?php echo set_value('asal_institusi') ?>">
                 <?php echo form_error('asal_institusi') ?>
               </div>

               <div class="form-group">
                 <label>Sebagai *</label>
                 <input type="text" class="form-control" name="sebagai" value="<?php echo set_value('sebagai') ?>">
                 <?php echo form_error('sebagai') ?>
               </div>

               <button class="btn btn-success" type="submit">Tambah</button>
               <a href="<?php echo base_url('narasumberseminar') ?>" class="btn btn-danger">Kembali</a>
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