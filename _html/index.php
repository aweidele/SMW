<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta charset="UTF-8" />
<title>SMW</title>
<link rel="stylesheet" type="text/css" href="inc/style.css">

<script src="https://use.typekit.net/ngd7xng.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body>
<div class="fixedTop">
  <nav id="externalNav">
    <ul>
      <li><a href="http://www.smwllc.com">SMWLLC.com</a></li>
      <li class="facebook"><a href=""><span>Facebook</span></a></li>
      <li class="twitter"><a href=""><span>Twitter</span></a></li>
      <li class="linkedin"><a href=""><span>LinkedIn</span></a></li>
    </ul>
  </nav>
  <header>
    <h1><span>SM&W 30 Years</span></h1>
    <h2>Celebrating 30 Years of Delivering Innovative Technology & Acoustics Solutions</h2>
  </header>
  <label for="mobileMenuToggle" id="mobileMenuToggleButton"><span>Menu</span></label>
  <input type="checkbox" id="mobileMenuToggle">
  <nav id="internalNav">
    <div class="internalNavContainer">
      <ul>
        <li class="active"><a href="#past">Celebrating the Past</a></li>
        <li><a href="#future">Innovating the Future</a></li>
        <li><a href="#visions">Visions of Tomorrow</a></li>
        <li><a href="#share">Share the Celebration</a></li>
      </ul>
    </div>
  </nav>
</div>
<div id="mainContent">

  <section id="past">
    <div class="contentContainer">
      <div class="col1">
        <h2>Reflecting on 30 Years of Innovation</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam eget nisl sed finibus. Proin mattis erat velit, eget pulvinar urna commodo at. Etiam accumsan tortor libero, sed porta odio sodales a. Etiam eu lorem lacinia nisi semper fermentum sed quis nulla.</p>
        <ul class="share">
          <li class="facebook"><a href=""><span>Facebook</span></a></li>
          <li class="twitter"><a href=""><span>Twitter</span></a></li>
          <li class="linkedin"><a href=""><span>LinkedIn</span></a></li>
        </ul>
      </div>
      <div class="col2">
        <video controls>
          <source src="video/placeholder.mp4" type="video/mp4">
        </video>
      </div>
    </div>
  </section>

  <section id="future">
    <div class="contentContainer">
      <div class="col1">
        <h2>Where we're heading</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam eget nisl sed finibus. Proin mattis erat velit, eget pulvinar urna commodo at. Etiam accumsan tortor libero, sed porta odio sodales a. Etiam eu lorem lacinia nisi semper fermentum sed quis nulla.</p>
      </div>
      <div class="col2">
        <video controls>
          <source src="video/placeholder.mp4" type="video/mp4">
        </video>
      </div>
    </div>
  </section>

  <section id="visions">
    <div class="contentContainer">
      <div class="col1">
        <h2>Visions of Tomorrow</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam eget nisl sed finibus. Proin mattis erat velit, eget pulvinar urna commodo at. Etiam accumsan tortor libero, sed porta odio sodales a. Etiam eu lorem lacinia nisi semper fermentum sed quis nulla.</p>
        <ul class="share">
          <li class="facebook"><a href=""><span>Facebook</span></a></li>
          <li class="twitter"><a href=""><span>Twitter</span></a></li>
          <li class="linkedin"><a href=""><span>LinkedIn</span></a></li>
        </ul>
      </div>
      <div class="col2">

        <div class="slideshowContainer">
          <div class="slideshowSlides">
            <ul>
              <li class="active" id="slide_1"><img src="images/1.jpg"></li>
              <li id="slide_2"><img src="images/2.jpg"></li>
              <li id="slide_3"><img src="images/3.jpg"></li>
            </ul>
            <div class="spacer"><img src="images/2.jpg"></div>
            <div class="controls">
              <p class="prev"><a href="#"><span>Previous</span></a></p>
              <p class="next"><a href="#"><span>Next</span></a></p>
            </div>
          </div>
          <ul class="slideThumbs">
            <li><a href="#slide_1"><img src="images/thumb1.jpg"></a></li>
            <li><a href="#slide_2"><img src="images/thumb2.jpg"></a></li>
            <li><a href="#slide_3"><img src="images/thumb3.jpg"></a></li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <section id="share">
    <div class="contentContainer">
      <h2>Share in the Celebration</h2>
      <p class="intro">Share your favorite Shen Milsom & Wilke memory:
      <div class="shareForm">
        <div class="contactFields">
          <p><label>Full Name</label>
            <input type="text" placeholder="Enter Name"></p>
          <p><label>Email</label>
            <input type="email" placeholder="Enter Email"></p>
          <p><label>Company</label>
            <input type="text" placeholder="Enter Company"></p>
        </div>
        <div class="contactMessage">
          <p><label for="shareMessage">Message</label>
            <textarea placeholder="Enter your message" id="shareMessage"></textarea></p>
          <p class="checkbox">
            <input type="checkbox" id="agree">
            <label for="agree"><span>I agree that my message may be used on the SM&W website and on Anniversary celebration collateral.</span></label>
          </p>
          <p class="submitButton"><button>Submit</button></p>
        </div>
    </div>
    </div>
  </section>

</div>

<footer>
  <ul class="footerNav">
    <li class="active"><a href="#past">Celebrating the Past</a></li>
    <li><a href="#future">Innovating the Future</a></li>
    <li><a href="#visions">Visions of Tomorrow</a></li>
    <li><a href="#visions">SMWLLC.com</a></li>
    <li class="social">
      <ul>
        <li class="facebook"><a href=""><span>Facebook</span></a></li>
        <li class="twitter"><a href=""><span>Twitter</span></a></li>
        <li class="linkedin"><a href=""><span>LinkedIn</span></a></li>
      </ul>
    </li>
  </ul>
  <p class="copyright">©<?php echo date('Y'); ?> Shen Milsom Wilke</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="inc/script.js"></script>
</body>
</html>