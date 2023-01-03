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
		<h2>Galeri İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="video-galerisi.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Video Ekle
				</div>
				<div class="card-block">
					<form method="POST" enctype="multipart/form-data" action="controller/function.php" class="form-horizontal">						
						<div class="form-group">
							<label>Youtube Video Kodu</label> 
							<input type="text" name="video_link" placeholder="Başlık giriniz." class="form-control">
							<span>linkin sonunda bulunan örn.<code>Zbr3GwHg31I</code> yazan kodu kopyalayınız. <a href="assets/img/genel/youtube.jpg">(Örnek Resim)</a></span>
						</div>
						<button style="cursor: pointer;" type="submit" name="videoekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>