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
              <form method="post" action="<?php echo base_url('Validasipembayaranseminarmahasiswa/submit_checkall_setuju') ?>">
                <div class="card-header">
                  <button type="submit" class="btn btn-success">Set Lunas </button>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="check_all" class="checked_all"></th>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Seminar</th>
                        <th>Tanggal Daftar</th>
                        <th>Status Pembayaran</th>
                        <th width="30%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                     $no = 1;
                     foreach ($list as $l) { ?>
                       <tr>
                         <td>
                          <?php 
                          if($l['smhs_status'] == 'Menunggu Pembayaran') 
                          { 

                            ?>
                            
                            <?php

                          } 
                          
                          elseif($l['smhs_status'] == 'Lunas') 
                          { 

                            ?>
                            
                            <?php 
                            
                          } 
                          elseif($l['smhs_status'] == 'Tolak') 
                          { 
                            ?>
                            <?php 
                          } 
                          else 
                          { 
                           ?>
                           
                           <input type="checkbox" name="mhs[]" id="c<?php echo $l['smhs_mahasiswa'];?>" class="checkbox" value="<?php echo $l['smhs_mahasiswa'];?>">

                           <input type="hidden" name="seminar" id="c<?php echo $l['smhs_seminar'];?>" value="<?php echo $l['smhs_seminar'];?>">
                           <?php 
                         } 
                         ?>
                       </td>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $nama_mhs[$l['smhs_mahasiswa']] ?></td>
                       <td><?php echo $l['smr_acara'] ?></td>
                       <td><?php echo date('d M Y',strtotime($l['smhs_tanggaldaftar'])) ?></td>
                       
                       <td>
                        <?php 
                        if($l['smhs_status'] == 'Menunggu Pembayaran') 
                        { 
                          ?>
                          <div class="badge badge-warning">Menunggu Pembayaran</div>
                          
                          <?php 
                        } 
                        
                        elseif($l['smhs_status'] == 'Validasi Pembayaran') 
                        { 
                          ?>
                          
                          <div class="badge badge-info">Validasi Pembayaran</div>
                          
                          <?php 
                        } 
                        
                        elseif($l['smhs_status'] == 'Lunas') 
                        {

                          ?>
                          <div class="badge badge-success">Lunas</div>
                          
                          <?php 
                          
                        } 
                        else 
                        { 
                          ?>
                          
                          <div class="badge badge-danger">Tolak</div>
                          
                          <?php 
                          
                        } 
                        ?>
                      </td>

                      <td>

                        <?php 
                        if($l['smhs_status'] == 'Menunggu Pembayaran' || $l['smhs_status'] == 'Validasi Pembayaran') 
                        { 
                          ?>
                          
                          <a href="<?php echo base_url('validasipembayaranseminarmahasiswa/detail/' . $l['smhs_mahasiswa'] . '/' . $l['smhs_seminar']) ?>" class="btn btn-info">Detail</a>

                          <a href="<?php echo base_url('validasipembayaranseminarmahasiswa/setLunas/' . $l['smhs_mahasiswa'] . '/' . $l['smhs_seminar']) ?>" onclick="return confirm('Apakah anda yakin ingin set Status Lunas?')" class="btn btn-success">Set Lunas</a>
                          
                          <a href="javascript:;" data-id="<?php echo $l['smhs_mahasiswa'] ?>" data-seminar="<?php echo $l['smhs_seminar'] ?>" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-danger">
                            Set Tolak
                          </button>
                          
                          <?php 
                        } 
                        else 
                        { 
                          ?>
                          <a href="<?php echo base_url('Validasipembayaranseminarmahasiswa/detail/' . $l['smhs_mahasiswa'] . '/' . $l['smhs_seminar']) ?>" class="btn btn-info">Detail</a>
                          
                          <?php 
                        } 
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Tolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('validasipembayaranseminarmahasiswa/setTolak'); ?>" method="post">
        <div class="modal-body">
            <input type="hidden" name="idmahasiswa" id="id" value="">
            <input type="hidden" name="seminar" id="seminar" value="">
            <label>Keterangan</label>
            <textarea class="form-control" rows="5" cols="5" name="keterangan"></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Set Tolak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
     $(document).ready(function() {
         // Untuk sunting
         $('#exampleModal').on('show.bs.modal', function (event) {
            var div            = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            modal.find('#seminar').attr("value",div.data('seminar'));
         });
     });
 </script>
<script type="text/javascript">
$('.checked_all').on('change', function() {     
    $('.checkbox').prop('checked', $(this).prop("checked"));              
});
//deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
$('.checkbox').change(function(){ //".checkbox" change 
    if($('.checkbox:checked').length == $('.checkbox').length){
       $('.checked_all').prop('checked',true);
   }else{
       $('.checked_all').prop('checked',false);
   }
});
</script>