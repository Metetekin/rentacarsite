<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$motor=$db->prepare("SELECT * from motor");
$motor->execute(array(0));
$motorprint=$motor->fetch(PDO::FETCH_ASSOC);
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Google & Yandex Ayarları</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Arama Motoru Ayarları
				</div>

				<div class="card-block">
					<!-- AYAR  -->
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<input type="hidden" name="motor_id" value="1">
						<div class="form-group">
							<div class="row">
								<input type="hidden" name="widget_id" value="1"  class="form-control">
								<div class="col-md-12">
									<label>Google Analytics Kodu</label>
									<textarea style="height: 100px;" type="text" name="motor_analitik" class="form-control"><?php echo $motorprint['motor_analitik']; ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<input type="hidden" name="widget_id" value="1"  class="form-control">
								<div class="col-md-12">
									<label>Yandex Metrica Kodu</label>
									<textarea style="height: 100px;" type="text" name="motor_metrika" class="form-control"><?php echo $motorprint['motor_metrika']; ?></textarea>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<input type="hidden" name="widget_id" value="1"  class="form-control">
								<div class="col-md-12">
									<label>Google Site Onay Kodu</label>
									<textarea style="height: 50px;" type="text" name="motor_gonay" class="form-control"><?php echo $motorprint['motor_gonay']; ?></textarea>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<input type="hidden" name="widget_id" value="1"  class="form-control">
								<div class="col-md-12">
									<label>Yandex Site Onay Kodu</label>
									<textarea style="height: 50px;" type="text" name="motor_yonay" class="form-control"><?php echo $motorprint['motor_yonay']; ?></textarea>
								</div>
							</div>
						</div>

						<button style="cursor: pointer;" type="submit" name="motorduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
					<!--#AYAR  -->
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>