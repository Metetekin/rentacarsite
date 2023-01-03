<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$sayfalarsor=$db->prepare("SELECT * from sayfalar order by sayfa_id DESC");
$sayfalarsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Sayfa İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sayfa-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Sayfa Ekle</a>
					</div>
					Sayfalar
				</div>

				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Sayfa id</strong>
								</th>
								<th class="text-left">
									<strong>Sayfa Adı</strong>
								</th>
								<th class="text-left">
									<strong>Sayfa Açıklama</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($sayfacek=$sayfalarsor->fetch(PDO::FETCH_ASSOC)) {
								$sayfaicerik=mb_substr(strip_tags($sayfacek['sayfa_icerik']), 0, 20, 'UTF-8')."...";
								?>
								<tr>
									<td>#<?php echo $sayfacek['sayfa_id']; ?></td>
									<td><?php echo $sayfacek['sayfa_baslik']; ?></td>
									<td><?php echo $sayfaicerik; ?></td>
									<td class="text-center">
										<a href="sayfa-duzenle.php?sayfa_id=<?php echo $sayfacek['sayfa_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?sayfasil=ok&sayfa_id=<?php echo $sayfacek['sayfa_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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