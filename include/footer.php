 <section class="sell-box padding-top-70">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="sell-box-grid">
               <div class="text-center">
                  <img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="trex/<?php echo $settingsprint['ayar_footer1']; ?> ">
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="sell-box-grid">
               <div class="text-center">
                  <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="trex/<?php echo $settingsprint['ayar_footer2']; ?> ">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php  $whatsapp=$db->prepare("SELECT * from whatsapp where whats_id=0");
$whatsapp->execute(array(0));
$whatsappprint=$whatsapp->fetch(PDO::FETCH_ASSOC); ?>


<div style='position: fixed; bottom: 32px; right: 20px; z-index: 9999;'>

  <button data-toggle="modal" data-target="#myModal" class="btn btn-theme">İLETİŞİM</button>

</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Kolay Erişim</h4>
      </div>
      <div class="modal-body text-center">
        <?php if ($whatsappprint['whats_cdestekdurum']==1) { ?>
          <p><a href="<?php echo $whatsappprint['whats_cdestek']; ?>" class="btn btn-info" style="width: 50%;background: #CB2027; border: none"><i class="fa fa-calendar-check-o"></i>&nbsp;REZERVASYON YAP</a></p>
        <?php } if ($whatsappprint['whats_tiklaaradurum']==1) { ?>
          <p><a href="tel:<?php echo $whatsappprint['whats_tiklaara']; ?>" class="btn btn-info" style="width: 50%;background: #3b5998; border: none"><i class="fa fa-phone"></i>&nbsp;TIKLA ARA</a></p>
        <?php } if ($whatsappprint['whats_durum']==1) { ?>
          <p><a href="https://api.whatsapp.com/send?phone=90<?php echo $whatsappprint['whats_tel']; ?>" class="btn btn-info" style="width: 50%;background: #23A217; border: none"><i class="fa fa-whatsapp"></i>&nbsp;WHATSAPP</a></p>
        <?php } if ($whatsappprint['whats_skypedurum']==1) { ?>
          <p><a href="skype:<?php echo $whatsappprint['whats_skype']; ?>?chat" class="btn btn-info" style="width: 50%;background: #00ACED; border: none"><i class="fa fa-skype"></i>&nbsp;SKYPE YAZ</a></p>
        <?php } if ($whatsappprint['whats_maildurum']==1) { ?>
          <p><a href="mailto:<?php echo $whatsappprint['whats_mail']; ?>" class="btn btn-info" style="width: 50%;background: #FFAA17; border: none"><i class="fa fa-envelope-o"></i>&nbsp;MAİL GÖNDER</a></p>
        <?php } if ($whatsappprint['whats_sssdurum']==1) { ?>
          <p><a href="sss" class="btn btn-info" style="width: 50%;background: #15BDD7; border: none"><i class="fa fa-question-circle-o"></i>&nbsp;SIK SORULAN SORULAR</a></p>
        <?php } if ($whatsappprint['whats_iletisimdurum']==1) { ?>
          <p><a href="iletisim" class="btn btn-info" style="width: 50%;background: #517FA4; border: none"><i class="fa fa-send-o"></i>&nbsp;İLETİŞİM FORMU</a></p>
        <?php } ?>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal" style="margin:10px !important;">Kapat</button>
      </div>
    </div>

  </div>
</div>
<!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
<footer class="footer-bg">
   <!-- Footer Content -->
   <div class="footer-top">
      <div class="container">
         <div class="row">
            <div class="col-md-5  col-sm-6 col-xs-12">
               <!-- Info Widget -->
               <div class="widget">
                  <div class="logo"> <img alt="<?php echo $settingsprint['ayar_firmaadi']; ?>" src="trex/<?php echo $settingsprint['ayar_logo']; ?>"> </div>
                  <p><?php echo $widgetprint['widget_bwelcome']; ?></p>
               </div>

               <!-- Info Widget Exit -->
            </div>
            <div class="col-md-2  col-sm-6 col-xs-12">
               <!-- Follow Us -->
               <div class="widget my-quicklinks">
                  <h5>Menü</h5>
                  <ul>
                    <?php 
                    $footermenu=$db->prepare("SELECT * from fmenu order by fmenu_sira");
                    $footermenu->execute();
                    while($footermenuprint=$footermenu->fetch(PDO::FETCH_ASSOC)) { ?>             
                       <li><a href="<?php echo $footermenuprint['fmenu_link'] ?>"><?php 
                       $projelerkarakter = strlen( $footermenuprint['fmenu_ad'] );
                       if ( $projelerkarakter > 30 )
                       {

                         echo mb_substr($footermenuprint['fmenu_ad'], 0,30, 'UTF-8')."...";
                      } else {
                         echo $footermenuprint['fmenu_ad'];
                      }

                      ?></a></li>
                   <?php } ?>
                </ul>
             </div>
             <!-- Follow Us End -->
          </div>
          <div class="col-md-4  col-sm-6 col-xs-12">
            <!-- Follow Us -->
            <div class="widget my-quicklinks">
               <h5>Blog</h5>
               <ul >
                  <?php 
                  $fblog=$db->prepare("SELECT * from blog order by blog_id Desc Limit 4");
                  $fblog->execute();
                  while($fblogcek=$fblog->fetch(PDO::FETCH_ASSOC)) { ?>
                     <li><a href="<?=seo('blog-'.$fblogcek["blog_baslik"]).'-'.$fblogcek["blog_id"]?>"><?php 
                     $karakter = strlen( $fblogcek['blog_baslik'] );
                     if ( $karakter > 35 )
                     {
                        echo mb_substr( $fblogcek['blog_baslik'], 0, 35, 'UTF-8' ) . '...';
                     }
                     else
                     {
                        echo $fblogcek['blog_baslik'];
                     }
                     ?></a></li>
                  <?php } ?>
               </ul>
            </div>
            <!-- Follow Us End -->
         </div>
      </div>
   </div>
