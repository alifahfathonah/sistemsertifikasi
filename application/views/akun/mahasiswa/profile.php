<section class="section-gap-top section-gap-bottom">

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
			
						<div class="mt-4">
							<table>
								<tr>
									<td>
										<h5>Nama</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $this->session->userdata('nama') ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>NPM</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $this->session->userdata('npm') ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Jurusan</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $this->session->userdata('jurusan') ?></h5>
									</td>
								</tr>
							</table>
						</div>

						<hr class="mt-5 mb-4">
						<h4 class="text-center">Data Sertifikasi</h4>
						
						<div class="mt-4">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Donna Snider</td>
										<td>Customer Support</td>
										<td>New York</td>
										<td>27</td>
										<td>2011/01/25</td>
										<td>$112,000</td>
									</tr>
								</tbody>
							</table>
						</div>

						<hr class="mt-5 mb-4">
						<h4 class="text-center">Data Seminar</h4>
						
						<div class="mt-4">
							<table id="example2" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Donna Snider</td>
										<td>Customer Support</td>
										<td>New York</td>
										<td>27</td>
										<td>2011/01/25</td>
										<td>$112,000</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="text-center mt-5">

							<a href="<?php echo base_url('') ?>logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>


						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</section>