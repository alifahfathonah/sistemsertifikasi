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
                <form action="<?php echo base_url('modul/simpan_perubahan'); ?>" method="post">

                  <input type="hidden" name="modul_id" value="<?php echo $list->mdl_id ?>">

                  <div class="form-group">
                    <label>Nama Modul</label>
                    <input type="text" class="form-control" name="nama_modul" value="<?php echo $list->mdl_modul ?>">
                    <?php echo form_error('nama_modul') ?>
                  </div>

                  <div class="form-group">
                    <label>Url</label>
                    <input type="text" class="form-control" name="url" value="<?php echo $list->mdl_link ?>">
                    <?php echo form_error('url') ?>
                  </div>

                  <div class="form-group">
                    <label>Icon</label>
                    <input type="text" class="form-control" name="icon" value="<?php echo $list->mdl_icon ?>">
                    <?php echo form_error('icon') ?>
                  </div>

                  <div class="form-group">
                    <label>Main Menu</label>
                    <select name="mainmenu" class="form-control">
                      <option value="">Pilih Salah satu</option>
                      <?php foreach ($mainmenu as $m) : ?>
                        <option value="<?php echo $m->mdl_id ?>" <?php if ($list->mdl_mainmenu == $m->mdl_id) {
                          echo "selected";
                        } ?>>Sub Menu <?php echo $m->mdl_modul ?></option>
                      <?php endforeach; ?>
                      <option value="0" <?php if ($list->mdl_mainmenu == '0') {
                        echo "selected";
                      } ?>>Set Main Menu</option>
                    </select>
                    <?php echo form_error('mainmenu') ?>
                  </div>

                  <button class="btn btn-success" type="submit">Ubah</button>
                  <a href="<?php echo base_url('modul') ?>" class="btn btn-danger">Kembali</a>
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