<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
include 'controller/seo.php';
$pageedit=$db->prepare("SELECT * from soz where soz_id=1");
$pageedit->execute(array());
$pagewrite=$pageedit->fetch(PDO::FETCH_ASSOC);
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Sözleşme İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Sözleşme Düzenle
				</div>
				<div class="card-block">
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="soz_id" value="1">
						</div>
						
						<div class="form-group">
							<label>Sözleşme Başlık</label>
							<input type="text" name="soz_baslik" value="<?php echo $pagewrite['soz_baslik']; ?>" class="form-control">
						</div>

						<div class="form-group">
							<label>İçerik</label>
							<textarea class="summernote" name="soz_aciklama"><?php echo $pagewrite['soz_aciklama']; ?></textarea>
						</div>
						
					<button style="cursor: pointer;" type="submit" name="sozlesmeduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
