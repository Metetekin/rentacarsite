<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$urunedit=$db->prepare("SELECT * from urunler where urun_id=:urun_id");
$urunedit->execute(array(
	'urun_id' => $_GET['arac_id']
));
$urunwrite=$urunedit->fetch(PDO::FETCH_ASSOC);

?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Araç İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="araclar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Araç Düzenle
				</div>
				<div class="card-block">

					<form method="POST" action="controller/function.php" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<input type="hidden" name="urun_id" value="<?php echo $urunwrite['urun_id']; ?>">
						</div>
						<div class="form-group">
							<label>Araç Başlık</label>
							<input type="text" name="urun_baslik" value="<?php echo $urunwrite['urun_baslik']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Günlük Fiyatlar</label>
							<div class="input-group col-md-4">
								<span class="input-group-addon">1-3 günlük</span>
								<input type="text" name="urun_fiyat" value="<?php echo $urunwrite['urun_fiyat']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<div class="input-group col-md-4">
								<span class="input-group-addon">4-7 günlük</span>
								<input type="text" name="urun_47" value="<?php echo $urunwrite['urun_47']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<div class="input-group col-md-4">
								<span class="input-group-addon">8-15 günlük</span>
								<input type="text" name="urun_815" value="<?php echo $urunwrite['urun_815']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<div class="input-group col-md-4">
								<span class="input-group-addon">16-21 günlük</span>
								<input type="text" name="urun_1621" value="<?php echo $urunwrite['urun_1621']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<div class="input-group col-md-4">
								<span class="input-group-addon">22-28 günlük</span>
								<input type="text" name="urun_2228" value="<?php echo $urunwrite['urun_2228']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<div class="input-group col-md-4">
								<span class="input-group-addon">29-99 günlük</span>
								<input type="text" name="urun_2999" value="<?php echo $urunwrite['urun_2999']; ?>" class="form-control">
							</div>     	
						</div>
						<div class="form-group">
							<label>Yüklü Resim</label>
							<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $urunwrite['urun_resim']; ?>"></p>
							
						</div>
						<div class="form-group">
							<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
								<span class="input-group-addon btn btn-primary btn-file ">
									<span class="fileinput-new">Yeni Yükle</span>
									<span class="fileinput-exists">Değiştir</span>
									<input type="file"  name="urun_resim">
								</span>
								<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
							</div>
						</div>
						<div class="form-group">
							<label>Vitrinde Göster</label>
							<select name="urun_vitrin" class="form-control m-b">
								<?php if ($urunwrite['urun_vitrin']==1) { ?>
									<option value="1">Göster</option>
									<option value="0">Gizle</option>
									<?php
								} else {?>
									<option value="0">Gizle</option>
									<option value="1">Göster</option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Araç Kapı Sayısı</label>
							<select name="urun_kapi" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_kapi'] ?>"><?php echo $urunwrite['urun_kapi'] ?></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="form-group">
							<label>Araç Koltuk Sayısı</label>
							<select name="urun_koltuk" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_koltuk'] ?>"><?php echo $urunwrite['urun_koltuk'] ?></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
						</div>
						<div class="form-group">
							<label>Bagaj Bavul Kapasitesi</label>
							<select name="urun_bagaj" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_bagaj'] ?>"><?php echo $urunwrite['urun_bagaj'] ?></option>
								<option value="1 Bavul">1 Bavul</option>
								<option value="2 Bavul">2 Bavul</option>
								<option value="3 Bavul">3 Bavul</option>
								<option value="4 Bavul">4 Bavul</option>
								<option value="5 Bavul">5 Bavul</option>
							</select>
						</div>
						<div class="form-group">
							<label>Klima</label>
							<select name="urun_klima" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_klima'] ?>"><?php echo $urunwrite['urun_klima'] ?></option>
								<option value="Klimalı">Klimalı</option>
								<option value="Klimasız">Klimasız</option>
							</select>
						</div>
						<div class="form-group">
							<label>Yakıt</label>
							<select name="urun_yakit" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_yakit'] ?>"><?php echo $urunwrite['urun_yakit'] ?></option>
								<option value="Dizel">Dizel</option>
								<option value="Benzin">Benzin</option>
								<option value="Benzin/LPG">Benzin/LPG</option>
								<option value="Elektrik">Elektrik</option>
								<option value="Benzin/Elektrik">Benzin/Elektrik</option>
							</select>
						</div>
						<div class="form-group">
							<label>Vites</label>
							<select name="urun_vites" class="form-control m-b">
								<option value="<?php echo $urunwrite['urun_vites'] ?>"><?php echo $urunwrite['urun_vites'] ?></option>
								<option value="Otomatik">Otomatik</option>
								<option value="Manuel">Manuel</option>
							</select>
						</div>
						<div class="form-group">
							<label>Kiralamak için yakıt/depo prosedürü</label>
							<textarea style="height: 80px;" type="text" name="urun_yakitprosedur" class="form-control"><?php echo $urunwrite['urun_yakitprosedur'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Minimum kiralama süresi</label>
							<textarea style="height: 80px;" type="text" name="urun_kiralamasuresi" class="form-control"><?php echo $urunwrite['urun_kiralamasuresi'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Ehliyet-Yaş sınırı</label>
							<textarea style="height: 80px;" type="text" name="urun_ehliyetyassiniri" class="form-control"><?php echo $urunwrite['urun_ehliyetyassiniri'] ?></textarea>
						</div>
						<button style="cursor: pointer;" type="submit" name="urunduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
