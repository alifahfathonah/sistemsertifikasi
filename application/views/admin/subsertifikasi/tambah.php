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
                <form method="post" action="<?php echo base_url() ?>subsertifikasi/simpan">

                  <input type="hidden" name="sertifikasi" value="<?php echo $id_sertifikasi ?>">
                  <div class="form-group">
                    <label for="nama">Nama Subsertifikasi </label>
                    <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama') ?>">
                    <?php echo form_error('nama') ?>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="y" <?php if(set_value('status') == "y"){echo "selected";} ?>>Aktif</option>
                      <option value="n" <?php  if(set_value('status') == "n"){echo "selected";} ?>>Non Aktif</option>
                    </select>
                    <?php echo form_error('status') ?>
                  </div>
                  
                  <button class="btn btn-success" type="submit">Tambah</button>
                  <a href="<?php echo base_url('subsertifikasi/index/' . $id_sertifikasi) ?>" class="btn btn-danger">Kembali</a>
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