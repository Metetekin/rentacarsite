<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$referansedit=$db->prepare("SELECT * from referanslar where referans_id=:referans_id");
$referansedit->execute(array(
	'referans_id' => $_GET['referans_id']
));
$referanseditwrite=$referansedit->fetch(PDO::FETCH_ASSOC);

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
					Referans Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="referans_id" value="<?php echo $referanseditwrite['referans_id']; ?>">
						</div>
						<div class="form-group">
							<label>Referans Adı</label>
							<input type="text" name="referans_adi" value="<?php echo $referanseditwrite['referans_adi']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Referans Kategori</label>
							<input type="text" name="referans_kategori" value="<?php echo $referanseditwrite['referans_kategori']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Referans Link</label>
							<input type="text" name="referans_link" value="<?php echo $referanseditwrite['referans_link']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Yüklü Resim <small>Boyut 140x70 olmalıdır</small></label>
							<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $referanseditwrite['referans_resim1']; ?>"></p>
						</div>
						<div class="form-group">
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
						<div class="form-group">
							<input type="hidden" name="eski_yol1" value="<?php echo $referanseditwrite['referans_resim1']; ?>">
						</div>
						<button style="cursor: pointer;" type="submit" name="referansduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>