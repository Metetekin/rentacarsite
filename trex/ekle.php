<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$sayfalarsor=$db->prepare("SELECT * from sayfalar order by sayfa_id DESC limit 10");
$sayfalarsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Sayfa İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Sayfa Düzenle
				</div>
				<div class="card-block">

					<form method="get" action="" class="form-horizontal">
						<div class="form-group">
							<label>Sayfa Başlık</label>
							<input type="text" placeholder="Sayfa başlığı " class="form-control">
						</div>

						<div class="form-group">
							<label>Slug</label>
							<input type="text" placeholder="Page slug" class="form-control">
							<small class="text-muted">Sample : <code>corporate-page</code></small>
						</div>

						<div class="form-group">
							<label>Content</label>
							<div class="summernote" style="display: none;"><p>Hello Summernote</p></div>
						</div>

						<div class="form-group">
							<label>Featured Image</label>
							<div class="fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;"></div>
								<span class="btn btn-primary  btn-file">
									<span class="fileinput-new">Select</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" id="image" name="image">
								</span>
								<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
						<hr>
						<div class="">
							<b style="color: red;">*SEO Meta Ayarları</b>
							<p class="text-muted">Google başta olmak üzere tüm arama motorları sizi buraya girdiğiniz bilgiler doğrultusunda üst sıralara taşıyacaktır.</p>
						</div>
						<div class="form-group">
							<label>Title</label>
							<input type="text" placeholder="Page title" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input type="text" placeholder="Page description" class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" placeholder="Page keywords" class="form-control form-control-rounded">
							<small class="text-muted">Sample : <code>apple, pear, banana, wholesale</code></small>
						</div>
						<a type="submit" name="sayfaduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Düzenle</a>
						<a href="sayfalar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>