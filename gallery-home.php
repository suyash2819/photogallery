<?php
include './functions.php';//as functions.php is outside inc folder.
 ?>
 <section class="gallery-content">
   <div class="section-header center">
      <h2>Gallery Images</h2>
   </div>
   <div class="container space">
     <div class="row">
        <?php get_home_gallery_content(6); ?>
     </div>
   </div>
 </section>
