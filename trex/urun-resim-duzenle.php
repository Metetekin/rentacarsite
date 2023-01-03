<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$urunedit=$db->prepare("SELECT * from urunler where urun_id=:urun_id");
$urunedit->execute(array(
	'urun_id' => $_GET['urun_id']
));
$urunwrite=$urunedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Ürün İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="urunler.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Ürün Düzenle
				</div>
				<div class="card-block">

					<form action="controller/resim.php" class="dropzone" >
						<input type="hidden" name="resim_urun" value="<?php echo $urunwrite['urun_id']; ?>">

					</form>

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<br/><label style="text-align: center;">Yüklü Resimler <small>(Resimleri yükledikten sonra sayfayı yenileyin.)</small></label><br/>
						<div class="card-block">
							<div class="lightboxGallery">
								<?php 
								$resimsor=$db->prepare("SELECT * from resim where resim_urun=:resim_id");
								$resimsor->execute(array(
									'resim_id' => $urunwrite['urun_id']
								));
								$say=$resimsor->rowCount();

								while ($resimcek=$resimsor->fetch(PDO::FETCH_ASSOC)) {
									if ($say=='0') { ?>								
									<?php } else { ?>

									<a href="#" data-toggle="modal" data-target="#textModal<?php echo $resimcek['resim_id']; ?>"><img style="max-width: 200px; max-height: 200px;" src="<?php echo $resimcek['resim_link']; ?>" alt=""></a>
									<div class="modal fade bs-example-modal-lg" id="textModal<?php echo $resimcek['resim_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="textModal">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<p>
														<img style="max-width: 100%; max-height: 600px;" src="<?php echo $resimcek['resim_link']; ?>">
													</p><br>
													<div class="text-center">
														<a href="controller/function.php?urunresimsil=ok&resim_id=<?php echo $resimcek['resim_id']; ?>&eski_yol=<?php echo $resimcek['resim_link']; ?>&urun_id=<?php echo $urunwrite['urun_id']; ?>"><i class="fa fa-trash-o"></i> Resmi Sil</a>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php } } ?>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.php'; ?>