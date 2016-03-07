<?php
/* Template Name: About */
get_header();
?>

<div id="aboutWrapper">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  <section id="aboutIntro">
    <div class="pageSectionContent">
      <div class="pageSectionCopy">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
<?php endwhile;endif;wp_reset_query(); ?>
  </section>
</div>

<?php
get_footer();
?>