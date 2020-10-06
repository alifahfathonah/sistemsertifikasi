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
              <div class="card-header">
                <a href="<?php echo base_url() ?>seminar" class="btn btn-danger">Kembali</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>No</th>
                     <th>Nama Peserta</th>
                     <th>Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   $no = 1;
                   foreach ($list as $s) { ?>
                     <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $mhs[$s->smhs_mahasiswa] ?></td>
                       <td>
                         <a target="_blank" href="<?php echo base_url('seminar/cetak_sertifikat_mhs/' . $s->smr_id .'/' . $s->smhs_mahasiswa); ?>" class="btn btn-info"><i class="fa fa-print"></i>&nbsp;&nbsp; Cetak Sertifikat</a>
                       </td>
                     </tr>
                   <?php } ?>
                 </tbody>
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