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
                <h3>Header Absen</h3>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <input type="hidden" name="id_absen" value="<?php echo $header->as_id ?>">
                    <label>Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $header->as_nama_absen ?>" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label>Tanggal Pelaksanaan</label>
                    <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo $header->as_tanggal ?>" readonly>
                  </div>
                  <div class="col-md-5">
                    <label>Nama Instruktur</label>
                    <input type="text" class="form-control" name="nama_instruktur" value="<?php echo $header->as_nama_instruktur ?>" readonly>
                  </div>
                  <div class="col-md-3 form-check form-check-inline pt-4">
                    <input class="form-check-input" type="radio" name="name_<?php echo $header->as_id ?>" <?php if($header->as_instruktur_ishadir == 'y') { echo 'checked'; }  ?> value="y" readonly onclick="return false">
                    <label class="form-check-label mr-3">Hadir</label>
                    <input class="form-check-input" type="radio" name="name_<?php echo $header->as_id ?>" <?php if($header->as_instruktur_ishadir == 'n') { echo 'checked'; }  ?> value="n" readonly onclick="return false">
                    <label class="form-check-label">Tidak Hadir</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Catatan</label>
                    <textarea class="form-control" name="catatan" readonly><?php echo $header->as_catatan ?></textarea>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-stripped" id="table-2">
                  <thead>
                    <tr>
                      <th width="30%%">Nama Peserta</th>
                      <th width="25%">Hadir</th>
                      <th width="25%">Tidak Hadir</th>
                      <th width="25%">Izin</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php foreach($peserta as $p) : ?>
                    <tr>
                      <input type="hidden" name="id_absen" value="<?php echo $header->as_id ?>>">
                      <input type="hidden" name="id_batch" value="<?php echo $header->as_batch ?>">
                      <td><?php echo $nama[$p->aps_peserta] ?></td>
                      <td class="text-left"><input type="radio" name="name<?php echo str_replace('.','',$p->aps_peserta)  ?>" value="y" <?php if($pesertarow[$p->aps_peserta] == 'y') { echo 'checked'; } ?> readonly onclick="return false"></td>
                      <td class="text-left"><input type="radio" name="name<?php echo str_replace('.','',$p->aps_peserta)  ?>" value="n" <?php if($pesertarow[$p->aps_peserta] == 'n') { echo 'checked'; } ?> readonly onclick="return false"></td>
                      <td class="text-left"><input type="radio" name="name<?php echo str_replace('.','',$p->aps_peserta)  ?>" value="i" <?php if($pesertarow[$p->aps_peserta] == 'i') { echo 'checked'; } ?> readonly onclick="return false"></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <a href="<?php echo base_url('absen_sertifikasi/absen_pertemuan/' . $header->as_batch); ?>" class="btn btn-danger mt-3">Kembali</a>
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