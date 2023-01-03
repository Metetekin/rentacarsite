<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=8");
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
       <li><a class="active" >İLETİŞİM</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>ŞUBELER</h1>
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
 <section class="section-padding no-top gray no-bottom">
  <!-- Main Container -->
  <div class="container">
   <div class="row">
    <!-- Middle Content Area -->
    <?php 
    $sayfalarsor=$db->prepare("SELECT * from sube order by sube_id DESC");
    $sayfalarsor->execute(array(0));
    while ($sayfacek=$sayfalarsor->fetch(PDO::FETCH_ASSOC)) {
      $sayfaicerik=$sayfacek['sube_il']." / ".$sayfacek['sube_ilce']; 
      $SayKontrol=$sayfalarsor->rowCount();
      if ( $SayKontrol==1) { ?>
        <div class="col-md-12 col-xs-12 col-sm-12">
        <?php } else { ?>
          <!-- Row -->

          <div class="col-md-6 col-xs-12 col-sm-12">

          <?php } ?>
          <div class="profile-section margin-bottom-20">
            <div class="profile-tabs">
             <ul class="nav nav-justified nav-tabs">
              <li class="active"><a href="#profile<?php echo $sayfacek['sube_id']; ?>" data-toggle="tab"><?php echo $sayfacek['sube_adi']; ?></a></li>
              <li><a href="#map<?php echo $sayfacek['sube_id']; ?>" data-toggle="tab">Haritada Göster</a></li>
            </ul>
            <div class="tab-content">

              <div class="profile-edit tab-pane fade in active" id="profile<?php echo $sayfacek['sube_id']; ?>">
               <dl class="dl-horizontal">
                <dt><strong>Adres </strong></dt>
                <dd>
                 <?php echo $sayfacek['sube_adres']; ?><br><?php echo $sayfaicerik; ?>
               </dd>
               <dt><strong>E mail Adresi</strong></dt>
               <dd>
                 <?php echo $sayfacek['sube_mail']; ?>
               </dd>
               <dt><strong>GSM</strong></dt>
               <dd>
                 <?php echo $sayfacek['sube_gsm']; ?>
               </dd>
               <dt><strong>Tel </strong></dt>
               <dd>
                 <?php echo $sayfacek['sube_tel']; ?>
               </dd>
               <dt><strong>Fax</strong></dt>
               <dd>
                 <?php echo $sayfacek['sube_fax']; ?>
               </dd>
               <dt><strong>Web Site </strong></dt>
               <dd>
                 <?php echo $sayfacek['sube_web']; ?>
               </dd>
             </dl>
           </div>

           <div class="profile-edit tab-pane fade in" id="map<?php echo $sayfacek['sube_id']; ?>" style="height:100%;">

             <?php echo $sayfacek['sube_harita']; ?>
           </div>

         </div>
       </div>
     </div>
     <!-- Row End -->
   </div>
 <?php } ?>

 <!-- Middle Content Area  End -->


</div>



</div>
<!-- Main Container End -->
</section>

<section class="section-padding gray no-top">
  <!-- Main Container -->
  <div class="container">
   <!-- Row -->
   <div class="header-page">
    <h1 style="color: #232323; font-size: 26px; font-weight: 600; text-transform: capitalize;">İLETİŞİM FORMU</h1>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding commentForm">
     <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
      <form action="trex/controller/function.php" method="post">
       <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
         <div class="form-group">
          <input type="text" id="name" placeholder="Ad soyad giriniz" name="mesaj_ad" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="form-group">
          <input type="email" placeholder="Eposta adresi giriniz" name="mesaj_mail"  class="form-control" required>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-xs-12">
       <div class="form-group">
        <textarea cols="12" rows="7" name="mesaj_icerik" placeholder="Mesajınızı giriniz" class="form-control" required></textarea>
      </div>
      <button name="iletisimform" class="btn btn-theme" type="submit">Gönder</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
<!-- Row End --> 
</div>
<!-- Main Container End --> 
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
