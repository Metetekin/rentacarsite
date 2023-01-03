<!-- Master Slider -->
<div class="master-slider ms-skin-default" id="masterslider">
   <?php 
   $slider=$db->prepare("SELECT * from slayt order by slayt_sira ASC");
   $slider->execute(array(0));
   while($sliderprint=$slider->fetch(PDO::FETCH_ASSOC)) { 
     ?>

     <div class="ms-slide slide-<?php echo $sliderprint['slayt_resim']; ?>" data-delay="4">
        <div class="ms-overlay-layers"></div>
        <!-- slide background --> 
        <img src="js/masterslider/style/blank.gif" data-src="trex/<?php echo $sliderprint['slayt_resim']; ?>" alt="Slide1 background"/> 
        <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs"
        style="left:120px; top:150px;color: <?php echo $sliderprint['slayt_renk']; ?>;"
        data-type="text"
        data-delay="2000"
        data-duration="2000"
        data-ease="easeOutExpo"
        data-effect="skewleft(30,80)"><?php echo $sliderprint['slayt_baslik']; ?></h3>
        <h5 class="ms-layer text1 font-white"
        style="left: 120px; top: 250px;color: <?php echo $sliderprint['slayt_renk']; ?>;"
        data-type="text"
        data-effect="bottom(45)"
        data-duration="2500"
        data-delay="3000"
        data-ease="easeOutExpo"><?php echo $sliderprint['slayt_aciklama']; ?>
    </h5>
    <?php
    $kontrol=strlen($sliderprint['slayt_butonad']);
    if ($kontrol>0) { ?>
        <a href="<?php echo $sliderprint['slayt_butonlink']; ?>" class="ms-layer btn3 uppercase"
            style="left:120px; top: 390px;"
            data-type="text"
            data-delay="3500"
            data-ease="easeOutExpo"
            data-duration="2000"
            data-effect="scale(1.5,1.6)"> <?php echo $sliderprint['slayt_butonad']; ?></a> 
        <?php } ?>
    </div>
    <!-- slide 2 -->
<?php } ?>

<!-- end of slide --> 
</div>
<!-- end Master Slider -->
