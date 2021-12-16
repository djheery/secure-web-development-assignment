<?php 
  function filePaths() {
    return array(
      'content'=>'/content',
      'scripts'=>'../assets/src',
      'css'=>'../assets/css/',
      );
  };

  function getPageName($url) {
    $pageName = '';
    $splitUrl = explode('/', $url);
    foreach($splitUrl as $split) {
      if(strpos($split, '.php') != 0) {
        return $split;
      }
    }
  };

  function getPageTitle($page) {
    $knownPages = array(
      'index.php'=>'The Home of Cinema',
      'accountSettings.php'=>'Account Settings',
      'addMovieForm.php'=>'Add A Movie!',
      'bookingForm.php'=>'Book a Film!',
      'confirmation.php'=>'Confirmed',
      'filmListings.php'=>'Watch Great Films With Us!',
      'individualFilmListing.php'=>'Find Out More',
      'loginForm.php'=>'Login to your account',
      'signUpForm.php'=>'Sign Up Today!',
    );

    $title = $knownPages[$page] ? $knownPages[$page] : $knownPages['index.php'];
    return $title;
  }

  function buildPageStart($tagline) {
    $pageStartContent = <<<PAGESTART
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../assets/css/core.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
      <title>Galactic Cinema | $tagline</title>
    </head>
    <body>
    PAGESTART;
    return $pageStartContent;  
  }
  function buildHeader($navigationLinks) {
    $headerContent = <<<HEADER
      <header id="site-header" class="bg-off-black">
        <div class="inner-container flex">
          <div class="logo">
            <a href="index.php" class="text-upper pastel-accent-clr" aria-label="Navigate to main page">
              Galactic Cinema
            </a>
          </div>
          <!-- Navigation -->
          <nav>
            <div class="nav-inner">
            <ul class="flex nav-bar">
    HEADER;
    // 
    $headerContent = addNavigationLinks($headerContent, $navigationLinks);
    $headerContent .= "</ul></div></nav></div></header>";
    return $headerContent;
  }

  function addNavigationLinks($header, $links) {
    foreach($links as $l) {
      if($l['active'] == 'true') {
        $header .= "
        <li class=\"text-upper\"><a href=\"{$l['href']}\" class=\"nav-link semi-bold nav-active-page\">{$l['text']}</a></li>";
      } else {
        $header .= "
        <li class=\"text-upper\"><a href=\"{$l['href']}\" class=\"nav-link semi-bold\">{$l['text']}</a></li>";
      }
    }
    return $header;
  }

  function startMainSection() {
    return "<main>";
  }

  function endMainSection() {
    return "</main>";
  }

  function buildHamburgerBtn() {
    $hamburger = <<<HAMBURGER
      <aside id="mobile-hamburger-menu" class="bg-off-black" aria-label="mobile navigation link">
        <div class="menu-icon flex">
          <div class="menu-line"></div>
          <div class="menu-line"></div>
          <div class="menu-line"></div>
          <div class="menu-line"></div>
        </div>
      </aside>
    HAMBURGER;

    return $hamburger;
  }

  function buildFooter() {
    $footerContent = <<<FOOTER
      <footer id="site-footer" class="bg-off-black">
        <div class="inner-container flex">      
          <div class="logo mgb-large">
            <p class="pastel-accent-clr text-upper">Cinema City</p>
          </div>
          <div class="footer-links flex">
            <section class="footer-links__section" aria-label="site-navigation" role="navigation">
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Site Navigation</h3>
              <ul class="footer-navigation-list flex mgb-mid">
                <li class="mgb-small" data-pageReference="home"><a href="#">Home</a></li>
                <li class="mgb-small" data-pageReference="about-us"><a href="#">About Us</a></li>
                <li class="mgb-small" data-pageReference="film-listings"><a href="#">Film Listings</a></li>
                <li class="mgb-small" data-pageReference="login-page"><a href="#">Login/ Join</a></li>
              </ul>
            </section>
            <section class="footer-links__section" aria-label="assignment-reference-links" role="navigation">
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Assignment References</h3>
              <ul class="footer-navigation-list mgb-mid flex">
                <li class="mgb-small" data-pageReference="home"><a href="#">Design Process</a></li>
                <li class="mgb-small" data-pageReference="about-us"><a href="#">Security Report</a></li>
                <li class="mgb-small" data-pageReference="film-listings"><a href="#">Weekly Analysis</a></li>
              </ul>
            </section>

          </div>
          <div class="copyright-statement text-center" >
            <span>Copyright &copy; Cinema City, December 2021</span>
          </div>
        </div>
      </footer>
    FOOTER;
    return $footerContent;
  }

  function buildMarketingBlock($sessionData) {
    $marketingBlock = <<<MARKETING
      <section id="marketing-section" class="page-section bg-light-grey" role="complementary">
        <div class="inner-container flex">
          <div class="page-left">
            <div class="section-heading mgb-large">
              <h2 class="heading-secondary text-upper">Want <span class="pastel-accent-clr">Exclusive</span> Discounts?</h2>
            </div>
            <div class="section-text-block mgb-large">
              <p>Exclusive discounts, early bird tickets to mattenes and much more! If this sounds good to you, you should sign up to our cinema club. It's free of charge and allows you to receive the exclusive offers listed above, and much more</p>
            </div>        
    MARKETING;

    if($sessionData) {
      $marketingBlock .= <<<DYNAMICBTNCONTENT
      <div class="buttons-container flex mgb-large">
        <div class="btn bg-strong-orange">
          <a href="accountSettings.php">View Account Settings</a>
        </div>
      </div>      
      DYNAMICBTNCONTENT;
    } else {
      $marketingBlock .= <<<DYNAMICBTNCONTENT
      <div class="buttons-container flex mgb-large">
        <div class="btn bg-strong-orange">
          <a href="signUpForm.php">Sign Up!</a>
        </div>
      </div>      
      DYNAMICBTNCONTENT;
    }

    $marketingBlock .= <<<BLOCKFINISH
    </div>
    <div class="page-right">
        <img aria-hidden="true" src="/swd-final-assignment/assets/images/camera-opperator-illustration.png" alt="" class='camera-operator-illustration'>
        </div>
      </div>
    </section>
    BLOCKFINISH;

    return $marketingBlock;
  }

  function buildPageEnd() {
    return "</body></html>";
  }  

  function makeOutputSafe($outputArray) {
    $cleanOutputArray = [];
    foreach($outputArray as $key=>$value) {
      $cleanOutputArray[$key] = htmlspecialchars($value);
    }
    return $cleanOutputArray;
  }

  function getErrorQueries($queryString) {
    $splitUrlQueries = explode('&',$queryString);
    $errorArray = [];
    $queryheading = 'error=';
    $counter = 0;
    for($i = 0; $i < count($splitUrlQueries); $i++) {
      if(strstr($splitUrlQueries[$i], 'error=') != 0) {
        $errorArray[$counter] = substr($splitUrlQueries[$i], strlen($queryheading), 
                                strlen($splitUrlQueries[$i]) - 1);
        $counter++;
      }        
    }
    return $errorArray;

  }

  function showFormErrors($errors) {
    $errorOutput = '';
    foreach($errors as $err) {
      $errorText = searchKnownErrors($err);
      $errorOutput .= <<<ERRORITEM
      <div class="warning-block bg-warning-red mgb-mid">
        <p class="user-error-text">$errorText</p>
      </div>
      ERRORITEM;
    }
    return $errorOutput;
  }

  function searchKnownErrors($error) {
    $knownErrors = array(
      "user-exists"=>"The email you entered already has an account",
      "user-error"=>"The entered username or password was wrong",
      "password-match"=>"Your passwords do not match",
      "email-match"=>"Your emails do not match",
      "email-invalid"=>"The email format you entered is invalid",
      "unknown"=>"Woops, something went wrong. Please try again later",
      "password-length"=>"Your password is too short, please enter a password more than 8 characters",
      "input-empty"=>"You must fill out all of the Inputs below",
      "member-error"=>"You must be a member to book your film",
      "booking-exists"=>"You have already booked this film",
      "account-delete-failed"=>"Your account delete failed, please try again",
      "whitespace-in-name"=>"Please do not use the space key within the first name or last name fields",
      "name-length"=>"Your name cannot be longer than 24 characters"
    );

    return array_key_exists($error, $knownErrors) ? $knownErrors[$error] : 
                                                    $knownErrors['unknown'];
    
  }
?>