<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">
			
			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Ganti Password</h2>

				<form action="<?php echo base_url() ?>akun_umum/konfirmasi_perubahan_password" method="post">

					<div class="mt-10">
						<input type="hidden" name="email" value="<?php echo $email ?>">
						<input type="password" name="password" placeholder="Password Baru" class="single-input">
					</div>

					<button type="submit" class="btn btn-primary mt-3 btn-block">Ubah Password</button>

				</form>

			</div>
		</div>
	</div>

</section>