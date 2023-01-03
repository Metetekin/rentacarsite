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
		<h2>Slayt İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="yorumlar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Yorum Ekle
				</div>
				<div class="card-block">

					<form method="POST" enctype="multipart/form-data" action="controller/function.php" class="form-horizontal">						
						<div class="form-group">
							<label>Yorum İçerik</label>
							<textarea class="editor" name="yorum_icerik" placeholder="Yorum giriniz."></textarea>
						</div>
						<div class="form-group">
							<label>Yorum İsim</label>
							<input type="text" name="yorum_isim" placeholder="İsim giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Yorum Ünvan</label>
							<input type="text" name="yorum_link" placeholder="Link giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Yorum Resim</label>
							<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $yorumwrite['yorum_resim']; ?>"></p>
						</div>
						<div class="form-group">
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yeni Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="yorum_resim">
								</span>
								<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
							</div>
						</div>
						<button style="cursor: pointer;" type="submit" name="yorumekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
