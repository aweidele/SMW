<?php
/* Template Name: Homepage */
get_header();
$homepage_sections = get_field('homepage_sections');
?>
<div id="homepageWrapper">
<?php foreach($homepage_sections as $section) {
  sectionGo($section);
} ?>
</div>
<pre><?php print_r($homepage_sections); ?></pre>
<?php get_footer(); ?>
<?php
function sectionGo($section) {
  switch($section['section_content']) {
    case "services";
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

<?php
    break;

    case "expertise";
     $args = array(
       'post_type'  => 'projects',
       'posts_per_page' => -1,
       'meta_key'   => 'featured_on_homepage',
       'meta_value' => 1
     );
     $projectsQuery = new WP_Query($args);
     if($projectsQuery->have_posts()) : while($projectsQuery->have_posts()) : $projectsQuery->the_post();
       $id = get_the_ID();
       $expertise = get_field('expertise');
     endwhile; endif; wp_reset_query();
?>

  <!-- EXPERTISE -->
  <section id="homepageExpertise">
    <h2><?php echo $section['section_title']; ?></h2>
    <p class="sectionStatement"><?php echo $section['section_blurb']; ?></p>
    <pre>
<?php

?>
    </pre>
  </section>

<?php
    break;
?>
<?php 
  }
} ?>