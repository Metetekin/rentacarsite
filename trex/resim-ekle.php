<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Resim İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="resim-galerisi.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Resim Ekle <small>Resimleri görmek için galeriye gidin.<a href="resim-galerisi.php" class="btn btn-warning">Galeri</a></small>
				</div>
				<div class="card-block">
					<form action="controller/galeri.php" class="dropzone" >
						<input type="hidden" name="resim_urun" value="<?php echo $urunwrite['urun_id']; ?>">
					</form>
					
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>