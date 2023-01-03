<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$metakey=$db->prepare("SELECT * from meta order by meta_id DESC");
$metakey->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Seo İşlemleri</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-heading card-default">
					Seo Meta Düzenle
				</div>
				<div class="card-block">
					<?php while ($metakeyprint=$metakey->fetch(PDO::FETCH_ASSOC)) { ?>
						<!-- AYAR  -->
						<form method="POST" action="controller/function.php" class="form-horizontal">
							<div class="form-group">
								<div class="row">
									<input type="hidden" name="meta_id" value="<?php echo $metakeyprint['meta_id'] ?>"  class="form-control">
									<div class="col-md-2">
										<label>Sayfa Adı</label>
										<input type="text" placeholder="<?php echo $metakeyprint['meta_ad'] ?>" readonly class="form-control">
									</div>
									<div class="col-md-2">
										<label>Title</label>
										<input type="text" name="meta_title" value="<?php echo $metakeyprint['meta_title'] ?>" class="form-control">
									</div>
									<div class="col-md-3">
										<label>Description</label>
										<input type="text" name="meta_descr" value="<?php echo $metakeyprint['meta_descr'] ?>" class="form-control">
									</div>
									<div class="col-md-3">
										<label>Keyword</label>
										<input type="text" name="meta_keyword" value="<?php echo $metakeyprint['meta_keyword'] ?>" class="form-control">
									</div>
									<div class="col-md-2">
										<label>İşlemler</label><br />
										<button style="cursor: pointer;" type="submit" name="metaduzenle" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Güncelle</button>
										<div class="col-md-6">
										</div>
									</div>
								</div>
							</div>
						</form>
						<!--#AYAR  -->
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>