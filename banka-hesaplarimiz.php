<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=10");
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
       <li><a class="active" >Sayfalar</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>BANKA HESAPLARIMIZ</h1>
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
      $hesapsor=$db->prepare("SELECT * from hesap");
      $hesapsor->execute();?>
      <?php  while($hesapcek=$hesapsor->fetch(PDO::FETCH_ASSOC)) { ?> 
        <li>
         <h3 class="accordion-title"><a href="#"><?php echo $hesapcek['hesap_banka']; ?></a></h3>
         <div class="accordion-content">
          <p>
            <h5>Ünvan: <span><b><?php echo $hesapcek['hesap_isim']; ?></b></span></h5>
            <h5>Şube/Şube no: <span><b><?php echo $hesapcek['hesap_sube']; ?></b></span></h5>
            <h5>Hesap no: <span><b><?php echo $hesapcek['hesap_no']; ?></b></span></h5>
            <h5>İban: <span><b><?php echo $hesapcek['hesap_iban']; ?></b></span></h5></p>
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
