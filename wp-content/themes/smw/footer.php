<?php 
  
?>
<footer>
  <div id="footerContent">
    <nav id="footerNav">
      <ul>
<?php smw_nav('footer-menu'); ?>
        <li><ul class="social">
          <li><a href=""><span>Facebook</span></a></li>
          <li><a href=""><span>Facebook</span></a></li>
          <li><a href=""><span>Facebook</span></a></li>
        </ul></li>
      </ul>
    </nav>
    <ul class="copyInfo">
      <li>&copy; <?php echo date('Y').' '.get_option('smw_copyright'); ?></li>
      <li><a href="">Site Map</a></li>
      <li><a href="">Log In</a></li>
    </ul>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>