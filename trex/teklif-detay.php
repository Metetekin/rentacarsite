<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$randevuedit=$db->prepare("SELECT * from randevu where randevu_id=:randevu_id");
$randevuedit->execute(array(
	'randevu_id' => $_GET['teklif_id']
));
$randevuwrite=$randevuedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Teklif Detayları</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
						<a href="teklif.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Gelen Teklif
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<label>Oluşturulma Tarihi</label>
							<input type="text"  value="<?php echo $randevuwrite['randevu_tarih']; ?>" readonly="" class="form-control">
						</div>
						<div class="form-group">
							<label>Ad Soyad</label>
							<input type="text" readonly="readonly" value="<?php echo $randevuwrite['randevu_ad']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Telefon</label>
							<input type="text" readonly="readonly" value="<?php echo $randevuwrite['randevu_tel']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Hizmet</label>
							<input type="text" readonly="readonly" value="<?php echo $randevuwrite['randevu_hizmet']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Not</label>
							<textarea style="height: 60px;" class="form-control" readonly=""  rows="5"><?php echo htmlspecialchars($randevuwrite['randevu_not']); ?></textarea>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>