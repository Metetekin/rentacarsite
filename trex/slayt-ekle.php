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
						<a href="slayt.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Slayt Ekle
				</div>
				<div class="card-block">

					<form method="POST" enctype="multipart/form-data" action="controller/function.php" class="form-horizontal">						
						<div class="form-group">
							<label>Slayt Başlık</label>
							<input type="text" name="slayt_baslik" placeholder="Başlık giriniz." class="form-control">
						</div>

						<div class="form-group">
							<label>Slayt Açıklama</label>
							<textarea class="summernote" name="slayt_aciklama">İçerik giriniz</textarea>
						</div>
						<div class="form-group">
							<label>Resim Yükle</label>
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="slayt_resim">
								</span>
								<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
							</div>
						</div>
						<div class="form-group">
							<label>Yazı Rengi</label>
							<input type="text" name="slayt_renk" placeholder="Yazı rengi giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Botun Adı</label>
							<input type="text" name="slayt_butonad" placeholder="Buton adı giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Botun Link</label>
							<input type="text" name="slayt_butonlink" placeholder="Buton linki giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Slayt Sıra</label>
							<input type="text" name="slayt_sira" placeholder="Salyt sırası belirtiniz." class="form-control">
						</div>
						<button style="cursor: pointer;" type="submit" name="slaytekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
