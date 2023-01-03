<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=12");
$metakey->execute(array(0));
$metakeyprint=$metakey->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $metakeyprint['meta_title'],
  'desc' => $metakeyprint['meta_descr'],
  'key' => $metakeyprint['meta_keyword']
];
require 'include/header.php';

$alis=$_POST['siparis_alistarih'];
$donus=$_POST['siparis_donustarih'];


$datetime1 = new DateTime($alis);
$datetime2 = new DateTime($donus);
$interval = $datetime1->diff($datetime2);
$gunfarkikarakter = $interval->format('%R%a');
$gunfarki =substr($gunfarkikarakter, 1);

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
       <li><a class="active" >Rezervasyon formu</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>Araç Seçiniz</h1>
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
       if ($gunfarki<='3') {
        $gunlukfiyati=$uruncek['urun_fiyat'];
      }
      if ($gunfarki>'3' && $gunfarki<='7') {
        $gunlukfiyati=$uruncek['urun_47'];
      }
      if ($gunfarki>'8' && $gunfarki<='15') {
        $gunlukfiyati=$uruncek['urun_815'];
      }
      if ($gunfarki>'15' && $gunfarki<='21') {
        $gunlukfiyati=$uruncek['urun_1621'];
      }
      if ($gunfarki>'21' && $gunfarki<='28') {
        $gunlukfiyati=$uruncek['urun_2228'];
      }
      if ($gunfarki>'28') {
        $gunlukfiyati=$uruncek['urun_2999'];
      }

      $FiyatToplam = $gunlukfiyati*$gunfarki;
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
         <div class="col-md-8 col-sm-12 col-xs-12">
          <!-- Ad Title -->
          <div class="row">
           <div class="col-md-7 col-sm-12 col-xs-12">
            <h3><a><?php echo $uruncek['urun_baslik']; ?> <small>veya benzeri...</small></a></h3>
          </div>
          <div class="col-md-5 col-sm-12 col-xs-12">
            <h3 style="text-align: right;"><a> <small><?php echo $gunfarki; ?> Günlük</small> <b style="color: #e52d27"><?php echo $FiyatToplam; ?>TL </b></a></h3>
          </div>
        </div>
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
      <div class="text-center" style="margin-top: 20px;margin-bottom: 20px;">

        <button style="z-index: 9999;" class="btn btn-md btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_yakitprosedur'] ?>"><i class="fa fa-info"></i> Yakıt Prosedürü</button>
        <button style="z-index: 9999;" class="btn btn-xl btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_kiralamasuresi'] ?>"><i class="fa fa-info"></i> Kiralama Süresi</button>
        <button style="z-index: 9999;" class="btn btn-xl btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $uruncek['urun_ehliyetyassiniri'] ?>"><i class="fa fa-info"></i> Ehliyet-Yaş sınırı</button>
      </div>
    </div>
    <div class="col-md-4 col-xs-12 col-sm-12 text-center">
      <!-- Ad Stats -->
      <div class="" style="margin-top: 0;">
        <div class="ad-stats">Alış Şubesi :<br><span> <?php echo $_POST['siparis_alissube']; ?> </span></div>
        <div class="ad-stats">Dönüş Şubesi : <br><span><?php echo $_POST['siparis_donussube']; ?></span></div>
        <div class="ad-stats">Alış Tarihi - Dönüş Tarihi :  <br><span><?php echo $alis; ?>-<?php echo $donus; ?></span></div>
      </div>
      <!-- Price -->
      <!-- Ad View Button -->
      <form method="POST" action="rezervasyon-bilgi">
        <input type="hidden" name="gunfarki" value="<?php echo $gunfarki; ?>"> 
        <input type="hidden" name="FiyatToplam" value="<?php echo $FiyatToplam; ?>">
        <input type="hidden" name="gunlukfiyati" value="<?php echo $gunlukfiyati; ?>">
        <input type="hidden" name="siparis_alissube" value="<?php echo $_POST['siparis_alissube']; ?>">
        <input type="hidden" name="siparis_donussube" value="<?php echo $_POST['siparis_donussube']; ?>">
        <input type="hidden" name="siparis_alistarih" value="<?php echo $_POST['siparis_alistarih']; ?>">
        <input type="hidden" name="siparis_donustarih" value="<?php echo $_POST['siparis_donustarih']; ?>">
        <input type="hidden" name="siparis_alissaat" value="<?php echo $_POST['siparis_alissaat']; ?>">
        <input type="hidden" name="siparis_alisdakika" value="<?php echo $_POST['siparis_alisdakika']; ?>">
        <input type="hidden" name="siparis_donussaat" value="<?php echo $_POST['siparis_donussaat']; ?>">
        <input type="hidden" name="siparis_donusdakika" value="<?php echo $_POST['siparis_donusdakika']; ?>">
        <input type="hidden" name="arac" value="<?php echo $uruncek['urun_id']; ?>">
        <button style="width: 100%" type="submit" name="rezervasyon" class="btn btn-success"><i class="fa fa-arrow-right"></i> SEÇ</button>
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
