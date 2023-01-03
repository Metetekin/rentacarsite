<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$html=$db->prepare("SELECT * from widget");
$html->execute(array());
$htmlwrite=$html->fetch(PDO::FETCH_ASSOC);
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Ana Sayfa HTML Alan İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Ana Sayfa HTML Alan Düzenle
				</div>
				<div class="card-block">
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<input type="hidden" name="widget_id" value="1">
						<div class="form-group">
							<textarea class="summernote" name="widget_html"><?php echo $htmlwrite['widget_html']; ?></textarea>
						</div>
						<button style="cursor: pointer;" type="submit" name="htmlduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
