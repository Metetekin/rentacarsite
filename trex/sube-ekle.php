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
		<h2>Şube İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sube.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Şube Ekle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<label>Şube Adı</label>
							<input type="text" name="sube_adi" placeholder="Şube adı giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Tel</label>
							<input type="text" name="sube_tel" placeholder="Telefon no giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube GSM</label>
							<input type="text" name="sube_gsm" placeholder="GSM no giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Fax</label>
							<input type="text" name="sube_fax" placeholder="Fax numarası giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Web (Mutalaka http:// olarak ekleyiniz.)</label>
							<input type="text" name="sube_web" placeholder="Web adresi giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Mail</label>
							<input type="text" name="sube_mail" placeholder="Mail adresi giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube Harita</label>
							<textarea style="height: 100px;" name="sube_harita"></textarea>
						</div>
						<div class="form-group">
							<label>Şube Adres</label>
							<textarea style="height: 100px;" name="sube_adres"></textarea>
						</div>
						<div class="form-group">
							<label>Şube il</label>
							<input type="text" name="sube_il" placeholder="İl giriniz." class="form-control">
						</div>
						<div class="form-group">
							<label>Şube ilce</label>
							<input type="text" name="sube_ilce" placeholder="İlce giriniz." class="form-control">
						</div>
						<button style="cursor: pointer;" type="submit" name="subeekle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
