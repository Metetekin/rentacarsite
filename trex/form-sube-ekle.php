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
		<h2>Şube İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="form-subeler.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Şube Ekle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="kategori_id" value="<?php echo $kategoriwrite['kategori_id']; ?>">
						</div>
						<div class="form-group">
							<label>Şube Adı</label>
							<input type="text" name="kategori_ad" placeholder="Şube adını giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Adres</label>
							<textarea style="height: 60px" type="text" name="kategori_adres" placeholder="Şube adresi giriniz." class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Şube Sıra</label>
							<input type="text" name="kategori_sira" placeholder="Şube sırası giriniz." class="form-control">
						</div>
						<button style="cursor: pointer;" type="submit" name="kategoriekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
						<a href="kategoriler.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
