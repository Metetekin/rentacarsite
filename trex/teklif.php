<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$randevusor=$db->prepare("SELECT * from randevu");
$randevusor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Teklif İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					Gelen Teklif Talepleri
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Oluşturulma Tarihi</strong>
								</th>
								<th class="text-left">
									<strong>Ad Soyad</strong>
								</th>
								<th class="text-left">
									<strong>Telefon</strong>
								</th>
								<th class="text-left">
									<strong>Hizmet</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($randevuprint=$randevusor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td><?php echo $randevuprint['randevu_tarih']; ?></td>
									<td><?php echo $randevuprint['randevu_ad']; ?></td>
									<td><?php echo $randevuprint['randevu_tel']; ?></td>
									<td><?php echo $randevuprint['randevu_hizmet']; ?></td>
									<td class="text-center">
										<a href="teklif-detay.php?teklif_id=<?php echo $randevuprint['randevu_id']; ?>" title="Göster" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
										<a href="controller/function.php?randevusil=ok&randevu_id=<?php echo $randevuprint['randevu_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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