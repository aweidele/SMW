<?php 
  /* Template Name: Projects */ 
  get_header();
  $view = isset($_GET['v']) ? $_GET['v'] : 'grid';
?>
<?php
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
      <ul class="views">
        <li class="gridview"><a href="?v=grid"><span>Grid</span></a></li>
        <li class="listview"><a href="?v=list"><span>List</span></a></li>
        <li class="locationview"><a href="?v=location"><span>Location</span></a></li>
      </ul>
    </div>
  </nav>
<?php switch($view) {
  case 'grid': 
  /************************ GRID VIEW ***************************************************/
   ?>
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
<?php 
  $groups = groupProjects();
  foreach($groups as $projectCols) { ?>
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
<?php break;
  case 'list':
  /************************ LIST VIEW ***************************************************/ ?>
  <section id="projects-list">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php the_content(); ?>
      </div>
      <div class="projectListView">
        <div class="row">
          <div class="th">Project</div>
          <div class="th">Location</div>
          <div class="th">Industry</div>
          <div class="th">Service</div>
        </div>
<?php
  $args = array(
    'post_type' => 'projects',
    'posts_per_page' => -1
  );
  $projects = new WP_Query($args);
  $jslist = array();
  if($projects->have_posts()) : while($projects->have_posts()) : $projects->the_post();
    $industry = get_field('industry');
    $services = get_field('services');
?>
        <div class="row">
          <div class="col"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
          <div class="col"><?php echo get_field('location'); ?></div>
          <div class="col"><ul class="industry">
<?php foreach($industry as $ind) { ?>
            <li><a href="<?php echo get_permalink($ind->ID); ?>"><?php echo $ind->post_title; ?></a></li>
<?php } ?>
          </ul></div>
          <div class="col"><ul class="servicesIcons">
<?php foreach($services as $s) { ?>
            <li><a href="<?php echo get_permalink($s->ID); ?>"><span><?php echo $s->post_title; ?></a></span></li>
<?php } ?>
          </ul></div>
        </div>
<?php endwhile;endif;wp_reset_query(); ?>
      </div>
    </div>
  </section>
<?php break;
} ?>
</div>
<?php get_footer(); 

function groupProjects() {
  $args = array(
    'post_type' => 'projects',
    'posts_per_page' => -1
  );
  $projects = new WP_Query($args);
  $groups = array();
  $i = 0;

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
  return $groups;
}

?>