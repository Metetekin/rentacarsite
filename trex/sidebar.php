<?php 
$link = $_SERVER['REQUEST_URI'];
?>
<div class="main-sidebar-nav default-navigation">
	<div class="nano">
		<div class="nano-content sidebar-nav">
			<ul class="metisMenu nav flex-column" id="menu">
				<div class="card-block border-bottom text-center nav-profile">
					<img alt="profile" class="rounded-circle margin-b-10 circle-border " src="<?php echo $userprint['kullanici_resim']; ?>" width="80">
					<p class="lead margin-b-0 toggle-none"><small>sayın<br> </small><?php echo $userprint['kullanici_adsoyad'] ?></p>
					<p class="text-muted mv-0 toggle-none">Hoşgeldin</p>
				</div>	
				<li class="nav-heading">
					<b>Menü</b>			
				</li>
				<li class="nav-item <?php if (strstr($link, "index.php")) { echo "active";} ?>"><a class="nav-link" href="index.php"><i class="icon-home"></i> <span class="toggle-none">Panel Anasayfa </a></li>	

					<li class="nav-item"><a class="nav-link" target="_blank" href="<?php echo $settingsprint['ayar_siteurl']; ?>"><i class="icon-link"></i> <span class="toggle-none">Siteye Git </a></li>	

						<li  class="nav-item <?php if (strstr($link, "urun")) { echo "active";} ?>"><a class="nav-link" href="araclar.php"><i class="icon-arrow-right"></i> <span class="toggle-none">Araç Yönetimi</a></li>

							<li class="nav-item <?php if (strstr($link, "hesap")) { echo "active";} ?><?php if (strstr($link, "rezervasyon")) { echo "active";} ?><?php if (strstr($link, "odeme")) { echo "active";} ?>">
								<a class="nav-link" href="javascript: void(0);" aria-expanded="true"><i class="icon-pencil"></i> <span class="toggle-none">Rezervasyon Yönetimi<span style="float: right;" class="fa fa-angle-down"></span></span></a>
								<ul class="nav-second-level nav flex-column sub-menu" aria-expanded="true">
									<li class="nav-item"><a class="nav-link" href="yeni-rezervasyonlar.php">Yeni Rezervasyonlar</a></li>
									<li class="nav-item"><a class="nav-link" href="tamamlanan-rezervasyonlar.php">Tamamlanan Rezervasyonlar</a></li>
									<li class="nav-item"><a class="nav-link" href="hesaplarim.php">Hesap Bilgileri</a></li>
									<li class="nav-item"><a class="nav-link" href="odeme-yontemleri.php">Ödeme Yöntemleri</a></li>
								</ul>
							</li>

							<li class="nav-item <?php if (strstr($link, "referans")) { echo "active";} ?><?php if (strstr($link, "sozlesme")) { echo "active";} ?><?php if (strstr($link, "marka")) { echo "active";} ?><?php if (strstr($link, "yorum")) { echo "active";} ?><?php if (strstr($link, "bilgi")) { echo "active";} ?><?php if (strstr($link, "sosyal")) { echo "active";} ?><?php if (strstr($link, "sube")) { echo "active";} ?><?php if (strstr($link, "sss")) { echo "active";} ?><?php if (strstr($link, "sayfa")) { echo "active";} ?><?php if (strstr($link, "hizmet")) { echo "active";} ?><?php if (strstr($link, "html")) { echo "active";} ?><?php if (strstr($link, "bolge")) { echo "active";} ?><?php if (strstr($link, "blog")) { echo "active";} ?>">
								<a class="nav-link" href="" aria-expanded="true"><i class="icon-list"></i> <span class="toggle-none">İçerik Yönetimi<span style="float: right;" class="fa fa-angle-down"></span></span></a>
								<ul class="nav-second-level nav flex-column sub-menu" aria-expanded="true">
									<li class="nav-item"><a class="nav-link" href="hizmetler.php">Hizmet Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="sube.php">Şube Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="sozlesme.php">Satış Sözleşlesi</a></li>
									<li class="nav-item"><a class="nav-link" href="bilgiler.php">Bilgi Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="referanslar.php">Marka Referans Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="projeler.php">Proje Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="html-alan.php">Ana Sayfa HTML Alan</a></li>
									<li class="nav-item"><a class="nav-link" href="blog.php">Blog Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="sayfalar.php">Sayfa Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="sss.php">Sık Sorulan Sorular</a></li>
									<li class="nav-item"><a class="nav-link" href="sosyal-medya.php">Sosyal Medya Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="yorumlar.php">Yorum Yönetimi</a></li>
								</ul>
							</li>
							<li class="nav-item <?php if (strstr($link, "slayt")) { echo "active";} ?><?php if (strstr($link, "video")) { echo "active";} ?><?php if (strstr($link, "resim")) { echo "active";} ?>">
								<a class="nav-link" href="" aria-expanded="true"><i class="icon-film"></i> <span class="toggle-none">Medya Yönetimi<span style="float: right;" class="fa fa-angle-down"></span></span></a>
								<ul class="nav-second-level nav flex-column sub-menu" aria-expanded="true">
									<li class="nav-item"><a class="nav-link" href="slayt.php">Slayt Yönetimi</a></li>
								</ul>
							</li>
							<li class="nav-item <?php if (strstr($link, "menu")) { echo "active";} ?><?php if (strstr($link, "link")) { echo "active";} ?>">
								<a class="nav-link" href="" aria-expanded="true"><i class="icon-list"></i> <span class="toggle-none">Menü Yönetimi<span style="float: right;" class="fa fa-angle-down"></span></span></a>
								<ul class="nav-second-level nav flex-column sub-menu" aria-expanded="true">
									<li class="nav-item"><a class="nav-link" href="menu.php">Üst Menü Yönetimi</a></li>
									<li class="nav-item"><a class="nav-link" href="yan-menu.php">Yan Menü</a></li>
									<li class="nav-item"><a class="nav-link" href="alt-menu.php">Alt Menü</a></li>
								</ul>
							</li>
							
							<li class="nav-item <?php if (strstr($link, "modul")) { echo "active";} ?>"><a class="nav-link" href="modul.php"><i class="icon-puzzle"></i> <span class="toggle-none">Modül Yönetimi</a></li>
								<li class="nav-item <?php if (strstr($link, "kolay")) { echo "active";} ?>"><a class="nav-link" href="kolay-iletisim.php"><i class=" icon-call-in"></i> <span class="toggle-none">Kolay İletişim</a></li>
									<li class="nav-item <?php if (strstr($link, "google")) { echo "active";} ?>"><a class="nav-link" href="google-yandex-ayarlari.php"><i class="icon-magnifier"></i> <span class="toggle-none">Google&Yandex Yönetimi</a></li>

										<li class="nav-item <?php if (strstr($link, "seo")) { echo "active";} ?>"><a class="nav-link" href="seo.php"><i class="icon-rocket"></i> <span class="toggle-none">Seo Yönetimi</a></li>

											<li class="nav-item <?php if (strstr($link, "counter")) { echo "active";} ?>"><a class="nav-link" href="counter.php"><i class="icon-equalizer"></i> <span class="toggle-none">Counter Yönetimi</a></li>

												<li class="nav-item <?php if (strstr($link, "genel-ayar")) { echo "active";} ?>"><a class="nav-link" href="genel-ayarlar.php"><i class="icon-wrench"></i> <span class="toggle-none">Site Ayarları</a></li>
												</ul>
											</div>
										</div>
									</div>
