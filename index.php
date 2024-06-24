<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<br><br>
<section id="kategori">
	<div class="kontainer">
		<div class="row mb-3 pb-3">
			<div class="kolom-md-12 judulsection ">
				<h1 class="text-tengah">SunnyFlorist</h1>
				<br>
				<center>
					<p>Rayakan setiap perasaanmu melalui bunga yang kami rangkai dengan penuh cinta.</p>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="kolom-md-4 kolom-lg-4 ">
				<div class="produk">
					<img src="foto/bunga11.jpg" style="height:390px;width:100%;border-radius:10px" alt="">
				</div>
			</div>
			<div class="kolom-md-4 kolom-lg-4 ">
				<div class="produk">
					<img src="foto/bunga10.jpg" style="height:390px;width:100%;border-radius:10px" alt="">
				</div>
			</div>
			<div class="kolom-md-4 kolom-lg-4 ">
				<div class="produk">
					<img src="foto/bunga9.jpg" style="height:390px;width:100%;border-radius:10px" alt="">
				</div>
			</div>
		</div>
		<div class="row mb-3 pb-3">
			<div class="kolom-md-12 judulsection ">

			</div>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>