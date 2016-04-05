<?php get_header();
$ppp = get_option('page_for_posts');
$newschildren = get_children(array('post_parent' => $ppp));

if(have_posts()) : while(have_posts()) : the_post(); 

  $postcats = wp_get_post_categories($post->ID);
  $author = get_field('author');
  $related = get_field('related_projects');

?>
<div id="newsWrapper">
  <nav class="subnav" id="newsNav">
    <div class="subnavContainer">
      <ul>
        <li class="active"><a href="<?php echo get_permalink($ppp); ?>">News Feed</a></li>
<?php foreach($newschildren as $newsie) { ?>
        <li><a href="<?php echo get_permalink($newsie->ID); ?>"><?php echo $newsie->post_title; ?></a></li>
<?php } ?>
      </ul>
    </div>
  </nav>
  <nav class="newsNextPrev">
    <ul>
      <li><a href="">Back</a></li>
      <li><a href="">Next</a></li>
    </ul>
  </nav>
  <article id="news-<?php echo $post->post_name; ?>">
    <section class="newsDetail">
      <div class="newsSectionContent">
        <ul class="newsInfo">
          <li>
            <ul>
<?php foreach($postcats as $c) { 
  $cat = get_category($c);
?>
              <li><?php echo '<a href="'.get_category_link( $c ).'">'.$cat->name.'</a>'; ?></li>
<?php } ?>
            </ul>
          </li>
          <li><?php the_date('M d, Y'); ?></li>
        </ul>
        <h2><?php the_title(); ?></h2>
        <div class="featureImage"><img src="<?php echo get_the_post_thumbnail_url($post->ID,'Large Slideshow'); ?>"></div>
      </div>
    </section>
    <section class="newsContent">
<?php if(is_object($author)) { ?>
      <div class="newsCopy">
          <?php the_content(); ?>
      </div>
      <div class="newsAuthor">
          <div class="leadershipCard">
            <a href="<?php echo get_permalink($author->ID); ?>" data-action="leadership">
              <p class="leadershipPortrait"><img src="<?php echo get_the_post_thumbnail_url($author->ID,'Leadership Thumb'); ?>"></p>
              <p><strong><?php echo $author->post_title; ?></strong></p>
              <p><?php echo get_field('title',$author->ID); ?></p>
            </a>
            <p><a href="tel:<?php echo get_field('phone',$author->ID); ?>">+<?php echo str_replace('-',' ',get_field('phone',$author->ID)); ?></a></p>
            <ul class="leadershipContact">
              <li class="email"><a href="mailto:<?php echo get_field('email',$author->ID); ?>"><span><?php echo get_field('email',$author->ID); ?></span></a></li>
              <li class="linkedin"><a href="<?php echo get_field('linkedin',$author->ID); ?>" target="_blank"><span><?php echo get_field('linkedin',$author->ID); ?></span></a></li>
            </ul>
          </div>
      </div>
<?php } else { ?>
      <div class="newsSectionContent">
          <?php the_content(); ?>
      </div>
<?php } ?>
    </section>
  </article>
<?php if(is_array($related)) { ?>
  <section class="newsRelated">
    <div class="newsRelatedList">
<?php foreach($related as $r) { 
  $ssid = uniqid();
  $photos = get_field('photos',$r->ID); ?>

        <article class="project" id="<?php echo $r->post_name; ?>">
          <div class="slideshowContainer" id="slideshow-<?php echo $ssid; ?>">
            <a href="<?php echo get_permalink($r->ID); ?>">
            <div class="slideshowSlider">
<?php foreach($photos as $key=>$photo) { ?>
              <div class="slide<?php if($key==0) { echo ' active'; } ?>"><img src="<?php echo $photo['sizes']['Grid Slideshow Small']; ?>"></div>
<?php } ?>
            </div>
            </a>
            <div class="slideshowOverlay">
              <div class="slideshowOverlayContainer"><h3><?php $r->post_title; ?></h3></div>
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

<?php } ?>
    </div>
  </section>
<?php } ?>
</div>
<?php 
endwhile; endif; wp_reset_query();
get_footer(); ?>