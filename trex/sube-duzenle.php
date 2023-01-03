<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$pageedit=$db->prepare("SELECT * from sube where sube_id=:sayfaid");
$pageedit->execute(array(
	'sayfaid' => $_GET['sube_id']
));
$pagewrite=$pageedit->fetch(PDO::FETCH_ASSOC);
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
						<a href="sube.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Şube Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
							<input type="hidden" name="sube_id" value="<?php echo $pagewrite['sube_id']; ?>">
						<div class="form-group">
							<label>Şube Adı</label>
							<input type="text" name="sube_adi" value="<?php echo $pagewrite['sube_adi']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Tel</label>
							<input type="text" name="sube_tel" value="<?php echo $pagewrite['sube_tel']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube GSM</label>
							<input type="text" name="sube_gsm" value="<?php echo $pagewrite['sube_gsm']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Fax</label>
							<input type="text" name="sube_fax" value="<?php echo $pagewrite['sube_fax']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Web  (Mutalaka http:// olarak ekleyiniz.)</label>
							<input type="text" name="sube_web" value="<?php echo $pagewrite['sube_web']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Mail</label>
							<input type="text" name="sube_mail" value="<?php echo $pagewrite['sube_mail']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Harita</label>
							<textarea style="height: 100px;" name="sube_harita"><?php echo $pagewrite['sube_harita']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Şube Adres</label>
							<textarea style="height: 100px;" name="sube_adres"><?php echo $pagewrite['sube_adres']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Şube il</label>
							<input type="text" name="sube_il" value="<?php echo $pagewrite['sube_il']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Şube ilce</label>
							<input type="text" name="sube_ilce" value="<?php echo $pagewrite['sube_ilce']; ?>" class="form-control">
						</div>
						<button style="cursor: pointer;" type="submit" name="subeduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
