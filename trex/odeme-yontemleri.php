<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$havaleedit=$db->prepare("SELECT * from odeme");
$havaleedit->execute(array());


?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Ödeme İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Ödeme Düzenle
				</div>
				<div class="card-block">
					<?php while ($havalewrite=$havaleedit->fetch(PDO::FETCH_ASSOC)) { ?>
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<div class="row">
								<input type="hidden" name="odeme_id" value="<?php echo $havalewrite['odeme_id']; ?>"  class="form-control">
								<div class="col-md-3">
									<label>Ödeme Adı</label>
									<input type="text" name="odeme_adi" value="<?php echo $havalewrite['odeme_adi']; ?>" readonly class="form-control">
								</div>
								<div class="col-md-5">
									<label>Ödeme Notu</label>
									<input type="text" name="odeme_not" value="<?php echo $havalewrite['odeme_not']; ?>" class="form-control">
								</div>
								<div class="col-md-2">
									<label>Ödeme Durum</label>
									<select name="odeme_durum" class="form-control m-b">
										<?php if ($havalewrite['odeme_durum']==1) { ?>
											<option value="1">Aktif</option>
											<option value="0">Pasif</option>
											<?php
										} else {?>
											<option value="0">Pasif</option>
											<option value="1">Aktif</option>
										<?php }?>
									</select>
								</div>
								<div class="col-md-2">
									<label>*Kaydet</label><div>
										<button style="cursor: pointer;" type="submit" name="odemeduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Kaydet</button></div>
									</div>
								</div>
							</div>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
