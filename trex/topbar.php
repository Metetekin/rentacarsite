<!-- ============================================================== -->
<!-- 						Topbar Start 							-->
<!-- ============================================================== -->
<div class="top-bar light-top-bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<a class="admin-logo" href="index.php">
				    <h1>

						<img alt="" src="assets/img/genel/logo.png" class="logo-icon margin-r-10">

						<img alt="" src="assets/img/genel/logo-text.png" class="toggle-none hidden-xs">

					</h1>
				</a>
				<div class="left-nav-toggle" >
					<a  href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
				</div>
				<div class="left-nav-collapsed" >
					<a  href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
				</div>
			</div>
			<div class="col">
				<ul class="list-inline top-right-nav">
					<li class="dropdown icon-dropdown d-none-m">
						<a href="genel-ayarlar.php"><i class="icon-settings"></i></a>
					</li>
					<li class="dropdown avtar-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<img alt="" class="rounded-circle" src="<?php echo $userprint['kullanici_resim']; ?>" width="30">
						</a>
						<ul class="dropdown-menu top-dropdown">
							<li>
								<a class="dropdown-item" href="user.php"><i class="icon-user"></i> Profil</a>
							</li>
							<li class="dropdown-divider"></li>
							<li>
								<a class="dropdown-item" href="logout.php"><i class="icon-logout"></i> Güvenli Çıkış</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!--                        Topbar End                              -->
<!-- ============================================================== -->

