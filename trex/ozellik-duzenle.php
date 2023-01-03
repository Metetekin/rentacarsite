<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
include 'controller/seo.php';
$hizmetedit=$db->prepare("SELECT * from ozellik where ozellik_id=:ozellik_id");
$hizmetedit->execute(array(
	'ozellik_id' => $_GET['ozellik_id']
));
$hizmetwrite=$hizmetedit->fetch(PDO::FETCH_ASSOC);

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
					Özellik Düzenle
				</div>
				<div class="card-block">
					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="ozellik_id" value="<?php echo $hizmetwrite['ozellik_id']; ?>">
						</div>
						<div class="form-group">
							<label>Özellik Adı</label>
							<input type="text" name="ozellik_baslik" value="<?php echo $hizmetwrite['ozellik_baslik']; ?>">
						</div>
						
						<div class="form-group">
							<label>Özellik Fiyat (TL)</label>
							<input type="text" name="ozellik_fiyat" value="<?php echo $hizmetwrite['ozellik_fiyat']; ?>" class="form-control">
						</div>

						<div class="form-group">
							<label>Özellik Araç</label>
							<select name="ozellik_arac" required="" class="form-control m-b">
								<?php 
								$urunVarsor=$db->prepare("SELECT * from urunler where urun_id=:arac");
								$urunVarsor->execute(array('arac' => $hizmetwrite['ozellik_arac'] )); 
								$urunVarcek=$urunVarsor->fetch(PDO::FETCH_ASSOC); ?>
								<option value="<?php echo $urunVarcek['urun_id'] ?>"><?php echo $urunVarcek['urun_baslik'] ?></option>
								
								<?php 
								$urunsor=$db->prepare("SELECT * from urunler order by urun_id ASC");
								$urunsor->execute(array(0)); 
								while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
									<option value="<?php echo $uruncek['urun_id']; ?>"><?php echo $uruncek['urun_baslik']; ?></option>
								<?php } ?>
								<option value="99">Tümü</option>
							</select>
						</div>
						<button style="cursor: pointer;" type="submit" name="ozellikduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
