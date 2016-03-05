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
  <section id="services-intro">
    This is the intro
  </section>
<?php foreach($serviceArray as $key => $service) { 
  $quote_attribute = $service->post_quote_attribute;
?>

  <section id="services-<?php echo $service->post_name; ?>">
    <div class="servicesContent">
      <div class="servicesCopy">
        <h2><?php echo $service->post_title; ?></h2>
        <?php echo wpautop($service->post_content); ?>
      </div>
      <div class="servicesQuote" style="background-image: url(<?php echo $service->post_thumbnail; ?>)">
        <div class="servicesQuoteText">
          <p>&ldquo;<?php echo $service->post_quote; ?>&rdquo;</p>
          <p class="viewProjects"><a href="">View Projects</a></p>
        </div>
        <div class="servicesQuoteAttribute">
          <p class="leadershipPortrait"><img src="<?php echo $quote_attribute->thumbnail; ?>"></p>
          <p><strong><?php echo $quote_attribute->post_title; ?></strong></p>
          <p><?php echo get_field('title',$quote_attribute->ID); ?></p>
          <p>+<?php echo str_replace('-',' ',get_field('phone',$quote_attribute->ID)); ?></p>
        </div>
        <div class="servicesQuoteOverlay"></div>
      </div>
    </div>
  </section>

<?php } ?>
<pre><?php print_r($post); ?></pre>
<pre><?php print_r($serviceArray); ?></pre>
</div>
<?php get_footer(); ?>