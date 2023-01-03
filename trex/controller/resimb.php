<?php 

ob_start();

session_start();

include 'config.php';


if (!empty($_FILES)) {


	$resimsor=$db->prepare("SELECT * from resimb where resim_urun=:resim_urun");
	$resimsor->execute(array(
		'resim_urun' => $_POST['resim_urun']

	));
	$resimcek=$resimsor->fetch(PDO::FETCH_ASSOC);

	$resimsay=$resimsor->Rowcount();



	if ($resimsay<=50) {



		$uploads_dir = '../assets/img/blog';

		@$tmp_name = $_FILES['file']["tmp_name"];

		$benzersizsayi1=rand(20000,32000);

		$benzersizsayi2=rand(20000,32000);

		$uzanti = '.jpg';

		$benzersizad=$benzersizsayi1.$benzersizsayi2;

		$refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$uzanti;

		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$uzanti");



		$kaydet=$db->prepare("INSERT INTO resimb SET
			resim_urun=:urun,
			resim_link=:rs
			");
		$insert=$kaydet->execute(array(
			'urun' => $_POST['resim_urun'],
			'rs' => $refimgyol

		));



	} else {
		echo "resim limitini aştınız";
	}


}


?>
