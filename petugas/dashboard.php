<div id="card-stats">
	<div class="row mt-1">

		<div class="col s12 m6 l3">
			<div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s7 m7">
						<?php
						$query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='proses'");
						$jlmmember = mysqli_num_rows($query);
						if ($jlmmember < 1) {
							$jlmmember = 0;
						}
						?>
						<i class="material-icons background-round mt-5">timeline</i>
						<p>Laporan status proses</p>
					</div>
					<div class="col s5 m5 right-align">
						<h5 class="mb-0"><?php echo $jlmmember; ?></h5>

					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m6 l3">
			<div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s7 m7">
						<?php
						$query = mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_petugas='" . $_SESSION['data']['id_petugas'] . "'");
						$jlmmember = mysqli_num_rows($query);
						if ($jlmmember < 1) {
							$jlmmember = 0;
						}
						?>
						<i class="material-icons background-round mt-5">check_circle</i>
						<p>Laporan Ditanggapi</p>
					</div>
					<div class="col s5 m5 right-align">
						<h5 class="mb-0"><?php echo $jlmmember; ?></h5>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>