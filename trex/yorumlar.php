<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$yorumsor=$db->prepare("SELECT * from yorumlar order by yorum_id DESC");
$yorumsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Yorum İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="yorum-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Yorum Ekle</a>
					</div>
					Yorum
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Yorum id</strong>
								</th>
								<th class="text-left">
									<strong>Yorum Resim</strong>
								</th>
								<th class="text-left">
									<strong>Yorum İçeril</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td>#<?php echo $yorumcek['yorum_id']; ?></td>
									<td><img style="max-height: 150px;max-width: 150px;" src="<?php echo $yorumcek['yorum_resim']; ?>"></td>
									<td><?php echo mb_substr($yorumcek['yorum_icerik'], 0,80, 'UTF-8'); ?></td>
									<td class="text-center">
										<a href="yorum-duzenle.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?yorumsil=ok&yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorum_resim=<?php echo $yorumcek['yorum_resim']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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