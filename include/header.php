
<!DOCTYPE html>
<html lang="tr">
<head>
<style>
    :root
    {
        --renk : <?php echo $settingsprint['ayar_mobil']; ?>
    }
</style>
    <?php echo $motorprint['motor_yonay']; ?>
    <?php echo $motorprint['motor_gonay']; ?>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title><?php echo $meta['title'] ?></title>
  <meta name="keywords" content="<?php echo $meta['desc'] ?>" />
  <meta name="description" content="<?php echo $meta['key'] ?>" />
  <!-- =-=-=-=-=-=-= Favicons Icon =-=-=-=-=-=-= -->
  <link rel="icon" href="trex/<?php echo $settingsprint['ayar_fav']; ?>" type="image/x-icon" />
  <!-- =-=-=-=-=-=-= Mobile Specific =-=-=-=-=-=-= -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- =-=-=-=-=-=-= Bootstrap CSS Style =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- =-=-=-=-=-=-= Template CSS Style =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/style.css">
  <!-- =-=-=-=-=-=-= Font Awesome =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/font-awesome.css" type="text/css">
  <!-- =-=-=-=-=-=-= Flat Icon =-=-=-=-=-=-= -->
  <link href="css/flaticon.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= Et Line Fonts =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/et-line-fonts.css" type="text/css">
  <!-- =-=-=-=-=-=-= Menu Drop Down =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/carspot-menu.css" type="text/css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.5.6/sweetalert2.min.css">
  <!-- =-=-=-=-=-=-= Animation =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/animate.min.css" type="text/css">
  <!-- =-=-=-=-=-=-= Select Options =-=-=-=-=-=-= -->
  <link href="css/select2.min.css" rel="stylesheet" />
  <!-- =-=-=-=-=-=-= noUiSlider =-=-=-=-=-=-= -->
  <link href="css/nouislider.min.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= Listing Slider =-=-=-=-=-=-= -->
  <link href="css/slider.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= Owl carousel =-=-=-=-=-=-= -->
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.css">
  <!-- =-=-=-=-=-=-= Check boxes =-=-=-=-=-=-= -->
  <link href="skins/minimal/minimal.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= PrettyPhoto =-=-=-=-=-=-= -->
  <link rel="stylesheet" href="css/jquery.fancybox.min.css" type="text/css" media="screen"/>
  <!-- =-=-=-=-=-=-= Responsive Media =-=-=-=-=-=-= -->
  <link href="css/responsive-media.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= Template Color =-=-=-=-=-=-= -->
  <link rel="stylesheet" id="color" href="css/colors/defualt.css">
  <!-- For This Page Only -->
  <!-- Base MasterSlider style sheet -->
  <link rel="stylesheet" href="js/masterslider/style/masterslider.css" />
  <link rel="stylesheet" href="js/masterslider/skins/default/style.css" />
  <link rel="stylesheet" href="js/masterslider/style/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600%7CSource+Sans+Pro:400,400i,600" rel="stylesheet">
  <!-- JavaScripts -->
  <script src="js/modernizr.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <?php $saat = date(H) ?>
  <body>
    <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
    
    <!-- =-=-=-=-=-=-=  Header =-=-=-=-=-=-= -->
    <div class="colored-header">
     <!-- Top Bar -->
     <div class="header-top">
      <div class="container">
       <div class="row">
        <!-- Header Top Left -->
        <div class="header-top-left col-md-8 col-sm-6 col-xs-12 hidden-xs">
         <ul class="listnone">
           <?php while($socialprint=$social->fetch(PDO::FETCH_ASSOC)) {?>
            <li>
              <a target="_blank" style="color: #fff;" href="<?php echo $socialprint['sosyal_link']; ?>"><i class="fa <?php echo $socialprint['sosyal_icon']; ?>" aria-hidden="true"></i></a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <!-- Header Top Right Social -->
      <div class="header-right col-md-4 col-sm-6 col-xs-12 ">
       <div class="pull-right">
        <ul class="listnone">
          <li><a href="tel:<?php echo $settingsprint['ayar_tel']; ?>"><i class="fa fa-phone"></i> <?php echo $settingsprint['ayar_tel']; ?></a></li>
          <li><a href="mailto:<?php echo $settingsprint['ayar_mail']; ?>"><i class="fa fa-envelope-o"></i> <?php echo $settingsprint['ayar_mail']; ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Top Bar End -->
<!-- Navigation Menu -->
<div class="clearfix"></div>
<!-- menu start -->
<nav id="menu-1" class="mega-menu">
  <!-- menu list items container -->
  <section class="menu-list-items">
   <div class="container">
    <div class="row">
     <div class="col-lg-12 col-md-12">
      <!-- menu logo -->
      <ul class="menu-logo">
       <li>
        <a href="<?php echo $settingsprint['ayar_siteurl']; ?>"><img src="trex/<?php echo $settingsprint['ayar_logo']; ?>" alt="logo"> </a>
      </li>
    </ul>
    <!-- menu links -->
    <ul class="menu-links">
     <!-- active class -->




     <li><a href="<?php echo $settingsprint['ayar_siteurl']; ?>"><i class="fa fa-home"></i></a></li>
     <?php 
                                                    // ALT MENU DÜZENİ YAPILMIŞTIR!!!!!
     $menulist=$db->prepare("SELECT * from omenu where omenu_ust=0 order by omenu_sira ASC");
     $menulist->execute(); 

     foreach ($menulist as $row) {
      $ust=$row['omenu_id'];
      $ustdurum=$row['omenu_durum'];
      $menuliste=$db->prepare("SELECT * from omenu where omenu_ust=$ust order by omenu_sira ASC");
      $menuliste->execute(); 
      ?>
      <!--sarkan menu-->
      <?php if ($ustdurum<=0) {
        ?> <li> <?php
      } else { ?>
        <li><?php } ?> <a href="<?php echo $row['omenu_link']; ?>"><?php echo $row['omenu_ad']; ?> 

        <?php if ($ustdurum<=0) {
          ?></a><?php
        } else {
          ?> <i class="fa fa-angle-down fa-indicator"></i></a><ul class="drop-down-multilevel"> <?php
        } ?>


        <?php foreach ($menuliste as $key) { ?>

          <li><a href="<?php echo $key['omenu_link']; ?>"><?php echo $key['omenu_ad']; ?> </a></li>

        <?php   } if ($ustdurum<=0) {

        } else {
          ?> </ul> <?php
        } ?>

      </li>
    <?php } ?>
    </ul><?php if ($widgetprint['widget_ara']==1) { ?>
      <ul class="menu-search-bar">
       <li>
        <a href="rezervasyon" class="btn btn-theme"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $widgetprint['widget_bara'] ?></a>
      </li>
    </ul>
  <?php } ?>
</div>
</div>
</div>
</section>
</nav>
<!-- menu end -->
</div>
<div class="clearfix"></div>
<!-- =-=-=-=-=-=-= Primary Header End =-=-=-=-=-=-= -->
