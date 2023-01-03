<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$whatsapp=$db->prepare("SELECT * from whatsapp where whats_id=0");
$whatsapp->execute(array(0));
$whatsappprint=$whatsapp->fetch(PDO::FETCH_ASSOC);
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Whatsapp İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Whatsapp Destek Düzenle
				</div>

				<div class="card-block">
					<!-- AYAR  -->
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<div class="row">
								
								<input type="hidden" name="whats_id" value="0"  class="form-control">
								<div class="col-md-4">
									<label>Whatsapp Tel:</label> <small>(Başında 0 'Sıfır' olmadan giriniz.)</small>
									<input type="text" name="whats_tel" value="<?php echo $whatsappprint['whats_tel']; ?>" class="form-control">
								</div>
								<div class="col-md-4">
									<label>Modül Yön</label>
									<select name="whats_yon" class="form-control m-b">
										<?php if ($whatsappprint['whats_yon']=='right') { ?>
										<option value="right">Sağ</option>
										<option value="left">Sol</option>
										<?php
									} else {?>
									<option value="left">Sol</option>
									<option value="right">Sağ</option>
									<?php }?>
								</select>
							</div>	
							<div class="col-md-4">
								<label>Modül Durum</label>
								<select name="whats_durum" class="form-control m-b">
									<?php if ($whatsappprint['whats_durum']==1) { ?>
									<option value="1">Aktif</option>
									<option value="0">Pasif</option>
									<?php
								} else {?>
								<option value="0">Pasif</option>
								<option value="1">Aktif</option>
								<?php }?>
							</select>
						</div>						
					</div>
				</div>
				<button style="cursor: pointer;" type="submit" name="whatsappduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
			</form>
			<!--#AYAR  -->
		</div>
	</div>
</div>
</div>
<?php include 'footer.php'; ?>
