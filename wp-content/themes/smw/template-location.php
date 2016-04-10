<?php
/* Template Name: Locations */
get_header();
$args = array(
'post_type'        => 'location',
'posts_per_page' => -1
);
$loc = get_posts($args);
?>
<div id="locationsWrapper">
  <div class="locationsTop">
    <nav class="locationsNav">
      <div class="locationsList">
        <ul>
<?php foreach($loc as $location) { ?>
          <li><a href="<?php echo get_permalink($location->ID); ?>"><?php echo $location->post_title; ?></a></li>
<?php } ?>
        </ul>
      </div>
    </nav>
  </div>
  <section class="locationsMap">
      <?php echo do_shortcode('[mapplic id="6" h="670"]'); ?>
  </section>
</div>
<div>
</div>
<?php get_footer(); ?>