<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$sms=$db->prepare("SELECT * from sms where sms_id=?");
$sms->execute(array(0));
$smsprint=$sms->fetch(PDO::FETCH_ASSOC);
$mail=$db->prepare("SELECT * from mail where mail_id=?");
$mail->execute(array(0));
$mailprint=$mail->fetch(PDO::FETCH_ASSOC);
?>	
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">

	<div class="page-header">
		<h2>Genel Ayarlar</h2>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="nav-item" role="presentation"><a class="nav-link  active" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">AYARLAR</a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="#tema" aria-controls="tema" role="tab" data-toggle="tab">TEMA</a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SANAL POS (PAYTR)</a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="#contact" aria-controls="contact" role="tab" data-toggle="tab">İLETİŞİM</a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="#mail" aria-controls="mail" role="tab" data-toggle="tab">SMTP</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="settings">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								GENEL AYARLAR
							</div>
							<div class="card-block">
								<form id="signupForm" method="POST" enctype="multipart/form-data" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<input type="hidden" name="eskiyol_logo" value="<?php echo $settingsprint['ayar_logo']; ?>">
									</div>
									<div class="form-group">
										<input type="hidden" name="eskiyol_fav" value="<?php echo $settingsprint['ayar_fav']; ?>">
									</div>
									<div class="form-group">
										<label>Yüklü Logo</label> <small> Logo max 128x90 olmalıdır. <b style="color: red;">(90 yükseklik şefaf olmalı, gerçek resim daha küçük olmalı)</b></small>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_logo']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_logo">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>
									<div class="form-group">
										<label>Yüklü Favicon</label> <small> Logo max 36x36 olmalıdır.</small>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_fav']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_fav">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>
									<div class="form-group">
										<label>Sınırsız Site Rengi</label>
										<input class="jscolor form-control form-control-rounded" name="ayar_mobil" value="<?php echo $settingsprint['ayar_mobil']; ?>">

									</div>
									<div class="form-group">
										<label for="ayar_siteurl">Site Link <small>Belirtilen linke <b style="color: red;">http://</b> veya <b style="color: red;">https://</b> dahil ediniz.</small></label>
										<input type="text" class="form-control" id="ayar_siteurl" name="ayar_siteurl" value="<?php echo $settingsprint['ayar_siteurl']; ?>" />
									</div>
									<div class="form-group">
										<label for="ayar_firmaadi">Firma Adı</label>
										<input type="text" class="form-control" id="ayar_firmaadi" name="ayar_firmaadi" value="<?php echo $settingsprint['ayar_firmaadi']; ?>" />
									</div>
									<div class="form-group">
										<label for="ayar_harita">Harita Kodu</label>
										<textarea style="height: 100px;" class="form-control" name="ayar_harita" rows="5" id="ayar_harita"><?php echo htmlspecialchars($settingsprint['ayar_harita']); ?></textarea>
									</div>
									<div class="form-group">
										<label for="ayar_kod">Canlı Destek Kodu</label>
										<textarea style="height: 100px;" class="form-control" name="ayar_kod" rows="5" id="ayar_harita"><?php echo htmlspecialchars($settingsprint['ayar_kod']); ?></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="genelayar" value="Sign up">Güncelle</button>
									</div>
								</form>
							</div>
							<!-- FORM SON -->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="tema">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								TEMA AYARLARI
							</div>
							<div class="card-block">


								<!-- TEMA ARKAPLAN -->
								<form id="signupForm" method="POST" enctype="multipart/form-data" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<input type="hidden" name="eskiyol_footer1" value="<?php echo $settingsprint['ayar_footer1']; ?>">
									</div>
									<div class="form-group">
										<label>Footer Araç 1</label>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_footer1']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_footer1">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>
									<div class="form-group">
										<input type="hidden" name="eskiyol_footer2" value="<?php echo $settingsprint['ayar_footer2']; ?>">
									</div>
									<div class="form-group">
										<label>Footer Araç 2</label> 
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_footer2']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_footer2">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>


									<div class="form-group">
										<input type="hidden" name="eskiyol_paralax" value="<?php echo $settingsprint['ayar_resimparalax']; ?>">
									</div>
									<div class="form-group">
										<input type="hidden" name="eskiyol_counter" value="<?php echo $settingsprint['ayar_resimcounter']; ?>">
									</div>

									<div class="form-group">
										<label>Bilgi Alanı Sol Görsel</label>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_resimparalax']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_resimparalax">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>


									<div class="form-group">
										<input type="hidden" name="eskiyol_index" value="<?php echo $settingsprint['ayar_resimindex']; ?>">
									</div>
									<div class="form-group">
										<label>Araçlar altı Görsel</label>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_resimindex']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_resimindex">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>





									<div class="form-group">
										<label>Yüklü Counter Arkaplan</label> <small> Ölçü max 1920x1280 olmalıdır.</small>
										<p><img style="max-height: 100px;max-width: 100px;" src="<?php echo $settingsprint['ayar_resimcounter']; ?>"></p>
									</div>
									<div class="form-group">
										<div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-primary btn-file ">
												<span class="fileinput-new">Yeni Yükle</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file"  name="ayar_resimcounter">
											</span>
											<a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Sil</a>
										</div>
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="arkaplan" value="Sign up">Güncelle</button>
									</div>
								</form>
								<!-- TEMA ARKAPLAN -->
							</div>
							<!-- FORM SON -->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="seo">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								SANAL POS AYARLARI <br>
							</div>
							<div class="card-block">
								<form id="signupForm" method="post" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<label>Mağaza No (merchant_id)</label>
										<input type="text" name="ayar_title" value="<?php echo $settingsprint['ayar_title']; ?>" class="form-control form-control-rounded">
									</div>

									<div class="form-group">
										<label>Mağaza Parola (merchant_key)</label>
										<input name="ayar_description" type="text" value="<?php echo $settingsprint['ayar_description']; ?>" class="form-control form-control-rounded">
									</div>

									<div class="form-group">
										<label>Mağaza Gizli Anahtar (merchant_salt)</label>
										<input type="text" name="ayar_keywords" value="<?php echo $settingsprint['ayar_keywords']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Geri Bildirim URL (Bu linki PAYTR hesabınızda "Ayarlar" menüsünden "Bildirim URL Ayarı (Callback URL)" sayfasında tanımlamalısınız.)</label>
										<input type="text" readonly="" value="<?php echo $settingsprint['ayar_siteurl']; ?>pay_int.php" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="seoayar" value="Sign up">Güncelle</button>
									</div>
								</form>
							</div>
							<!-- FORM SON -->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="contact">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								İLETİŞİM AYARLARI
							</div>
							<div class="card-block">
								<form id="signupForm" method="POST" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<input type="hidden" class="form-control" id="ayar_adres" name="ayar_adres" value="<?php echo $settingsprint['ayar_adres']; ?>" />
									</div>

									<div class="form-group">
										<input type="hidden" class="form-control" id="ayar_il" name="ayar_il" value="<?php echo $settingsprint['ayar_il']; ?>" />
									</div>

									<div class="form-group">
										<input type="hidden" class="form-control" id="ayar_ilce" name="ayar_ilce" value="<?php echo $settingsprint['ayar_ilce']; ?>" />
									</div>

									<div class="form-group">
										<label for="ayar_mail">Email</label>
										<input type="text" class="form-control" id="ayar_mail" name="ayar_mail" value="<?php echo $settingsprint['ayar_mail']; ?>" />
									</div>

									<div class="form-group">
										<input type="hidden" class="form-control" id="ayar_fax" name="ayar_fax" value="<?php echo $settingsprint['ayar_fax']; ?>" />
									</div>
									<div class="form-group">
										<label for="ayar_tel">Telefon</label>
										<input type="text" class="form-control" id="ayar_tel" name="ayar_tel" value="<?php echo $settingsprint['ayar_tel']; ?>" />
									</div>
									<div class="form-group">
										<label>Kolay Erişim Butonu</label>
										<select name="ayar_ara" class="form-control m-b">
											<?php if ($settingsprint['ayar_ara']==1) { ?>
												<option value="1">Aktif</option>
												<option value="0">Pasif</option>
												<?php
											} else {?>
												<option value="0">Pasif</option>
												<option value="1">Aktif</option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="iletisimayar" value="Sign up">Güncelle</button>
									</div>
								</form>
							</div>
							<!-- FORM SON -->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="sms">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								SMS AYARLARI
								<p>SMS firması İleti merkezi'dir Link: <a target="_blank" href="https://www.iletimerkezi.com">www.iletimerkezi.com</a></p><br><img style="height: 34px;background: #d83d3d;border-radius: 4px;padding: 5px;margin-top: -40px;" src="assets/img/genel/ileti-merkezi-logo.png">
							</div>
							<div class="card-block">
								<form id="signupForm" method="post" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<label>Kullanıcı Adı</label>
										<input type="text" name="sms_kullanici" value="<?php echo $smsprint['sms_kullanici']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Şifre</label>
										<input name="sms_sifre" type="text" value="<?php echo $smsprint['sms_sifre']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Başlık</label>
										<input type="text" name="sms_baslik" value="<?php echo $smsprint['sms_baslik']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Durum</label>
										<select name="sms_durum" class="form-control m-b">
											<?php if ($smsprint['sms_durum']==1) { ?>
												<option value="1">Aktif</option>
												<option value="0">Pasif</option>
												<?php
											} else {?>
												<option value="0">Pasif</option>
												<option value="1">Aktif</option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="sms" value="Sign up">Güncelle</button>
									</div>
								</form>
							</div>
							<!-- FORM SON -->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="mail">
						<div class="widget white-bg">
							<!-- FORM BAŞLA -->
							<div class="card-heading card-default">
								SMTP AYARLARI
							</div>
							<div class="card-block">
								<form id="signupForm" method="post" class="form-horizontal" action="controller/function.php">
									<div class="form-group">
										<label>Bildirim Yapılacak Mail</label>
										<input type="text" name="mail_bildirim" value="<?php echo $mailprint['mail_bildirim']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Adresi</label>
										<input type="text" name="mail_user" value="<?php echo $mailprint['mail_user']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Şifre</label>
										<input type="text" name="mail_pass" value="<?php echo $mailprint['mail_pass']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Sunucu</label>
										<input type="text" name="mail_host" value="<?php echo $mailprint['mail_host']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Port</label>
										<input type="text" name="mail_port" value="<?php echo $mailprint['mail_port']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Gönderici</label>
										<input type="text" name="mail_sender" value="<?php echo $mailprint['mail_sender']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Mail Adı</label>
										<input type="text" name="mail_name" value="<?php echo $mailprint['mail_name']; ?>" class="form-control form-control-rounded">
									</div>
									<div class="form-group">
										<label>Durum</label>
										<select name="mail_secure" class="form-control m-b">
											<?php if ($mailprint['mail_secure']=='ssl') { ?>
												<option value="ssl">SSL</option>
												<option value="tls">TLS</option>
												<?php
											} else {?>
												<option value="tls">TLS</option>
												<option value="ssl">SSL</option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary" name="mailayarlari" value="Sign up">Güncelle</button>
									</div>
								</form>
							</div>
							<!-- FORM SON -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- 						Content End 							-->
	<!-- ============================================================== -->

	<?php include 'footer.php'; ?>
