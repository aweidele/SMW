<?php
/* Template Name: About */
get_header();

  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order', 'post_parent' => $id));
  $childPages = get_page_children(get_the_ID(),$all_wp_pages);


?>
<div id="aboutWrapper">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <section id="<?php echo $post->post_name; ?>">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php the_content(); ?>
      </div>
      <div class="pageSectionRight">
<?php switch(get_field('additional_content')) {
  case 'video': ?>
        <div class="oEmbedWrapper"><?php echo get_field('additional_content_video'); ?></div>
<?php break;
  case 'image': ?>
        <div class="imageWrapper"><?php echo get_field('addition_content_image'); ?></div>
<?php break;
  case 'text': 
       echo get_field('additional_text');
       break;
} ?>
      </div>
    </div>
  </section>
<?php endwhile; endif; wp_reset_query(); ?>
<?php foreach($childPages as $page) { 
  $template = get_page_template_slug($page->ID);

?>
  <section id="<?php echo $page->page_name; ?>">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php echo wpautop($page->post_content); ?>
      </div>
      <div class="pageSectionRight">
<?php if($template == "template-staff.php") {
  $args = array(
    'post_type'=>'leadership',
    'posts_per_page' => -1
  );
  $leadership = new WP_Query($args);
  if($leadership->have_posts()): ?>
        <div class="aboutLeadership">
<?php while($leadership->have_posts()) : $leadership->the_post(); ?>

          <div class="leadershipCard">
            <a href="<?php echo get_permalink(); ?>" data-action="leadership">
              <p class="leadershipPortrait"><img src="<?php echo get_the_post_thumbnail_url($post->post_quote_attribute->ID,'Leadership Thumb'); ?>"></p>
              <p><strong><?php echo $post->post_title; ?></strong></p>
              <p><?php echo get_field('title'); ?></p>
            </a>

          </div>

<?php endwhile; ?>
      </div>
<?php 
   endif; wp_reset_query();
} ?>
      </div>
    </div>
  </section>
<?php } ?>
</div>

<?php
get_footer();
?>