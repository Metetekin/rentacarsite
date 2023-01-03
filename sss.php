<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=5");
$metakey->execute(array(0));
$metakeyprint=$metakey->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $metakeyprint['meta_title'],
  'desc' => $metakeyprint['meta_descr'],
  'key' => $metakeyprint['meta_keyword']
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
       <li><a class="active" >SSS</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>SIK SORULAN SORULAR</h1>
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
     <ul class="accordion">
       <?php 
       $ssssor=$db->prepare("SELECT * from sss");
       $ssssor->execute(array("HizmetID" => $_GET['hizmet_id']));
       while ($ssscek=$ssssor->fetch(PDO::FETCH_ASSOC)) { ?>
        <li>
         <h3 class="accordion-title"><a href="#"><?php echo $ssscek['sss_soru']; ?></a></h3>
         <div class="accordion-content">
          <p>
            <?php echo $ssscek['sss_cevap']; ?>

          </p>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>
<!-- Middle Content Area  End -->
<!-- Right Sidebar -->
<div class="col-md-4 col-xs-12 col-sm-12">

  <?php  include 'include/sidebar.php'; ?>

</div>
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
