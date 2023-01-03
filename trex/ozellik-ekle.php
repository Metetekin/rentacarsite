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
		<h2>Özellik İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="ozellikler.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Özellik Ekle
				</div>
				<div class="card-block">
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<label>Özellik Adı</label>
							<input type="text" name="ozellik_baslik" placeholder="Adı belirtiniz">
						</div>
						
						<div class="form-group">
							<label>Özellik Fiyat (TL)</label>
							<input type="text" name="ozellik_fiyat" placeholder="Fiyat belirtiniz" " class="form-control">
						</div>

						<div class="form-group">
							<label>Özellik Araç</label>
							<select name="ozellik_arac" required="" class="form-control m-b">
								
								<option value="">Seçim yapınız</option>
								<?php 
								$urunsor=$db->prepare("SELECT * from urunler order by urun_id ASC");
								$urunsor->execute(array(0)); 
								while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
									<option value="<?php echo $uruncek['urun_id']; ?>"><?php echo $uruncek['urun_baslik']; ?></option>
								<?php } ?>
								<option value="99">Tümü</option>
							</select>
						</div>
						<button style="cursor: pointer;" type="submit" name="ozellikekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
