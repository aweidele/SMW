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
    </div>
  </section>
<?php endwhile; endif; wp_reset_query(); ?>
<?php foreach($childPages as $page) { 
  $template = get_page_template_slug($page->ID);
  //template-staff.php
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
            <a href="<?php echo get_permalink(); ?>" class="popupModal">
              <p class="leadershipPortrait"><img src="<?php echo get_the_post_thumbnail_url($post->post_quote_attribute->ID,'Leadership Thumb'); ?>"></p>
              <p><strong><?php echo $post->post_title; ?></strong></p>
              <p><?php echo get_field('title'); ?></p>
            </a>
<!-- 
            <p><a href="tel:<?php echo get_field('phone'); ?>">+<?php echo str_replace('-',' ',get_field('phone')); ?></a></p>
            <ul class="leadershipContact">
              <li class="email"><a href="mailto:<?php echo get_field('email'); ?>"><span><?php echo get_field('email'); ?></span></a></li>
              <li class="linkedin"><a href="<?php echo get_field('linkedin'); ?>" target="_blank"><span><?php echo get_field('linkedin'); ?></span></a></li>
            </ul>
 -->
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

<pre><?php print_r($post); ?></pre>
<pre><?php print_r($childPages); ?></pre>
</div>

<?php
get_footer();
?>