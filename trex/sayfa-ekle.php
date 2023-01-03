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
		<h2>Sayfa İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sayfalar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Sayfa Ekle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						
						<div class="form-group">
							<label>Sayfa Başlık</label>
							<input type="text" name="sayfa_baslik" placeholder="Sayfa başlığı giriniz." class="form-control">
						</div>

						<div class="form-group">
							<label>İçerik</label>
							<textarea class="summernote" name="sayfa_icerik">İçerik giriniz..</textarea>
						</div>
						<div class="form-group">
							<label>Menude Göster</label>
							<select name="sayfa_menu" class="form-control m-b">
								<option value="1">Göster</option>
								<option value="0">Gizle</option>
							</select>
							<small class="text-muted">Seçilen özellik ile oluşturulan sayfa üst menude alt sekme olarak gösterilecektir</small>
						</div>
						<hr>
						<div class="">
							<b style="color: red;">*SEO Meta Ayarları</b>
							<p class="text-muted">Google başta olmak üzere tüm arama motorları sizi buraya girdiğiniz bilgiler doğrultusunda üst sıralara taşıyacaktır.</p>
						</div>
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="sayfa_title" placeholder="Title giriniz." class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Description</label>
							<input name="sayfa_descr" type="text" placeholder="Description giriniz." class="form-control form-control-rounded">
						</div>

						<div class="form-group">
							<label>Keywords</label>
							<input type="text" name="sayfa_keyword" placeholder="Keywords giriniz." class="form-control form-control-rounded">
							<small class="text-muted">Örnek : <code>elma, armut, muz, karpuz</code></small>
						</div>
						<button style="cursor: pointer;" type="submit" name="sayfaekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>