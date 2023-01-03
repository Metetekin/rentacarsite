<?php 
require 'include/head.php';
$metakey=$db->prepare("SELECT * from meta where meta_id=5");
$metakey->execute(array(0));
$metakeyprint=$metakey->fetch(PDO::FETCH_ASSOC);
$meta = [
  'title' => $metakeyprint['meta_title'],
  'desc' => $metakeyprint['meta_descr'],
  'key' => $metakeyprint['meta_keyword']
];
require 'include/header.php';

?>

<!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
<div class="page-header-area-2 gray">
 <div class="container">
  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="small-breadcrumb">
     <div class=" breadcrumb-link">
      <ul>
       <li><a href="<?php echo $settingsprint['ayar_siteurl'] ?>">Anasayfa</a></li>
       <li><a class="active" >SSS</a></li>
     </ul>
   </div>
   <div class="header-page">
    <h1>SIK SORULAN SORULAR</h1>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
 <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
 <section class="section-padding no-top gray ">
  <!-- Main Container -->
  <div class="container">
   <!-- Row -->
   <div class="row">
    <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
     <!-- end post-padding -->
     <div class="post-ad-form postdetails">
      <form  class="submit-form">
       <!-- Title  -->
       <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
         <label class="control-label">Car Title</label>
         <input class="form-control" placeholder="Brand new honda civic 2017 for sale" type="text">
       </div>
     </div>
     <div class="row">
      <!-- Category  -->
      <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
       <label class="control-label">Select Make </label>
       <select class=" form-control make">
        <option label="Any Make"></option>
        <option>BMW</option>
        <option>Honda </option>
        <option>Hyundai </option>
        <option>Nissan </option>
        <option>Mercedes Benz </option>
      </select>
    </div>
    <!-- Price  -->
    <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
     <label class="control-label">Price<small>USD only</small></label>
     <input class="form-control" placeholder="$350" type="text">
   </div>
 </div>
 <!-- end row -->
 <div class="row">
  <!-- Category  -->
  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Manufacture Year </label>
   <select class=" form-control make">
    <option label="Any Make"></option>
    <option>BMW</option>
    <option>Honda </option>
    <option>Hyundai </option>
    <option>Nissan </option>
    <option>Mercedes Benz </option>
  </select>
</div>
<!-- Price  -->
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
 <label class="control-label">Select Body Type</label>
 <select class=" form-control make">
  <option label="Any Make"></option>
  <option>BMW</option>
  <option>Honda </option>
  <option>Hyundai </option>
  <option>Nissan </option>
  <option>Mercedes Benz </option>
</select>
</div>
</div>
<!-- end row -->
<div class="row">
  <!-- Category  -->
  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Transmission Type</label>
   <select class=" form-control make">
    <option label="Any Make"></option>
    <option>BMW</option>
    <option>Honda </option>
    <option>Hyundai </option>
    <option>Nissan </option>
    <option>Mercedes Benz </option>
  </select>
</div>
<!-- Price  -->
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
 <label class="control-label">Drive Type</label>
 <select class=" form-control make">
  <option label="Any Make"></option>
  <option>BMW</option>
  <option>Honda </option>
  <option>Hyundai </option>
  <option>Nissan </option>
  <option>Mercedes Benz </option>
</select>
</div>
</div>
<!-- end row -->
<!-- Image Upload  -->
<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
   <label class="control-label">Select Additional Features Your Car Has</label>
   <!-- Brands List -->                    
   <div class="skin-minimal">
    <ul class="list">
     <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-1">
      <label for="minimal-checkbox-1">Alloy Wheels </label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-2">
      <label for="minimal-checkbox-2">ABS </label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-3">
      <label for="minimal-checkbox-3">Air Bags </label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-4">
      <label for="minimal-checkbox-4">Air Conditioning</label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-5">
      <label for="minimal-checkbox-5">CD Player</label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-6">
      <label for="minimal-checkbox-6">Cool Box</label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-7">
      <label for="minimal-checkbox-7">AM/FM Radio</label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-8">
      <label for="minimal-checkbox-8">Bonnet Protector</label>
    </li>
    <li class="col-md-4 col-sm-6 col-xs-12">
      <input  type="checkbox" id="minimal-checkbox-9">
      <label for="minimal-checkbox-9">Power Steering</label>
    </li>
  </ul>
