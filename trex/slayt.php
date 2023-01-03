<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$slaytsor=$db->prepare("SELECT * from slayt order by slayt_id DESC");
$slaytsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Slayt İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="slayt-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Slayt Ekle</a>
					</div>
					Slayt
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Slayt id</strong>
								</th>
								<th class="text-left">
									<strong>Slayt Resim</strong>
								</th>
								<th class="text-left">
									<strong>Slayt Başlık</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($slaytcek=$slaytsor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td>#<?php echo $slaytcek['slayt_id']; ?></td>
									<td><img style="max-height: 150px;max-width: 150px;" src="<?php echo $slaytcek['slayt_resim']; ?>"></td>
									<td><?php echo $slaytcek['slayt_baslik']; ?></td>
									<td class="text-center">
										<a href="slayt-duzenle.php?slayt_id=<?php echo $slaytcek['slayt_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?slaytsil=ok&slayt_id=<?php echo $slaytcek['slayt_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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