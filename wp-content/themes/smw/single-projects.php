<?php get_header(); ?>
<div id="projectsWrapper">
<?php if(have_posts()): while(have_posts()) : the_post();
  $services                = get_field('services');
  $industry                = get_field('industry');
  $photos                  = get_field('photos');
  $project_size            = get_field('project_size');
  $completion              = get_field('completion');
  $owner                   = get_field('owner');
  $architect               = get_field('architect');
  $project_quote           = get_field('project_quote');
  $project_quote_attribute = get_field('project_quote_attribute');
  $project_quote_photo     = get_field('project_quote_photo');
  $related_projects        = get_field('related_projects');
  $tags                    = get_terms('project_tags');
?>
  <section id="singleProjectHeader">
    <div class="singleProjectTitle">
      <h2><?php the_title(); ?></h2>
    </div>
  </section>
  <section id="singleProjectSlideshow">
    <div class="servicesList">
      <ul class="servicesIcons">
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
<?php } if(sizeof($tags)) { ?>
      <aside>
        <h3>Tags</h3>
        <ul>
<?php foreach($tags as $tag) { ?>
          <li><a href="<?php echo get_term_link($tag->term_id); ?>"><?php echo $tag->name; ?></a></li>
<?php } ?>
        </ul>
      </aside>
<?php } ?>
    </div>
    <div class="projectQuote">
<?php if(is_array($project_quote_photo)) { ?>
      <p class="projectQuotePhoto"><img src="<?php echo $project_quote_photo['sizes']['Project Quote Photo']; ?>"></p>
<?php } if($project_quote != '') { ?>
      <blockquote>
        <p><?php echo $project_quote; ?></p>
<?php if($project_quote_attribute != '') { ?>
        <cite>—<?php echo $project_quote_attribute; ?></cite>
<?php } ?>
      </blockquote>
<?php } ?>
    </div>
  </section>
<?php if(sizeof($related_projects)) { ?>
  <section id="singleProjectRelated">
    <div class="relatedProjects">
      <h3>Related</h3>
      <div>
<?php foreach($related_projects as $project) { 
  $ssid = uniqid(); 
  $projPhotos = get_field('photos',$project->ID)
  ?>
        <article class="project" id="project-<?php echo $project->post_name; ?>">
          <div class="slideshowContainer" id="slideshow-<?php echo $ssid; ?>">
            <a href="<?php echo get_permalink($project-ID); ?>">
            <div class="slideshowSlider">
<?php foreach($projPhotos as $key => $photo) { ?>
              <div class="slide <?php if($key==0) { echo ' active'; } ?>"><img src="<?php echo $photo['sizes']['Grid Slideshow Small']; ?>"></div>
<?php } ?>
            </div>
            </a>
            <div class="slideshowOverlay">
              <div class="slideshowOverlayContainer"><h4><?php echo $project->post_title; ?></h4></div>
            </div>
<?php if(sizeof($projPhotos) > 1) { ?>
            <div class="slideshowControls">
              <ul class="prevNext" data-slideshow="slideshow-<?php echo $ssid; ?>">
                <li><span>Previous</span></li>
                <li><span>Next</span></li>
              </ul>
              <ul class="slideshowIndicators" data-slideshow="slideshow-<?php echo $ssid; ?>">
<?php foreach($projPhotos as $i => $photo) { ?>
                <li<?php if($i==0) { echo ' class="active"'; } ?>><span><?php echo $i; ?></span></li>
<?php } ?>
              </ul>
            </div>
<?php } ?>
          </div>
        </article>
<?php } ?>
      </div>
    </div>
  </section>
<?php } ?>
<?php endwhile; endif; wp_reset_query(); ?>
</div>
<?php get_footer(); ?>