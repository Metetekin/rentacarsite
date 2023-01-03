<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=11");
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
       <li><a class="active" >Fiyat Listemiz</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>FİYAT LİSTESi</h1>
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
    <div class="col-md-12 col-lg-12 col-sx-12">
     <!-- Row -->
     <ul class="list-unstyled">
      <!-- Listing Grid -->

      <?php 
      $urunsor=$db->prepare("SELECT * from urunler order by urun_id ASC");
      $urunsor->execute();
      while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { 
       ?>
       <li>
         <div class="well ad-listing clearfix">
          <div class="col-md-4 col-sm-5 col-xs-12 grid-style">
           <!-- Image Box -->
           <div class="img-box">
            <img style="height: 100%; padding: 40px;" src="trex/<?php echo $uruncek['urun_resim']; ?>" class="img-responsive" alt="<?php echo $uruncek['urun_baslik']; ?>">
          </div>
        </div>
        <div class="col-md-8 col-sm-7 col-xs-12">
         <!-- Ad Content-->
         <div class="row">
          <div class="content-area">
           <div class="col-md-9 col-sm-12 col-xs-12">
            <!-- Ad Title -->
            <h3><a><?php echo $uruncek['urun_baslik']; ?> <small>veya benzeri...</small></a></h3>
            
            <!-- Ad Description-->
            <div class="ad-details">
             <ul class="">
              <li><i class="flaticon-gas-station-1"></i><?php echo $uruncek['urun_yakit']; ?></li>
              <li><i class="flaticon-gearshift"></i><?php echo $uruncek['urun_vites']; ?></li>
              <li><i class="flaticon-air-conditioner-3"></i><?php echo $uruncek['urun_klima']; ?></li>
              <li><i class="flaticon-vehicle-4"></i><?php echo $uruncek['urun_bagaj']; ?></li>
              <li><i class="flaticon-security"></i><?php echo $uruncek['urun_koltuk']; ?> kişilik</li>
              <li><i class="flaticon-car-door"></i><?php echo $uruncek['urun_kapi']; ?> Kapi</li>
            </ul>
          </div>
          <div class="text-center" style="margin-top: 30px;margin-bottom: 40px;">

            <button style="z-index: 9999;" class="btn btn-xl btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_yakitprosedur'] ?>"><i class="fa fa-info"></i> Yakıt Prosedürü</button>
            <button style="z-index: 9999;" class="btn btn-xl btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_kiralamasuresi'] ?>"><i class="fa fa-info"></i> Kiralama Süresi</button>
            <button style="z-index: 9999;" class="btn btn-xl btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_ehliyetyassiniri'] ?>"><i class="fa fa-info"></i> Ehliyet-Yaş sınırı</button>
          </div>
        </div>
        <div class="col-md-3 col-xs-12 col-sm-12 text-center">
          <!-- Ad Stats -->
          <div class="" style="margin-top: 0;">
            <div class="ad-stats"><span>1-3 gün  : </span><?php echo $uruncek['urun_fiyat']; ?>.00 TL </div>
            <div class="ad-stats"><span>4-7 gün : </span><?php echo $uruncek['urun_47']; ?>.00 TL </div>
            <div class="ad-stats"><span>8-15 gün : </span><?php echo $uruncek['urun_815']; ?>.00 TL </div>
            <div class="ad-stats"><span>16-21 gün  : </span><?php echo $uruncek['urun_1621']; ?>.00 TL </div>
            <div class="ad-stats"><span>22-28 gün : </span><?php echo $uruncek['urun_2228']; ?>.00 TL </div>
            <div class="ad-stats"><span>29-99 gün : </span><?php echo $uruncek['urun_2999']; ?>.00 TL </div>
          </div>
          <!-- Price -->
          <!-- Ad View Button -->
          <form method="POST" action="rezervasyon">
            <button style="width: 100%" type="submit" name="rezervasyon" class="btn btn-success"><i class="fa fa-arrow-right"></i> Rezervasyon Yap</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Ad Content End -->
  </div>
</div>
</li>
<?php } ?>
</ul>
<!-- Advertizing -->
<section class="advertising">
  <a href="rezervasyon">
   <div class="banner">
    <div class="wrapper">
     <span class="title">Rezervasyon formu ile ücreti güvenle öde anında kirala?</span>
     <span class="submit">Rezervasyon Formu! <i class="fa fa-plus-square"></i></span>
   </div>
 </div>
 <!-- /.banner-->
</a>
</section>
<!-- Advertizing End -->
<!-- Ads Archive End -->  
<div class="clearfix"></div> 
</div>




</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
