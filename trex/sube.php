<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$sayfalarsor=$db->prepare("SELECT * from sube order by sube_id DESC");
$sayfalarsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Şube İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sube-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Şube Ekle</a>
					</div>
					Şubeler
				</div>

				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Sube id</strong>
								</th>
								<th class="text-left">
									<strong>Sube Adı</strong>
								</th>
								<th class="text-left">
									<strong>Sube İl / İLÇE</strong>
								</th>
								<th class="text-center">
									<strong>işlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($sayfacek=$sayfalarsor->fetch(PDO::FETCH_ASSOC)) {
								$sayfaicerik=$sayfacek['sube_il']." / ".$sayfacek['sube_ilce'];
								?>
								<tr>
									<td>#<?php echo $sayfacek['sube_id']; ?></td>
									<td><?php echo $sayfacek['sube_adi']; ?></td>
									<td><?php echo $sayfaicerik; ?></td>
									<td class="text-center">
										<a href="sube-duzenle.php?sube_id=<?php echo $sayfacek['sube_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?subesil=ok&sube_id=<?php echo $sayfacek['sube_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
