<?php
ob_start();
session_start();
include 'config.php';
date_default_timezone_set( 'Europe/Istanbul' );
if ( isset( $_POST[ 'login' ] ) )
{


	$kullanici_adi  = htmlspecialchars(trim($_POST[ 'kullanici_adi' ]));
	$kullanici_pass = htmlspecialchars(trim(md5( $_POST[ 'kullanici_pass' ] )));

	if ( $kullanici_adi && $kullanici_pass )
	{


		$kullanicisor = $db->prepare( "SELECT * from kullanici where kullanici_adi=:adi and kullanici_pass=:pass" );
		$kullanicisor->execute(
			array(
				'adi'  => $kullanici_adi,
				'pass' => $kullanici_pass
			)
		);

		$say = $kullanicisor->rowCount();

		if ( $say > 0 )
		{

			$_SESSION[ 'kullanici_adi' ] = $kullanici_adi;

			header( 'Location:../index.php' );
		}
		else
		{

			header( 'Location:../login.php?status=no' );
		}
	}
}

if ( isset( $_POST[ 'randevu' ] ) )
{
	$kaydet = $db->prepare(
		"INSERT INTO randevu SET
		randevu_ad=:ad,
		randevu_tel=:tel,
		randevu_hizmet=:hizmet,
		randevu_not=:not");
	$insert = $kaydet->execute(
		array(
			'ad' => $_POST[ 'randevu_ad' ],
			'tel' => $_POST[ 'randevu_tel' ],
			'hizmet' => $_POST[ 'randevu_hizmet' ],
			'not' => $_POST[ 'randevu_not' ]
		));


	$smssor=$db->prepare("SELECT * from sms where sms_id=0");
	$smssor->execute(array(0));
	$smscek=$smssor->fetch(PDO::FETCH_ASSOC);

	$settings=$db->prepare("SELECT * from ayar where ayar_id=?");
	$settings->execute(array(0));
	$settingsprint=$settings->fetch(PDO::FETCH_ASSOC);

	$link = $settingsprint['ayar_siteurl'];

	if ( $insert )
	{

		Header( "Location:../../phpmail/randevu.php?randevuform=ok" );
		
		
	}
	else
	{

		Header( "Location:$linkrandevu/?status=no" );
	}
}


if ( isset( $_POST[ 'siparisver' ] ) )
{
	$ad=htmlspecialchars(trim($_POST[ 'siparis_ad' ]));
	$tel=htmlspecialchars(trim($_POST[ 'siparis_tel' ]));
	$ilce=htmlspecialchars(trim($_POST[ 'siparis_ilce' ]));
	$adres=htmlspecialchars(trim($_POST[ 'siparis_adres' ]));


	$kaydet = $db->prepare(
		"INSERT INTO siparis SET
		siparis_ad=:ad,
		siparis_urun=:urun,
		siparis_tel=:tel,
		siparis_il=:il,
		siparis_ilce=:ilce,
		siparis_mail=:mail,
		siparis_adres=:adres");
	$insert = $kaydet->execute(
		array(
			'ad' => $ad,
			'urun' => $_POST[ 'siparis_urun' ],
			'tel' => $tel,
			'mail' => $_POST[ 'siparis_mail' ],
			'il' => $_POST[ 'siparis_il' ],
			'ilce' => $ilce,
			'adres' => $adres
		));

	$smssor=$db->prepare("SELECT * from sms where sms_id=0");
	$smssor->execute(array(0));
	$smscek=$smssor->fetch(PDO::FETCH_ASSOC);

	$settings=$db->prepare("SELECT * from ayar where ayar_id=?");
	$settings->execute(array(0));
	$settingsprint=$settings->fetch(PDO::FETCH_ASSOC);

	$link = $settingsprint['ayar_siteurl'];

	if ( $insert )
	{
		Header( "Location:../../phpmail/siparis.php?iletisimform=ok" );
		
	}
	else
	{

		Header( "Location:$link?status=no" );
	}
}
if ( isset( $_POST[ 'iletisimform' ] ) )
{
    $ad = htmlspecialchars(trim(strip_tags($_POST[ 'mesaj_ad' ])));
    $mail = htmlspecialchars(trim(strip_tags($_POST[ 'mesaj_mail' ])));
    $icerik = htmlspecialchars(trim(strip_tags($_POST[ 'mesaj_icerik' ])));

    $ayarkaydet = $db->prepare(
      "INSERT INTO mesajlar SET
      mesaj_ad=:ad,
      mesaj_mail=:mail,
      mesaj_icerik=:icerik
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'ad'     => $ad,
       'mail'     => $mail,
       'icerik'     => $icerik
   )
  );

    

    if ( $update )
    {
      $idmesaj = $db->lastInsertId();
      Header( "Location:../../phpmail/index.php?iletisimform=ok&mesaj=$idmesaj" );
  }
  else
  {

      Header( "Location:../../iletisim?status=no" );
  }
} 
if ( isset( $_POST[ 'blogekle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../assets/img/blog';
    @$tmp_name = $_FILES[ 'blog_resim' ][ "tmp_name" ];
    $benzersizsayi1 = rand( 20000, 32000 );
    $benzersizsayi2 = rand( 20000, 32000 );
    $uzanti='.jpg';
    $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

    $kaydet = $db->prepare(
      "INSERT INTO blog SET
      blog_baslik=:baslik,
      blog_kategori=:kategori,
      blog_detay=:detay,
      blog_title=:title,
      blog_descr=:descr,
      blog_keyword=:keyword,
      blog_resim=:resim"
  );
    $insert = $kaydet->execute(
      array(
         'baslik' => $_POST[ 'blog_baslik' ],
         'kategori' => $_POST[ 'blog_kategori' ],
         'detay'  => $_POST[ 'blog_detay' ],
         'title' => $_POST[ 'blog_title' ],
         'descr'  => $_POST[ 'blog_descr' ],
         'keyword' => $_POST[ 'blog_keyword' ],
         'resim'  => $refimgyol
     )
  );

    if ( $insert )
    {

      Header( "Location:../blog.php?status=ok" );
  }
  else
  {

      Header( "Location:../blog.php?status=no" );
  }
}

if ( isset( $_POST[ 'blogkategoriekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "INSERT INTO kategorilerb SET
      kategori_ad=:ad,
      kategori_title=:title,
      kategori_descr=:descr,
      kategori_keyword=:keyword,
      kategori_sira=:sira
      "
  );
    $update     = $ayarkaydet->execute(
      array(
         'ad'     => $_POST[ 'kategori_ad' ],
         'title'     => $_POST[ 'kategori_title' ],
         'descr'     => $_POST[ 'kategori_descr' ],
         'keyword'     => $_POST[ 'kategori_keyword' ],
         'sira'    => $_POST[ 'kategori_sira' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../blog-kategoriler.php?status=ok" );
  }
  else
  {

      Header( "Location:../blog-kategoriler.php?status=no" );
  }
}
if ( $_GET[ 'blogkategorisil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from kategorilerb where kategori_id=:kategori_id" );
    $kontrol = $sil->execute(
      array(
         'kategori_id' => $_GET[ 'kategori_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../blog-kategoriler.php?status=ok" );
  }
  else
  {

      Header( "Location:../blog-kategoriler.php?status=no" );
  }

}
if ( isset( $_POST[ 'blogkategoriduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE kategorilerb SET
      kategori_ad=:ad,
      kategori_title=:title,
      kategori_descr=:descr,
      kategori_keyword=:keyword,
      kategori_sira=:sira
      WHERE kategori_id={$_POST['kategori_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'ad'     => $_POST[ 'kategori_ad' ],
         'title'     => $_POST[ 'kategori_title' ],
         'descr'     => $_POST[ 'kategori_descr' ],
         'keyword'     => $_POST[ 'kategori_keyword' ],
         'sira'    => $_POST[ 'kategori_sira' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../blog-kategoriler.php?status=ok" );
  }
  else
  {

      Header( "Location:../blog-kategoriler.php?status=no" );
  }
}
if ( isset( $_POST[ 'widgetduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE widget SET
      widget_btwitter=:btwitter,
      widget_twitter=:twitter,
      widget_diger=:diger,
      widget_bdiger=:bdiger,
      widget_blog=:blog,
      widget_referans=:referans,
      widget_breferans=:breferans,
      widget_burun=:burun,
      widget_urun=:urun,
      widget_yorum=:yorum,
      widget_bwelcome=:bwelcome,
      widget_welcome=:welcome,
      widget_counter=:counter,
      widget_bblog=:bblog,
      widget_bara=:bara,
      widget_ara=:ara,
      widget_bilgi=:bilgi,
      widget_bbilgi=:bbilgi,
      widget_byorum=:byorum
      WHERE widget_id={$_POST['widget_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'btwitter'     => $_POST[ 'widget_btwitter' ],
         'twitter'     => $_POST[ 'widget_twitter' ],
         'diger'     => $_POST[ 'widget_diger' ],
         'bdiger'     => $_POST[ 'widget_bdiger' ],
         'blog'     => $_POST[ 'widget_blog' ],
         'referans'     => $_POST[ 'widget_referans' ],
         'breferans'     => $_POST[ 'widget_breferans' ],
         'burun'     => $_POST[ 'widget_burun' ],
         'urun'     => $_POST[ 'widget_urun' ],
         'yorum'     => $_POST[ 'widget_yorum' ],
         'bwelcome'     => $_POST[ 'widget_bwelcome' ],
         'welcome'     => $_POST[ 'widget_welcome' ],
         'counter'    => $_POST[ 'widget_counter' ],
         'bblog'     => $_POST[ 'widget_bblog' ],
         'bara'     => $_POST[ 'widget_bara' ],
         'ara'     => $_POST[ 'widget_ara' ],
         'bilgi'     => $_POST[ 'widget_bilgi' ],
         'bbilgi'     => $_POST[ 'widget_bbilgi' ],
         'byorum'     => $_POST[ 'widget_byorum' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../modul.php?status=ok" );
  }
  else
  {

      Header( "Location:../modul.php?status=no" );
  }
}
if ( isset( $_POST[ 'bilgiduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE bilgi SET
      bilgi_baslik=:baslik,
      bilgi_icon=:icon,
      bilgi_aciklama=:aciklama
      WHERE bilgi_id={$_POST['bilgi_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'baslik'     => $_POST[ 'bilgi_baslik' ],
         'icon'     => $_POST[ 'bilgi_icon' ],
         'aciklama'     => $_POST[ 'bilgi_aciklama' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../bilgiler.php?status=ok" );
  }
  else
  {

      Header( "Location:../bilgiler.php?status=no" );
  }
}
if ( isset( $_POST[ 'whatsappduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE whatsapp SET
      whats_tel=:tel,
      whats_cdestek=:cdestek,
      whats_cdestekdurum=:cdestekdurum,
      whats_tiklaara=:tiklaara,
      whats_tiklaaradurum=:tiklaaradurum,
      whats_skype=:skype,
      whats_skypedurum=:skypedurum,
      whats_mail=:mail,
      whats_maildurum=:maildurum,
      whats_sssdurum=:sssdurum,
      whats_iletisimdurum=:iletisimdurum,
      whats_durum=:durum
      WHERE whats_id={$_POST['whats_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'tel'     => $_POST[ 'whats_tel' ],
         'cdestek'     => $_POST[ 'whats_cdestek' ],
         'cdestekdurum'     => $_POST[ 'whats_cdestekdurum' ],
         'tiklaara'     => $_POST[ 'whats_tiklaara' ],
         'tiklaaradurum'     => $_POST[ 'whats_tiklaaradurum' ],
         'skype'     => $_POST[ 'whats_skype' ],
         'skypedurum'     => $_POST[ 'whats_skypedurum' ],
         'mail'     => $_POST[ 'whats_mail' ],
         'maildurum'     => $_POST[ 'whats_maildurum' ],
         'sssdurum'     => $_POST[ 'whats_sssdurum' ],
         'iletisimdurum'     => $_POST[ 'whats_iletisimdurum' ],
         'durum'     => $_POST[ 'whats_durum' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../kolay-iletisim.php?status=ok" );
  }
  else
  {

      Header( "Location:../kolay-iletisim.php?status=no" );
  }
}
if ( isset( $_POST[ 'htmlduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE widget SET
      widget_html=:html
      WHERE widget_id={$_POST['widget_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'html'     => $_POST[ 'widget_html' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../html-alan.php?status=ok" );
  }
  else
  {

      Header( "Location:../html-alan.php?status=no" );
  }
}
if ( isset( $_POST[ 'widgetsssduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE widget SET
      widget_sbir=:sbir,
      widget_cbir=:cbir,
      widget_siki=:siki,
      widget_ciki=:ciki,
      widget_suc=:suc,
      widget_cuc=:cuc
      WHERE widget_id={$_POST['widget_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'sbir'     => $_POST[ 'widget_sbir' ],
         'cbir'     => $_POST[ 'widget_cbir' ],
         'siki'     => $_POST[ 'widget_siki' ],
         'ciki'     => $_POST[ 'widget_ciki' ],
         'suc'     => $_POST[ 'widget_suc' ],
         'cuc'     => $_POST[ 'widget_cuc' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../modul.php?status=ok" );
  }
  else
  {

      Header( "Location:../modul.php?status=no" );
  }
}
if ( isset( $_POST[ 'counterduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE counter SET
      counter_isim=:isim,
      counter_rakam=:rakam,
      counter_icon=:icon
      WHERE counter_id={$_POST['counter_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'isim'     => $_POST[ 'counter_isim' ],
         'rakam'     => $_POST[ 'counter_rakam' ],
         'icon'     => $_POST[ 'counter_icon' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../counter.php?status=ok" );
  }
  else
  {

      Header( "Location:../counter.php?status=no" );
  }
}
if ( isset( $_POST[ 'metaduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE meta SET
      meta_title=:title,
      meta_descr=:descr,
      meta_keyword=:keyword
      WHERE meta_id={$_POST['meta_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'title'     => $_POST[ 'meta_title' ],
         'descr'     => $_POST[ 'meta_descr' ],
         'keyword'     => $_POST[ 'meta_keyword' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../seo.php?status=ok" );
  }
  else
  {

      Header( "Location:../seo.php?status=no" );
  }
}
if ( isset( $_POST[ 'kategoriduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE kategoriler SET
      kategori_ad=:ad,
      kategori_adres=:adres,
      kategori_sira=:sira
      WHERE kategori_id={$_POST['kategori_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'ad'     => $_POST[ 'kategori_ad' ],
         'adres'     => $_POST[ 'kategori_adres' ],
         'sira'    => $_POST[ 'kategori_sira' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../form-subeler.php?status=ok" );
  }
  else
  {

      Header( "Location:../form-subeler.php?status=no" );
  }
}
if ( isset( $_POST[ 'genelayar' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'ayar_logo' ][ "size" ] > 0 )
    { 
      $uploads_dir = '../assets/img/genel';
      @$tmp_name = $_FILES[ 'ayar_logo' ][ "tmp_name" ];
      $benzersizsayi4 = rand( 20000, 32000 );
      $uzanti = '.jpg';
      $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

      $ayarkaydet = $db->prepare(
         "UPDATE ayar SET
         ayar_siteurl=:siteurl,
         ayar_mobil=:mobil,
         ayar_firmaadi=:firmaadi,
         ayar_kod=:kod,
         ayar_logo=:logo,
         ayar_harita=:harita

         WHERE ayar_id=0"
     );
      $update     = $ayarkaydet->execute(
         array(
            'siteurl'     => $_POST[ 'ayar_siteurl' ],
            'firmaadi'    => $_POST[ 'ayar_firmaadi' ],
            'mobil'    => "#".$_POST[ 'ayar_mobil' ],
            'kod'     => $_POST[ 'ayar_kod' ],
            'logo' => $refimgyol,
            'harita'         => $_POST[ 'ayar_harita' ]
        )
     );

      if ( $update )
      {
         $resimsilunlink = $_POST[ 'eskiyol_logo' ];
         unlink( "../$resimsilunlink" );

         Header( "Location:../genel-ayarlar.php?status=ok" );
     }
     else
     {

         Header( "Location:../genel-ayarlar.php?status=no" );
     }
 } else {
  $ayarkaydet = $db->prepare(
     "UPDATE ayar SET
     ayar_siteurl=:siteurl,
     ayar_firmaadi=:firmaadi,
     ayar_mobil=:mobil,
     ayar_kod=:kod,
     ayar_harita=:harita

     WHERE ayar_id=0"
 );
  $update     = $ayarkaydet->execute(
     array(
        'siteurl'     => $_POST[ 'ayar_siteurl' ],
        'firmaadi'    => $_POST[ 'ayar_firmaadi' ],
        'mobil'    => "#".$_POST[ 'ayar_mobil' ],
        'kod'     => $_POST[ 'ayar_kod' ],
        'harita'         => $_POST[ 'ayar_harita' ]
    )
 );

  if ( $update )
  {

     Header( "Location:../genel-ayarlar.php?status=ok" );
 }
 else
 {

     Header( "Location:../genel-ayarlar.php?status=no" );
 }
}

if ( $_FILES[ 'ayar_fav' ][ "size" ] > 0 )
{ 
  $uploads_dir = '../assets/img/genel';
  @$tmp_name = $_FILES[ 'ayar_fav' ][ "tmp_name" ];
  $benzersizsayi4 = rand( 20000, 32000 );
  $uzanti = '.jpg';
  $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

  @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

  $ayarkaydet = $db->prepare(
     "UPDATE ayar SET
     ayar_siteurl=:siteurl,
     ayar_firmaadi=:firmaadi,
     ayar_kod=:kod,
     ayar_fav=:fav,
     ayar_harita=:harita

     WHERE ayar_id=0"
 );
  $update     = $ayarkaydet->execute(
     array(
        'siteurl'     => $_POST[ 'ayar_siteurl' ],
        'firmaadi'    => $_POST[ 'ayar_firmaadi' ],
        'kod'     => $_POST[ 'ayar_kod' ],
        'fav' => $refimgyol,
        'harita'         => $_POST[ 'ayar_harita' ]
    )
 );

  if ( $update )
  {
     $resimsilunlink = $_POST[ 'eskiyol_fav' ];
     unlink( "../$resimsilunlink" );

     Header( "Location:../genel-ayarlar.php?status=ok" );
 }
 else
 {

     Header( "Location:../genel-ayarlar.php?status=no" );
 }
} else {
  $ayarkaydet = $db->prepare(
     "UPDATE ayar SET
     ayar_siteurl=:siteurl,
     ayar_firmaadi=:firmaadi,
     ayar_kod=:kod,
     ayar_harita=:harita

     WHERE ayar_id=0"
 );
  $update     = $ayarkaydet->execute(
     array(
        'siteurl'     => $_POST[ 'ayar_siteurl' ],
        'firmaadi'    => $_POST[ 'ayar_firmaadi' ],
        'kod'     => $_POST[ 'ayar_kod' ],
        'harita'         => $_POST[ 'ayar_harita' ]
    )
 );

  if ( $update )
  {

     Header( "Location:../genel-ayarlar.php?status=ok" );
 }
 else
 {

     Header( "Location:../genel-ayarlar.php?status=no" );
 }
}

}
if ( isset( $_POST[ 'arkaplan' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'ayar_resimcounter' ][ "size" ] > 0 || $_FILES[ 'ayar_resimindex' ][ "size" ] > 0|| $_FILES[ 'ayar_resimparalax' ][ "size" ] > 0|| $_FILES[ 'ayar_footer1' ][ "size" ] > 0|| $_FILES[ 'ayar_footer2' ][ "size" ] > 0)
    { 

      if ( $_FILES[ 'ayar_resimindex' ][ "size" ] > 0 )
      { 
         $uploads_dir = '../assets/img/genel';
         @$tmp_name = $_FILES[ 'ayar_resimindex' ][ "tmp_name" ];
         $benzersizsayi4 = rand( 20000, 32000 );
         $uzanti = '.jpg';
         $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

         @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

         $ayarkaydet = $db->prepare(
            "UPDATE ayar SET
            ayar_resimindex=:logo

            WHERE ayar_id=0"
        );
         $update     = $ayarkaydet->execute(
            array(
               'logo' => $refimgyol
           )
        );

         if ( $update )
         {
            $resimsilunlink = $_POST[ 'eskiyol_index' ];
            unlink( "../$resimsilunlink" );

            Header( "Location:../genel-ayarlar.php?status=ok" );
        }
        else
        {

            Header( "Location:../genel-ayarlar.php?status=no" );
        }
    } 

    if ( $_FILES[ 'ayar_footer1' ][ "size" ] > 0 )
    { 
     $uploads_dir = '../assets/img/genel';
     @$tmp_name = $_FILES[ 'ayar_footer1' ][ "tmp_name" ];
     $benzersizsayi4 = rand( 20000, 32000 );
     $uzanti = '.jpg';
     $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

     @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

     $ayarkaydet = $db->prepare(
        "UPDATE ayar SET
        ayar_footer1=:logo

        WHERE ayar_id=0"
    );
     $update     = $ayarkaydet->execute(
        array(
           'logo' => $refimgyol
       )
    );

     if ( $update )
     {
        $resimsilunlink = $_POST[ 'eskiyol_footer1' ];
        unlink( "../$resimsilunlink" );

        Header( "Location:../genel-ayarlar.php?status=ok" );
    }
    else
    {

        Header( "Location:../genel-ayarlar.php?status=no" );
    }
} 
if ( $_FILES[ 'ayar_footer2' ][ "size" ] > 0 )
{ 
 $uploads_dir = '../assets/img/genel';
 @$tmp_name = $_FILES[ 'ayar_footer2' ][ "tmp_name" ];
 $benzersizsayi4 = rand( 20000, 32000 );
 $uzanti = '.jpg';
 $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

 @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

 $ayarkaydet = $db->prepare(
    "UPDATE ayar SET
    ayar_footer2=:logo

    WHERE ayar_id=0"
);
 $update     = $ayarkaydet->execute(
    array(
       'logo' => $refimgyol
   )
);

 if ( $update )
 {
    $resimsilunlink = $_POST[ 'eskiyol_footer2' ];
    unlink( "../$resimsilunlink" );

    Header( "Location:../genel-ayarlar.php?status=ok" );
}
else
{

    Header( "Location:../genel-ayarlar.php?status=no" );
}
} 

if ( $_FILES[ 'ayar_resimparalax' ][ "size" ] > 0 )
{ 
 $uploads_dir = '../assets/img/genel';
 @$tmp_name = $_FILES[ 'ayar_resimparalax' ][ "tmp_name" ];
 $benzersizsayi4 = rand( 20000, 32000 );
 $uzanti = '.jpg';
 $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

 @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

 $ayarkaydet = $db->prepare(
    "UPDATE ayar SET
    ayar_resimparalax=:logo

    WHERE ayar_id=0"
);
 $update     = $ayarkaydet->execute(
    array(
       'logo' => $refimgyol
   )
);

 if ( $update )
 {
    $resimsilunlink = $_POST[ 'eskiyol_paralax' ];
    unlink( "../$resimsilunlink" );

    Header( "Location:../genel-ayarlar.php?status=ok" );
}
else
{

    Header( "Location:../genel-ayarlar.php?status=no" );
}
} 

if ( $_FILES[ 'ayar_resimcounter' ][ "size" ] > 0 )
{ 
 $uploads_dir = '../assets/img/genel';
 @$tmp_name = $_FILES[ 'ayar_resimcounter' ][ "tmp_name" ];
 $benzersizsayi4 = rand( 20000, 32000 );
 $uzanti = '.jpg';
 $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

 @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

 $ayarkaydet = $db->prepare(
    "UPDATE ayar SET
    ayar_resimcounter=:fav

    WHERE ayar_id=0"
);
 $update     = $ayarkaydet->execute(
    array(
       'fav' => $refimgyol
   )
);

 if ( $update )
 {
    $resimsilunlink = $_POST[ 'eskiyol_counter' ];
    unlink( "../$resimsilunlink" );

    Header( "Location:../genel-ayarlar.php?status=ok" );
}
else
{

    Header( "Location:../genel-ayarlar.php?status=no" );
}
} 
}else {
  Header( "Location:../genel-ayarlar.php?status=eksik" );
}

}
if ( isset( $_POST[ 'seoayar' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE ayar SET
      ayar_title=:title,
      ayar_description=:description,
      ayar_keywords=:keywords
      WHERE ayar_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
         'title'       => $_POST[ 'ayar_title' ],
         'description' => $_POST[ 'ayar_description' ],
         'keywords' => $_POST[ 'ayar_keywords' ]
     )
  );

    if ( $update )
    {

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayarlar.php?status=no" );
  }
}
if ( isset( $_POST[ 'renkayar' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE ayar SET
      ayar_mobil=:mobil,
      ayar_renk=:renk
      WHERE ayar_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'mobil'       => $_POST[ 'ayar_mobil' ],
       'renk'       => $_POST[ 'ayar_renk' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayarlar.php?status=no" );
  }
}
if ( isset( $_POST[ 'iletisimayar' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE ayar SET
      ayar_adres=:adres,
      ayar_ilce=:ilce,
      ayar_ara=:ara,
      ayar_il=:il,
      ayar_tel=:tel,
      ayar_fax=:fax,
      ayar_mail=:mail
      WHERE ayar_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'adres'       => $_POST[ 'ayar_adres' ],
       'ilce'        => $_POST[ 'ayar_ilce' ],
       'ara'        => $_POST[ 'ayar_ara' ],
       'il'          => $_POST[ 'ayar_il' ],
       'tel'         => $_POST[ 'ayar_tel' ],
       'fax'         => $_POST[ 'ayar_fax' ],
       'mail'        => $_POST[ 'ayar_mail' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayarlar.php?status=no" );
  }
}
if ( isset( $_POST[ 'sms' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE sms SET
      sms_kullanici=:kullanici,
      sms_sifre=:sifre,
      sms_baslik=:baslik,
      sms_durum=:durum
      WHERE sms_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'kullanici' => $_POST[ 'sms_kullanici' ],
       'sifre' => $_POST[ 'sms_sifre' ],
       'baslik' => $_POST[ 'sms_baslik' ],
       'durum' => $_POST[ 'sms_durum' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayarlar.php?status=no" );
  }
}
if ( isset( $_POST[ 'motorduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE motor SET
      motor_analitik=:analitik,
      motor_metrika=:metrika,
      motor_gonay=:gonay,
      motor_yonay=:yonay
      WHERE motor_id={$_POST['motor_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'analitik' => $_POST[ 'motor_analitik' ],
       'metrika' => $_POST[ 'motor_metrika' ],
       'gonay' => $_POST[ 'motor_gonay' ],
       'yonay' => $_POST[ 'motor_yonay' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../google-yandex-ayarlari.php?status=ok" );
  }
  else
  {

      Header( "Location:../google-yandex-ayarlari.php?status=no" );
  }
}
if ( isset( $_POST[ 'logoduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../assets/img/genel';
    @$tmp_name = $_FILES[ 'ayar_logo' ][ "tmp_name" ];
    @$name = $_FILES[ 'ayar_logo' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol      = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );

    $ayarkaydet = $db->prepare(
      "UPDATE ayar SET
      ayar_logo=:logo
      WHERE ayar_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'logo' => $refimgyol
   )
  );

    if ( $update )
    {
      $resimsilunlink = $_POST[ 'eski_yol' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayaralar.php?status=no" );
  }
}

if ( isset( $_POST[ 'favduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../../img';
    @$tmp_name = $_FILES[ 'ayar_fav' ][ "tmp_name" ];
    @$name = $_FILES[ 'ayar_fav' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol2     = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );

    $ayarkaydet = $db->prepare(
      "UPDATE ayar SET
      ayar_fav=:fav
      WHERE ayar_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'fav' => $refimgyol2,
   )
  );

    if ( $update )
    {

      $resimsilunlink = $_POST[ 'eski_yol2' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../production/genel-ayarlar.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/genel-ayarlar.php?durum=no" );
  }
}

if ( isset( $_POST[ 'sosyalduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "UPDATE sosyal SET
      sosyal_link=:link,
      sosyal_icon=:icon
      WHERE sosyal_id={$_POST['sosyal_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'link' => $_POST[ 'sosyal_link' ],
       'icon' => $_POST[ 'sosyal_icon' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../sosyal-medya.php?status=ok" );
  }
  else
  {

      Header( "Location:../sosyal-medya.php?status=no" );
  }
}

if ( isset( $_POST[ 'sosyalekle' ] ) )
{



    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "INSERT INTO sosyal SET
      sosyal_link=:link,
      sosyal_icon=:icon
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'link' => $_POST[ 'sosyal_link' ],
       'icon' => $_POST[ 'sosyal_icon' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../sosyal-medya.php?status=ok" );
  }
  else
  {

      Header( "Location:../sosyal-medya.php?status=no" );
  }
}

if ( isset( $_POST[ 'mailayarlari' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE mail SET
      mail_user=:user,
      mail_host=:host,
      mail_pass=:pass,
      mail_bildirim=:bildirim,
      mail_name=:name,
      mail_sender=:sender,
      mail_secure=:secure,
      mail_port=:port
      WHERE mail_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'user' => $_POST[ 'mail_user' ],
       'host' => $_POST[ 'mail_host' ],
       'pass' => $_POST[ 'mail_pass' ],
       'bildirim' => $_POST[ 'mail_bildirim' ],
       'name' => $_POST[ 'mail_name' ],
       'sender' => $_POST[ 'mail_sender' ],
       'secure' => $_POST[ 'mail_secure' ],
       'port' => $_POST[ 'mail_port' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../genel-ayarlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../genel-ayarlar.php?status=no" );
  }
}

if ( isset( $_POST[ 'profilresimduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../assets/img/genel';
    @$tmp_name = $_FILES[ 'kullanici_resim' ][ "tmp_name" ];
    $uzanti='.jpg';
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

    $ayarkaydet = $db->prepare(
      "UPDATE kullanici SET
      kullanici_resim=:resim
      WHERE kullanici_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'resim' => $refimgyol
   )
  );

    if ( $update )
    {


      Header( "Location:../user.php?status=ok" );
  }
  else
  {

      Header( "Location:../user.php?status=no" );
  }
}

if ( isset( $_POST[ 'kullaniciduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $kullanici_pass = md5( $_POST[ 'kullanici_pass' ] );

    $ayarkaydet = $db->prepare(
      "UPDATE kullanici SET
      kullanici_adsoyad=:adsoyad,
      kullanici_adi=:adi
      WHERE kullanici_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'adsoyad' => $_POST[ 'kullanici_adsoyad' ],
       'adi'     => $_POST[ 'kullanici_adi' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../user.php?status=ok" );
  }
  else
  {

      Header( "Location:../user.php?status=no" );
  }
}

if ( isset( $_POST[ 'kullanicisifre' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $kullanici_pass = md5( $_POST[ 'kullanici_pass' ] );

    $ayarkaydet = $db->prepare(
      "UPDATE kullanici SET
      kullanici_pass=:pass
      WHERE kullanici_id=0"
  );
    $update     = $ayarkaydet->execute(
      array(
       'pass' => $kullanici_pass
   )
  );

    if ( $update )
    {

      Header( "Location:../user.php?status=ok" );
  }
  else
  {

      Header( "Location:../user.php?status=no" );
  }
}


if ( isset( $_POST[ 'sssduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sss_id = $_POST[ 'sss_id' ];

    $ayarkaydet = $db->prepare(
      "UPDATE sss SET
      sss_soru=:soru,
      sss_sira=:sira,
      sss_cevap=:cevap
      WHERE sss_id={$_POST['sss_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'soru'  => $_POST[ 'sss_soru' ],
       'sira'  => $_POST[ 'sss_sira' ],
       'cevap' => $_POST[ 'sss_cevap' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../sss.php?status=ok" );
  }
  else
  {

      Header( "Location:../sss.php?status=ok" );
  }
}
if ( isset( $_POST[ 'kategoriekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "INSERT INTO kategoriler SET
      kategori_ad=:ad,
      kategori_adres=:adres,
      kategori_sira=:sira
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'ad'     => $_POST[ 'kategori_ad' ],
       'adres'     => $_POST[ 'kategori_adres' ],
       'sira'    => $_POST[ 'kategori_sira' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../form-subeler.php?status=ok" );
  }
  else
  {

      Header( "Location:../form-subeler.php?status=no" );
  }
}

if ( isset( $_POST[ 'sssekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "INSERT INTO sss SET
      sss_soru=:soru,
      sss_cevap=:cevap,
      sss_sira=:sira
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'soru'  => $_POST[ 'sss_soru' ],
       'cevap' => $_POST[ 'sss_cevap' ],
       'sira'  => $_POST[ 'sss_sira' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../sss.php?&status=ok" );
  }
  else
  {

      Header( "Location:../sss.php?status=no" );
  }
}
if ( isset( $_POST[ 'omenuekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ust=$_POST[ 'omenu_ust' ];
    if ($ust==0) {
      $ayarkaydet = $db->prepare(
       "INSERT INTO omenu SET
       omenu_ad=:ad,
       omenu_link=:link,
       omenu_ust=:ust,
       omenu_durum=:durum,
       omenu_sira=:sira
       "
   );
      $update     = $ayarkaydet->execute(
       array(
        'ad'  => $_POST[ 'omenu_ad' ],
        'link' => $_POST[ 'omenu_link' ],
        'ust' => $_POST[ 'omenu_ust' ],
        'durum' => '0',
        'sira'  => $_POST[ 'omenu_sira' ]
    )
   );
  } else {
      $ayarkaydet = $db->prepare(
       "INSERT INTO omenu SET
       omenu_ad=:ad,
       omenu_link=:link,
       omenu_ust=:ust,
       omenu_durum=:durum,
       omenu_sira=:sira
       "
   );
      $update     = $ayarkaydet->execute(
       array(
        'ad'  => $_POST[ 'omenu_ad' ],
        'link' => $_POST[ 'omenu_link' ],
        'ust' => $_POST[ 'omenu_ust' ],
        'durum' => $_POST[ 'omenu_ust' ],
        'sira'  => $_POST[ 'omenu_sira' ]
    )
   );
  }
  if ( $update )
  {
      $ayarkaydet = $db->prepare(
       "UPDATE omenu SET
       omenu_durum=:durum
       WHERE omenu_id={$_POST[ 'omenu_ust' ]}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'durum' => $_POST[ 'omenu_ust' ]
    )
   );

      Header( "Location:../menu.php?&status=ok" );
  }
  else
  {

      Header( "Location:../menu.php?status=no" );
  }
}
if ( isset( $_POST[ 'flinkekle' ] ) )
{



    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $ayarkaydet = $db->prepare(
      "INSERT INTO flink SET
      flink_ad=:ad,
      flink_sira=:sira,
      flink_link=:link
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'ad'  => $_POST[ 'flink_ad' ],
       'sira'  => $_POST[ 'flink_sira' ],
       'link' => $_POST[ 'flink_link' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../yan-menu.php?status=ok" );
  }
  else
  {

      Header( "Location:../yan-menu.php?status=no" );
  }
}
if ( isset( $_POST[ 'fmenuekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "INSERT INTO fmenu SET
      fmenu_ad=:ad,
      fmenu_link=:link,
      fmenu_sira=:sira
      "
  );
    $update     = $ayarkaydet->execute(
      array(
       'ad'  => $_POST[ 'fmenu_ad' ],
       'link' => $_POST[ 'fmenu_link' ],
       'sira'  => $_POST[ 'fmenu_sira' ]
   )
  );

    if ( $update )
    {

      Header( "Location:../alt-menu.php?&status=ok" );
  }
  else
  {

      Header( "Location:../alt-menu.php?status=no" );
  }
}

if ( isset( $_POST[ 'slaytresimduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../../img/slayt';
    @$tmp_name = $_FILES[ 'slayt_resim' ][ "tmp_name" ];
    @$name = $_FILES[ 'slayt_resim' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol2     = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );

    $slayt_id = $_POST[ 'slayt_id' ];

    $ayarkaydet = $db->prepare(
      "UPDATE slayt SET
      slayt_resim=:resim
      WHERE slayt_id={$_POST['slayt_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'resim' => $refimgyol2,
   )
  );

    if ( $update )
    {

      $resimsilunlink = $_POST[ 'eski_yol' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../production/slayt.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/slayt.php?durum=no" );
  }
}


if ( isset( $_POST[ 'hizmetresimduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../../img/hizmetler';
    @$tmp_name = $_FILES[ 'hizmet_resim' ][ "tmp_name" ];
    @$name = $_FILES[ 'hizmet_resim' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol2     = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );

    $slayt_id = $_POST[ 'hizmet_id' ];

    $ayarkaydet = $db->prepare(
      "UPDATE hizmetler SET
      hizmet_resim=:resim
      WHERE hizmet_id={$_POST['hizmet_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'resim' => $refimgyol2,
   )
  );

    if ( $update )
    {

      $resimsilunlink = $_POST[ 'eski_yol' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../production/hizmetler.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/hizmetler.php?durum=no" );
  }
}
if ( isset( $_POST[ 'yorumresimduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $uploads_dir = '../../img/yorum';
    @$tmp_name = $_FILES[ 'yorum_resim' ][ "tmp_name" ];
    @$name = $_FILES[ 'yorum_resim' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol2     = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );

    $slayt_id = $_POST[ 'yorum_id' ];

    $ayarkaydet = $db->prepare(
      "UPDATE yorumlar SET
      yorum_resim=:resim
      WHERE yorum_id={$_POST['yorum_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'resim' => $refimgyol2,
   )
  );

    if ( $update )
    {

      $resimsilunlink = $_POST[ 'eski_yol' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../production/yorumlar.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/yorumlar.php?durum=no" );
  }
}
if ( isset( $_POST[ 'urunresimekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../assets/img/urunler';
    $tmp_name = $_FILES[ 'resim_link' ][ "tmp_name" ];
    $benzersizsayi1 = rand( 20000, 32000 );
    $benzersizsayi2 = rand( 20000, 32000 );
    $uzanti = '.jpg';
    $benzersizad    = $benzersizsayi1 . $benzersizsayi2 ;
    $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
    move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

    $kaydet = $db->prepare(
      "INSERT INTO resim SET
      resim_urun=:urun,
      resim_link=:link
      ");
    $insert = $kaydet->execute(
      array(
       'urun'     => $_POST[ 'resim_urun' ],
       'link'    => $refimgyol
   ));

    if ( $insert )
    {

      Header( "Location:../urunler.php?status=ok" );
  }
  else
  {

      Header( "Location:../urunler.php?status=no" );
  }
}
if ( isset( $_POST[ 'projeresimduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $uploads_dir = '../../img/projeler';
    @$tmp_name = $_FILES[ 'proje_resim' ][ "tmp_name" ];
    @$name = $_FILES[ 'proje_resim' ][ "name" ];
    $benzersizsayi4 = rand( 20000, 32000 );
    $refimgyol2     = substr( $uploads_dir, 6 ) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$name" );



    $ayarkaydet = $db->prepare(
      "UPDATE projeler SET
      proje_resim=:resim
      WHERE proje_id={$_POST['proje_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'resim' => $refimgyol2,
   )
  );

    if ( $update )
    {

      $resimsilunlink = $_POST[ 'eski_yol' ];
      unlink( "../../$resimsilunlink" );

      Header( "Location:../production/projeler.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/projeler.php?durum=no" );
  }
}
if ( isset( $_POST[ 'slaytduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'slayt_resim' ][ "size" ] > 0 )
    {

      $uploads_dir = '../assets/img/slayt';
      @$tmp_name = $_FILES[ 'slayt_resim' ][ "tmp_name" ];
      $benzersizsayi4 = rand( 20000, 32000 );
      $uzanti = '.jpg';
      $refimgyol2     = substr( $uploads_dir, 3 ) . "/" . $benzersizsayi4 . $uzanti;

      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizsayi4$uzanti" );

      $ayarkaydet = $db->prepare(
       "UPDATE slayt SET
       slayt_sira=:sira,
       slayt_baslik=:baslik,
       slayt_butonlink=:butonlink,
       slayt_renk=:renk,
       slayt_butonad=:butonad,
       slayt_aciklama=:aciklama,
       slayt_resim=:resim
       WHERE slayt_id={$_POST['slayt_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'sira'     => $_POST[ 'slayt_sira' ],
        'baslik'     => $_POST[ 'slayt_baslik' ],
        'butonlink'     => $_POST[ 'slayt_butonlink' ],
        'renk'     => $_POST[ 'slayt_renk' ],
        'butonad'     => $_POST[ 'slayt_butonad' ],
        'aciklama' => $_POST[ 'slayt_aciklama' ],
        'resim' => $refimgyol2
    )
   );

      if ( $update )
      {
       $resimsilunlink = $_POST[ 'eski_yol' ];
       unlink( "../$resimsilunlink" );

       Header( "Location:../slayt.php?status=ok" );
   }
   else
   {

       Header( "Location:../slayt.php?status=no" );
   }
} else {
  $ayarkaydet = $db->prepare(
   "UPDATE slayt SET
   slayt_sira=:sira,
   slayt_baslik=:baslik,
   slayt_butonlink=:butonlink,
   slayt_renk=:renk,
   slayt_butonad=:butonad,
   slayt_aciklama=:aciklama
   WHERE slayt_id={$_POST['slayt_id']}"
);
  $update     = $ayarkaydet->execute(
   array(
    'sira'     => $_POST[ 'slayt_sira' ],
    'baslik'     => $_POST[ 'slayt_baslik' ],
    'butonlink'     => $_POST[ 'slayt_butonlink' ],
    'renk'     => $_POST[ 'slayt_renk' ],
    'butonad'     => $_POST[ 'slayt_butonad' ],
    'aciklama' => $_POST[ 'slayt_aciklama' ]
)
);

  if ( $update )
  {


   Header( "Location:../slayt.php?status=ok" );
}
else
{

   Header( "Location:../slayt.php?status=no" );
}
}
}


if ( isset( $_POST[ 'hizmetduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'hizmet_resim' ][ "size" ] > 0 )
    {
      $uploads_dir = '../assets/img/hizmetler';
      @$tmp_name = $_FILES[ 'hizmet_resim' ][ "tmp_name" ];
      @$name = $_FILES[ 'hizmet_resim' ][ "name" ];
      $benzersizsayi1 = rand( 20000, 32000 );
      $benzersizsayi2 = rand( 20000, 32000 );
      $uzanti='.jpg';
      $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
      $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

      $ayarkaydet = $db->prepare(
       "UPDATE hizmetler SET
       hizmet_baslik=:baslik,
       hizmet_icerik=:icerik,
       hizmet_title=:title,
       hizmet_descr=:descr,
       hizmet_keyword=:keyword,
       hizmet_vitrin=:vitrin,
       hizmet_resim=:resim,
       hizmet_icon=:icon
       WHERE hizmet_id={$_POST['hizmet_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'baslik'     => $_POST[ 'hizmet_baslik' ],
        'icerik'     => $_POST[ 'hizmet_icerik' ],
        'title'     => $_POST[ 'hizmet_title' ],
        'descr'     => $_POST[ 'hizmet_descr' ],
        'keyword'     => $_POST[ 'hizmet_keyword' ],
        'vitrin'     => $_POST[ 'hizmet_vitrin' ],
        'resim'     => $refimgyol,
        'icon' => $_POST[ 'hizmet_icon' ]
    )
   );

      if ( $update )
      {
       $resimsilunlink = $_POST[ 'eski_yol' ];
       unlink( "../$resimsilunlink" );

       Header( "Location:../hizmetler.php?status=ok" );
   }
   else
   {

       Header( "Location:../hizmetler.php?status=no" );
   }
} else {

  $ayarkaydet = $db->prepare(
   "UPDATE hizmetler SET
   hizmet_baslik=:baslik,
   hizmet_icerik=:icerik,
   hizmet_title=:title,
   hizmet_descr=:descr,
   hizmet_keyword=:keyword,
   hizmet_vitrin=:vitrin,
   hizmet_icon=:icon
   WHERE hizmet_id={$_POST['hizmet_id']}"
);
  $update     = $ayarkaydet->execute(
   array(
    'baslik'     => $_POST[ 'hizmet_baslik' ],
    'icerik'     => $_POST[ 'hizmet_icerik' ],
    'title'     => $_POST[ 'hizmet_title' ],
    'descr'     => $_POST[ 'hizmet_descr' ],
    'keyword'     => $_POST[ 'hizmet_keyword' ],
    'vitrin'     => $_POST[ 'hizmet_vitrin' ],
    'icon' => $_POST[ 'hizmet_icon' ]
)
);

  if ( $update )
  {


   Header( "Location:../hizmetler.php?status=ok" );
}
else
{

   Header( "Location:../hizmetler.php?status=no" );
}
}
}



if ( isset( $_POST[ 'ozellikduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE ozellik SET
      ozellik_baslik=:baslik,
      ozellik_fiyat=:fiyat,
      ozellik_arac=:arac
      WHERE ozellik_id={$_POST['ozellik_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
         'baslik'     => $_POST[ 'ozellik_baslik' ],
         'fiyat'     => $_POST[ 'ozellik_fiyat' ],
         'arac'     => $_POST[ 'ozellik_arac' ]
     )
  );

    if ( $update )
    {


      Header( "Location:../ozellikler.php?status=ok" );
  }
  else
  {

      Header( "Location:../ozellikler.php?status=no" );
  }
  
}
if ( isset( $_POST[ 'markaduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'hizmet_resim' ][ "size" ] > 0 )
    {
      $uploads_dir = '../assets/img/hizmetler';
      @$tmp_name = $_FILES[ 'hizmet_resim' ][ "tmp_name" ];
      @$name = $_FILES[ 'hizmet_resim' ][ "name" ];
      $benzersizsayi1 = rand( 20000, 32000 );
      $benzersizsayi2 = rand( 20000, 32000 );
      $uzanti='.jpg';
      $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
      $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

      $ayarkaydet = $db->prepare(
       "UPDATE markalar SET
       hizmet_baslik=:baslik,
       hizmet_icerik=:icerik,
       hizmet_title=:title,
       hizmet_descr=:descr,
       hizmet_keyword=:keyword,
       hizmet_resim=:resim,
       hizmet_icon=:icon
       WHERE hizmet_id={$_POST['hizmet_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'baslik'     => $_POST[ 'hizmet_baslik' ],
        'icerik'     => $_POST[ 'hizmet_icerik' ],
        'title'     => $_POST[ 'hizmet_title' ],
        'descr'     => $_POST[ 'hizmet_descr' ],
        'keyword'     => $_POST[ 'hizmet_keyword' ],
        'resim'     => $refimgyol,
        'icon' => $_POST[ 'hizmet_icon' ]
    )
   );

      if ( $update )
      {
       $resimsilunlink = $_POST[ 'eski_yol' ];
       unlink( "../$resimsilunlink" );

       Header( "Location:../markalar.php?status=ok" );
   }
   else
   {

       Header( "Location:../markalar.php?status=no" );
   }
} else {

  $ayarkaydet = $db->prepare(
   "UPDATE markalar SET
   hizmet_baslik=:baslik,
   hizmet_icerik=:icerik,
   hizmet_title=:title,
   hizmet_descr=:descr,
   hizmet_keyword=:keyword,
   hizmet_vitrin=:vitrin,
   hizmet_icon=:icon
   WHERE hizmet_id={$_POST['hizmet_id']}"
);
  $update     = $ayarkaydet->execute(
   array(
    'baslik'     => $_POST[ 'hizmet_baslik' ],
    'icerik'     => $_POST[ 'hizmet_icerik' ],
    'title'     => $_POST[ 'hizmet_title' ],
    'descr'     => $_POST[ 'hizmet_descr' ],
    'keyword'     => $_POST[ 'hizmet_keyword' ],
    'vitrin'     => $_POST[ 'hizmet_vitrin' ],
    'icon' => $_POST[ 'hizmet_icon' ]
)
);

  if ( $update )
  {


   Header( "Location:../markalar.php?status=ok" );
}
else
{

   Header( "Location:../markalar.php?status=no" );
}
}
}

if ( isset( $_POST[ 'yorumduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE yorumlar SET
      yorum_isim=:isim,
      yorum_icerik=:icerik,
      yorum_link=:link
      WHERE yorum_id={$_POST['yorum_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'isim'     => $_POST[ 'yorum_isim' ],
       'icerik'     => $_POST[ 'yorum_icerik' ],
       'link' => $_POST[ 'yorum_link' ]
   )
  );

    if ( $update )
    {


      Header( "Location:../production/yorumlar.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/yorumlar.php?durum=no" );
  }
}
if ( isset( $_POST[ 'urunduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }


    if ( $_FILES[ 'urun_resim' ][ "size" ] > 0 )
    {
      $uploads_dir = '../assets/img/urunler';
      @$tmp_name = $_FILES[ 'urun_resim' ][ "tmp_name" ];
      @$name = $_FILES[ 'urun_resim' ][ "name" ];
      $benzersizsayi1 = rand( 20000, 32000 );
      $benzersizsayi2 = rand( 20000, 32000 );
      $uzanti='.jpg';
      $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
      $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

      $ayarkaydet = $db->prepare(
       "UPDATE urunler SET
       urun_baslik=:baslik,
       urun_fiyat=:fiyat,
       urun_47=:urun47,
       urun_815=:urun815,
       urun_1621=:urun1621,
       urun_2228=:urun2228,
       urun_2999=:urun2999,
       urun_vitrin=:vitrin,
       urun_kapi=:kapi,
       urun_koltuk=:koltuk,
       urun_bagaj=:bagaj,
       urun_klima=:klima,
       urun_yakit=:yakit,
       urun_resim=:resim,
       urun_yakitprosedur=:yakitprosedur,
       urun_kiralamasuresi=:kiralamasuresi,
       urun_ehliyetyassiniri=:ehliyetyassiniri,
       urun_vites=:vites
       WHERE urun_id={$_POST['urun_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'baslik'     => $_POST[ 'urun_baslik' ],
        'fiyat'     => $_POST[ 'urun_fiyat' ],
        'urun47'     => $_POST[ 'urun_47' ],
        'urun815'     => $_POST[ 'urun_815' ],
        'urun1621'     => $_POST[ 'urun_1621' ],
        'urun2228'     => $_POST[ 'urun_2228' ],
        'urun2999'     => $_POST[ 'urun_2999' ],
        'vitrin'     => $_POST[ 'urun_vitrin' ],
        'kapi'     => $_POST[ 'urun_kapi' ],
        'koltuk'     => $_POST[ 'urun_koltuk' ],
        'bagaj'     => $_POST[ 'urun_bagaj' ],
        'klima'     => $_POST[ 'urun_klima' ],
        'yakit'     => $_POST[ 'urun_yakit' ],
        'yakitprosedur'     => $_POST[ 'urun_yakitprosedur' ],
        'kiralamasuresi'     => $_POST[ 'urun_kiralamasuresi' ],
        'ehliyetyassiniri'     => $_POST[ 'urun_ehliyetyassiniri' ],
        'resim'     => $refimgyol,
        'vites'     => $_POST[ 'urun_vites' ]
    )
   );
  } else {
      $ayarkaydet = $db->prepare(
       "UPDATE urunler SET
       urun_baslik=:baslik,
       urun_fiyat=:fiyat,
       urun_47=:urun47,
       urun_815=:urun815,
       urun_1621=:urun1621,
       urun_2228=:urun2228,
       urun_2999=:urun2999,
       urun_vitrin=:vitrin,
       urun_kapi=:kapi,
       urun_koltuk=:koltuk,
       urun_bagaj=:bagaj,
       urun_klima=:klima,
       urun_yakit=:yakit,
       urun_yakitprosedur=:yakitprosedur,
       urun_kiralamasuresi=:kiralamasuresi,
       urun_ehliyetyassiniri=:ehliyetyassiniri,
       urun_vites=:vites
       WHERE urun_id={$_POST['urun_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'baslik'     => $_POST[ 'urun_baslik' ],
        'fiyat'     => $_POST[ 'urun_fiyat' ],
        'urun47'     => $_POST[ 'urun_47' ],
        'urun815'     => $_POST[ 'urun_815' ],
        'urun1621'     => $_POST[ 'urun_1621' ],
        'urun2228'     => $_POST[ 'urun_2228' ],
        'urun2999'     => $_POST[ 'urun_2999' ],
        'vitrin'     => $_POST[ 'urun_vitrin' ],
        'kapi'     => $_POST[ 'urun_kapi' ],
        'koltuk'     => $_POST[ 'urun_koltuk' ],
        'bagaj'     => $_POST[ 'urun_bagaj' ],
        'klima'     => $_POST[ 'urun_klima' ],
        'yakit'     => $_POST[ 'urun_yakit' ],
        'yakitprosedur'     => $_POST[ 'urun_yakitprosedur' ],
        'kiralamasuresi'     => $_POST[ 'urun_kiralamasuresi' ],
        'ehliyetyassiniri'     => $_POST[ 'urun_ehliyetyassiniri' ],
        'vites'     => $_POST[ 'urun_vites' ]
    )
   );

      
  }
  if ( $update )
  {


      Header( "Location:../araclar.php?status=ok" );
  }
  else
  {

      Header( "Location:../araclar.php?status=no" );
  }
}

if ( isset( $_POST[ 'projeduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    if ( $_FILES[ 'proje_resim' ][ "size" ] > 0 )
    {
      $uploads_dir = '../assets/img/projeler';
      @$tmp_name = $_FILES[ 'proje_resim' ][ "tmp_name" ];
      @$name = $_FILES[ 'proje_resim' ][ "name" ];
      $benzersizsayi1 = rand( 20000, 32000 );
      $benzersizsayi2 = rand( 20000, 32000 );
      $uzanti='.jpg';
      $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
      $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
      @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );


      $ayarkaydet = $db->prepare(
       "UPDATE projeler SET
       proje_baslik=:baslik,
       proje_icerik=:icerik,
       proje_resim=:resim,
       proje_title=:title,
       proje_descr=:descr,
       proje_keyword=:keyword
       WHERE proje_id={$_POST['proje_id']}"
   );
      $update     = $ayarkaydet->execute(
       array(
        'baslik'     => $_POST[ 'proje_baslik' ],
        'icerik'     => $_POST[ 'proje_icerik' ],
        'resim'     => $refimgyol,
        'title'     => $_POST[ 'proje_title' ],
        'descr'     => $_POST[ 'proje_descr' ],
        'keyword'     => $_POST[ 'proje_keyword' ]
    )
   );

      if ( $update )
      {
       $resimsilunlink = $_POST[ 'eski_yol' ];
       unlink( "../$resimsilunlink" );

       Header( "Location:../projeler.php?status=ok" );
   }
   else
   {

       Header( "Location:../projeler.php?status=no" );
   }
}
else {
  $ayarkaydet = $db->prepare(
   "UPDATE projeler SET
   proje_baslik=:baslik,
   proje_icerik=:icerik,
   proje_vitrin=:vitrin,
   proje_title=:title,
   proje_descr=:descr,
   proje_keyword=:keyword
   WHERE proje_id={$_POST['proje_id']}"
);
  $update     = $ayarkaydet->execute(
   array(
    'baslik'     => $_POST[ 'proje_baslik' ],
    'icerik'     => $_POST[ 'proje_icerik' ],
    'vitrin'     => $_POST[ 'proje_vitrin' ],
    'title'     => $_POST[ 'proje_title' ],
    'descr'     => $_POST[ 'proje_descr' ],
    'keyword'     => $_POST[ 'proje_keyword' ]
)
);

  if ( $update )
  {


   Header( "Location:../projeler.php?status=ok" );
}
else
{

   Header( "Location:../projeler.php?status=no" );
}
}
}

if ( isset( $_POST[ 'hosduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $ayarkaydet = $db->prepare(
      "UPDATE hosgeldiniz SET
      hosgeldiniz_baslik=:baslik,
      hosgeldiniz_aciklama=:icerik
      WHERE hos_id={$_POST['hosgeldiniz_id']}"
  );
    $update     = $ayarkaydet->execute(
      array(
       'baslik'     => $_POST[ 'hosgeldiniz_baslik' ],
       'icerik'     => $_POST[ 'hosgeldiniz_aciklama' ]
   )
  );

    if ( $update )
    {


      Header( "Location:../production/hosgeldiniz.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/hosgeldiniz.php?durum=no" );
  }
}
if ( $_GET[ 'aracsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from urunler where urun_id=:urun_id" );
    $kontrol = $sil->execute(
      array(
         'urun_id' => $_GET[ 'arac_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['urun_resim'];
      unlink("../$resimsilunlink");

      Header( "Location:../araclar.php?status=ok" );
  }
  else
  {

      Header( "Location:../araclar.php?status=no" );
  }
}
if ( $_GET[ 'urunresimdetaysil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from resim where resim_id=:resim_id" );
    $kontrol = $sil->execute(
      array(
         'resim_id' => $_GET[ 'resim_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['resim_link'];
      unlink("../$resimsilunlink");

      Header( "Location:../urunler.php?status=ok" );
  }
  else
  {

      Header( "Location:../urunler.php?status=no" );
  }
}
if ( $_GET[ 'referanssil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from referanslar where referans_id=:referans_id" );
    $kontrol = $sil->execute(
      array(
         'referans_id' => $_GET[ 'referans_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['referans_resim1'];
      unlink("../$resimsilunlink");

      Header( "Location:../referanslar.php?status=ok" );
  }
  else
  {

      Header( "Location:../referanslar.php?status=no" );
  }
}
if ( $_GET[ 'slaytsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from slayt where slayt_id=:slayt_id" );
    $kontrol = $sil->execute(
      array(
         'slayt_id' => $_GET[ 'slayt_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['slayt_resim'];
      unlink("../$resimsilunlink");

      Header( "Location:../slayt.php?status=ok" );
  }
  else
  {

      Header( "Location:../slayt.php?status=no" );
  }
}
if ( $_GET[ 'videosil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from videogaleri where video_id=:video_id" );
    $kontrol = $sil->execute(
      array(
         'video_id' => $_GET[ 'video_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['video_resim'];
      unlink("../$resimsilunlink");

      Header( "Location:../video-galerisi.php?status=ok" );
  }
  else
  {

      Header( "Location:../video-galerisi.php?status=no" );
  }
}
if ( $_GET[ 'resimsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from resimgaleri where resim_id=:resim_id" );
    $kontrol = $sil->execute(
      array(
         'resim_id' => $_GET[ 'resim_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['eski_yol'];
      unlink("../$resimsilunlink");

      Header( "Location:../resim-galerisi.php?status=ok" );
  }
  else
  {

      Header( "Location:../resim-galerisi.php?status=no" );
  }
}
if ( $_GET[ 'yorumsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from yorumlar where yorum_id=:yorum_id" );
    $kontrol = $sil->execute(
      array(
         'yorum_id' => $_GET[ 'yorum_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['yorum_resim'];
      unlink("../$resimsilunlink");

      Header( "Location:../yorumlar.php?status=ok" );
  }
  else
  {

      Header( "Location:../yorumlar.php?status=no" );
  }
}
if ( $_GET[ 'markasil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from markalar where hizmet_id=:hizmet_id" );
    $kontrol = $sil->execute(
      array(
         'hizmet_id' => $_GET[ 'hizmet_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../markalar.php?status=ok" );
  }
  else
  {

      Header( "Location:../markalar.php?status=no" );
  }
}
if ( $_GET[ 'hizmetsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from hizmetler where hizmet_id=:hizmet_id" );
    $kontrol = $sil->execute(
      array(
         'hizmet_id' => $_GET[ 'hizmet_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../hizmetler.php?status=ok" );
  }
  else
  {

      Header( "Location:../hizmetler.php?status=no" );
  }
}
if ( $_GET[ 'projesil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from projeler where proje_id=:proje_id" );
    $kontrol = $sil->execute(
      array(
         'proje_id' => $_GET[ 'proje_id' ]
     )
  );

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['proje_resim'];
      unlink("../../$resimsilunlink");

      Header( "Location:../projeler.php?status=ok" );
  }
  else
  {

      Header( "Location:../projeler.php?status=no" );
  }
}
if ( $_GET[ 'sosyalsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from sosyal where sosyal_id=:sosyal_id" );
    $kontrol = $sil->execute(
      array(
         'sosyal_id' => $_GET[ 'sosyal_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../sosyal-medya.php?status=ok" );
  }
  else
  {

      Header( "Location:../sosyal-medya.php?status=no" );
  }
}
if ( $_GET[ 'mesajsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from mesajlar where mesaj_id=:mesaj_id" );
    $kontrol = $sil->execute(
      array(
         'mesaj_id' => $_GET[ 'mesaj_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../index.php?status=ok" );
  }
  else
  {

      Header( "Location:../index.php?status=no" );
  }
}
if ( $_GET[ 'subesil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from sube where sube_id=:sube_id" );
    $kontrol = $sil->execute(
      array(
         'sube_id' => $_GET[ 'sube_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../subeler.php?status=ok" );
  }
  else
  {

      Header( "Location:../subeler.php?status=no" );
  }
}
if ( $_GET[ 'formsubesil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from kategoriler where kategori_id=:kategori_id" );
    $kontrol = $sil->execute(
      array(
         'kategori_id' => $_GET[ 'sube_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../subeler.php?status=ok" );
  }
  else
  {

      Header( "Location:../subeler.php?status=no" );
  }
}
if ( $_GET[ 'flinksil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from flink where flink_id=:flink_id" );
    $kontrol = $sil->execute(
      array(
         'flink_id' => $_GET[ 'flink_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../yan-menu.php?status=ok" );
  }
  else
  {

      Header( "Location:../yan-menu.php?status=no" );
  }
}
if ( $_GET[ 'fmenusil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from fmenu where fmenu_id=:fmenu_id" );
    $kontrol = $sil->execute(
      array(
         'fmenu_id' => $_GET[ 'fmenu_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../alt-menu.php?status=ok" );
  }
  else
  {

      Header( "Location:../alt-menu.php?status=no" );
  }
}

if ( $_GET[ 'omenusil' ] == "ok" )
{


	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from omenu where omenu_id=:omenu_id" );
    $kontrol = $sil->execute(
      array(
         'omenu_id' => $_GET[ 'omenu_id' ]
     )
  );




    if ( $kontrol )
    {

      $menulistixl=$db->prepare("SELECT * from omenu where omenu_ust=:UstMenux");
      $menulistixl->execute(array('UstMenux' => $_GET[ 'omenu_ust' ])); 
      $KontSay=$menulistixl->rowCount();

      if ($KontSay=='0') {
         $eski=$_GET[ 'omenu_ust' ];
         $ayarkaydet = $db->prepare(
            "UPDATE omenu SET
            omenu_durum=:durum
            WHERE omenu_id={$eski}"
        );
         $update     = $ayarkaydet->execute(
            array(
               'durum' => '0'
           )
        );
     }

     Header( "Location:../menu.php?status=ok" );
 }
 else
 {

  Header( "Location:../menu.php?status=no" );
}
}
if ( $_GET[ 'ssssil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from sss where sss_id=:sss_id" );
    $kontrol = $sil->execute(
      array(
         'sss_id' => $_GET[ 'sss_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../sss.php?status=ok" );
  }
  else
  {

      Header( "Location:../sss.php?status=no" );
  }
}

if ( isset( $_POST[ 'hizmetekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $uploads_dir = '../assets/img/hizmetler';
    @$tmp_name = $_FILES[ 'hizmet_resim' ][ "tmp_name" ];
    $benzersizsayi1 = rand( 20000, 32000 );
    $benzersizsayi2 = rand( 20000, 32000 );
    $uzanti = '.jpg';
    $benzersizad    = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
    @move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

    $kaydet = $db->prepare(
      "INSERT INTO hizmetler SET
      hizmet_baslik=:baslik,
      hizmet_icerik=:icerik,
      hizmet_title=:title,
      hizmet_descr=:descr,
      hizmet_keyword=:keyword,
      hizmet_vitrin=:vitrin,
      hizmet_resim=:resim");
    $insert = $kaydet->execute(
      array(
       'baslik'     => $_POST[ 'hizmet_baslik' ],
       'icerik'     => $_POST[ 'hizmet_icerik' ],
       'title'     => $_POST[ 'hizmet_title' ],
       'descr'     => $_POST[ 'hizmet_descr' ],
       'keyword'     => $_POST[ 'hizmet_keyword' ],
       'vitrin'     => $_POST[ 'hizmet_vitrin' ],
       'resim'     => $refimgyol
   ));

    if ( $insert )
    {

      Header( "Location:../hizmetler.php?status=ok" );
  }
  else
  {

      Header( "Location:../hizmetler.php?status=no" );
  }
}
if ( isset( $_POST[ 'ozellikekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

    $kaydet = $db->prepare(
      "INSERT INTO ozellik SET
      ozellik_baslik=:baslik,
      ozellik_fiyat=:fiyat,
      ozellik_arac=:arac");
    $insert = $kaydet->execute(
      array(
         'baslik'     => $_POST[ 'ozellik_baslik' ],
         'fiyat'     => $_POST[ 'ozellik_fiyat' ],
         'arac'     => $_POST[ 'ozellik_arac' ]
     ));

    if ( $insert )
    {

      Header( "Location:../ozellikler.php?status=ok" );
  }
  else
  {

      Header( "Location:../ozellikler.php?status=no" );
  }
}
if ( isset( $_POST[ 'markaekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$uploads_dir = '../assets/img/hizmetler';
	@$tmp_name = $_FILES[ 'hizmet_resim' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO markalar SET
		hizmet_baslik=:baslik,
		hizmet_icerik=:icerik,
		hizmet_title=:title,
		hizmet_descr=:descr,
		hizmet_keyword=:keyword,
		hizmet_vitrin=:vitrin,
		hizmet_resim=:resim");
	$insert = $kaydet->execute(
		array(
			'baslik'     => $_POST[ 'hizmet_baslik' ],
			'icerik'     => $_POST[ 'hizmet_icerik' ],
			'title'     => $_POST[ 'hizmet_title' ],
			'descr'     => $_POST[ 'hizmet_descr' ],
			'keyword'     => $_POST[ 'hizmet_keyword' ],
			'vitrin'     => $_POST[ 'hizmet_vitrin' ],
			'resim'     => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../markalar.php?status=ok" );
	}
	else
	{

		Header( "Location:../markalar.php?status=no" );
	}
}
if ( isset( $_POST[ 'yorumekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$uploads_dir = '../assets/img/yorumlar';
	@$tmp_name = $_FILES[ 'yorum_resim' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$benzersizsayi3 = rand( 20000, 32000 );
	$benzersizsayi4 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO yorumlar SET
		yorum_isim=:isim,
		yorum_link=:link,
		yorum_icerik=:icerik,
		yorum_resim=:resim");
	$insert = $kaydet->execute(
		array(
			'isim'     => $_POST[ 'yorum_isim' ],
			'link' => $_POST[ 'yorum_link' ],
			'icerik'     => $_POST[ 'yorum_icerik' ],
			'resim'    => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../yorumlar.php?status=ok" );
	}
	else
	{

		Header( "Location:../yorumlar.php?status=no" );
	}
}
if ( isset( $_POST[ 'projeekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$uploads_dir = '../assets/img/projeler';
	@$tmp_name = $_FILES[ 'proje_resim' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti='.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO projeler SET
		proje_baslik=:baslik,
		proje_icerik=:icerik,
		proje_resim=:resim,
		proje_title=:title,
		proje_descr=:descr,
		proje_keyword=:keyword");
	$insert = $kaydet->execute(
		array(
			'baslik'     => $_POST[ 'proje_baslik' ],
			'icerik'     => $_POST[ 'proje_icerik' ],
			'resim'     => $refimgyol,
			'title'     => $_POST[ 'proje_title' ],
			'descr'     => $_POST[ 'proje_descr' ],
			'keyword'     => $_POST[ 'proje_keyword' ]
		));

	if ( $insert )
	{

		Header( "Location:../projeler.php?status=ok" );
	}
	else
	{

		Header( "Location:../projeler.php?status=no" );
	}
}

if ( $_GET[ 'blogresimsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from resimb where resim_id=:resim_id" );
    $kontrol = $sil->execute(
      array(
         'resim_id' => $_GET[ 'resim_id' ]
     )
  );
    $urun = $_GET['blog_id'];

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['eski_yol'];
      unlink("../$resimsilunlink");

      Header( "Location:../blog-resim-duzenle.php?blog_id=$urun&status=ok" );
  }
  else
  {

      Header( "Location:../blog-resim-duzenle.php?blog_id=$urun&status=no" );
  }
}
if ( isset( $_POST[ 'slaytekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$uploads_dir = '../assets/img/slayt';
	$tmp_name = $_FILES[ 'slayt_resim' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 ;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO slayt SET
		slayt_baslik=:baslik,
		slayt_aciklama=:aciklama,
		slayt_renk=:renk,
		slayt_sira=:sira,
		slayt_butonad=:butonad,
		slayt_butonlink=:butonlink,
		slayt_resim=:resim");
	$insert = $kaydet->execute(
		array(
			'baslik' => $_POST[ 'slayt_baslik' ],
			'aciklama' => $_POST[ 'slayt_aciklama' ],
			'renk' => $_POST[ 'slayt_renk' ],
			'butonad'     => $_POST[ 'slayt_butonad' ],
			'butonlink' => $_POST[ 'slayt_butonlink' ],
			'sira'     => $_POST[ 'slayt_sira' ],
			'resim'    => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../slayt.php?status=ok" );
	}
	else
	{

		Header( "Location:../slayt.php?status=no" );
	}
}

if ( isset( $_POST[ 'urunekle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$uploads_dir = '../assets/img/urunler';
	@$tmp_name = $_FILES[ 'urun_resim' ][ "tmp_name" ];
	@$name = $_FILES[ 'urun_resim' ][ "name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti='.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );


	$kaydet = $db->prepare(
		"INSERT INTO urunler SET
		urun_baslik=:baslik,
		urun_fiyat=:fiyat,
		urun_47=:urun47,
		urun_815=:urun815,
		urun_1621=:urun1621,
		urun_2228=:urun2228,
		urun_2999=:urun2999,
		urun_vitrin=:vitrin,
		urun_kapi=:kapi,
		urun_koltuk=:koltuk,
		urun_bagaj=:bagaj,
		urun_klima=:klima,
		urun_yakit=:yakit,
		urun_resim=:resim,
		urun_yakitprosedur=:yakitprosedur,
		urun_kiralamasuresi=:kiralamasuresi,
		urun_ehliyetyassiniri=:ehliyetyassiniri,
		urun_vites=:vites");
	$insert = $kaydet->execute(
		array(
			'baslik'     => $_POST[ 'urun_baslik' ],
			'fiyat'     => $_POST[ 'urun_fiyat' ],
			'urun47'     => $_POST[ 'urun_47' ],
			'urun815'     => $_POST[ 'urun_815' ],
			'urun1621'     => $_POST[ 'urun_1621' ],
			'urun2228'     => $_POST[ 'urun_2228' ],
			'urun2999'     => $_POST[ 'urun_2999' ],
			'vitrin'     => $_POST[ 'urun_vitrin' ],
			'kapi'     => $_POST[ 'urun_kapi' ],
			'koltuk'     => $_POST[ 'urun_koltuk' ],
			'bagaj'     => $_POST[ 'urun_bagaj' ],
			'klima'     => $_POST[ 'urun_klima' ],
			'yakit'     => $_POST[ 'urun_yakit' ],
			'yakitprosedur'     => $_POST[ 'urun_yakitprosedur' ],
			'kiralamasuresi'     => $_POST[ 'urun_kiralamasuresi' ],
			'ehliyetyassiniri'     => $_POST[ 'urun_ehliyetyassiniri' ],
			'resim'     => $refimgyol,
			'vites'     => $_POST[ 'urun_vites' ]
		));

	if ( $insert )
	{

		Header( "Location:../araclar.php?status=ok" );
	}
	else
	{

		Header( "Location:../araclar.php?status=no" );
	}
}
if ( isset( $_POST[ 'refekle' ] ) )
{



    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$uploads_dir = '../assets/img/referanslar';
	@$tmp_name = $_FILES[ 'referans_resim1' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );


	$kaydet = $db->prepare(
		"INSERT INTO referanslar SET
		referans_adi=:adi,
		referans_kategori=:kategori,
		referans_link=:link,
		referans_resim1=:resim1
		");
	$insert = $kaydet->execute(
		array(
			'adi'    => $_POST[ 'referans_adi' ],
			'kategori'    => $_POST[ 'referans_kategori' ],
			'link'    => $_POST[ 'referans_link' ],
			'resim1'    => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../referanslar.php?status=ok" );
	}
	else
	{

		Header( "Location:../referanslar.php?status=no" );
	}
}

if ( isset( $_POST[ 'blogduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	if ( $_FILES[ 'blog_resim' ][ "size" ] > 0 )
	{

		$uploads_dir = '../assets/img/blog';
		@$tmp_name = $_FILES[ 'blog_resim' ][ "tmp_name" ];
		$benzersizsayi1 = rand( 20000, 32000 );
		$benzersizsayi2 = rand( 20000, 32000 );
		$uzanti = '.jpg';
		$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
		$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
		@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

		$duzenle = $db->prepare(
			"UPDATE blog SET
			blog_baslik=:baslik,
			blog_kategori=:kategori,
			blog_detay=:detay,
			blog_title=:title,
			blog_descr=:descr,
			blog_keyword=:keyword,
			blog_resim=:resim
			WHERE blog_id={$_POST['blog_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'baslik' => $_POST[ 'blog_baslik' ],
				'kategori' => $_POST[ 'blog_kategori' ],
				'detay'  => $_POST[ 'blog_detay' ],
				'title'  => $_POST[ 'blog_title' ],
				'descr'  => $_POST[ 'blog_descr' ],
				'keyword'  => $_POST[ 'blog_keyword' ],
				'resim'  => $refimgyol
			)
		);

		$blog_id = $_POST[ 'blog_id' ];

		if ( $update )
		{

			$resimsilunlink = $_POST[ 'eski_yol' ];
			unlink( "../$resimsilunlink" );

			Header( "Location:../blog.php?status=ok" );
		}
		else
		{

			Header( "Location:../blog.php?status=no" );
		}
	}
	else
	{

		$duzenle = $db->prepare(
			"UPDATE blog SET
			blog_baslik=:baslik,
			blog_kategori=:kategori,
			blog_title=:title,
			blog_descr=:descr,
			blog_keyword=:keyword,
			blog_detay=:detay
			WHERE blog_id={$_POST['blog_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'baslik' => $_POST[ 'blog_baslik' ],
				'kategori' => $_POST[ 'blog_kategori' ],
				'title'  => $_POST[ 'blog_title' ],
				'descr'  => $_POST[ 'blog_descr' ],
				'keyword'  => $_POST[ 'blog_keyword' ],
				'detay'  => $_POST[ 'blog_detay' ]
			)
		);

		$blog_id = $_POST[ 'blog_id' ];

		if ( $update )
		{


			Header( "Location:../blog.php?status=ok" );
		}
		else
		{

			Header( "Location:../blog.php?status=no" );
		}
	}
}

if ( isset( $_POST[ 'subeduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$duzenle = $db->prepare(
		"UPDATE sube SET
		sube_adi=:adi,
		sube_tel=:tel,
		sube_gsm=:gsm,
		sube_fax=:fax,
		sube_web=:web,
		sube_mail=:mail,
		sube_harita=:harita,
		sube_il=:il,
		sube_ilce=:ilce,
		sube_adres=:adres
		WHERE sube_id={$_POST['sube_id']}"
	);
	$update  = $duzenle->execute(
		array(
			'adi'   => $_POST[ 'sube_adi' ],
			'tel'   => $_POST[ 'sube_tel' ],
			'gsm'   => $_POST[ 'sube_gsm' ],
			'fax'   => $_POST[ 'sube_fax' ],
			'web'   => $_POST[ 'sube_web' ],
			'mail'   => $_POST[ 'sube_mail' ],
			'harita'   => $_POST[ 'sube_harita' ],
			'il'   => $_POST[ 'sube_il' ],
			'ilce'   => $_POST[ 'sube_ilce' ],
			'adres' => $_POST[ 'sube_adres' ]
		)
	);

	$sayfa_id = $_POST[ 'sube_id' ];

	if ( $update )
	{


		Header( "Location:../sube-duzenle.php?sube_id=$sayfa_id&status=ok" );
	}
	else
	{

		Header( "Location:../sube-duzenle.php?sube_id=$sayfa_id&status=no" );
	}
}

if ( isset( $_POST[ 'subeekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$kaydet = $db->prepare(
		"INSERT INTO sube SET
		sube_adi=:adi,
		sube_tel=:tel,
		sube_gsm=:gsm,
		sube_fax=:fax,
		sube_web=:web,
		sube_mail=:mail,
		sube_harita=:harita,
		sube_il=:il,
		sube_ilce=:ilce,
		sube_adres=:adres
		"
	);
	$insert = $kaydet->execute(
		array(
			'adi'   => $_POST[ 'sube_adi' ],
			'tel'   => $_POST[ 'sube_tel' ],
			'gsm'   => $_POST[ 'sube_gsm' ],
			'fax'   => $_POST[ 'sube_fax' ],
			'web'   => $_POST[ 'sube_web' ],
			'mail'   => $_POST[ 'sube_mail' ],
			'harita'   => $_POST[ 'sube_harita' ],
			'il'   => $_POST[ 'sube_il' ],
			'ilce'   => $_POST[ 'sube_ilce' ],
			'adres' => $_POST[ 'sube_adres' ]
		)
	);

	if ( $insert )
	{

		Header( "Location:../sube.php?status=ok" );
	}
	else
	{

		Header( "Location:../sube.php?status=no" );
	}
}

if ( $_GET[ 'subesil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from sube where sube_id=:sayfa_id" );
    $kontrol = $sil->execute(
      array(
         'sayfa_id' => $_GET[ 'sube_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../sube.php?status=ok" );
  }
  else
  {

      Header( "Location:../sube.php?status=no" );
  }
}
if ( $_GET[ 'blogsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from blog where blog_id=:blog_id" );
    $kontrol = $sil->execute(
      array(
         'blog_id' => $_GET[ 'blog_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../blog.php?status=ok" );
  }
  else
  {

      Header( "Location:../blog.php?status=no" );
  }
}

if ( $_GET[ 'ozelliksil' ] == "ok" )
{
	
	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from ozellik where ozellik_id=:ozellik_id" );
    $kontrol = $sil->execute(
      array(
         'ozellik_id' => $_GET[ 'ozellik_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../ozellikler.php?status=ok" );
  }
  else
  {

      Header( "Location:../ozellikler.php?status=no" );
  }
}

if ( isset( $_POST[ 'yaziduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$duzenle = $db->prepare(
		"UPDATE yazi SET
		yazi_baslik=:baslik,
		yazi_icerik=:icerik
		WHERE yazi_id={$_POST['yazi_id']}"
	);
	$update  = $duzenle->execute(
		array(
			'baslik'   => $_POST[ 'yazi_baslik' ],
			'icerik' => $_POST[ 'yazi_icerik' ]
		)
	);

	$yazi_id = $_POST[ 'yazi_id' ];

	if ( $update )
	{


		Header( "Location:../production/yazi.php?durum=ok" );
	}
	else
	{

		Header( "Location:../production/yazi.php?durum=no" );
	}
}

if ( isset( $_POST[ 'sayfaduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$duzenle = $db->prepare(
		"UPDATE sayfalar SET
		sayfa_title=:title,
		sayfa_descr=:descr,
		sayfa_keyword=:keyword,
		sayfa_baslik=:baslik,
		sayfa_menu=:menu,
		sayfa_icerik=:icerik
		WHERE sayfa_id={$_POST['sayfa_id']}"
	);
	$update  = $duzenle->execute(
		array(
			'title'   => $_POST[ 'sayfa_title' ],
			'descr'   => $_POST[ 'sayfa_descr' ],
			'keyword'   => $_POST[ 'sayfa_keyword' ],
			'baslik'   => $_POST[ 'sayfa_baslik' ],
			'menu'   => $_POST[ 'sayfa_menu' ],
			'icerik' => $_POST[ 'sayfa_icerik' ]
		)
	);

	$sayfa_id = $_POST[ 'sayfa_id' ];

	if ( $update )
	{


		Header( "Location:../sayfalar.php?status=ok" );
	}
	else
	{

		Header( "Location:../sayfalar.php?status=no" );
	}
}
if ( isset( $_POST[ 'sozlesmeduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$duzenle = $db->prepare(
		"UPDATE soz SET
		soz_baslik=:title,
		soz_aciklama=:descr
		WHERE soz_id={$_POST['soz_id']}"
	);
	$update  = $duzenle->execute(
		array(
			'title'   => $_POST[ 'soz_baslik' ],
			'descr'   => $_POST[ 'soz_aciklama' ]
		)
	);

	if ( $update )
	{


		Header( "Location:../sozlesme.php?status=ok" );
	}
	else
	{

		Header( "Location:../sozlesme.php?status=no" );
	}
}
if ( isset( $_POST[ 'hesapduzenle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$duzenle = $db->prepare(
		"UPDATE hesap SET
		hesap_banka=:banka,
		hesap_isim=:isim,
		hesap_sube=:sube,
		hesap_no=:no,
		hesap_iban=:iban
		WHERE hesap_id={$_POST['hesap_id']}"
	);
	$update  = $duzenle->execute(
		array(
			'banka'   => $_POST[ 'hesap_banka' ],
			'isim'   => $_POST[ 'hesap_isim' ],
			'sube'   => $_POST[ 'hesap_sube' ],
			'no'   => $_POST[ 'hesap_no' ],
			'iban' => $_POST[ 'hesap_iban' ]
		)
	);


	if ( $update )
	{


		Header( "Location:../hesaplarim.php?status=ok" );
	}
	else
	{

		Header( "Location:../hesaplarim.php?status=no" );
	}
}
if ( $_GET[ 'hesapsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from hesap where hesap_id=:hesap_id" );
    $kontrol = $sil->execute(
      array(
         'hesap_id' => $_GET[ 'hesap_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../hesaplarim.php?status=ok" );
  }
  else
  {

      Header( "Location:../hesaplarim.php?status=no" );
  }
}
if ( $_GET[ 'sayfasil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from sayfalar where sayfa_id=:sayfa_id" );
    $kontrol = $sil->execute(
      array(
         'sayfa_id' => $_GET[ 'sayfa_id' ]
     )
  );

    if ( $kontrol )
    {

      Header( "Location:../sayfalar.php?status=ok" );
  }
  else
  {

      Header( "Location:../sayfalar.php?status=no" );
  }
}


if ( isset( $_POST[ 'hesapekle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }


	$kaydet = $db->prepare(
		"INSERT INTO hesap SET
		hesap_banka=:banka,
		hesap_isim=:isim,
		hesap_sube=:sube,
		hesap_no=:no,
		hesap_iban=:iban
		"
	);
	$insert = $kaydet->execute(
		array(
			'banka'   => $_POST[ 'hesap_banka' ],
			'isim'   => $_POST[ 'hesap_isim' ],
			'sube'   => $_POST[ 'hesap_sube' ],
			'no'   => $_POST[ 'hesap_no' ],
			'iban' => $_POST[ 'hesap_iban' ]
		)
	);

	if ( $insert )
	{

		Header( "Location:../hesaplarim.php?status=ok" );
	}
	else
	{

		Header( "Location:../hesaplarim.php?status=no" );
	}
}
if ( isset( $_POST[ 'sayfaekle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }


	$kaydet = $db->prepare(
		"INSERT INTO sayfalar SET
		sayfa_title=:title,
		sayfa_descr=:descr,
		sayfa_keyword=:keyword,
		sayfa_baslik=:baslik,
		sayfa_menu=:menu,
		sayfa_icerik=:icerik
		"
	);
	$insert = $kaydet->execute(
		array(
			'title'   => $_POST[ 'sayfa_title' ],
			'descr'   => $_POST[ 'sayfa_descr' ],
			'keyword'   => $_POST[ 'sayfa_keyword' ],
			'baslik'   => $_POST[ 'sayfa_baslik' ],
			'menu'   => $_POST[ 'sayfa_menu' ],
			'icerik' => $_POST[ 'sayfa_icerik' ]
		)
	);

	if ( $insert )
	{

		Header( "Location:../sayfalar.php?status=ok" );
	}
	else
	{

		Header( "Location:../sayfalar.php?status=no" );
	}
}



if ( isset( $_POST[ 'teklifver' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }


	$ayarkaydet = $db->prepare(
		"INSERT INTO teklif SET
		teklif_adsoyad=:adsoyad,
		teklif_tel=:tel,
		teklif_nereden=:nereden,
		teklif_nereye=:nereye,
		teklif_cinsi=:cinsi"
	);
	$update     = $ayarkaydet->execute(
		array(
			'adsoyad' => $_POST[ 'teklif_adsoyad' ],
			'tel'    => $_POST[ 'teklif_tel' ],
			'nereden'   => $_POST[ 'teklif_nereden' ],
			'nereye' => $_POST[ 'teklif_nereye' ],
			'cinsi'    => $_POST[ 'teklif_cinsi' ]
		)
	);

	$uye    = $_POST[ 'teklif_adsoyad' ];
	$tel   = $_POST[ 'teklif_tel' ];

	if ( $update )
	{

		Header( "Location:../../teklif-sms-yolla?tel=$tel&ad=$uye" );

	}
	else
	{

		Header( "Location:../../index.php?teklif=no" );
	}
}

if ( isset( $_POST[ 'beniara' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }


	$ayarkaydet = $db->prepare(
		"INSERT INTO beniara SET
		beniara_tel=:tel"
	);
	$update     = $ayarkaydet->execute(
		array(
			'tel' => $_POST[ 'beniara_tel' ]
		)
	);

	$tel   = $_POST[ 'teklif_tel' ];

	if ( $update )
	{

		Header( "Location:../../beniara-sms-yolla?tel=$tel" );

	}
	else
	{

		Header( "Location:../../index.php?teklif=no" );
	}
}

if ( $_GET[ 'beniarasil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from beniara where beniara_id=:beniara_id" );
    $kontrol = $sil->execute(
      array(
         'beniara_id' => $_GET[ 'beniara_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../production/beni-ara.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/beni-ara.php?durum=no" );
  }
}
if ( $_GET[ 'randevusil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from randevu where randevu_id=:randevu_id" );
    $kontrol = $sil->execute(
      array(
         'randevu_id' => $_GET[ 'randevu_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../teklif.php?status=ok" );
  }
  else
  {

      Header( "Location:../teklif.php?status=no" );
  }
}
if ( $_GET[ 'teklifsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from teklif where teklif_id=:teklif_id" );
    $kontrol = $sil->execute(
      array(
         'teklif_id' => $_GET[ 'teklif_id' ]
     )
  );

    if ( $kontrol )
    {


      Header( "Location:../production/teklifler.php?durum=ok" );
  }
  else
  {

      Header( "Location:../production/teklifler.php?durum=no" );
  }
}


if ( $_GET[ 'urunresimsil' ] == "ok" )
{

	if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
    $sil     = $db->prepare( "DELETE from resim where resim_id=:resim_id" );
    $kontrol = $sil->execute(
      array(
         'resim_id' => $_GET[ 'resim_id' ]
     )
  );
    $urun = $_GET['urun_id'];

    if ( $kontrol )
    {
      $resimsilunlink=$_GET['eski_yol'];
      unlink("../$resimsilunlink");

      Header( "Location:../urun-resim-duzenle.php?urun_id=$urun&?status=ok" );
  }
  else
  {

      Header( "Location:../slayt.php?urun_id=$urun&?status=no" );
  }
}
if ( isset( $_POST[ 'videoekle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$uploads_dir = '../assets/img/galeri';
	$tmp_name = $_FILES[ 'video_resim' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 ;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO videogaleri SET
		video_link=:link,
		video_resim=:resim");
	$insert = $kaydet->execute(
		array(
			'link' => $_POST[ 'video_link' ],
			'resim'    => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../video-galerisi.php?status=ok" );
	}
	else
	{

		Header( "Location:../video-galerisi.php?status=no" );
	}
}
if ( $_GET[ 'siparisonay']=='ok' )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$kaydet = $db->prepare(
		"UPDATE siparis SET
		siparis_durum=:durum
		WHERE siparis_id={$_GET['siparis_id']}");
	$insert = $kaydet->execute(
		array(
			'durum' => 0
		));

	if ( $insert )
	{

		Header( "Location:../tamamlanan-rezervasyonlar.php?status=ok" );
	}
	else
	{

		Header( "Location:../yeni-rezervasyonlar.php?status=no" );
	}
}
if ( isset( $_POST[ 'resimekle' ] ) )
{


    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$uploads_dir = '../assets/img/galeri';
	$tmp_name = $_FILES[ 'resim_link' ][ "tmp_name" ];
	$benzersizsayi1 = rand( 20000, 32000 );
	$benzersizsayi2 = rand( 20000, 32000 );
	$uzanti = '.jpg';
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 ;
	$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
	move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

	$kaydet = $db->prepare(
		"INSERT INTO resimgaleri SET
		resim_baslik=:baslik,
		resim_link=:resim");
	$insert = $kaydet->execute(
		array(
			'baslik' => $_POST[ 'resim_baslik' ],
			'resim'    => $refimgyol
		));

	if ( $insert )
	{

		Header( "Location:../resim-galerisi.php?status=ok" );
	}
	else
	{

		Header( "Location:../resim-galerisi.php?status=no" );
	}
}
if ( $_GET[ 'rezervasyonsil' ] == "ok" )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$inovance=$db->prepare("SELECT * from siparis where siparis_id=:siparis_id");
	$inovance->execute(array(
		'siparis_id' => $_GET['rezervasyon_id']
	));
	$inovanceprint=$inovance->fetch(PDO::FETCH_ASSOC);

	$durum=$inovanceprint['siparis_durum'];

    $sil     = $db->prepare( "DELETE from siparis where siparis_id=:siparis_id" );
    $kontrol = $sil->execute(
      array(
         'siparis_id' => $_GET[ 'rezervasyon_id' ]
     )
  );

    if ( $kontrol )
    {



      if ($durum=='1') {

         Header( "Location:../yeni-rezervasyonlar.php?status=ok" );
     } else {
         Header( "Location:../tamamlanan-rezervasyonlar.php?status=ok" );
     }


 }
 else
 {

  Header( "Location:../slayt.php?urun_id=$urun&?status=no" );
}
}
if ( isset( $_POST[ 'omenuduzenle' ] ) )
{
    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	if ($_POST[ 'omenu_ust' ]=='0') {
		$Durum='0';
	}
	else {
		$Durum=$_POST[ 'omenu_ust' ];
	}

	$ayarkaydet = $db->prepare(
		"UPDATE omenu SET
		omenu_ad=:ad,
		omenu_sira=:sira,
		omenu_ust=:ust,
		omenu_durum=:durum,
		omenu_link=:link
		WHERE omenu_id={$_POST['omenu_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'ad'     => $_POST[ 'omenu_ad' ],
			'sira'     => $_POST[ 'omenu_sira' ],
			'ust'     => $_POST[ 'omenu_ust' ],
			'durum'     => $Durum,
			'link'     => $_POST[ 'omenu_link' ]
		)
	);
	if ( $update )
	{ 

		Header( "Location:../menu.php?status=ok" );
	}
	else
	{

		Header( "Location:../menu.php?status=no" );
	}
}
if ( isset( $_POST[ 'omenuduzenle' ] ) )
{
    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$ust=$_POST[ 'omenu_ust' ];
	if ($ust==0) {
		$ayarkaydet = $db->prepare(
			"UPDATE omenu SET
			omenu_ad=:ad,
			omenu_sira=:sira,
			omenu_link=:link
			WHERE omenu_id={$_POST['omenu_id']}"
		);
		$update     = $ayarkaydet->execute(
			array(
				'ad'     => $_POST[ 'omenu_ad' ],
				'sira'     => $_POST[ 'omenu_sira' ],
				'link'     => $_POST[ 'omenu_link' ]
			)
		);
	}
	$ayarkaydet = $db->prepare(
		"UPDATE omenu SET
		omenu_ad=:ad,
		omenu_sira=:sira,
		omenu_ust=:ust,
		omenu_link=:link
		WHERE omenu_id={$_POST['omenu_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'ad'     => $_POST[ 'omenu_ad' ],
			'sira'     => $_POST[ 'omenu_sira' ],
			'ust'     => $_POST[ 'omenu_ust' ],
			'link'     => $_POST[ 'omenu_link' ]
		)
	);

	if ( $update )
	{ 

		Header( "Location:../menu.php?status=ok" );
	}
	else
	{

		Header( "Location:../menu.php?status=no" );
	}
}
if ( isset( $_POST[ 'smenuduzenle' ] ) )
{
    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$ayarkaydet = $db->prepare(
		"UPDATE smenu SET
		smenu_ad=:ad,
		smenu_durum=:durum
		WHERE smenu_id={$_POST['smenu_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'ad'     => $_POST[ 'smenu_ad' ],
			'durum'     => $_POST[ 'smenu_durum' ]
		)
	);

	if ( $update )
	{

		Header( "Location:../menu.php?status=ok" );
	}
	else
	{

		Header( "Location:../menu.php?status=no" );
	}
}
if ( isset( $_POST[ 'flinkduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }
	$ayarkaydet = $db->prepare(
		"UPDATE flink SET
		flink_ad=:ad,
		flink_sira=:sira,
		flink_link=:link
		WHERE flink_id={$_POST['flink_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'ad'     => $_POST[ 'flink_ad' ],
			'sira'     => $_POST[ 'flink_sira' ],
			'link'     => $_POST[ 'flink_link' ]
		)
	);

	if ( $update )
	{

		Header( "Location:../yan-menu.php?status=ok" );
	}
	else
	{

		Header( "Location:../yan-menu.php?status=no" );
	}
}
if ( isset( $_POST[ 'fmenuduzenle' ] ) )
{
    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$ayarkaydet = $db->prepare(
		"UPDATE fmenu SET
		fmenu_ad=:ad,
		fmenu_link=:link,
		fmenu_sira=:sira
		WHERE fmenu_id={$_POST['fmenu_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'ad'     => $_POST[ 'fmenu_ad' ],
			'sira'     => $_POST[ 'fmenu_sira' ],
			'link'     => $_POST[ 'fmenu_link' ]
		)
	);

	if ( $update )
	{

		Header( "Location:../alt-menu.php?status=ok" );
	}
	else
	{

		Header( "Location:../alt-menu.php?status=no" );
	}
}
if ( isset( $_POST[ 'yorumduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	if ( $_FILES[ 'yorum_resim' ][ "size" ] > 0 )
	{

		$uploads_dir = '../assets/img/yorumlar';
		@$tmp_name = $_FILES[ 'yorum_resim' ][ "tmp_name" ];
		$benzersizsayi1 = rand( 20000, 32000 );
		$benzersizsayi2 = rand( 20000, 32000 );
		$uzanti = '.jpg';
		$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
		$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
		@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

		$duzenle = $db->prepare(
			"UPDATE yorumlar SET
			yorum_icerik=:icerik,
			yorum_isim=:isim,
			yorum_link=:link,
			yorum_resim=:resim
			WHERE yorum_id={$_POST['yorum_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'icerik' => $_POST[ 'yorum_icerik' ],
				'isim'  => $_POST[ 'yorum_isim' ],
				'link'  => $_POST[ 'yorum_link' ],
				'resim'  => $refimgyol
			)
		);


		if ( $update )
		{

			$resimsilunlink = $_POST[ 'eski_yol' ];
			unlink( "../$resimsilunlink" );

			Header( "Location:../yorumlar.php?status=ok" );
		}
		else
		{

			Header( "Location:../yorumlar.php?status=no" );
		}
	}
	else
	{

		$duzenle = $db->prepare(
			"UPDATE yorumlar SET
			yorum_icerik=:icerik,
			yorum_isim=:isim,
			yorum_link=:link
			WHERE yorum_id={$_POST['yorum_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'icerik' => $_POST[ 'yorum_icerik' ],
				'isim'  => $_POST[ 'yorum_isim' ],
				'link'  => $_POST[ 'yorum_link' ]
			)
		);

		if ( $update )
		{

			Header( "Location:../yorumlar.php?status=ok" );
		}
		else
		{

			Header( "Location:../yorumlar.php?status=no" );
		}
	}
}
if ( isset( $_POST[ 'referansduzenle' ] ) )
{

    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	if ( $_FILES[ 'referans_resim1' ][ "size" ] > 0 )
	{

		$uploads_dir = '../assets/img/referanslar';
		@$tmp_name = $_FILES[ 'referans_resim1' ][ "tmp_name" ];
		$benzersizsayi1 = rand( 20000, 32000 );
		$benzersizsayi2 = rand( 20000, 32000 );
		$uzanti = '.jpg';
		$benzersizad    = $benzersizsayi1 . $benzersizsayi2;
		$refimgyol      = substr( $uploads_dir, 3 ) . "/" . $benzersizad . $uzanti;
		@move_uploaded_file( $tmp_name, "$uploads_dir/$benzersizad$uzanti" );

		$duzenle = $db->prepare(
			"UPDATE referanslar SET
			referans_adi=:adi,
			referans_kategori=:kategori,
			referans_link=:link,
			referans_resim1=:resim1
			WHERE referans_id={$_POST['referans_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'adi'    => $_POST[ 'referans_adi' ],
				'kategori'    => $_POST[ 'referans_kategori' ],
				'link'    => $_POST[ 'referans_link' ],
				'resim1'    => $refimgyol
			)
		);

		if ( $update )
		{

			$resimsilunlink = $_POST[ 'eski_yol1' ];
			unlink( "../$resimsilunlink" );

			Header( "Location:../referanslar.php?status=ok" );
		}
		else
		{

			Header( "Location:../referanslar.php?status=no" );
		}
	} else {
		$duzenle = $db->prepare(
			"UPDATE referanslar SET
			referans_adi=:adi,
			referans_kategori=:kategori,
			referans_link=:link
			WHERE referans_id={$_POST['referans_id']}"
		);
		$update  = $duzenle->execute(
			array(
				'adi'    => $_POST[ 'referans_adi' ],
				'kategori'    => $_POST[ 'referans_kategori' ],
				'link'    => $_POST[ 'referans_link' ]
			)
		);

		if ( $update )
		{


			Header( "Location:../referanslar.php?status=ok" );
		}
		else
		{

			Header( "Location:../referanslar.php?status=no" );
		}
	}
}  

if ( isset( $_POST[ 'odemeduzenle' ] ) )
{
    if (!$_SESSION[ 'kullanici_adi' ]) {
        Header( "Location:../login.php?status=no" );
        exit();
    }

	$ayarkaydet = $db->prepare(
		"UPDATE odeme SET
		odeme_adi=:adi,
		odeme_not=:not,
		odeme_durum=:durum
		WHERE odeme_id={$_POST['odeme_id']}"
	);
	$update     = $ayarkaydet->execute(
		array(
			'adi'     => $_POST[ 'odeme_adi' ],
			'not'     => $_POST[ 'odeme_not' ],
			'durum'     => $_POST[ 'odeme_durum' ]
		)
	);

	if ( $update )
	{

		Header( "Location:../odeme-yontemleri.php?status=ok" );
	}
	else
	{

		Header( "Location:../odeme-yontemleri.php?status=no" );
	}
}


?>
