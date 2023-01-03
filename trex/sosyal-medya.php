<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$sosyalsor=$db->prepare("SELECT * from sosyal order by sosyal_id DESC");
$sosyalsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Sosyal Medya İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="sosyal-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Sosyal Medya Ekle</a>
					</div>
					Sosyal Medya
				</div>

				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-center">
									<strong>İcon</strong>
								</th>
								<th class="text-left">
									<strong>Sosyal Link</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($sosyalcek=$sosyalsor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td class="text-center"><i class="fa <?php echo $sosyalcek['sosyal_icon']; ?>"></i></td>
									<td><?php echo $sosyalcek['sosyal_link']; ?></td>
									<td class="text-center">
										<a href="sosyal-duzenle.php?sosyal_id=<?php echo $sosyalcek['sosyal_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?sosyalsil=ok&sosyal_id=<?php echo $sosyalcek['sosyal_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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