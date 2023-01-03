<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$refsor=$db->prepare("SELECT * from referanslar order by referans_id DESC");
$refsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Referans İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="referans-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Referans Ekle</a>
					</div>
					Referanslar
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Referans id</strong>
								</th>
								<th class="text-left">
									<strong>Referans Resim</strong>
								</th>
								<th class="text-left">
									<strong>Referans adi</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($refcek=$refsor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td>#<?php echo $refcek['referans_id']; ?></td>
									<td><img style="max-height: 50px;" src="<?php echo $refcek['referans_resim1']; ?>"></td>
									<td><?php echo $refcek['referans_adi']; ?></td>
									<td class="text-center">
										<a href="referans-duzenle.php?referans_id=<?php echo $refcek['referans_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?referanssil=ok&referans_id=<?php echo $refcek['referans_id']; ?>&referans_resim1=<?php echo $refcek['referans_resim1']; ?>&referans_resim2=<?php echo $refcek['referans_resim2']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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