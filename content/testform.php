<?php 
  require_once 'buildPage.php';
  require_once 'marketingBlock.php';
  require_once '../assets/src/filmTiles.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/buildForms.php';

  $tagline = "Sign Up";
  $form = getFormFields('signUpForm.php');
  $links = checkPageType('Logged Out', 'signUpForm.php');
  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
?>
   <section id="sign-up" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <h1 class="heading-secondary text-upper mgb-large">Sign <span class="pastel-accent-clr">Up</span> For<span class="pastel-accent-clr"> Cinema Club</span></h1>
<?php 
  echo openForm('post');
  echo generateForm($form);
  echo closeForm();
?>
          </div>
        <div class="page-right">
          <img src="../assets/images/camera-opperator-illustration.png" alt="" class='camera-operator-illustration'>
        </div>
      </div>
    </section>
<?php
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo buildPageEnd();
?>