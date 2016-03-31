<?php
/* Template Name: Services */
get_header();
$serviceArray = array();
$args = array(
  'post_type' => 'services',
  'posts_per_page' => -1
);
$services = new WP_Query($args);
if($services->have_posts()) : while($services->have_posts()) : $services->the_post();
  $post->post_quote = get_field('quote');
  $post->post_quote_attribute = get_field('quote_attribute');
  $post->post_quote_attribute->thumbnail = get_the_post_thumbnail_url($post->post_quote_attribute->ID,'Leadership Thumb');
  $post->post_thumbnail = get_the_post_thumbnail_url($post->ID,'Services Background');
  $serviceArray[] = $post;
endwhile;endif;wp_reset_query();
?>
<div id="servicesWrapper">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  <section id="services-intro">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
<?php endwhile;endif;wp_reset_query(); ?>
<?php foreach($serviceArray as $key => $service) { 
  $quote_attribute = $service->post_quote_attribute;
?>

  <section id="services-<?php echo $service->post_name; ?>">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <h2><?php echo $service->post_title; ?></h2>
        <?php echo wpautop($service->post_content); ?>
      </div>
      <div class="servicesQuote" style="background-image: url(<?php echo $service->post_thumbnail; ?>)">
        <div class="servicesQuoteText">
          <p>&ldquo;<?php echo $service->post_quote; ?>&rdquo;</p>
          <p class="viewProjects"><a href="<?php echo get_permalink($service->ID); ?>">View Projects</a></p>
        </div>
        <div class="servicesQuoteAttribute">
          <div class="leadershipCard">
            <a href="<?php echo get_permalink($quote_attribute->ID); ?>" data-action="leadership">
              <p class="leadershipPortrait"><img src="<?php echo $quote_attribute->thumbnail; ?>"></p>
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

<?php } ?>
<?php /*
<pre><?php print_r($post); ?></pre>
<pre><?php print_r($serviceArray); ?></pre>
*/ ?>
</div>
<?php get_footer(); ?>