<?php get_header(); ?>
<div id="industryWrapper">
  <section id="industryContent">
<?php if(have_posts()) : while(have_posts()) : the_post();
  $subheading = get_field('subheading');
  $leadership = get_field('industry_leader');
  $industry_leader = $leadership[0];
  $industry_leader->thumbnail = get_the_post_thumbnail_url($industry_leader->ID,'Leadership Thumb');

  $post_id = $post->ID;
?>
    <div class="pageSectionCopy">
      <h2><?php
        if($subheading != '') {
          echo $subheading;
        } else {
          the_title();
        }
      ?></h2>
      <?php the_content(); ?>
    </div>
    <div class="industryQuote" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID,'Services Background'); ?>)">
      <div class="industryQuoteText">
        <p>&ldquo;<?php echo get_field('quote'); ?>&rdquo;</p>
        <p class="industryQuoteAttribution">—<?php echo get_field('quote_attribution'); ?></p>
        <p class="downloadBrochure"><a href="">Download Brochure</a></p>
      </div>
      <div class="industryLeader">
        <div class="leadershipCard">
          <a href="<?php echo get_permalink($industry_leader->ID); ?>" data-action="leadership">
            <p class="leadershipPortrait"><img src="<?php echo $industry_leader->thumbnail; ?>"></p>
            <p><strong><?php echo $industry_leader->post_title; ?></strong></p>
            <p><?php echo get_field('title',$industry_leader->ID); ?></p>
          </a>
          <p><a href="tel:<?php echo get_field('phone',$industry_leader->ID); ?>">+<?php echo str_replace('-',' ',get_field('phone',$industry_leader->ID)); ?></a></p>
          <ul class="leadershipContact">
            <li class="email"><a href="mailto:<?php echo get_field('email',$industry_leader->ID); ?>"><span><?php echo get_field('email',$industry_leader->ID); ?></span></a></li>
            <li class="linkedin"><a href="<?php echo get_field('linkedin',$industry_leader->ID); ?>" target="_blank"><span><?php echo get_field('linkedin',$industry_leader->ID); ?></span></a></li>
          </ul>
        </div>
      </div>
      <div class="industryQuoteOverlay"></div>
    </div>
<?php endwhile;endif;wp_reset_query(); ?>
  </section>
<?php
$args = array(
  'post_type' => 'projects',
  'meta_query' => array(
    array(
      'key' => 'industry',
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