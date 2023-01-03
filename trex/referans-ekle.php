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
		<h2>Referans İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="referanslar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Referans Ekle
				</div>
				<div class="card-block">
					<form method="POST" enctype="multipart/form-data" action="controller/function.php" class="form-horizontal">						
						<div class="form-group">
							<label>Referans Adı</label>
							<input type="text" name="referans_adi" placeholder="Referans adı giriniz" class="form-control">
						</div>
						<div class="form-group">
							<label>Referans Kategori</label>
							<input type="text" name="referans_kategori" placeholder="Referans kategorisi giriniz" class="form-control">
						</div>
						<div class="form-group">
							<label>Referans Link</label>
							<input type="text" name="referans_link" placeholder="Referans linki giriniz" class="form-control">
						</div>
						<div class="form-group">
							<label>Resim Ekle</label>
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yeni Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="referans_resim1">
								</span>
								<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
							</div>
						</div>
						
						<button style="cursor: pointer;" type="submit" name="refekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>