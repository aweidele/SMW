<?php 
  /* Template Name: Projects */ 
  get_header();
?>
<?php
$args = array(
  'post_type' => 'projects',
  'posts_per_page' => -1
);
$projects = new WP_Query($args);
$groups = array();
$i = 0;
//echo "<pre>",print_r($projects->posts),"</pre>";
if($projects->have_posts()) : while($projects->have_posts()) : $projects->the_post();
  $proj = array(
    'ID'=>$post->ID,
    'name'=>$post->post_name,
    'title'=>$post->post_title,
    'permalink'=>get_permalink(),
    'photos'=>get_field('photos')
  );
  $sub = (($i+1)%10 == 1 || ($i+1)%10 == 0) ? 'a' : 'b';
  $groups[floor($i/5)][$sub][] = $proj;
  $i++;
endwhile;endif;wp_reset_query();
$args = array(
  'post_type'=>array('services','industry','region'),
  'posts_per_page'=>-1,
  'orderby' => 'title',
  'order'   => 'ASC',
);
$filter = new WP_Query($args);
$filters = array();
if($filter->have_posts()) : while($filter->have_posts()) : $filter->the_post();
  $filters[$post->post_type][] = array(
    'title'=>$post->post_title,
    'permalink'=>get_permalink()
  );
endwhile;endif;wp_reset_query();
?>
<div id="projectsWrapper">
  <nav class="projectFilters">
    <div class="projectFiltersContainer">
      <ul class="filters">
        <li>Filter by:</li>
        <li>Industry
          <ul>
<?php foreach($filters['industry'] as $f) { ?>
            <li><a href="<?php echo $f['permalink']; ?>"><?php echo $f['title']; ?></a></li>
<?php } ?>
          </ul>
        </li>
        <li>Service
          <ul>
<?php foreach($filters['services'] as $f) { ?>
            <li><a href="<?php echo $f['permalink']; ?>"><?php echo $f['title']; ?></a></li>
<?php } ?>
          </ul>
        </li>
        <li>Region
          <ul>
<?php foreach($filters['region'] as $f) { ?>
            <li><a href="<?php echo $f['permalink']; ?>"><?php echo $f['title']; ?></a></li>
<?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  <section id="projects-intro">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php the_content(); ?>
      </div>
      <div class="projectFeature">Feature</div>
    </div>
  </section>
<?php endwhile;endif;wp_reset_query(); ?>
  
  <section id="projectsGrid">
<?php foreach($groups as $projectCols) { ?>
    <div class="projectRow">
<?php foreach($projectCols as $type => $proj) { 
  $imgsize = $type == 'a' ? 'Grid Slideshow Large' : 'Grid Slideshow Small';
?>
      <div class="projectCol<?php if($type == 'a') { echo ' projectColBig'; } ?>">
<?php foreach($proj as $project) { 
  $ssid = uniqid();
?>
        <article class="project" id="project-<?php echo $project['name']; ?>">
          <div class="slideshowContainer" id="slideshow-<?php echo $ssid; ?>">
            <a href="<?php echo $project['permalink']; ?>">
            <div class="slideshowSlider">
<?php foreach($project['photos'] as $key => $photo) { ?>
              <div class="slide <?php if($key==0) { echo ' active'; } ?>"><img src="<?php echo $photo['sizes'][$imgsize]; ?>"></div>
<?php } ?>
            </div>
            </a>
            <div class="slideshowOverlay">
              <div class="slideshowOverlayContainer"><h3><?php echo $project['title']; ?></h3></div>
            </div>
<?php if(sizeof($project['photos']) > 1) { ?>
            <div class="slideshowControls">
              <ul class="prevNext" data-slideshow="slideshow-<?php echo $ssid; ?>">
                <li><span>Previous</span></li>
                <li><span>Next</span></li>
              </ul>
              <ul class="slideshowIndicators" data-slideshow="slideshow-<?php echo $ssid; ?>">
<?php foreach($project['photos'] as $i => $photo) { ?>
                <li<?php if($i==0) { echo ' class="active"'; } ?>><span><?php echo $i; ?></span></li>
<?php } ?>
              </ul>
            </div>
<?php } ?>
          </div>
        </article>
<?php } ?>
      </div>
<?php } ?>
    </div>
<?php } ?>
  </section>
</div>
<pre><?php print_r($groups); ?></pre>
<?php get_footer(); ?>