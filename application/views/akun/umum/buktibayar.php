<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">
			
			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Register</h2>

				<form action="<?php echo base_url('seminar/upload_umum') ?>" method="post" enctype="multipart/form-data">

					<input type="hidden" name="seminar_id" value="<?php echo $bukti->su_seminar ?>">

					<div class="mt-10">
						<label class="pb-2">Nama Bank</label>
						<input type="text" class="single-input" name="nama_bank" value="<?php echo $this->input->post('nama_bank') ?? $bukti->su_bank ?>">
						<?php echo form_error('nama_bank') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">Nama Pemilik</label>
						<input type="text" class="single-input" name="nama_pemilik" value="<?php echo $this->input->post('nama_pemilik') ?? $bukti->su_namapemilik ?>">
						<?php echo form_error('nama_pemilik') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">No. Rekening</label>
						<input type="text" class="single-input" name="no_rek" value="<?php echo $this->input->post('no_rek') ?? $bukti->su_norekening ?>">
						<?php echo form_error('no_rek') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">Bukti Bayar</label>
						<input type="file" class="single-input" name="buktibayar">
						<p style="text-align: left !important; margin-bottom: 5px; margin-top: 10px;">Bukti Bayar : <?php if ($bukti->su_bukti!=""||$bukti->su_bukti!= NULL){?><a target="_BLANK" href="<?php echo base_url();?>assets/transfer_seminar_umum/<?php echo $bukti->su_bukti;?>">Klik Untuk Download</a><?php } ?></p>
					</div>


					<button type="submit" class="btn btn-primary mt-3 btn-block">Upload</button>

					<a href="<?php echo base_url() ?>akun_umum/akun" class="btn btn-danger mt-3 btn-block">Kembali</a>


				</form>

			</div>
		</div>
	</div>

</section>