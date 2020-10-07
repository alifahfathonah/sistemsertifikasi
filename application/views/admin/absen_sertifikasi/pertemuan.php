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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kegiatan</th>
                      <th width="50%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($list as $l) : ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $l->as_nama_absen ?></td>
                        <td>
                          <?php error_reporting (E_ALL ^ E_NOTICE); ?>
                          <?php if($l->as_id == $cek[$l->as_id]) { ?>
                            <a href="<?php echo base_url('Absen_sertifikasi/absen_update/' . $l->as_id .'/' . $l->as_batch) ?>" class="btn btn-primary">Input Ulang Absen Sertifikasi</a>
                            <a href="<?php echo base_url('Absen_sertifikasi/detail/' . $l->as_id .'/' . $l->as_batch) ?>" class="btn btn-info">Detail Absensi</a>
                            <a href="<?php echo base_url('Absen_sertifikasi/cetak_absen/' . $l->as_id .'/' . $l->as_batch) ?>" class="btn btn-warning" target="_blank">Cetak Absen</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url('Absen_sertifikasi/absen/' . $l->as_id .'/' . $l->as_batch) ?>" class="btn btn-primary">Input Absen Sertifikasi</a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
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