<?php 
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');
include 'controller/config.php'; 
if (isset($_SESSION['kullanici_adi'])) {
} else { header("Location:login.php");}
$settings=$db->prepare("SELECT * from ayar where ayar_id=?");
$settings->execute(array(0));
$settingsprint=$settings->fetch(PDO::FETCH_ASSOC);
$user=$db->prepare("SELECT * from kullanici where kullanici_id=?");
$user->execute(array(0));
$userprint=$user->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Son Panel - Son Yazılım Gelişmiş Yönetim Sistemi</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $settingsprint['ayar_fav']; ?>">
  <script src="../ckeditor/ckeditor.js"></script>
  <script src="assets/js/alert.js"></script>

  <!-- DropZone -->
  <link rel="stylesheet" href="assets/dropzone/dropzone.css" />
  <link rel="stylesheet" href="assets/dropzone/dropzone.min.css" />

  <!-- Common Plugins -->
  <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Sweet Alerts -->
  <link href="assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet">

  <!-- Summernote -->
  <link href="assets/lib/summernote/summernote.css" rel="stylesheet">
  <link href="assets/lib/summernote/summernote-bs3.css" rel="stylesheet">

  <!-- Vector Map Css-->
  <link href="assets/lib/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

  <!-- DataTables -->
  <link href="assets/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="assets/lib/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="assets/lib/toast/jquery.toast.min.css" rel="stylesheet">
  <link href="assets/lib/datatables/buttons.dataTables.css" rel="stylesheet" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
  
  <!-- Custom Css-->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body>
