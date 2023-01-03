<?php 
require 'include/head.php';
$sayfasor=$db->prepare("SELECT * from sayfalar where sayfa_id=:sayfa_id");
$sayfasor->execute(array(
 'sayfa_id' => $_GET['sayfa_id']
));
$sayfacek=$sayfasor->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $sayfacek['sayfa_title'],
  'desc' => $sayfacek['sayfa_descr'],
  'key' => $sayfacek['sayfa_keyword']
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
       <li><a class="active" >Sayfalar</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1><?php echo $sayfacek['sayfa_baslik']; ?></h1>
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
 <section class="section-padding no-top gray ">
  <!-- Main Container -->
  <div class="container">
   <!-- Row -->
   <div class="row">
    <!-- Middle Content Area -->
    <div class="col-md-8 col-xs-12 col-sm-12">
     <div class="blog-detial">
      <!-- Blog Archive -->
      <div class="blog-post">
        <div class="post-img">
        </div>
        <div class="post-excerpt">
          <p><?php echo $sayfacek['sayfa_icerik']; ?></p>
          <div class="clearfix"></div>

        </div>
      </div>
      <!-- Blog Grid -->
    </div>
  </div>
  <!-- Right Sidebar -->
  <div class="col-md-4 col-xs-12 col-sm-12">
   <!-- Sidebar Widgets -->
   <div class="blog-sidebar">
    <!-- Categories --> 
    <div class="widget">
     <div class="widget-heading">
      <h4 class="panel-title"><a>Diğer Sayfalar</a></h4>
    </div>
    <div class="widget-content categories">
      <ul><?php 
      $sayfalarsors=$db->prepare("SELECT * from sayfalar order by sayfa_id ASC");
      $sayfalarsors->execute(array(0));
      while ($sayfaceks=$sayfalarsors->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <li> <a href="<?=seo('sayfa-'.$sayfaceks["sayfa_baslik"]).'-'.$sayfaceks["sayfa_id"]?>"> <?php echo $sayfaceks['sayfa_baslik']; ?> </a> </li>
      <?php } ?>
    </ul>
  </div>
</div>
<br>
    <?php  include 'include/sidebar.php'; ?>
</div>
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
