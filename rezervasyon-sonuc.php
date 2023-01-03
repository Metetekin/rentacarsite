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

$inovance=$db->prepare("SELECT * from siparis where siparis_secure=:siparis_id");
$inovance->execute(array(
  'siparis_id' => $_GET['sec']
));
$inovanceprint=$inovance->fetch(PDO::FETCH_ASSOC);
$sayKontrol=$inovance->rowCount();
?>
<div class="page-header-area-2 gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="small-breadcrumb">
                    <div class=" breadcrumb-link">
                        <ul>
                            <li><a href="<?php echo $settingsprint['ayar_siteurl'] ?>">Anasayfa</a></li>
                            <li><a class="active">Rezervasyon Formu</a></li>
                        </ul>
                    </div>
                    <div class="header-page">
                        <h1>Rezervasyon Sonuç</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-content-area clearfix">
    <section class="section-padding no-top gray ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="post-ad-form postdetails">
                        <?php if ($sayKontrol==1) {  ?>
                        <div role="alert" class="alert alert-success alert-dismissible alert-outline">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                            <strong>Tebrikler</strong> - Rezervasyon kaydınız başarılı bir şekilde oluşturulmuştur.
                        </div>
                        <p><br> Rezervasyonunuz ile ilgili bilgi almak için lütfen aşağıda bulunan rezevasyon kodunu not alınız bizimle iletişime geçtiğinizde bu kod sorulacaktır. <br /><br />
                            <b>Rezervasyon Kodunuz: </b> <?php echo $inovanceprint['siparis_id']; ?> <br /><br />
                            <?php } elseif ($_GET['status']=='no') { ?>
                        <div role="alert" class="alert alert-danger alert-dismissible alert-outline">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                            <strong>HATA</strong> - Rezervasyon kaydı sırasında sistemsel bir hata oluştu. Bu hatayı birden fazla kez aldıysanız lütfen bizimle iletişime geçiniz!
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  include 'include/footer.php'; ?>
