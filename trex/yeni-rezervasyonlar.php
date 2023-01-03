<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$siparissor=$db->prepare("SELECT * from siparis where siparis_durum=1 order by siparis_tarih ASC");
$siparissor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Rezervasyon İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					Yeni Rezervasyonlar
				</div>
				<div class="card-block">
					<table id="datatable2" class="table table-striped dt-responsive nowrap">
						<thead>
							<tr>
								<th>
									<strong>Rezervasyon Tarih</strong>
								</th>
								<th>
									<strong>Rezervasyon No</strong>
								</th>
								<th>
									<strong>Rezervasyon Ad</strong>
								</th>
								<th>
									<strong>Rezervasyon Tel</strong>
								</th>
								<th>
									<strong>Rezervasyon Fiyat</strong>
								</th>
								<th class="text-center">
									<strong>İşlemeler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td><?php echo $sipariscek['siparis_tarih']; ?></td>
									<td><?php echo $sipariscek['siparis_id']; ?></td>
									<td><?php echo $sipariscek['siparis_ad']; ?></td>
									<td><?php echo $sipariscek['siparis_tel']; ?></td>
									<td><?php echo $sipariscek['siparis_fiyat']; ?>TL</td>
									<td class="text-center">
										<a href="rezervasyon-detay.php?rezervasyon_id=<?php echo $sipariscek['siparis_id']; ?>" title="Göster" class="btn btn-sm btn-default"><i class="fa fa-eye"></i></a>
										<a href="controller/function.php?rezervasyonsil=ok&rezervasyon_id=<?php echo $sipariscek['siparis_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
