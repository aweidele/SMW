<?php
/* Template Name: Locations */
get_header();
?>
<div id="locationsWrapper">
  <div class="locationsTop">
    <nav class="locationsNav">
      <div class="locationsList">
        <ul>
        
        </ul>
      </div>
    </nav>
    <section class="locationsMap">
      <?php echo do_shortcode('[mapplic id="6" h="670"]'); ?>
    </section>
  </div>
</div>
<div>
<?php 
$args = array(
'post_type'        => 'location',
'posts_per_page' => -1
);
$posts_array = get_posts($args);
echo '<pre>',print_r($posts_array),'</pre>';
?>
</div>
<?php get_footer(); ?>