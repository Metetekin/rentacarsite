<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=13");
$metakey->execute(array(0));
$metakeyprint=$metakey->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $metakeyprint['meta_title'],
  'desc' => $metakeyprint['meta_descr'],
  'key' => $metakeyprint['meta_keyword']
];
require 'include/header.php';
require 'include/slider.php';

$bugun = date('d.m.Y'); 

$yarin = date("d.m.Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));

$saat = date(H);
?>
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">

  <?php if ($widgetprint['widget_ara']==1) { ?>
   <section >
    <!-- Main Container -->
    <div class="container">


     <!-- end post-padding -->

     <div class="post-ad-form postdetails" >

      <form method="POST" action="rezervasyon-arac" class="submit-form">

        <div class="clearfix"></div>
        <!-- Heading Area -->
        <div class="heading-panel">
         <div class="col-xs-12 col-md-12 col-sm-12 text-center">
          <!-- Main Title -->
          <h1><?php echo $widgetprint['widget_bara'] ?></h1>
          <!-- Short Description -->
        </div>
      </div>
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



<button class="btn btn-theme pull-right" style="width: 100%;">DEVAM</button>

</form>

</div>

<!-- end post-ad-form-->


</div>
</section>



<?php } if ($widgetprint['widget_urun']==1) { ?>
 <!-- =-=-=-=-=-=-= Ads Archieve =-=-=-=-=-=-= --> 
 <section class="custom-padding">
  <!-- Main Container -->
  <div class="container">
   <!-- Row -->
   <div class="row">
    <div class="clearfix"></div>
    <!-- Heading Area -->
    <div class="heading-panel">
     <div class="col-xs-12 col-md-12 col-sm-12 text-center">
      <!-- Main Title -->
      <h1><?php echo $widgetprint['widget_burun']; ?></h1>
      <!-- Short Description -->
    </div>
  </div>
  <!-- Middle Content Box -->
  <div class="col-md-12 col-xs-12 col-sm-12">
    <div class="posts-masonry">
      <?php 
      $urunsor=$db->prepare("SELECT * from urunler where urun_vitrin=1 order by urun_id ASC Limit 10");
      $urunsor->execute();
      while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { 
       ?>
       <div class="col-md-4 col-xs-12 col-sm-6">
        <!-- Ad Box -->
        <div class="category-grid-box">
         <!-- Ad Img -->
         <div class="category-grid-img">
          <img class="img-responsive" alt="" style="padding: 20px; " src="trex/<?php echo $uruncek['urun_resim']; ?>">
          <!-- Ad Status -->
          <a href="fiyat-listesi" class="view-details">Tüm Araçlar -></a>
          <!-- Additional Info -->
          <div class="additional-information" style="top: 10px;">
            <p>Yakıt: <?php echo $uruncek['urun_yakit']; ?></p>
            <p>Vites: <?php echo $uruncek['urun_vites']; ?></p>
            <p>Klima: <?php echo $uruncek['urun_klima']; ?></p>
            <p>Bagaj: <?php echo $uruncek['urun_bagaj']; ?></p>
            <p>Kişi Sayısı: <?php echo $uruncek['urun_koltuk']; ?> </p>
            <p>Kapı Sayısı: <?php echo $uruncek['urun_kapi']; ?></p>
          </div>
          <!-- Additional Info End-->
        </div>
        <!-- Ad Img End -->
        <div class="short-description">
          <!-- Ad Category -->
          <!-- Ad Title -->
          <h3><a title="" href="fiyat-listesi"><?php 
          $karakter = strlen( $uruncek['urun_baslik'] );
          if ( $karakter > 35 )
          {
           echo mb_substr( $uruncek['urun_baslik'], 0, 35, 'UTF-8' ) . '...';
         }
         else
         {
           echo $uruncek['urun_baslik'];
         }
         ?></a> <small>veya benzeri...</small></h3>
         <!-- Price -->
         <div class="price"><?php echo $uruncek['urun_2999']; ?>.00 TL</b> <span class="negotiable">(Başlayan Fiyatlar...)</span></div>
       </div>
       <!-- Addition Info -->
       <div class="ad-info">
        <ul>
         <li><i class="flaticon-fuel-1"></i><?php echo $uruncek['urun_yakit']; ?></li>
         <li><i class="flaticon-engine-2"></i> <?php echo $uruncek['urun_vites']; ?></li>
       </ul>
     </div>
   </div>
   <!-- Ad Box End -->
 </div>

<?php } ?>
</div>
</div>
<div class="text-center">
 <div class="load-more-btn">
  <a href="fiyat-listesi" class="btn btn-lg  btn-theme">TÜM ARAÇLAR <i class="fa fa-refresh"></i> </a>
</div>
</div>
<!-- Middle Content Box End -->
<img alt="" class="block-content wow zoomIn "  data-wow-delay="0ms" data-wow-duration="3500ms" src="trex/<?php echo $settingsprint['ayar_resimindex']; ?>">
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archieve End =-=-=-=-=-=-= --> 
<?php }  if ($widgetprint['widget_counter']==1) { ?>
  <!-- =-=-=-=-=-=-= Statistics Counter =-=-=-=-=-=-= -->
  <div class="funfacts custom-padding parallex" style="background: rgba(0, 0, 0, 0) url(trex/<?php echo $settingsprint['ayar_resimcounter']; ?>) no-repeat scroll center center;">
   <div class="container">
    <div class="row">

      <?php 
      $counterarticle=$db->prepare("SELECT * from counter");
      $counterarticle->execute(array(0)); 
      while ($counterarticleprint=$counterarticle->fetch(PDO::FETCH_ASSOC)) { ?>
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="icons">
         <i class="fa fa-3x <?php echo $counterarticleprint['counter_icon']; ?>"></i>
       </div>
       <div class="number"><span class="timer" data-from="0" data-to="<?php echo $counterarticleprint['counter_rakam']; ?>" data-speed="1500" data-refresh-interval="5">0</span>+</div>
       <h4>Toplam <span><?php echo $counterarticleprint['counter_isim']; ?></span></h4>
     </div>
   <?php } ?>
 </div>
 <!-- /.row -->
</div>
<!-- /.container -->
</div>
<!-- =-=-=-=-=-=-= Statistics Counter End =-=-=-=-=-=-= -->
<?php } if ($widgetprint['widget_bilgi']==1) { ?>
  <!-- =-=-=-=-=-=-= Services Section  =-=-=-=-=-=-= -->
  <section class="custom-padding services-2">
   <div class="absolute-img"><img alt="" src="trex/<?php echo $settingsprint['ayar_resimparalax']; ?>" class="img-responsive wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms"></div>
   <div class="container">
    <div class="row">
     <div class="col-md-5"></div>
     <div class="col-md-7 col-sm-12 col-xs-12 ">
       <div class="choose-services">
         <ul class="choose-list">
           <?php 
           $bilgisor=$db->prepare("SELECT * from bilgi");
           $bilgisor->execute(array(0));
           while ($bilgicek=$bilgisor->fetch(PDO::FETCH_ASSOC)) {?>
            <!-- feature -->
            <li class="col-md-6 col-xs-12 col-sm-6">
             <div class="services-grid">
              <div class="icon"> <i class="fa <?php echo $bilgicek['bilgi_icon'] ?> fa-2x"></i></div>
              <h4><?php echo $bilgicek['bilgi_baslik'] ?></h4>
              <p><?php echo $bilgicek['bilgi_aciklama'] ?></p>
            </div>
          </li>
        <?php } ?>
      </ul>
      <!-- end choose-list -->
    </div>
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
</section>
<!-- =-=-=-=-=-=-= Services Section End =-=-=-=-=-=-= -->
<?php }  if ($widgetprint['widget_diger']==1) { ?>
  <!-- =-=-=-=-=-=-= Car Comparison End  =-=-=-=-=-=-= -->
  <section class="client-section gray">
   <div class="container">
    <div class="row">
     <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="margin-top-50">
       <h2><?php echo htmlspecialchars($widgetprint['widget_bdiger']); ?></h2>
     </div>
   </div>
   <div class="col-md-8 col-sm-12 col-xs-12">
    <div class="brand-logo-area clients-bg">
     <div class="clients-list">
      <?php 
      $refsor=$db->prepare("SELECT * from referanslar");
      $refsor->execute(array(0));
      while ($refprint=$refsor->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="client-logo">
         <a target="_blank" href="<?php echo $refprint['referans_link'] ?>"><img src="trex/<?php echo $refprint['referans_resim1'] ?>" class="img-responsive" alt="<?php echo $refprint['referans_adi']; ?>" title="<?php echo $refprint['referans_kategori'] ?>" /></a>
       </div>
     <?php } ?>
   </div>
 </div>
</div>
</div>
</div>
</section>
<!-- =-=-=-=-=-=-= Expert Reviews Section =-=-=-=-=-=-= -->
<?php }  if ($widgetprint['widget_yorum']==1) {  ?>
  <!-- =-=-=-=-=-=-= Expert Reviews End =-=-=-=-=-=-= -->
  <!-- =-=-=-=-=-=-= Feedback Section =-=-=-=-=-=-= -->
  <section class="news section-padding">
   <div class="container">
    <div class="row">
     <div class="heading-panel">
      <div class="col-xs-12 col-md-12 col-sm-12 left-side">
       <!-- Main Title -->
       <h1><?php echo $widgetprint['widget_byorum']; ?> </h1>
       <!-- Short Description -->
       
     </div>
   </div>
   <!-- Middle Content Box -->
   <div class="col-md-12 col-xs-12 col-sm-12" style="height: 150px;">
    <div class="row">
     <div class="owl-testimonial-1">
      <?php 
      $yorum=$db->prepare("SELECT * from yorumlar order by yorum_id");
      $yorum->execute();
      while($yorumcek=$yorum->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="single_testimonial">
         <div class="textimonial-content">
          <h4><?php echo $yorumcek['yorum_isim']; ?></h4>
          <p><?php echo $yorumcek['yorum_icerik']; ?></p>
        </div>
        <div class="testimonial-meta-box">
          <img src="trex/<?php echo $yorumcek['yorum_resim']; ?>" >
          <div class="testimonial-meta">
           <p><?php echo $yorumcek['yorum_link']; ?></p>
           <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
         </div>
       </div>
     </div>
   <?php } ?>
 </div>
 <div class="clearfix"></div>
</div>
</div>
<!-- Middle Content Box End -->
</div>
<div class="clearfix"></div>
</div>
</section>
<?php }  if ($widgetprint['widget_blog']==1) { ?>
  <!-- =-=-=-=-=-=-= Feedback Section End =-=-=-=-=-=-= -->
  <section class="news section-padding">
   <div class="container">
    <div class="row">
     <div class="heading-panel">
      <div class="col-xs-12 col-md-12 col-sm-12 left-side">
       <!-- Main Title -->
       <h1><?php echo $widgetprint['widget_bblog']; ?></h1>
       <!-- Short Description -->
     </div>
   </div>
   <?php 
   $blog=$db->prepare("SELECT * from blog order by blog_id DESC Limit 1");
   $blog->execute();
   while($blogcek=$blog->fetch(PDO::FETCH_ASSOC)) { 
    ?>
    <div class="col-md-7 col-sm-12 col-xs-12">
      <div class="mainimage">
        <a href="<?=seo('blog-'.$blogcek["blog_baslik"]).'-'.$blogcek["blog_id"]?>">
          <img class="img-responsive" src="trex/<?php echo $blogcek['blog_resim']; ?>" alt="<?php echo $blogcek['blog_baslik']; ?>">
          <div class="overlay">
           <h2><?php 
           $karakter = strlen( $blogcek['blog_baslik'] );
           if ( $karakter > 35 )
           {
            echo mb_substr( $blogcek['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
          }
          else
          {
            echo $blogcek['blog_baslik'];
          }
          ?></h2>
        </div>
      </a>
      <div class="clearfix"></div>
    </div>
  </div>
<?php } ?>


<div class="col-md-5 col-sm-12 col-xs-12">
  <div class="newslist">
   <ul>
    <?php 
    $blog=$db->prepare("SELECT * from blog order by blog_id DESC Limit 2,4");
    $blog->execute();
    while($blogcek=$blog->fetch(PDO::FETCH_ASSOC)) { 
      ?>
      <li style="margin-bottom: 29px;">
       <div class="imghold"> <a><img src="trex/<?php echo $blogcek['blog_resim']; ?>" alt="<?php echo $blogcek['blog_baslik']; ?>"></a> </div>
       <div class="texthold">
        <h4><a href="<?=seo('blog-'.$blogcek["blog_baslik"]).'-'.$blogcek["blog_id"]?>"><?php 
        $karakter = strlen( $blogcek['blog_baslik'] );
        if ( $karakter > 35 )
        {
          echo mb_substr( $blogcek['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
        }
        else
        {
          echo $blogcek['blog_baslik'];
        }
        ?></a></h4>
        <p><?php echo substr(strip_tags($blogcek['blog_detay']), 0,120).'...'; ?></p>
      </div>
      <div class="clear"></div>
    </li>

  <?php } ?>
</ul>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
</section>

<?php } include 'include/footer.php'; ?>
