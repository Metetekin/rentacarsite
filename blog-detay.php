<?php 
require 'include/head.php';
$blogsor=$db->prepare("SELECT * from blog where blog_id=:blog_id");
$blogsor->execute(array(
 'blog_id' => $_GET['blog_id']
));
$blogcek=$blogsor->fetch(PDO::FETCH_ASSOC);

$kategoriedit=$db->prepare("SELECT * from kategorilerb where kategori_id=:kategori_id");
$kategoriedit->execute(array(
  'kategori_id' => $blogcek['blog_kategori']
));
$kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);

$meta = [
  'title' => $blogcek['blog_title'],
  'desc' => $blogcek['blog_descr'],
  'key' => $blogcek['blog_keyword']
];
require 'include/header.php';
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
       <li><a href="blog"><?php echo $widgetprint['widget_bblog']; ?></a></li>
       <li><a href="<?=seo('konu-kategori-'.$kategoriwrite["kategori_ad"]).'-'.$kategoriwrite["kategori_id"]?>" class="active" ><?php echo $kategoriwrite['kategori_ad']; ?></a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1><?php echo $blogcek['blog_baslik'] ?></h1>
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
    <div class="col-md-8 col-xs-12 col-sm-12">
     <div class="blog-detial">
      <!-- Blog Archive -->
      <div class="blog-post">

        <div id="single-slider" class="flexslider">
         <ul class="slides">
           <?php 
           $urunresimsor=$db->prepare("SELECT * from resimb where resim_urun=:resim_urun");
           $urunresimsor->execute(array(
            'resim_urun' => $blogcek['blog_id']
          ));
          while($urunresimcek=$urunresimsor->fetch(PDO::FETCH_ASSOC)) { ?>
            <li>
              <a href="trex/<?php echo $urunresimcek['resim_link'] ?>" data-fancybox="group">
                <img src="trex/<?php echo $urunresimcek['resim_link'] ?>" alt="<?php echo $hizmetcek['hizmet_baslik']; ?>"/>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="review-excerpt">
        <p>
         <?php echo $blogcek['blog_detay']; ?>
       </p>
       <!-- Start "post-review" -->

       <!-- End "post-review" -->
       <div class="clearfix"></div>
     </div>
   </div>
   <!-- Blog Grid -->
 </div>


 <?php 

 $blogsorb=$db->prepare("SELECT * from blog where blog_kategori=:KatID and blog_id!=:BlogID order by blog_id DESC limit 3");
 $blogsorb->execute(array(
  'KatID' => $blogcek['blog_kategori'],
  'BlogID' => $blogcek['blog_id']
));
 $SayKont = $blogsorb->RowCount();
 if ($SayKont>='1') {
  ?>


  <div class="grid-panel margin-top-30">
   <div class="heading-panel">
    <div class="col-xs-12 col-md-12 col-sm-12">
     <h3 class="main-title text-left">
      İlgili Yazılar
    </h3>
  </div>
</div>
<!-- Ads Archive -->
<div class="col-md-12 col-xs-12 col-sm-12">
  <div class="posts-masonry">

    <?php 
    while($blogcekb=$blogsorb->fetch(PDO::FETCH_ASSOC)) {

      $kategoriedit=$db->prepare("SELECT * from kategorilerb where kategori_id=:kategori_id");
      $kategoriedit->execute(array(
        'kategori_id' => $blogcekb['blog_kategori']
      ));
      $kategoriwrite=$kategoriedit->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="ads-list-archive">
        <!-- Image Block -->
        <div class="col-lg-5 col-md-5 col-sm-5 no-padding">
         <!-- Img Block -->
         <div class="ad-archive-img">
          <a href="<?=seo('blog-'.$blogcekb["blog_baslik"]).'-'.$blogcekb["blog_id"]?>">
            <img class="img-responsive" src="trex/<?php echo $blogcekb['blog_resim']; ?>" alt="<?php echo $blogcekb['blog_baslik']; ?>"> 
          </a>
        </div>
        <!-- Img Block -->
      </div>
      <!-- Ads Listing -->
      <div class="clearfix visible-xs-block"></div>
      <!-- Content Block -->
      <div class="col-lg-7 col-md-7 col-sm-7 no-padding">
       <!-- Ad Desc -->
       <div class="ad-archive-desc">
        <!-- Price -->
        <!-- Title -->
        <h3><?php 
        $karakter = strlen( $blogcekb['blog_baslik'] );
        if ( $karakter > 35 )
        {
          echo mb_substr( $blogcekb['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
        }
        else
        {
          echo $blogcekb['blog_baslik'];
        }
        ?></h3>
        <!-- Category -->
        <div class="category-title"> <span><a href="<?=seo('konu-kategori-'.$kategoriwrite["kategori_ad"]).'-'.$kategoriwrite["kategori_id"]?>"><?php echo $kategoriwrite['kategori_ad']; ?></a></span> </div>
        <!-- Short Description -->
        <div class="clearfix visible-xs-block"></div>
        <p class="hidden-sm"><?php echo mb_substr(strip_tags($blogcekb['blog_detay']),0,200,"UTF-8"); ?></p>
        <!-- Ad Features -->
        <!-- Ad History -->
        <div class="clearfix archive-history">
          <div class="ad-meta"> <a href="<?=seo('blog-'.$blogcekb["blog_baslik"]).'-'.$blogcekb["blog_id"]?>" class="btn btn-warning">Devamını Oku</a> </div>
        </div>
      </div>
      <!-- Ad Desc End -->
    </div>
    <!-- Content Block End -->
  </div>
<?php } ?>






</div>
</div>
</div>
<?php } ?>


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
 $blogsor=$db->prepare("SELECT * from blog where blog_id!=:BlogID order by blog_id DESC limit 3");
 $blogsor->execute(array(
  'BlogID' => $blogcek['blog_id']
));
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
