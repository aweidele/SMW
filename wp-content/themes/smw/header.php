<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta charset="UTF-8" />
<title><?php 
  if (is_front_page()) { 
    echo get_bloginfo('name');
    if (get_bloginfo('description')!="") { echo " | ".get_bloginfo('description'); }
  } else {
    wp_title ( ' | ', true,'right' );
    echo get_bloginfo('name');
  } ?></title>
<?php wp_head(); ?>
<script src="https://use.typekit.net/ngd7xng.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body>
<div class="fixedTop">
  <nav id="topNav">
    <ul>
      <li><a href="">Contact</a></li>
      <li><a href="">Careers</a></li>
      <li><ul class="social">
         <li><a href=""><span>Facebook</span></a></li>
         <li><a href=""><span>Twitter</span></a></li>
         <li><a href=""><span>LinkedIn</span></a></li>
      </ul></li>
      <li class="search">
        <span>...</span>
      </li>
    </ul>
  </nav>
  <header>
    <div id="headerContent">
      <h1 style="background-image: url('<?php echo get_option('smw_logo'); ?>')"><a href="<?php echo get_home_url(); ?>"><span><?php echo get_bloginfo('name'); ?></span></a></h1>
      <nav>
        <ul>
<?php smw_nav('primary-menu'); ?>
        </ul>
      </nav>
    </div>
  </header>
</div>
