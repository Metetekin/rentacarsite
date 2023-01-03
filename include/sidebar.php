
<!-- Sidebar Widgets -->
<div class="blog-sidebar">
  <!-- Categories --> 
  <div class="widget">
   <div class="widget-heading">
    <h4 class="panel-title"><a>Yan Menü</a></h4>
  </div>
  <div class="widget-content categories">
    <ul>
      <?php 
      $flink=$db->prepare("SELECT * from flink order by flink_sira");
      $flink->execute(array(0));
      while ($flinkprint=$flink->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <li> <a href="<?php echo $flinkprint['flink_link']; ?>"> <?php echo $flinkprint['flink_ad']; ?> </a> </li>
      <?php } ?>
    </ul>
  </div>
</div>
</div>
<!-- Sidebar Widgets End -->
