<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$kategorisor=$db->prepare("SELECT * from kategoriler");
$kategorisor->execute(array(0));
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
						<a href="form-sube-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Şube Ekle</a>
					</div>
					<div style="margin-right: 20px;" class="pull-right mt-10">
						<a href="araclar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
					</div>
					Şubeler
				</div>

				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th style="width: 10%;" class="text-center">
									<strong>Şube Sira</strong>
								</th>
								<th class="text-left">
									<strong>Şube Adı</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<tr>
									<td class="text-center"><?php echo $kategoricek['kategori_sira']; ?></i></td>
									<td><?php echo $kategoricek['kategori_ad']; ?></i></td>
									<td class="text-center">
										<a href="form-sube-duzenle.php?sube_id=<?php echo $kategoricek['kategori_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?formsubesil=ok&sube_id=<?php echo $kategoricek['kategori_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
