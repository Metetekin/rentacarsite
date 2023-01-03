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
		<h2>Blog İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="blog.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Blog Ekle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">						
						<div class="form-group">
							<label>Blog Adı</label>
							<input type="text" name="blog_baslik" placeholder="Blog adı giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Kategori</label>
							<select name="blog_kategori" class="form-control m-b">
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
							<textarea class="summernote" id="summernote" name="blog_detay">İçerik giriniz</textarea>
						</div>
						<div class="form-group">
							<label>Blog Resim</label>
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file" name="blog_resim">
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
							<input type="text" name="blog_title" placeholder="Title belirtiniz" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input name="blog_descr" type="text" placeholder="Description belirtiniz" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" name="blog_keyword" placeholder="Keywords belirtiniz" class="form-control form-control-rounded">
							<small class="text-muted">Örnek : <code>elma, armut, muz, karpuz</code></small>
						</div>
						<button style="cursor: pointer;" type="submit" name="blogekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
