<?php 
  // get the file path
  function filePaths() {
    return array(
      'content'=>'/content',
      'scripts'=>'../assets/src',
      'css'=>'../assets/css/',
      );
  };

  // return the page name so that it can be used for the page title
  function getPageName($url) {
    $pageName = '';
    $splitUrl = explode('/', $url);
    foreach($splitUrl as $split) {
      if(strpos($split, '.php') != 0) {
        return $split;
      }
    }
  };
  
  // Depending on the page display a different page title. titles up in the below array to find the designated output
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
      'securityReport.php'=>'Security Report'
    );

    $title = $knownPages[$page] ? $knownPages[$page] : $knownPages['index.php'];
    return $title;
  }

  // Start the page
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

  // Build the header
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
    // get the navigation links and display them
    $headerContent = addNavigationLinks($headerContent, $navigationLinks, 'header');
    $headerContent .= "</ul></div></nav></div></header>";
    return $headerContent;
  }

  // Add navigation lionks to the header or footer
  function addNavigationLinks($navigationContainer, $links, $callingFunction) {
    foreach($links as $l) {
      if($l['active'] == 'true') {
        if($callingFunction == 'header') {    
          $navigationContainer .= "
          <li class='text-upper' aria-label='Current Page'><a href={$l['href']} class='nav-link semi-bold nav-active-page'>{$l['text']}</a></li>";
        } else {
          $navigationContainer .= "<li class='mgb-small '><a href='{$l['href']}' class'nav-active-page nav-link'>{$l['text']}</a></li>";
        }
      } else {
        if($callingFunction == 'header') {
          $navigationContainer .= "
          <li class='text-upper'><a href='{$l['href']}' class='nav-link semi-bold'>{$l['text']}</a></li>";          
        } else {
          $navigationContainer .= "<li class='mgb-small' ><a href='{$l['href']}'>{$l['text']}</a></li>";
        }
      }
    }
    return $navigationContainer;
  }

  function startMainSection() {
    return "<main>";
  }

  function endMainSection() {
    return "</main>";
  }

  // Build the mobbile hamburger button
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

  // Build the footer
  function buildFooter($links) {
    $footerContent = <<<FOOTER
      <footer id="site-footer" class="bg-off-black">
        <div class="inner-container flex">      
          <div class="logo mgb-large">
            <p class="pastel-accent-clr text-upper">Galactic Cinema</p>
          </div>
          <div class="footer-links flex">
            <section class="footer-links__section" aria-label="site-navigation" role="navigation">
              <h3 class="footer-link-heading mgb-mid text-upper pastel-accent-clr footer-section-header">Site Navigation</h3>
              <ul class="footer-navigation-list flex mgb-mid">
    FOOTER;
    // Add the navigation links depending on the login status
    $footerContent = addNavigationLinks($footerContent, $links, 'footer');

    $footerContent .= <<<FOOTER
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
            <span>Copyright &copy; Galactic Cinema, December 2021</span>
          </div>
        </div>
      </footer>
    FOOTER;

    
    return $footerContent;
  }


  // Sign up/ view account settings call to action
  function buildMarketingBlock($sessionData) {
    $marketingBlock = <<<MARKETING
      <section id="marketing-section" class="page-section bg-light-grey" role="complementary">
        <div class="inner-container flex">
          <div class="page-left">
            <div class="section-heading mgb-large">
              <h2 class="heading-secondary text-upper">The <span class="pastel-accent-clr">Galaxies</span> Best Film <span class="pastel-accent-clr">Experience</span></h2>
            </div>
            <div class="section-text-block mgb-large">
              <p>An account with us offers you the most extraordinary film experience in the known universe. Book yourself a movie with us today, we promise you won't regret it!</p>
            </div>        
    MARKETING;
    // If the user is logged in display view account settings else display signup
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

  // Loop that will sanitize a given output array
  function makeOutputSafe($outputArray) {
    $cleanOutputArray = [];
    foreach($outputArray as $key=>$value) {
      $type = gettype($value);
      if($type == 'string') {
        $cleanOutputArray[$key] = htmlspecialchars($value);
      } elseif($type == 'array') {
        // Recursive call if the array item is an array
        $cleanOutputArray[$key] = makeOutputSafe($value);
      } 
    }
    return $outputArray;
  }

  // Deals with parseing the urlErrorQueries back to a variable so they can be displayed on the page
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

  // show form errors 
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

  // Look up the error in this array and display the correct one.

  function searchKnownErrors($error) {
    $knownErrors = array(
      "user-exists"=>"The email you entered already has an account",
      "user-error"=>"The entered username or password was wrong",
      "password-match"=>"Your passwords do not match",
      "email-match"=>"Your emails do not match",
      "email-invalid"=>"The email format you entered is invalid",
      "unknown"=>"Your input entry was invalid",
      "password-length"=>"Your password is too short, please enter a password more than 8 characters",
      "input-empty"=>"You must fill out all of the Inputs below",
      "member-error"=>"You must be a member to book your film",
      "booking-exists"=>"You have already booked this film",
      "account-delete-failed"=>"Your account delete failed, please try again",
      "whitespace-in-name"=>"Please do not use the space key within the first name or last name fields",
      "name-length"=>"Your name cannot be longer than 24 characters",
      "invalid-date"=>"Sorry, this movie is unavailable on your specified date",
      "password-change-fail"=>"Password Change Failed"
    );

    return array_key_exists($error, $knownErrors) ? $knownErrors[$error] : 
                                                    $knownErrors['unknown'];
    
  }
?>