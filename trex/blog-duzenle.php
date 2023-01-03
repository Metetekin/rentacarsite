<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$blogedit=$db->prepare("SELECT * from blog where blog_id=:blog_id");
$blogedit->execute(array(
	'blog_id' => $_GET['blog_id']
));
$blogwrite=$blogedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Blog İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="blog.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Blog Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="blog_id" value="<?php echo $blogwrite['blog_id']; ?>">
						</div>
						<div class="form-group">
							<input type="hidden" name="eski_yol" value="<?php echo $blogwrite['blog_resim']; ?>">
						</div>						
						<div class="form-group">
							<label>Blog Adı</label>
							<input type="text" name="blog_baslik" value="<?php echo $blogwrite['blog_baslik']; ?>" class="form-control">
						</div>

						<div class="form-group">
							<label>Kategori</label>
							<select name="blog_kategori" class="form-control m-b">
								<?php 
								$kategoriedit=$db->prepare("SELECT * from kategorilerb where kategori_id=:kategori_id");
								$kategoriedit->execute(array(
									'kategori_id' => $blogwrite['blog_kategori']
								));
								$kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);
								?>
								<option value="<?php echo $kategoriwrite['kategori_id'] ?>"><?php echo $kategoriwrite['kategori_ad'] ?></option>
								<?php 
								$kategorisor=$db->prepare("SELECT * from kategorilerb");
								$kategorisor->execute(array(0));
								while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
									?>
									<option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>İçerik</label>
							<textarea class="summernote" name="blog_detay"><?php echo $blogwrite['blog_detay']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Yüklü Resim</label>
							<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $blogwrite['blog_resim']; ?>"></p>
							
						</div>
						<div class="form-group">
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yeni Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="blog_resim">
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
							<input type="text" name="blog_title" value="<?php echo $blogwrite['blog_title']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input name="blog_descr" type="text" value="<?php echo $blogwrite['blog_descr']; ?>" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" name="blog_keyword" value="<?php echo $blogwrite['blog_keyword']; ?>" class="form-control form-control-rounded">
							<small class="text-muted">Örnek : <code>elma, armut, muz, karpuz</code></small>
						</div>
						<button style="cursor: pointer;" type="submit" name="blogduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
						<a href="blog.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
