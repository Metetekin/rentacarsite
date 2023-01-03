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
		<h2>Kolay İletişim İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Kolay İletişim Düzenle
				</div>

				<div class="card-block">
					<!-- AYAR  -->
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<div class="form-group">
							<div class="row">
								
								<input type="hidden" name="whats_id" value="0"  class="form-control">
								<!-- Grup -->
								<div class="col-md-6">
									<label>Whatsapp Tel:</label> <small>(Başında 0 'Sıfır' olmadan giriniz.)</small>
									<input type="text" name="whats_tel" value="<?php echo $whatsappprint['whats_tel']; ?>" class="form-control">
								</div>	
								<div class="col-md-6">
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
							<!-- Grup -->
							<!-- Grup -->
							<div style="margin-top: 20px;" class="col-md-6">
								<label>Teklif Al:</label> 
								<input type="text" name="whats_cdestek" value="<?php echo $whatsappprint['whats_cdestek']; ?>" class="form-control">
							</div>	
							<div style="margin-top: 20px;" class="col-md-6">
								<label>Modül Durum</label>
								<select name="whats_cdestekdurum" class="form-control m-b">
									<?php if ($whatsappprint['whats_cdestekdurum']==1) { ?>
									<option value="1">Aktif</option>
									<option value="0">Pasif</option>
									<?php
								} else {?>
								<option value="0">Pasif</option>
								<option value="1">Aktif</option>
								<?php }?>
							</select>
						</div>	
						<!-- Grup -->		
						<!-- Grup -->
						<div style="margin-top: 20px;" class="col-md-6">
							<label>Tıkla Ara:</label> <small>(Başında 0 'Sıfır' olmadan giriniz.)</small>
							<input type="text" name="whats_tiklaara" value="<?php echo $whatsappprint['whats_tiklaara']; ?>" class="form-control">
						</div>	
						<div style="margin-top: 20px;" class="col-md-6">
							<label>Modül Durum</label>
							<select name="whats_tiklaaradurum" class="form-control m-b">
								<?php if ($whatsappprint['whats_tiklaaradurum']==1) { ?>
								<option value="1">Aktif</option>
								<option value="0">Pasif</option>
								<?php
							} else {?>
							<option value="0">Pasif</option>
							<option value="1">Aktif</option>
							<?php }?>
						</select>
					</div>	
					<!-- Grup -->
					<!-- Grup -->
					<div style="margin-top: 20px;" class="col-md-6">
						<label>Skype:</label> <small>(Kullanıcı adını girmeniz yeterli.)</small>
						<input type="text" name="whats_skype" value="<?php echo $whatsappprint['whats_skype']; ?>" class="form-control">
					</div>	
					<div style="margin-top: 20px;" class="col-md-6">
						<label>Modül Durum</label>
						<select name="whats_skypedurum" class="form-control m-b">
							<?php if ($whatsappprint['whats_skypedurum']==1) { ?>
							<option value="1">Aktif</option>
							<option value="0">Pasif</option>
							<?php
						} else {?>
						<option value="0">Pasif</option>
						<option value="1">Aktif</option>
						<?php }?>
					</select>
				</div>	
				<!-- Grup -->	
				<!-- Grup -->
				<div style="margin-top: 20px;" class="col-md-6">
					<label>Mail:</label> <small>(Mail adresini girmeniz yeterli.)</small>
					<input type="text" name="whats_mail" value="<?php echo $whatsappprint['whats_mail']; ?>" class="form-control">
				</div>	
				<div style="margin-top: 20px;" class="col-md-6">
					<label>Modül Durum</label>
					<select name="whats_maildurum" class="form-control m-b">
						<?php if ($whatsappprint['whats_maildurum']==1) { ?>
						<option value="1">Aktif</option>
						<option value="0">Pasif</option>
						<?php
					} else {?>
					<option value="0">Pasif</option>
					<option value="1">Aktif</option>
					<?php }?>
				</select>
			</div>	
			<!-- Grup -->	
			<!-- Grup -->	
			<div style="margin-top: 20px;" class="col-md-6">
				<label>Sık Sorulan Sorular:</label>
				<select name="whats_sssdurum" class="form-control m-b">
					<?php if ($whatsappprint['whats_sssdurum']==1) { ?>
					<option value="1">Aktif</option>
					<option value="0">Pasif</option>
					<?php
				} else {?>
				<option value="0">Pasif</option>
				<option value="1">Aktif</option>
				<?php }?>
			</select>
		</div>	
		<div style="margin-top: 20px;" class="col-md-6">
			<label>İletişim Formu:</label>
			<select name="whats_iletisimdurum" class="form-control m-b">
				<?php if ($whatsappprint['whats_iletisimdurum']==1) { ?>
				<option value="1">Aktif</option>
				<option value="0">Pasif</option>
				<?php
			} else {?>
			<option value="0">Pasif</option>
			<option value="1">Aktif</option>
			<?php }?>
		</select>
	</div>
	<!-- Grup -->	

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