</div>
<!-- Brands List End -->  
</div>
</div>
<!-- end row -->
<!-- Image Upload  -->
<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
   <label class="control-label">Photos for your ad <small>Please add images of your ad. (350x450)</small></label>
   <div id="dropzone" class="dropzone"></div>
 </div>
</div>
<!-- end row -->
<!-- Ad Description  -->
<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
   <label class="control-label">Ad Description <small>Enter long description for your project</small></label>
   <textarea name="editor1" id="editor1" rows="12" class="form-control" placeholder=""></textarea>
 </div>
</div>
<!-- end row -->
<!-- Ad Tags  -->
<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
   <label class="control-label">Ad Tags </label>
   <input class="form-control" name="tags" id="tags" value="honda ,honda civic,sport car" >
 </div>
</div>
<!-- end row -->
<!-- Ad Type  -->
<div class="row">
  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Type Of Ad<small>want to buy or sale</small></label>
   <div class="skin-minimal">
    <ul class="list">
     <li>
      <input tabindex="7" type="radio" id="minimal-radio-1" name="minimal-radio">
      <label  for="minimal-radio-1">I want to sell </label>
    </li>
    <li>
      <input tabindex="8" type="radio" id="minimal-radio-2" name="minimal-radio" checked>
      <label for="minimal-radio-2">I want to buy</label>
    </li>
  </ul>
</div>
</div>
<!-- Ad Condition  -->
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
 <label class="control-label">Condition<small>Item Condition</small></label>
 <div class="skin-minimal">
  <ul class="list">
   <li>
    <input type="radio" id="new" name="minimal-radio">
    <label  for="new">New</label>
  </li>
  <li>
    <input type="radio" id="used" name="minimal-radio" checked>
    <label for="used">Used</label>
  </li>
</ul>
</div>
</div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Your Name</label>
   <input class="form-control" placeholder="eg John Doe" type="text">
 </div>
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Your Email ID<small>where you receive your emails</small></label>
   <input class="form-control" placeholder="contact@scriptsbundle.com" type="text">
 </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Mobile Number<small>number for conformation</small></label>
   <input class="form-control" placeholder="eg +92-0321-123-456-789" type="text">
 </div>
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
   <label class="control-label">Address<small>your permanent address</small></label>
   <input class="form-control" placeholder="eg House no 8 Streent no 2 New York" type="text">
 </div>
</div>
<button class="btn btn-theme pull-right">Publish My Ad</button>
</form>
</div>
<!-- end post-ad-form-->
</div>
<!-- end col -->
<!-- Right Sidebar -->
<div class="col-md-4 col-xs-12 col-sm-12">
 <!-- Sidebar Widgets -->
 <div class="blog-sidebar">
  <!-- Categories --> 
  <div class="widget">
   <div class="widget-heading">
    <h4 class="panel-title"><a>Saftey Tips </a></h4>
  </div>
  <div class="widget-content">
    <p class="lead">Posting an ad on <a href="#">Carspot</a> is free! However, all ads must follow our rules:</p>
    <ol>
     <li>Make sure you post in the correct category.</li>
     <li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
     <li>Do not upload pictures with watermarks.</li>
     <li>Do not post ads containing multiple items unless it's a package deal.</li>
     <li>Do not put your email or phone numbers in the title or description.</li>
     <li>Make sure you post in the correct category.</li>
     <li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
     <li>Do not upload pictures with watermarks.</li>
     <li>Do not post ads containing multiple items unless it's a package deal.</li>
   </ol>
 </div>
</div>
<!-- Latest News --> 
</div>
<!-- Sidebar Widgets End -->
</div>
<!-- Middle Content Area  End --><!-- end col -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
<?php  include 'include/footer.php'; ?>
