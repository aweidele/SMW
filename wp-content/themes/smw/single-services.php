<?php get_header(); ?>
<div id="servicesWrapper">
<?php if(have_posts()) : while(have_posts()) : the_post();
  $quote_attribute = get_field('quote_attribute');
  $quote_attribute_thumbnail = get_the_post_thumbnail_url($quote_attribute->ID,'Leadership Thumb');
  $post_id = $post->ID;
?>
  <section id="services-<?php echo $post->post_name; ?>">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      </div>
      <div class="servicesQuote" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID,'Services Background'); ?>)">
        <div class="servicesQuoteText">
          <p>&ldquo;<?php echo get_field('quote'); ?>&rdquo;</p>
        </div>
        <div class="servicesQuoteAttribute">
          <div class="leadershipCard">
            <a href="<?php echo get_permalink($quote_attribute->ID); ?>" data-action="leadership">
              <p class="leadershipPortrait"><img src="<?php echo $quote_attribute_thumbnail; ?>"></p>
              <p><strong><?php echo $quote_attribute->post_title; ?></strong></p>
              <p><?php echo get_field('title',$quote_attribute->ID); ?></p>
            </a>
            <p><a href="tel:<?php echo get_field('phone',$quote_attribute->ID); ?>">+<?php echo str_replace('-',' ',get_field('phone',$quote_attribute->ID)); ?></a></p>
            <ul class="leadershipContact">
              <li class="email"><a href="mailto:<?php echo get_field('email',$quote_attribute->ID); ?>"><span><?php echo get_field('email',$quote_attribute->ID); ?></span></a></li>
              <li class="linkedin"><a href="<?php echo get_field('linkedin',$quote_attribute->ID); ?>" target="_blank"><span><?php echo get_field('linkedin',$quote_attribute->ID); ?></span></a></li>
            </ul>
          </div>
        </div>
        <div class="servicesQuoteOverlay"></div>
      </div>
    </div>
  </section>
<?php endwhile;endif;wp_reset_query(); ?>
<?php /******** LIST OF PROJECTS ********/ ?>

<?php
$args = array(
  'post_type' => 'projects',
  'meta_query' => array(
    array(
      'key' => 'services',
      'value' => sprintf(':"%s";', $post_id),
      'compare' => 'LIKE'
    )
  )
);
$projects = new WP_Query($args);
if($projects->have_posts()): ?>
  <section id="industryProjects">
<?php while($projects->have_posts()) : $projects->the_post(); 
  $ssid = uniqid();
  $photos = get_field('photos');
?>

        <article class="project" id="project-new-york-presbyterian-hospitalweill-cornell-medical-college-ophthalmology-center-2">
          <div class="slideshowContainer" id="slideshow-<?php echo $ssid; ?>">
            <a href="<?php echo get_permalink(); ?>">
            <div class="slideshowSlider">
<?php foreach($photos as $key=>$photo) { ?>
              <div class="slide<?php if($key==0) { echo ' active'; } ?>"><img src="<?php echo $photo['sizes']['Grid Slideshow Small']; ?>"></div>
<?php } ?>
            </div>
            </a>
            <div class="slideshowOverlay">
              <div class="slideshowOverlayContainer"><h3><?php the_title(); ?></h3></div>
            </div>
            <div class="slideshowControls">
              <ul class="prevNext" data-slideshow="slideshow-<?php echo $ssid; ?>">
                <li><span>Previous</span></li>
                <li><span>Next</span></li>
              </ul>
              <ul class="slideshowIndicators" data-slideshow="slideshow-<?php echo $ssid; ?>">
<?php /*for($i=0;$i>sizeof($photos);$i++); ?>
                <li<?php if($i==0) { echo ' class="active"'; } ?>><span><?php echo $i; ?></span></li>
<?php } */ ?>
              </ul>
            </div>
          </div>
        </article>

<?php endwhile; ?>
  </section>
<?php endif;wp_reset_query(); ?>

</div>
<?php get_footer(); ?>