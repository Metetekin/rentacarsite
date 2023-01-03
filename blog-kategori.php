<?php 
require 'include/head.php';
$Id=htmlspecialchars(strip_tags(trim($_GET['kategori_id'])));
$kategorisor=$db->prepare("SELECT * from kategorilerb where kategori_id=:SorguId");
$kategorisor->execute(array('SorguId' => $Id));
$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $kategoricek['kategori_title'],
  'desc' => $kategoricek['kategori_descr'],
  'key' => $kategoricek['kategori_keyword']
];
require 'include/header.php';
$sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.

$sorgu=$db->prepare("SELECT * from blog where blog_kategori=$Id ");
$sorgu->execute();
$toplam_icerik=$sorgu->rowCount();

$toplam_sayfa = ceil($toplam_icerik / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

                // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 

                // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

$limit = ($sayfa - 1) * $sayfada;

$blogsor=$db->prepare("SELECT * from blog where blog_kategori=$Id order by blog_id DESC limit $limit,$sayfada");
$blogsor->execute(array(
  'bloglimit' => "$limit,$sayfada"
));
?>

<!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
<div class="page-header-area-2 gray">
 <div class="container">
  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="small-breadcrumb">
     <div class=" breadcrumb-link">
      <ul>
       <li><a href="<?php echo $settingsprint['ayar_siteurl'] ?>">Anasayfa</a></li>
       <li><a href="blog" class=""><?php echo $widgetprint['widget_bblog']; ?></a></li>
       <li><a class="active" ><?php echo $kategoricek['kategori_ad'] ?></a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1><?php echo $widgetprint['widget_bblog']; ?></h1>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
 <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
 <section class="section-padding no-top reviews gray ">
  <!-- Main Container -->
  <div class="container">
   <!-- Row -->
   <div class="row">
    <!-- Middle Content Area -->
    <div class="col-md-8 col-xs-12 col-sm-12 news">
     <div class="row">
      <!-- Review Archive -->
      <div class="posts-masonrys">

        <div class="clearfix"></div>
        <!-- Review Post-->
        <?php 
        while($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) {
          $kategoriedit=$db->prepare("SELECT * from kategorilerb where kategori_id=:kategori_id");
          $kategoriedit->execute(array(
            'kategori_id' => $blogcek['blog_kategori']
          ));
          $kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="mainimage">
              <span class="badge text-uppercase badge-overlay badge-tech"><?php echo $kategoriwrite['kategori_ad']; ?></span>
              <a href="<?=seo('blog-'.$blogcek["blog_baslik"]).'-'.$blogcek["blog_id"]?>">
                <img class="img-responsive" src="trex/<?php echo $blogcek['blog_resim']; ?>" alt="<?php echo $blogcek['blog_baslik']; ?>">
                <div class="overlay small-font">
                 <h2><?php 
                 $karakter = strlen( $blogcek['blog_baslik'] );
                 if ( $karakter > 35 )
                 {
                  echo mb_substr( $blogcek['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
                }
                else
                {
                  echo $blogcek['blog_baslik'];
                }
                ?></h2>
              </div>
            </a>
            <div class="clearfix"></div>
          </div>
        </div> 
      <?php } ?>

    </div>
    <div class="col-md-12 col-xs-12 col-sm-12">
     <ul class="pagination pagination-lg">




 <?php $gosterilecekbuton = 3; // gösterilecek sayfa.
 if ($sayfa > 1) {
  ?>
  <li><a href="?sayfa=1"><i class="fa fa-home"></i></a></li>
  <li><a href="?sayfa=<?php echo $sayfa-1; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></i></a></li>
<?php }
for ($i= $sayfa - $gosterilecekbuton; $i < $sayfa + $gosterilecekbuton +1; $i++) {
  if ($i > 0 and $i <= $toplam_sayfa) {
    if ($i == $sayfa) {
      ?>
      <li class="active">
        <a href="?sayfa=<?php echo $i ?>"><?php echo $i ?> <span class="sr-only">(current)</span></a>
      </li>
      <?php
    } else {
      ?>
      <li>
        <a href="?sayfa=<?php echo $i ?>"><?php echo $i ?> <span class="sr-only">(current)</span></a>
      </li>
      <?php
    }
  }
}
if ($sayfa != $toplam_sayfa) {
  ?>
  <li><a href="?sayfa=<?php echo $sayfa+1; ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
<?php } ?>

</ul>
</div>
</div>
</div>
<!-- Right Sidebar -->
<div class="col-md-4 col-xs-12 col-sm-12">
 <!-- Sidebar Widgets -->

 <!-- Sidebar Widgets -->
 <div class="blog-sidebar">
  <!-- Categories --> 
  <div class="widget">
   <div class="widget-heading">
    <h4 class="panel-title"><a>Kategoriler</a></h4>
  </div>
  <div class="widget-content categories">
    <ul>
     <?php 
     $kategorisor=$db->prepare("SELECT * from kategorilerb order by kategori_sira ASC");
     $kategorisor->execute(array(0));
     while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <li><a href="<?=seo('konu-kategori-'.$kategoricek["kategori_ad"]).'-'.$kategoricek["kategori_id"]?>"><?php echo $kategoricek['kategori_ad']; ?></a></li>
    <?php } ?>

    <li><a href="blog">Tüm Kategoriler</a></li>
  </ul>
</div>
</div>
<div class="widget">
 <div class="widget-heading">
  <h4 class="panel-title"><a>Son Yazılar</a></h4>
</div>
<div class="recent-ads">
 <?php 
 $blogsor=$db->prepare("SELECT * from blog order by blog_id DESC limit 3");
 $blogsor->execute(array(0));
 while($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) {
  $kategoriedit=$db->prepare("SELECT * from kategorilerb where kategori_id=:kategori_id");
  $kategoriedit->execute(array(
    'kategori_id' => $blogcek['blog_kategori']
  ));
  $kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);
  ?>
  <!-- Ads -->
  <div class="recent-ads-list">
   <div class="recent-ads-container">
    <div class="recent-ads-list-image">
     <a href="<?=seo('blog-'.$blogcek["blog_baslik"]).'-'.$blogcek["blog_id"]?>" class="recent-ads-list-image-inner">
       <img src="trex/<?php echo $blogcek['blog_resim']; ?>" alt="<?php echo $blogcek['blog_baslik'] ?>">
     </a><!-- /.recent-ads-list-image-inner -->
   </div>
   <!-- /.recent-ads-list-image -->
   <div class="recent-ads-list-content">
     <h3 class="recent-ads-list-title">
      <a href="<?=seo('blog-'.$blogcek["blog_baslik"]).'-'.$blogcek["blog_id"]?>"><?php 
      $karakter = strlen( $blogcek['blog_baslik'] );
      if ( $karakter > 35 )
      {
        echo mb_substr( $blogcek['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
      }
      else
      {
        echo $blogcek['blog_baslik'];
      }
      ?></a>
    </h3>
    <ul class="recent-ads-list-location">
      <li><a href="<?=seo('konu-kategori-'.$kategoricek["kategori_ad"]).'-'.$kategoricek["kategori_id"]?>"><?php echo $kategoriwrite['kategori_ad']; ?></a></li>
    </ul>
    <!-- /.recent-ads-list-price -->
  </div>
  <!-- /.recent-ads-list-content -->
</div>
<!-- /.recent-ads-container -->
</div>
<!-- Ads -->
<?php } ?>
</div>
<br>
</div>
</div>
<!-- Sidebar Widgets End -->

<!-- Sidebar Widgets End -->
</div>
<!-- Middle Content Area  End -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>

<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