</div>

</footer>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core Css  -->
<script src="js/bootstrap.min.js"></script>
<!-- Jquery Easing -->
<script src="js/easing.js"></script>
<!-- Menu Hover  -->
<script src="js/carspot-menu.js"></script>
<!-- Jquery Appear Plugin -->
<script src="js/jquery.appear.min.js"></script>
<!-- Numbers Animation   -->
<script src="js/jquery.countTo.js"></script>
<!-- Jquery Select Options  -->
<script src="js/select2.min.js"></script>
<!-- noUiSlider -->
<script src="js/nouislider.all.min.js"></script>

<script src="//cdn.jsdelivr.net/sweetalert2/6.5.6/sweetalert2.min.js"></script>   
<!-- Carousel Slider  -->
<script src="js/carousel.min.js"></script>
<script src="js/slide.js"></script>
<!-- Image Loaded  -->
<script src="js/imagesloaded.js"></script>
<script src="js/isotope.min.js"></script>
<!-- CheckBoxes  -->
<script src="js/icheck.min.js"></script>
<!-- Jquery Migration  -->
<script src="js/jquery-migrate.min.js"></script>

<!-- Style Switcher -->
<script src="js/color-switcher.js"></script>
<!-- PrettyPhoto -->
<script src="js/jquery.fancybox.min.js"></script>
<!-- Wow Animation -->
<script src="js/wow.js"></script>
<!-- Template Core JS -->
<script src="js/custom.js"></script>
<!-- For This Page Only -->
<!-- MasterSlider --> 
<script src="js/masterslider/masterslider.min.js"></script> 
<?php echo $motorprint['motor_analitik']; ?>
<?php echo $motorprint['motor_metrika']; ?>
<?php echo $settingsprint['ayar_kod']; ?>
<script type="text/javascript"> 
   (function($) {
     "use strict";  


     var slider = new MasterSlider();

                // adds Arrows navigation control to the slider.
                slider.control('arrows');

                slider.setup('masterslider' , {
                     width:1400,    // slider standard width
                     height:560,   // slider standard height
                     layout:'fullwidth',
                     loop:true,
                     preload:0,
                     fillMode:'fill',
                     instantStartLayers:true,
                     autoplay:true,
                     view:"basic"

                  });
         // add scroll parallax effect
         
      })(jQuery);







   </script>
   
<?php if ($_GET['status']=='ok') { ?>
  <script>
   $(document).ready(function () {
    swal({
      title: "TAMAMLANDI!",
      text: "İşlem Başarılı Bir Şekilde Tamamlandı.",
      type: "success",
      select:false,
      timer: '5000',
    });
  });
</script>
<?php  
$sayfaURL = "http";
if(isset($_SERVER["HTTPS"])){
  if($_SERVER["HTTPS"] == "on"){
    $sayfaURL .= "s";
  }
}
$hesapa=$db->prepare("SELECT * from smenu where smenu_id=11");
$hesapa->execute(array(0));
$hesapprinta=$hesapa->fetch(PDO::FETCH_ASSOC);

$sayfaURL .= "://";
$sayfaURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
?>
<meta http-equiv="refresh" content="5; URL=<?php echo substr($sayfaURL,0, -10);?>">
<?php

} elseif ($_GET['status']=='no') {?>
  <script>
   $(document).ready(function () {
    swal({
      title: "HATA!",
      text: "İşlem sırasında bir hata oluştu.",
      type: "error",
      timer: '5000'
    });
  });
</script>
<?php  
$sayfaURL = "http";
if(isset($_SERVER["HTTPS"])){
  if($_SERVER["HTTPS"] == "on"){
    $sayfaURL .= "s";
  }
}
$sayfaURL .= "://";
$sayfaURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>
<meta http-equiv="refresh" content="5; URL=<?php echo substr($sayfaURL,0, -10);?>">
<?php } elseif ($_GET['demo']=='ok') {?>
  <script>
   $(document).ready(function () {
    swal({
      title: "OoPs!",
      text: "Demo modda bu işleme izin verilmiyor.",
      type: "warning",
      timer: '6000'
    });
  });
</script>
<?php  
$sayfaURL = "http";
if(isset($_SERVER["HTTPS"])){
  if($_SERVER["HTTPS"] == "on"){
    $sayfaURL .= "s";
  }
}
$sayfaURL .= "://";
$sayfaURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>
<meta http-equiv="refresh" content="6; URL=<?php echo substr($sayfaURL,0, -8);?>">
<?php } elseif ($_GET['yorum']=='ok') {?>
  <script>
   $(document).ready(function () {
    swal({
      title: "YORUM KAYDEDİLDİ!",
      text: "Yorumunuz onay sonrası yayınlanacaktır.",
      type: "success",
      timer: '6000'
    });
  });
</script>
<?php  
$sayfaURL = "http";
if(isset($_SERVER["HTTPS"])){
  if($_SERVER["HTTPS"] == "on"){
    $sayfaURL .= "s";
  }
}
$sayfaURL .= "://";
$sayfaURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>
<meta http-equiv="refresh" content="6; URL=<?php echo substr($sayfaURL,0, -9);?>">
<?php } ?>
</body>
</html>

