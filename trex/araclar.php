<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$urunsor=$db->prepare("SELECT * from urunler order by urun_id ASC");
$urunsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Araç İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="arac-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i>Araç Ekle</a>
					</div>
					<div style="margin-right: 20px;" class="pull-right mt-10">
						<a href="form-subeler.php" class="btn btn-warning btn-icon"><i class="icon-home"></i>Alış ve Teslim Şube Yönetimi</a>
					</div>
					<div style="margin-right: 20px;" class="pull-right mt-10">
						<a href="ozellikler.php" class="btn btn-success btn-icon"><i class="fa fa-plus"></i>Özellik Yönetimi</a>
					</div>
					Araçlar
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Araç Resim</strong>
								</th>
								<th class="text-left">
									<strong>Araç İsmi</strong>
								</th>
								<th class="text-left">
									<strong>Araç Fiyat</strong>
								</th>
								<th class="text-left">
									<strong>Araç Yakıt</strong>
								</th>
								<th class="text-left">
									<strong>Araç Vites</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td><img style="max-height: 140px;max-width: 240px;" src="<?php echo $uruncek['urun_resim']; ?>"></td>
									<td><?php echo $uruncek['urun_baslik']; ?></td>
									<td><?php echo $uruncek['urun_fiyat']; ?> TL</td>
									<td><?php echo $uruncek['urun_yakit']; ?></td>
									<td><?php echo $uruncek['urun_vites']; ?></td>
									<td class="text-center">
										<a href="arac-duzenle.php?arac_id=<?php echo $uruncek['urun_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?aracsil=ok&arac_id=<?php echo $uruncek['urun_id']; ?>&urun_resim=<?php echo $uruncek['urun_resim']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- İLETİŞİM MESAJLARI -->
		</div>

		<?php include 'footer.php'; ?>
