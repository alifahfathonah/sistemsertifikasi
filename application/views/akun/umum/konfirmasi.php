<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">
			
			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Konfirmasi Akun</h2>

				<form action="<?php echo base_url() ?>akun_umum/kirim_konfirmasi" method="post">

					<div class="mt-10">
						<input type="hidden" name="guardkode" value="<?php echo $guardkode ?>">
						<input type="text" name="email" placeholder="Email" class="single-input">
					</div>

					<button type="submit" class="btn btn-primary mt-3 btn-block">Konfirmasi Akun</button>

				</form>

			</div>
		</div>
	</div>

</section>