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
    <h1>Tarih Seçiniz</h1>
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
     <!-- end post-padding -->
     <div class="post-ad-form postdetails">
      <form method="POST" action="rezervasyon-arac" class="submit-form">
       <div class="row">
        <!-- Category  -->
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
         <label class="control-label">Alış Şubesi </label>
         <select class=" form-control make" name="siparis_alissube" >
          <?php 
          $subeAlis=$db->prepare("SELECT * from kategoriler order by kategori_sira ASC");
          $subeAlis->execute();
          while($subeAlisYaz=$subeAlis->fetch(PDO::FETCH_ASSOC)) { ?>  
           <option required value="<?php echo $subeAlisYaz['kategori_ad']; ?>"><?php echo $subeAlisYaz['kategori_ad']; ?></option>
         <?php } ?>
       </select>
     </div>
     <!-- Price  -->
     <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
       <label class="control-label">Alış Tarihi</label>
       <input style="height: 55px" type="text" required value = "<?php echo $bugun ?>" onfocus = "(this.type = 'date')"  class="form-control input-sm" name="siparis_alistarih" />
     </div>
     <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
       <label class="control-label">Alış Saati</label>
       <select class=" form-control make" name="siparis_alissaat">
         <option value="<?php echo $saat; ?>"><?php echo $saat; ?></option>
         <option value="09">09</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
         <option value="13">13</option>
         <option value="14">14</option>
         <option value="15">15</option>
         <option value="16">16</option>
         <option value="17">17</option>
         <option value="18">18</option>
         <option value="19">19</option>
         <option value="20">20</option>
         <option value="21">21</option>
       </select>
     </div>
     <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
       <label class="control-label">Alış Dakika</label>
       <select class=" form-control make"name="siparis_alisdakika" >
        <option value="00">00</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
      </select>
    </div>
  </div>
  <div class="row">
    <!-- Category  -->
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
      <label class="control-label">Dönüş Şubesi </label>
      <select class=" form-control make" name="siparis_donussube" >
        <?php 
        $subeAlis=$db->prepare("SELECT * from kategoriler order by kategori_sira ASC");
        $subeAlis->execute();
        while($subeAlisYaz=$subeAlis->fetch(PDO::FETCH_ASSOC)) { ?>  
         <option required value="<?php echo $subeAlisYaz['kategori_ad']; ?>"><?php echo $subeAlisYaz['kategori_ad']; ?></option>
       <?php } ?>
     </select>
   </div>
   <!-- Price  -->
   <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
     <label class="control-label">Dönüş Tarihi</label>
     <input style="height: 55px" type="text" required value = "<?php echo $yarin ?>" onfocus = "(this.type = 'date')"  class="form-control input-sm" name="siparis_donustarih" />
   </div>
   <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
     <label class="control-label">Dönüş Saati</label>
     <select class=" form-control make" name="siparis_donussaat">
       <option value="<?php echo $saat; ?>"><?php echo $saat; ?></option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       <option value="13">13</option>
       <option value="14">14</option>
       <option value="15">15</option>
       <option value="16">16</option>
       <option value="17">17</option>
       <option value="18">18</option>
       <option value="19">19</option>
       <option value="20">20</option>
       <option value="21">21</option>
     </select>
   </div>
   <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
     <label class="control-label">Dönüş Dakika</label>
     <select class=" form-control make" name="siparis_donusdakika" >
      <option value="00">00</option>
      <option value="15">15</option>
      <option value="30">30</option>
      <option value="45">45</option>
    </select>
  </div>
</div>
<!-- end row --><!-- end row -->

<button class="btn btn-theme pull-right">DEVAM</button>
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
