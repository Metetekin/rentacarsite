<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$hizmetsor=$db->prepare("SELECT * from bilgi");
$hizmetsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Bilgi İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
					</div>
					Bilgiler
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Bilgi id</strong>
								</th>
								<th class="text-left">
									<strong>Bilgi Başlık</strong>
								</th>
								<th class="text-left">
									<strong>Bilgi Açıklama</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($hizmetcek=$hizmetsor->fetch(PDO::FETCH_ASSOC)) {
								$hizmeticerik=mb_substr(strip_tags($hizmetcek['bilgi_aciklama']), 0, 40, 'UTF-8')."...";
								?>
								<tr>
									<td>#<?php echo $hizmetcek['bilgi_id']; ?></td>
									<td><?php echo $hizmetcek['bilgi_baslik'] ?></td>
									<td><?php echo $hizmeticerik; ?></td>
									<td class="text-center">
										<a href="bilgi-duzenle.php?bilgi_id=<?php echo $hizmetcek['bilgi_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
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