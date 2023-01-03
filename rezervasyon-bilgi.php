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

$bugun = date('d.m.Y'); 
$yarin = date("d.m.Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
$saat = date(H);


$alis=$_POST['siparis_alistarih'];
$donus=$_POST['siparis_donustarih'];


$datetime1 = new DateTime($alis);
$datetime2 = new DateTime($donus);
$interval = $datetime1->diff($datetime2);
$gunfarkikarakter = $interval->format('%R%a');
$gunfarki =substr($gunfarkikarakter, 1);
$urunsor=$db->prepare("SELECT * from urunler where urun_id=:AracID ");
$urunsor->execute(array('AracID' => $_POST['arac']));


if ( isset( $_POST[ 'rezervasyonson' ] ) )
{ 

  $name = $_POST['siparis_ozellik'];


  foreach( $name as $v ) {
    if ($v>0) {
      $ozellik=$db->prepare("SELECT * from ozellik where ozellik_id=:ozellikid");
      $ozellik->execute(array(
        'ozellikid' => $v
      ));
      $ozellikprint=$ozellik->fetch(PDO::FETCH_ASSOC);

      $ozellikfiyatyaz .= $ozellikprint['ozellik_baslik']." - <b>".$ozellikprint['ozellik_fiyat']."TL".'</b><br/>';
      $ozellikyaz .= $ozellikprint['ozellik_baslik'].'<br/>';
      $fiyatozellik += $ozellikprint['ozellik_fiyat'];
      $fiyatOzellikToplam = "Toplam Özellik Fiyatı: <b>".$fiyatozellik."TL</b>";

    } 
  }
  if ($ozellikyaz) {
    $ozelikCesit= $ozellikfiyatyaz;
    $ozelikCesitf= $fiyatozellik;

  } else {
    $ozelikCesit= "Özellik seçilmedi";
    $ozelikCesitf= "Özellik seçilmedi";

  }

  $secure = md5(rand( 10000, 3020000 ));


  $ad=htmlspecialchars(trim($_POST[ 'siparis_ad' ]));
  $tel=htmlspecialchars(trim($_POST[ 'siparis_tel' ]));
  $mail=htmlspecialchars(trim($_POST[ 'siparis_mail' ]));
  $odeme=htmlspecialchars(trim($_POST[ 'siparis_odeme' ]));


  $alissube=htmlspecialchars(trim($_POST[ 'siparis_alissube' ]));
  $alissaat=htmlspecialchars(trim($_POST[ 'siparis_alissaat' ]));
  $alisdakika=htmlspecialchars(trim($_POST[ 'siparis_alisdakika' ]));


  $donussube=htmlspecialchars(trim($_POST[ 'siparis_donussube' ]));
  $donussaat=htmlspecialchars(trim($_POST[ 'siparis_donussaat' ]));
  $donusdakika=htmlspecialchars(trim($_POST[ 'siparis_donusdakika' ]));


  $FiyatToplam=htmlspecialchars(trim($_POST[ 'FiyatToplam' ]));

  $kaydet = $db->prepare(
   "INSERT INTO siparis SET
   siparis_ad=:ad,
   siparis_tel=:tel,
   siparis_mail=:mail,
   siparis_arac=:arac,
   siparis_fiyat=:fiyat,
   siparis_gun=:detay,
   ek_ozellik=:ozellik,
   ozellik_fiyat=:mdetay,
   siparis_alissube=:alissube,
   siparis_donussube=:donussube,
   siparis_odeme=:odeme,
   siparis_secure=:secure,
   genel_toplam=:toplam");
  $insert = $kaydet->execute(
   array(
     'ad' => $ad,
     'tel' => $tel,
     'mail' => $mail,
     'arac' => $_POST[ 'arac' ],
     'fiyat' => $_POST[ 'gunlukfiyati' ],
     'odeme' => $odeme,
     'secure' => $secure,
     'detay' => $gunfarki,
     'ozellik' => $ozelikCesit,
     'mdetay' => $ozelikCesitf,
     'alissube' => $alissube." ".$alis."-".$alissaat.":".$alisdakika,
     'donussube' => $donussube." ".$donus."-".$donussaat.":".$donusdakika,
     'toplam' => $FiyatToplam+$fiyatozellik
   ));

  if ( $insert )
  {
    if ($_POST[ 'siparis_odeme' ]=='Online Kredi Kartı ile Öde') {

      header( 'Location:rezervasyon-ode?sec='.$secure.'' );
    } else {

      header( 'Location:rezervasyon-sonuc?sec='.$secure.'&status=ok' );
    }

  }
  else
  {
    header( 'Location:rezervasyon-sonuc?sec='.$secure.'&status=ok' );

  }


}


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
       <li><a class="active" >Rezervasyon Fromu</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>Rezervasyon Detay</h1>
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
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
     <?php 
     
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
        <div class="ad-stats">Alış Zamanı:  <br><span><?php echo $alis." ".$_POST['siparis_alissaat'].":".$_POST['siparis_alisdakika']; ?></span>
        </div>
        <div class="ad-stats">Dönüş Zamanı:  <br><span><?php echo $donus." ".$_POST['siparis_donussaat'].":".$_POST['siparis_donusdakika']; ?></span>
        </div>
      </div>
      <!-- Price -->
    </div>
  </div>
</div>
<!-- Ad Content End -->
</div>
</div>
<?php } ?>
<!-- end post-padding -->
<div class="post-ad-form postdetails">



 <form method="POST" action="" class="submit-form">


  <h4 class="heading-md" style="font-size: 18px;font-weight: 500;color: #323232;">Rezervasyon Bilgileri</h4>

  <!-- end row -->

  <!-- end row -->
  <!-- Image Upload  -->
  <div class="row">

    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
      <label>Ad Soyad:</label>
      <input type="text" required class="form-control" name="siparis_ad" placeholder="Adınızı ve soyadınızı belirtiniz" />
    </div>

    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
      <label>Telefon:</label>
      <input type="text" required class="form-control" name="siparis_tel" placeholder="Telefon numaranızı giriniz" />
    </div>

    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
      <label>Mail Adresiniz:</label>
      <input type="text" required class="form-control" name="siparis_mail" placeholder="Telefon numaranızı giriniz" />
    </div>

    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="margin-top: 20px;">   
      <?php 
      $odeme=$db->prepare("SELECT * from odeme where odeme_durum=1");
      $odeme->execute();
      ?>
      <label class="control-label">Ödeme Tipi: </label>
      <select class=" form-control make" required name="siparis_odeme">
       <?php  while($odemecek=$odeme->fetch(PDO::FETCH_ASSOC)) { ?>  
         <option required value="<?php echo $odemecek['odeme_adi']; ?>"><?php echo $odemecek['odeme_adi']; ?></option>
       <?php } ?>
     </select>
   </div>



 </div>
 <!-- end row -->
 <div class="row">
   <?php 
   $ozellik=$db->prepare("SELECT * from ozellik where ozellik_arac=:ozellik || ozellik_arac=99");
   $ozellik->execute(array(
     'ozellik' => $uruncek['urun_id']
   ));
   while($ozellikprint=$ozellik->fetch(PDO::FETCH_ASSOC)) { ?> 
    <!-- Start select -->
    <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
      <label><?php echo $ozellikprint['ozellik_baslik'] ?></label>
      <select class="form-control" required name="siparis_ozellik[]" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false}'>
        <option value="0">İstemiyorum</option>

        <option required value="<?php echo $ozellikprint['ozellik_id'] ?>"><?php echo $ozellikprint['ozellik_baslik'] ?> - <?php echo $ozellikprint['ozellik_fiyat'] ?>TL</option>
      </select>
      <!-- End select -->
    </div>
  <?php } ?>
</div>

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
<input type="hidden" name="arac" value="<?php echo $_POST['arac']; ?>">
<?php
$pageedit=$db->prepare("SELECT * from soz where soz_id=1");
$pageedit->execute(array());
$pagewrite=$pageedit->fetch(PDO::FETCH_ASSOC);
?>
<div class="icheckbox_minimal checked" style="position: relative;"><input type="checkbox" id="minimal-checkbox-2" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
<label for="minimal-checkbox-2" class="">Yukarıda bulunan detayları, ayrıca <a target="_blank" href="sozlesme"><?php echo $pagewrite['soz_baslik']; ?></a> sözleşmesini okudum ve kabul ediyorum. </label>
<button class="btn btn-theme pull-right" name="rezervasyonson">TAMAMLA</button>
</form>
</div>
<!-- end post-ad-form-->
</div>
<!-- end col -->

<!-- Middle Content Area  End --><!-- end col -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
