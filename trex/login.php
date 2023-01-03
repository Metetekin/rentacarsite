<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Son Panel - Son Yazılım Gelişmiş Yönetim Sistemi</title>

  <!-- Common Plugins -->
  <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Sweet Alerts -->
  <link href="assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet">

  <!-- Custom Css-->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        html,body{ 
          background: url(assets/img/genel/orange_loginbg.jpg) no-repeat center center fixed;
          height: 100%;
        }
      </style>
    </head>
    <body class="bg-light">

      <div class="misc-wrapper">
        <div class="misc-content">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-4 col-sm-12">
                <div class="misc-header text-center">
                  <img src="assets/img/logo-dark.png" alt="">
                </div>
                <div class="misc-box">   
                  <form action="controller/function.php" method="POST">
                    <div class="form-group">                                      
                      <label  for="exampleuser1">Kullanıcı Adı</label>
                      <div class="group-icon">
                        <input name="kullanici_adi" id="exampleuser1" type="text" placeholder="Kullanıcı adınızı giriniz." class="form-control" required="">
                        <span class="icon-user text-muted icon-input"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Şifre</label>
                      <div class="group-icon">
                        <input name="kullanici_pass" id="exampleInputPassword1" type="password" placeholder="Şifrenizi giriniz." class="form-control">
                        <span class="icon-lock text-muted icon-input"></span>
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="pull-centre">
                        <button name="login" type="submit" class="btn btn-block btn-success">Giriş</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="text-center misc-footer">
                 <p>Copyright &copy; 2017</p>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- Common Plugins -->
     <script src="assets/lib/jquery/dist/jquery.min.js"></script>
     <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
     <script src="assets/lib/pace/pace.min.js"></script>
     <script src="assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
     <script src="assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
     <script src="assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
     <script src="assets/lib/metisMenu/metisMenu.min.js"></script>
     <script src="assets/js/custom.js"></script>
     <!--Sweet Alerts-->
     <script src="assets/lib/sweet-alerts2/sweetalert2.min.js"></script>

     <?php if ($_GET['status']=='exit') {?>
     <script>
       $(document).ready(function () {
        swal({
          title: "BAŞARILI!",
          text: "Çıkış işlemi başarılı bir şekilde gerçekleşti.",
          type: "success",
          showConfirmButton: false,
          timer: '1000'
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
    <meta http-equiv="refresh" content="1; URL=<?php echo substr($sayfaURL,0, -12);?>">
    <?php } ?>

  </body>
  </html>
