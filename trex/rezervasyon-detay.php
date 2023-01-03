<?php 
include 'header.php';
include 'topbar.php';
include 'sidebar.php';
$inovance=$db->prepare("SELECT * from siparis where siparis_id=:siparis_id");
$inovance->execute(array(
	'siparis_id' => $_GET['rezervasyon_id']
));
$inovanceprint=$inovance->fetch(PDO::FETCH_ASSOC);

$product=$db->prepare("SELECT * from urunler where urun_id=:urun_id");
$product->execute(array(
	'urun_id' => $inovanceprint['siparis_urun']
));
$productprint=$product->fetch(PDO::FETCH_ASSOC);
$urunicerik=mb_substr(strip_tags($productprint['urun_aciklama']), 0, 80, 'UTF-8')."...";
?>		
<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<section class="main-content container">
	<div class="page-header">
		<h2>Rezervasyon Detay</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
					<div class="row">
						<div class="col-md-6">
							<h4>Sipariş No : <small>#00<?php echo $inovanceprint['siparis_id']; ?></small></h4>
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<a href="controller/function.php?rezervasyonsil=ok&rezervasyon_id=<?php echo $inovanceprint['siparis_id']; ?>" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Rezervasyonu Sil </a>
								<?php if ($inovanceprint['siparis_durum']=='1') { ?>
									<a href="controller/function.php?siparisonay=ok&siparis_id=<?php echo $inovanceprint['siparis_id']; ?>" title="Tamamla" class="btn btn-success btn-sm"><i class="fa fa-check"></i>Rezervasyonu Tamamla</a>
								<?php } else {} ?>
							</div>

						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="row margin-b-40">
						<div class="col-sm-6">
							<h6>Rezervasyon Durumu : <?php if ($inovanceprint['siparis_durum']=='1') { ?>
								<b style="color: green;">Yeni Rezervasyon</b>
							<?php } else {?>
								<b style="color: #ffb822;">Tamamlanmış Rezervasyon</b>
							<?php } ?>
						</h6>
						<h6>Rezervasyon oluşturma tarihi : 
							<b><?php echo $inovanceprint['siparis_tarih']; ?></b>
						</h6>
						<h6>Rezervasyon ad : 
							<b><?php echo $inovanceprint['siparis_ad']; ?></b>
						</h6>
						<h6>Rezervasyon tel : 
							<b><?php echo $inovanceprint['siparis_tel']; ?></b>
						</h6>
						<h6>Rezervasyon mail : 
							<b><?php echo $inovanceprint['siparis_mail']; ?></b>
						</h6>
						<h6>Rezervasyon ödeme : 
							<b><?php echo $inovanceprint['siparis_odeme']; ?></b>
						</h6>
						<h6>Alış Bilgileri : 
							<b><?php echo $inovanceprint['siparis_alissube']; ?></b>
						</h6>
						<h6>Dönüş Bilgileri : 
							<b><?php echo $inovanceprint['siparis_donussube']; ?></b>
						</h6>

						<address>
							<?php echo $inovanceprint['musteri_detay']; ?>
						</address>
					</div>

				</div>

				<div class="table-responsive margin-b-40">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Rezervasyon Detayı</th>
								<th>Fiyat</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
									$urunedit=$db->prepare("SELECT * from urunler where urun_id=:urun_id");
                                    $urunedit->execute(array(
                                    	'urun_id' => $inovanceprint['siparis_arac']
                                    ));
                                    $urunwrite=$urunedit->fetch(PDO::FETCH_ASSOC);
									
									echo $urunwrite['urun_baslik']." ".$inovanceprint['musteri_detay'].$inovanceprint['siparis_gun']." GÜN"; ?><br>
									
									<?php echo $inovanceprint['ek_ozellik']; ?>
								</td>
								<td>
									<?php echo $inovanceprint['siparis_fiyat']; ?><br>
									<?php echo $inovanceprint['ozellik_fiyat']; ?>
								</td>
								
							</tr>
						</tbody>
					</table>
				</div>
				
			<div class="row">
				<div class='col-md-8'>
					<?php 
					$tutar=$inovanceprint['genel_toplam'];
					$oran='18';
					$kdv = $tutar * ($oran / 100);
					$ytutar = $tutar - $kdv;
					$fark = $inovanceprint['genel_toplam']-$ytutar;
					?>
				</div>
				<div class="col-md-4 col-md-offset-2">
					<table class="table table-striped text-right">
						<tbody>
							<tr>
								<td><strong>Ara Toplam :</strong></td>
								<td><i class="fa fa-try"></i><?php echo $ytutar; ?></td>
							</tr>
							<tr>
								<td><strong>KDV :</strong></td>
								<td>(%18)  <i class="fa fa-try"></i><?php echo $fark; ?></td>
							</tr>
							<tr>
								<td><strong>TOPLAM :</strong></td>
								<td><i class="fa fa-try"></i><?php echo $inovanceprint['genel_toplam']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
				<div class="row">
					<div class="col-md-12 text-right">
						<div>
							<button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>  
							<?php if ($inovanceprint['siparis_durum']=='1') { ?>          
								<a href="yeni-rezervasyonlar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>   
							<?php } else { ?>
								<a href="tamamlanan-rezervasyonlar.php" class="btn btn-warning btn-icon"><i class="fa fa-reply"></i>Geri Dön</a>
							<?php } ?>       
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
