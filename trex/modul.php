<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$widget=$db->prepare("SELECT * from widget");
$widget->execute(array(0));
$widgetprint=$widget->fetch(PDO::FETCH_ASSOC);
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Anasayfa Modül İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Modül Düzenle
				</div>

				<div class="card-block">
					<!-- AYAR  -->
					<form method="POST" action="controller/function.php" class="form-horizontal">
						<input type="hidden" name="widget_id" value="1">

						<input type="hidden" name="widget_twitter" value="<?php echo htmlspecialchars($widgetprint['widget_twitter']); ?>" class="form-control">
						<input type="hidden" name="widget_btwitter" value="<?php echo htmlspecialchars($widgetprint['widget_btwitter']); ?>" class="form-control">	
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Modül Adı</label>
									<input type="text" name="widget_bdiger" value="<?php echo htmlspecialchars($widgetprint['widget_bdiger']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<label>Modül Durum</label>
									<select name="widget_diger" class="form-control m-b">
										<?php if ($widgetprint['widget_diger']==1) { ?>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="widget_burun" value="<?php echo htmlspecialchars($widgetprint['widget_burun']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_urun" class="form-control m-b">
										<?php if ($widgetprint['widget_urun']==1) { ?>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="widget_bbilgi" readonly="" value="<?php echo htmlspecialchars($widgetprint['widget_bbilgi']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_bilgi" class="form-control m-b">
										<?php if ($widgetprint['widget_bilgi']==1) { ?>
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
						<input type="hidden" name="widget_breferans" value="<?php echo htmlspecialchars($widgetprint['widget_breferans']); ?>" class="form-control">
						<input type="hidden" name="widget_referans" value="<?php echo htmlspecialchars($widgetprint['widget_referans']); ?>" class="form-control">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text"  placeholder="Counter" readonly class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_counter" class="form-control m-b">
										<?php if ($widgetprint['widget_counter']==1) { ?>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="widget_byorum" value="<?php echo htmlspecialchars($widgetprint['widget_byorum']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_yorum" class="form-control m-b">
										<?php if ($widgetprint['widget_yorum']==1) { ?>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="widget_bblog" value="<?php echo htmlspecialchars($widgetprint['widget_bblog']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_blog" class="form-control m-b">
										<?php if ($widgetprint['widget_blog']==1) { ?>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="widget_bara" value="<?php echo htmlspecialchars($widgetprint['widget_bara']); ?>" class="form-control">
								</div>
								<div class="col-md-6">
									<select name="widget_ara" class="form-control m-b">
										<?php if ($widgetprint['widget_ara']==1) { ?>
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
						<input type="hidden" name="widget_welcome" value="<?php echo htmlspecialchars($widgetprint['widget_welcome']); ?>" class="form-control">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Footer Yazı Alanı</label>
									<textarea style="height: 80px;" name="widget_bwelcome" class="form-control"><?php echo htmlspecialchars($widgetprint['widget_bwelcome']); ?></textarea>
								</div>							
							</div>
						</div>
						<button style="cursor: pointer;" type="submit" name="widgetduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
					<!--#AYAR  -->
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
