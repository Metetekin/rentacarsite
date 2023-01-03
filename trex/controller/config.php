<?php

try {

	$db=new PDO("mysql:host=localhost;dbname=sitearac_rent",'sitearac_rent','123emo123.' );
	$db->query("SET NAMES utf8");
	//echo "veritabanı bağlantısı başarılı";

}

catch (PDOExpception $e) {

	echo $e->getMessage();
}
