<?php
/* Template Name: Homepage */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
get_header();
?>
<div id="homepageWrapper">
<?php 
$homepage_sections = get_field('homepage_sections');
foreach($homepage_sections as $k => $section) {
  switch($section['section_content']) {
    case "video":
?>

  <!-- VIDEO -->
  <section id="homepageVideo">
    <div class="videoLayer">
      <video autoplay loop muted>
        <source src="http://smwllc.flywheelsites.com/SPLASH/timelapse.mp4" type="video/mp4">
      </video>
    </div>
    <div class="dotLayer"></div>
    <div class="contentLayer">
      <div class="contentLayerContent">
        <p><?php echo $section['section_blurb']; ?></p>
        <p class="jumplink"><a href="#<?php
          switch($homepage_sections[$k+1]['section_content']) {
            case "services":
              echo 'homepageServices';
              break;
            case "expertise":
              echo 'homepageExpertise';
              break;
            case "contact":
              echo 'homepageContact';
              break;
          }
        ?>"><?php echo $section['jump_button_text']; ?></a></p>
      </div>
    </div>
  </section>
  <!-- END VIDEO -->
<?php
    break;
    case "services":
?>

  <!-- SERVICES -->
  <section id="homepageServices">
    <h2><?php echo $section['section_title']; ?></h2>
    <p class="sectionStatement"><?php echo $section['section_blurb']; ?></p>
    <div class="servicesTiles">

<?php
  $args = array(
    'post_type' => 'services',
    'posts_per_page' => -1,
  );
  $servicesQuery = new WP_Query($args);
  if($servicesQuery->have_posts()) : while($servicesQuery->have_posts()) : $servicesQuery->the_post();
?>
      <article>
        <a href="<?php echo get_permalink(); ?>">
        <p class="icon"></p>
        <p class="blurb"><?php echo get_field('homepage_blurb'); ?></p>
        <p class="readmore">Read More ></p>
        </a>
      </article>
<?php endwhile; endif; wp_reset_query(); ?>

    </div>
  </section>
  <!-- END SERVICES -->

<?php
    break;

    case "expertise";
      $expSort = array();
      $expArray = array();
      foreach($section['featured_projects'] as $project) {
        $project->slideImage = project_thumb($project->ID,'Homepage Slideshow Thumb');
        $industry = get_field('industry',$project->ID);
        if(is_array($industry)) {
          foreach($industry as $exp) {
            $expSort[$exp->ID] = $exp->post_title;
            $expArray[$exp->post_name]['permalink'] = get_permalink($exp->ID);
            $expArray[$exp->post_name]['name'] = $exp->post_title;
            $expArray[$exp->post_name]['posts'][] = $project;
          }
        }
      }
      array_multisort($expSort,$expArray);
?>

  <!-- EXPERTISE -->
  <section id="homepageExpertise">
    <h2><?php echo $section['section_title']; ?></h2>
    <p class="sectionStatement"><?php echo $section['section_blurb']; ?></p>
    <div class="expertiseTiles">
<?php foreach($expArray as $expID => $exp) { ?>

    <article id="expertise-<?php echo $expID; ?>">
      <div class="slideshowContainer" id="slideshow-<?php echo $expID; ?>">
        <div class="slideshowSlider">

<?php foreach($exp['posts'] as $project) { ?>
            <div class="slide"><a href="<?php echo $exp['permalink']; ?>"><?php echo $project->slideImage; ?></a></div>
<?php } ?>

        </div>
        <div class="slideshowOverlay">
          <div class="slideshowOverlayContainer"><h3><a href="<?php echo $exp['permalink']; ?>"><?php echo $exp['name']; ?></a></h3></div>
        </div>
<?php if(sizeof($exp['posts']) > 1) { ?>
        <div class="slideshowControls">
          <ul class="prevNext" data-slideshow="slideshow-<?php echo $expID; ?>">
            <li><span>Previous</span></li>
            <li><span>Next</span></li>
          </ul>
          <ul class="slideshowIndicators" data-slideshow="slideshow-<?php echo $expID; ?>">
<?php foreach($exp['posts'] as $i => $project) { ?>
            <li<?php if($i==0) { echo ' class="active"'; } ?>><span><?php echo $i; ?></span></li>
<?php } ?>
          </ul>
        </div>
<?php } ?>
      </div>
    </article>

<?php } ?>


    </div>
  </section>

<?php

    break;

    case "locations";
?>

  <!-- LOCATIONS -->
  <section id="homepageLocations">
    <div class="homepageLocationCopy">
      <h2><?php echo $section['section_title']; ?></h2>
      <p class="sectionStatement"><?php echo $section['section_blurb']; ?></p>
    </div>
    <div class="locationsMap">
      <?php echo do_shortcode('[mapplic id="6" h="970"]'); ?>
    </div>
  </section>
  <!-- END LOCATIONS -->

<?php
    break;

    case "contact";
?>

  <!-- CONTACT -->
  <section id="homepageContact">
    <h2><?php echo $section['section_title']; ?></h2>
    <p class="sectionStatement"><?php echo $section['section_blurb']; ?></p>
    <div class="contactColumn">
<?php echo $section['contact_column_1']; ?>
    </div>
    <div class="contactColumn">
<?php echo $section['contact_column_2']; ?>
    </div>  
    <div class="contactColumn">
<?php echo $section['contact_column_3']; ?>
      <form>
        <p><input type="email" name="email" placeholder="E-mail Address"></p>
      </form>
<?php
  $fb = get_option('smw_fb');
  $fbtext = get_option('smw_fbtext');
  $tw = get_option('smw_tw');
  $twtext = get_option('smw_twtext');
  $li = get_option('smw_li');
  $litext = get_option('smw_litext');
  
  if($fb != '' || $tw != '' || $li != '') {
    echo "  <ul class=\"socailLinks\">\n";
    if($fb != '') { echo "    <li><a href=\"$fb\" target=\"_blank\">".($fbtext != '' ? $fbtext : 'Facebook')."</a></li>\n"; }
    if($tw != '') { echo "    <li><a href=\"$tw\" target=\"_blank\">".($twtext != '' ? $twtext : 'Twitter')."</a></li>\n"; }
    if($li != '') { echo "    <li><a href=\"$li\" target=\"_blank\">".($litext != '' ? $litext : 'LinkedIn')."</a></li>\n"; }
    echo "  </ul>\n";
  }
?>
    </div>
  </section>
<?php 
      break;
  }
} ?>

</div>
<?php get_footer(); ?>
