<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$hizmetedit=$db->prepare("SELECT * from markalar where hizmet_id=:hizmet_id");
$hizmetedit->execute(array(
	'hizmet_id' => $_GET['hizmet_id']
));
$hizmetwrite=$hizmetedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Marka İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="markalar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Marka Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="hizmet_id" value="<?php echo $hizmetwrite['hizmet_id']; ?>">
						</div>
						<div class="form-group">
							<input type="hidden" name="eski_yol" value="<?php echo $hizmetwrite['hizmet_resim']; ?>">
						</div>
						
						<div class="form-group">
							<label>Marka Adı</label>
							<input type="text" name="hizmet_baslik" value="<?php echo $hizmetwrite['hizmet_baslik']; ?>" class="form-control">
						</div>

						<div class="form-group">
							<label>İçerik</label>
							<textarea class="summernote" name="hizmet_icerik"><?php echo $hizmetwrite['hizmet_icerik']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Yüklü Resim</label>
							<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $hizmetwrite['hizmet_resim']; ?>"></p>
							
						</div>
						<div class="form-group">
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yeni Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="hizmet_resim">
								</span>
								<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
							</div>
						</div>
						<hr>
						<div class="">
							<b style="color: red;">*SEO Meta Ayarları</b>
							<p class="text-muted">Google başta olmak üzere tüm arama motorları sizi buraya girdiğiniz bilgiler doğrultusunda üst sıralara taşıyacaktır.</p>
						</div>
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="hizmet_title" value="<?php echo $hizmetwrite['hizmet_title']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input name="hizmet_descr" type="text" value="<?php echo $hizmetwrite['hizmet_descr']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" name="hizmet_keyword" value="<?php echo $hizmetwrite['hizmet_keyword']; ?>" class="form-control form-control-rounded">
							<small class="text-muted">Örnek : <code>elma, armut, muz, karpuz</code></small>
						</div>
						<button style="cursor: pointer;" type="submit" name="markaduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>