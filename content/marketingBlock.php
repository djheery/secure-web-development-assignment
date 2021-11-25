  
<?php 
  function buildMarketingBlock() {
    $marketingBlock = <<<MARKETING
      <section id="marketing-section" class="page-section bg-light-grey">
        <div class="inner-container flex">
          <div class="page-left">
            <div class="section-heading mgb-large">
              <h2 class="heading-secondary text-upper">Want <span class="pastel-accent-clr">Exclusive</span> Discounts?</h2>
            </div>
            <div class="section-text-block mgb-large">
              <p>Exclusive discounts, early bird tickets to mattenes and much more! If this sounds good to you, you should sign up to our cinema club. It's free of charge and allows you to receive the exclusive offers listed above, and much more</p>
            </div>
            <div class="buttons-container flex mgb-large">
              <div class="btn bg-strong-orange">
                <a href="signUpForm.php">Sign up now!</a>
              </div>
            </div>
          </div>
          <div class="page-right">
            <img src="/swd-final-assignment/assets/images/camera-opperator-illustration.png" alt="" class='camera-operator-illustration'>
          </div>
        </div>
      </section>
    MARKETING;

    return $marketingBlock;
  }
?>
  