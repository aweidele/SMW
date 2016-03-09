<?php get_header(); ?>
<div id="leadershipWrapper">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <section class="leadershipBio">
    <div class="leadershipLeft">
      <div class="leadershipCard">
        <a href="<?php echo get_permalink(); ?>" class="popupModal">
          <p class="leadershipPortrait"><img src="<?php echo get_the_post_thumbnail_url($post->post_quote_attribute->ID,'Leadership Thumb'); ?>"></p>
          <p><strong><?php echo $post->post_title; ?></strong></p>
          <p><?php echo get_field('title'); ?></p>
        </a>
        <p><a href="tel:<?php echo get_field('phone'); ?>">+<?php echo str_replace('-',' ',get_field('phone')); ?></a></p>
        <ul class="leadershipContact">
          <li class="email"><a href="mailto:<?php echo get_field('email'); ?>"><span><?php echo get_field('email'); ?></span></a></li>
          <li class="linkedin"><a href="<?php echo get_field('linkedin'); ?>" target="_blank"><span><?php echo get_field('linkedin'); ?></span></a></li>
        </ul>
      </div>
    </div>
    <div class="leadershipCopy">
<?php the_content(); ?>
    </div>
  </section>
<?php endwhile; endif; wp_reset_query(); ?>
</div>
<?php get_footer(); ?>