<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$kategoriedit=$db->prepare("SELECT * from kategoriler where kategori_id=:kategori_id");
$kategoriedit->execute(array(
	'kategori_id' => $_GET['kategori_id']
));
$kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Kategori İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="kategoriler.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Kategori Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="kategori_id" value="<?php echo $kategoriwrite['kategori_id']; ?>">
						</div>
						<div class="form-group">
							<label>Kategori Adı</label>
							<input type="text" name="kategori_ad" value="<?php echo $kategoriwrite['kategori_ad']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Kategori Sıra</label>
							<input type="text" name="kategori_sira" value="<?php echo $kategoriwrite['kategori_sira']; ?>" class="form-control">
						</div>
						<hr>
						<div class="">
							<b style="color: red;">*SEO Meta Ayarları</b>
							<p class="text-muted">Google başta olmak üzere tüm arama motorları sizi buraya girdiğiniz bilgiler doğrultusunda üst sıralara taşıyacaktır.</p>
						</div>
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="kategori_title" value="<?php echo $kategoriwrite['kategori_title']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input name="kategori_descr" type="text" value="<?php echo $kategoriwrite['kategori_descr']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" name="kategori_keyword" value="<?php echo $kategoriwrite['kategori_keyword']; ?>" class="form-control form-control-rounded">
							<small class="text-muted">Örnek : <code>elma, armut, muz, karpuz</code></small>
						</div>
						<button style="cursor: pointer;" type="submit" name="kategoriduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>