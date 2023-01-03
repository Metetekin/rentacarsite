<?php
ob_start();
include 'trex/controller/config.php'; 
include 'trex/controller/seo.php';

date_default_timezone_set('Europe/Istanbul');
$settings=$db->prepare("SELECT * from ayar where ayar_id=?");
$settings->execute(array(0));
$settingsprint=$settings->fetch(PDO::FETCH_ASSOC);

$social=$db->prepare("SELECT * from sosyal");
$social->execute();

$socialf=$db->prepare("SELECT * from sosyal");
$socialf->execute();

$socials=$db->prepare("SELECT * from sosyal");
$socials->execute();

$motor=$db->prepare("SELECT * from motor where motor_id=1");
$motor->execute(array(0));
$motorprint=$motor->fetch(PDO::FETCH_ASSOC);

$widgets=$db->prepare("SELECT * from widget where widget_id=1");
$widgets->execute(array(0));
$widgetprint=$widgets->fetch(PDO::FETCH_ASSOC);
?>
