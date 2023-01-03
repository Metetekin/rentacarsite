<?php 
require 'include/head.php';
$pageedit=$db->prepare("SELECT * from soz where soz_id=1");
$pageedit->execute(array());
$pagewrite=$pageedit->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => Sözleşme,
  'desc' => Sözleşme,
  'key' => Sözleşme
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
       <li><a class="active" >Sözleşme</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1><?php echo $pagewrite['soz_baslik']; ?></h1>
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
    <div class="col-md-12 col-xs-12 col-sm-12">
     <div class="blog-detial">
      <!-- Blog Archive -->
      <div class="blog-post">
        <div class="post-img">
        </div>
        <div class="post-excerpt">
          <p><?php echo $pagewrite['soz_aciklama']; ?></p>
          <div class="clearfix"></div>

        </div>
      </div>
      <!-- Blog Grid -->
    </div>
  </div>
<!-- Middle Content Area  End -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
