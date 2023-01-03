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
		<h2>Sık Sorulan Sorular</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sss.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Sık Sorulan Sorular
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<label>Soru</label>
							<input type="text" name="sss_soru" placeholder="Soru giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Cevap</label>
							<input type="text" name="sss_cevap" placeholder="Cevap giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Sıra</label>
							<input type="text" name="sss_sira" placeholder="Sıra belirtiniz." class="form-control">
						</div>
						<button style="cursor: pointer;" type="submit" name="sssekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>