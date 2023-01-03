<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$blogsor=$db->prepare("SELECT * from blog order by blog_id DESC");
$blogsor->execute(array(0));
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Blog İşlemleri</h2>
	</div>
	<div class="row">
		<!-- İLETİŞİM MESAJLARI -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-heading card-default">
					<div class="pull-right mt-10">
						<a href="blog-ekle.php" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i> Blog Ekle</a>
					</div>
					<div class="pull-right mt-10" style="margin-right: 10px;">
						<a href="blog-kategoriler.php" class="btn btn-danger btn-icon"><i class="fa fa-list"></i>Kategori Yönetimi</a>
					</div>
					Blog Konuları
				</div>
				<div class="card-block">
					<table id="datatable1" class="table table-striped dt-responsive nowrap table-hover">
						<thead>
							<tr>
								<th class="text-left">
									<strong>Blog id</strong>
								</th>
								<th class="text-left">
									<strong>Blog Resim</strong>
								</th>
								<th class="text-left">
									<strong>Blog Başlık</strong>
								</th>
								<th class="text-left">
									<strong>Blog İçerik</strong>
								</th>
								<th class="text-left">
									<strong>Resim Ayarları</strong>
								</th>
								<th class="text-center">
									<strong>İşlemler</strong>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$blogsor=$db->prepare("SELECT * from blog order by blog_id DESC");
							$blogsor->execute(array(0));
							while ($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) {
								$blogicerik=mb_substr(strip_tags($blogcek['blog_detay']), 0, 80, 'UTF-8')."...";
								?>
								<tr>
									<td>#<?php echo $blogcek['blog_id']; ?></td>
									<td><img style="max-height: 40px;max-width: 40px;" src="<?php echo $blogcek['blog_resim']; ?>"></td>
									<td><?php echo $blogcek['blog_baslik']; ?></td>
									<td><?php echo $blogicerik; ?></td>
									<td class="text-center">
										<a href="blog-resim-duzenle.php?blog_id=<?php echo $blogcek['blog_id']; ?>" class="btn btn-primary btn-icon"><i class="icon-picture"></i> Resim Ayarları</a>
									</td>
									<td class="text-center">
										<a href="blog-duzenle.php?blog_id=<?php echo $blogcek['blog_id']; ?>" title="Düzenle" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
										<a href="controller/function.php?blogsil=ok&blog_id=<?php echo $blogcek['blog_id']; ?>" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
