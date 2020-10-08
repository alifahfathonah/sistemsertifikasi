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
                <a href="<?php echo base_url('sertifikasi') ?>" class="btn btn-danger">Kembali</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>No</th>
                     <th>Nama Peserta</th>
                     <th>Skor Total</th>
                     <th>Grade</th>
                     <th>Status</th>
                     <th>Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  $no = 1;
                  foreach ($list as $l) { ?>
                   <tr>
                     <td><?php echo $no++ ?></td>
                     <td><?php echo $l->pu_nama ?></td>
                     <td>
                      <?php if($l->srtu_skor == '') { ?>
                        <p class="text-danger">Skor Masih Belum Diisi</p>
                      <?php } else { ?>
                        <?php echo $l->srtu_skor ?>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($l->srtu_grade == '') { ?>
                        <p class="text-danger">Skor Masih Belum Diisi</p>
                      <?php } else { ?>
                        <?php echo $l->srtu_grade ?>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($l->srtu_status == '') { ?>
                        <p class="text-danger">Skor Masih Belum Diisi</p>
                      <?php } elseif($l->srtu_status == 'Lulus') { ?>
                        <div class="badge badge-success">Lulus</div>
                      <?php } elseif($l->srtu_status == 'Tidak Lulus') { ?>
                        <div class="badge badge-danger">Tidak Lulus</div>
                      <?php } ?>
                    </td>
                    <td>
                     <?php if($l->srtu_skor == '') { ?>
                      <a href="<?php echo base_url('input_nilai_sertifikasi_final/input_nilai_umum/' . $l->srtu_sertifikasi . '/' . $l->srtu_peserta); ?>" class="btn btn-info btn-block btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp; Input Nilai dan Sertifikat</a>
                     <?php } else { ?>
                      <a href="<?php echo base_url('input_nilai_sertifikasi_final/input_nilai_umum/' . $l->srtu_sertifikasi . '/' . $l->srtu_peserta); ?>" class="btn btn-info btn-block btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp; Input Sertifikat Ulang</a>
                    <?php } ?>
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