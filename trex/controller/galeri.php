<?php 

ob_start();

session_start();

include 'config.php';


if (!empty($_FILES)) {


	$uploads_dir = '../assets/img/galeri';

	@$tmp_name = $_FILES['file']["tmp_name"];

	@$name = $_FILES['file']["name"];

	$benzersizsayi1=rand(20000,32000);

	$benzersizsayi2=rand(20000,32000);

	$uzanti = '.jpg';

	$benzersizad=$benzersizsayi1.$benzersizsayi2;

	$refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$uzanti;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$uzanti");



	$kaydet=$db->prepare("INSERT INTO resimgaleri SET
		resim_baslik=:baslik,
		resim_link=:rs
		");
	$insert=$kaydet->execute(array(
		'baslik' => $name,
		'rs' => $refimgyol

		));

header( 'Location:../resim-galerisi.php?status=ok' );
}


?>
