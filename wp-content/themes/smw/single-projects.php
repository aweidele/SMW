<?php get_header(); ?>
<div id="projectsWrapper">
<?php if(have_posts()): while(have_posts()) : the_post();
  $services     = get_field('services');
  $industry     = get_field('industry');
  $photos       = get_field('photos');
  $project_size = get_field('project_size');
  $completion   = get_field('completion');
  $owner        = get_field('owner');
  $architect    = get_field('architect');
?>
  <section id="singleProjectHeader">
    <div class="singleProjectTitle">
      <h2><?php the_title(); ?></h2>
    </div>
  </section>
  <section id="singleProjectSlideshow">
    <div class="servicesIcons">
      <ul>
<?php foreach($services as $s) { ?>
        <li><a href="<?php echo get_permalink($s->ID); ?>"><span><?php echo $s->post_title; ?></a></span></li>
<?php } ?>
      </ul>
    </div>
    <div class="projectSlideshow">
    <?php $ssid = uniqid(); ?>
          <div class="slideshowContainer" id="slideshow-<?php echo $ssid; ?>">
            <div class="slideshowSlider">
<?php foreach($photos as $key => $photo) { ?>
              <div class="slide <?php if($key==0) { echo ' active'; } ?>"><img src="<?php echo $photo['sizes']['Large Slideshow']; ?>"></div>
<?php } ?>
            </div>
<?php if(sizeof($photos) > 1) { ?>
            <div class="slideshowControls">
              <ul class="prevNext" data-slideshow="slideshow-<?php echo $ssid; ?>">
                <li><span>Previous</span></li>
                <li><span>Next</span></li>
              </ul>
              <ul class="slideshowIndicators" data-slideshow="slideshow-<?php echo $ssid; ?>">
<?php foreach($photos as $i => $photo) { ?>
                <li<?php if($i==0) { echo ' class="active"'; } ?>><span><?php echo $i; ?></span></li>
<?php } ?>
              </ul>
            </div>
<?php } ?>
          </div>
    </div>
  </section>
  <section id="singleProjectCopy">
    <div class="mainCopy">
      <h3>SM&W Contribution</h3>
      <?php the_content(); ?>
<?php if(sizeof($industry)) { ?>
      <aside>
        <h3>Industry</h3>
        <ul>
<?php foreach($industry as $ind) { ?>
          <li><a href="<?php echo get_permalink($ind->ID); ?>"><?php echo $ind->post_title; ?></a></li>
<?php } ?>
        </ul>
      </aside>
<?php }
  if($owner != '' || $architect != '') { ?>
      <aside>
        <h3>Project Team</h3>
        <?php if($owner != '') { ?><p>Owner: <?php echo $owner; ?></p><?php } ?>
        <?php if($architect != '') { ?><p>Owner: <?php echo $architect; ?></p><?php } ?>
      </aside>
<?php }
  if($project_size != '') { ?>
      <aside>
        <h3>Project Size</h3>
        <p>Area: <?php echo $project_size; ?></p>
      </aside>
<?php
}
if($completion != '') { ?>
      <aside>
        <h3>Completion</h3>
        <p><?php echo $completion; ?></p>
      </aside>
<?php } ?>
      <aside>
        <h3>Tags</h3>
      </aside>
    </div>
    <div class="projectQuote">
      Quote here.
    </div>
  </section>
<?php endwhile; endif; wp_reset_query(); ?>
</div>
<?php get_footer(); ?>