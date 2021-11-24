<?php 
  function buildPageStart($tagline) {
    $pageStartContent = <<<PAGESTART
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/swd-final-assignment/assets/css/core.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
      <title>City Cinema | $tagline</title>
    </head>
    <body>
    PAGESTART;
    return $pageStartContent;  
  }
  function buildHeader() {
    $headerContent = <<<HEADER
      <header id="site-header" class="bg-off-black">
        <div class="inner-container flex">
          <div class="logo">
            <a href="/content/index.html">
              <span class="text-upper pastel-accent-clr">Cinema City</span>
            </a>
          </div>
          <!-- Navigation -->
          <nav>
            <ul class="flex nav-bar" data-login='false'>
              <li class="text-upper" data-pageReference="whats-on"><a href="/content/film-listings.html" class="nav-link semi-bold">What's On</a></li>
              <li class="text-upper" data-pageReference="cinema-club"><a href="#" class="nav-link semi-bold">Cinema Club</a></li>
              <li class="text-upper" data-pageReference="about-us"><a href="#" class="nav-link semi-bold">About Us</a></li>
              <li class="text-upper" data-pageReference="login-page"><a href="#" class="nav-link semi-bold" >Login/ Join</a></li>
            </ul>
          </nav>
        </div>
      </header>
    HEADER;
    return $headerContent;
  }

  function startMainSection() {
    return "<main>";
  }
  function endMainSection() {
    return "</main>";
  }

  function buildHamburgerBtn() {
    $hamburger = <<<HAMBURGER
      <aside id="mobile-hamburger-menu" class="bg-off-black" data-menuStatus="inactive">
        <div class="menu-icon flex">
          <div class="menu-line"></div>
          <div class="menu-line"></div>
          <div class="menu-line"></div>
          <div class="menu-line"></div>
        </div>
      </aside>
    HAMBURGER;
  }

  function buildFooter() {
    $footerContent = <<<FOOTER
      <footer id="site-footer" class="bg-off-black">
        <div class="inner-container flex">      
          <div class="logo mgb-large">
            <p class="pastel-accent-clr text-upper">Cinema City</p>
          </div>
          <div class="footer-links flex"> <!-- Ask if a semtantic tag would be semantically correct here? -->
            <section class="footer-links__section">
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Site Navigation</h3>
              <ul class="footer-navigation-list flex mgb-mid">
                <li class="mgb-small" data-pageReference="home"><a href="#">Home</a></li>
                <li class="mgb-small" data-pageReference="about-us"><a href="#">About Us</a></li>
                <li class="mgb-small" data-pageReference="film-listings"><a href="#">Film Listings</a></li>
                <li class="mgb-small" data-pageReference="login-page"><a href="#">Login/ Join</a></li>
              </ul>
            </section>
            <section class="footer-links__section"> <!-- Ask if a semtantic tag would be semantically correct here? -->
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Assignment References</h3>
              <ul class="footer-navigation-list mgb-mid flex">
                <li class="mgb-small" data-pageReference="home"><a href="#">Design Process</a></li>
                <li class="mgb-small" data-pageReference="about-us"><a href="#">Security Report</a></li>
                <li class="mgb-small" data-pageReference="film-listings"><a href="#">Weekly Analysis</a></li>
              </ul>
            </section>
            <section id="social-media" class="footer-links__section"> <!-- Ask if a semtantic tag would be semantically correct here? -->
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Social Media</h3>
              <ul class="footer-navigation-list mgb-mid flex">
                <li class="mgb-small"><a href="#" target="_blank">Facebook</a></li>
                <li class="mgb-small"><a href="#" target="_blank">Instagram</a></li>
                <li class="mgb-small"><a href="#" target="_blank">Twitter</a></li>
                <li class="mgb-small"><a href="#" target="_blank">YouTube</a></li>
              </ul>
            </section>
          </div>
          <section class="copyright-statement text-center">
            <span>Copyright &copy; Cinema City, December 2021</span>
          </section>
        </div>
      </footer>
    FOOTER;
    return $footerContent;
  }

  function buildPageEnd() {
    return "</body></html>";
  }

  
?>