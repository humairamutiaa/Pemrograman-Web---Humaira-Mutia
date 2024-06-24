<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>
<?php include 'header.php'; ?>
<div class="kontainer">
	<div class="row mb-3 mt-5 pb-3">
		<div class="kolom-md-12 judulsection animasikontainer">
			<h3 class="mb-4 text-tengah">Riwayat Transaksi</h3>
		</div>
	</div>
</div>
<div class="kontainer">
	<div class="row">
		<div class="kolom-md-12 animasikontainer">
			<div class="cart-list">
				<table class="tabel">
					<thead class="thead-white">
						<tr class="text-tengah">
							<th>No</th>
							<th>Tanggal</th>
							<th>Total</th>
							<th>Opsi</th>
							<th>Nota</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$nomor = 1;
						$id = $_SESSION["pengguna"]['id'];
						$ambil = $koneksi->query("SELECT * FROM pembelian WHERE pembelian.id='$id' ORDER BY pembelian.tanggalbeli DESC, pembelian.idbeli DESC");
						while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo tanggal($pecah['tanggalbeli']); ?></td>
								<td>Rp. <?php echo number_format($pecah["totalbeli"]); ?></td>
								<td>
									<?php if ($pecah['statusbeli'] == "Menunggu Konfirmasi Admin") { ?>
										<a class="tombolkecil text-putih">Menunggu Konfirmasi Admin</a>
									<?php } elseif ($pecah['statusbeli'] == "Pesanan Disetujui") { ?>
										<a class="tombolkecil text-putih">Pesanan Disetujui</a>
									<?php } elseif ($pecah['statusbeli'] == "Pesanan Selesai") { ?>
										<a class="tombolkecil text-putih">Pesanan Selesai</a>
									<?php } elseif ($pecah['statusbeli'] == "Pesanan Di Tolak") { ?>
										<a class="tombolkecil text-putih">Pesanan Anda Di Tolak</a>
									<?php } ?>
								</td>
								<td>
									<a class="tombolkecil" target="_blank" href="notacetak.php?id=<?= $pecah['idbeli'] ?>">Nota</a>
								</td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>
<?php
$no = 1;
$id = $_SESSION["pengguna"]['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE pembelian.id='$id' ORDER BY pembelian.tanggalbeli DESC, pembelian.idbeli DESC");
while ($pecah = $ambil->fetch_assoc()) { ?>
	<div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post">
					<div class="modal-body">
						<h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
					</div>
					<div class="modal-footer">
						<input type="hidden" class="form-contol" value="<?= $pecah['idbeli'] ?>" name="idbeli">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="selesai" value="selesai" class="btn btn-biru">Konfirmasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	$no++;
} ?>
<div style="padding-top: 500px"></div>
<?php
if (isset($_POST["selesai"])) {
	$koneksi->query("UPDATE pembelian SET statusbeli='Selesai'
		WHERE idbeli='$_POST[idbeli]'");
	echo "<script>alert('Pesanan berhasil di konfirmasi selesai')</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>