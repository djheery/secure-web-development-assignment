<?php
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/databaseActions.php';



  function buildFilmTiles($title) {
    $movieArray = getMovieData('movies');
    if(!$movieArray) return;
    $filmTiles = <<<FILMTILES
      <section id="film-tiles" class="page-section bg-off-black">
      <div class="inner-container flex">
        <div class="section-heading mgb-large">
          <h2 class="heading-secondary text-upper">$title</h2>
        </div>
        <div class="film-tiles-block flex mgb-large">
    FILMTILES;
    $visitedNode = [];
    $tilesToDisplay = 4;
    for($i = 0; $i < $tilesToDisplay; $i++) {
      $randomInt = rand(0, count($movieArray) - 1);
      if(array_key_exists($movieArray[$randomInt]['movieID'], $visitedNode)) {
        $i--;
        continue;
      }

      $cleanedMovieArray = makeOutputSafe($movieArray[$randomInt]);
      $movieID = $cleanedMovieArray['movieID'];
      $movieImg = $cleanedMovieArray['img_path'];
      $movieName = $cleanedMovieArray['movie_name'];

      $filmTiles .= <<<FILMITEM
      <div class="film-tile__container">
        <div class="ft-container__inner">
        <a href="individualFilmListing.php?id={$movieID}" class="film-tile-link"></a>
        <img src="../assets/images/{$movieImg}" alt="{$movieName} - Link to more information about {$movieName}">
        </div>
      </div>
      FILMITEM;
      $visitedNode[$movieArray[$randomInt]['movieID']] = $movieArray[$randomInt]['movie_name'];
    }

    $filmTiles .= <<<FILMEND
      </div>
        <div class="buttons-container flex">
          <div class="btn bg-strong-orange">
            <a href="filmListings.php">View all Films</a>
          </div>
        </div>
      </div>
    </section>
    FILMEND;
    return $filmTiles;
  }

    // Responsible for creating the film listings page on filmListings.php
    function createFilmListingsSection($sessionData) {
      $filmListingsContainer = <<<FILMLISTINGS
      <section id="film-listings" class="bg-off-black page-section">
        <div class="inner-container flex">
          <div class="mgb-large">
            <h2 class="text-upper heading-secondary">Film <span class="pastel-accent-clr">Listings</span></h2>
          </div>
      FILMLISTINGS;
      $filmItems = getMovieData('movies');
      $filmListingsContainer = createFilmItems($filmListingsContainer, $filmItems, $sessionData);
      $filmListingsContainer .= "</div></section>";
      return $filmListingsContainer;
    }
  
    // Responsible for creating the film items within filmListings.php
  function createFilmItems($container, $items, $sessionData) {
    for($i = 0; $i < count($items); $i++) {
      $itemImg = htmlspecialchars($items[$i]['img_path']);
      $itemTitle = htmlspecialchars($items[$i]['movie_name']);
      $itemDirector = htmlspecialchars($items[$i]['director']);
    
      $container .= <<<FILMITEM
        <div class="film-listings__item-container flex mgb-large">
          <div class="film-listings__item-img flex mgb-mid">
            <img src="../assets/images/$itemImg" alt="$itemTitle film poster" aria-hidden="true">
          </div>
          <div class="film-listings__item-content flex">
            <div class="film-listings__item-heading mgb-mid">
              <h3 class="sub-heading pastel-accent-clr text-upper">{$items[$i]['movie_name']}</h3>
            </div>
            <div class="film-listings__item-text-block mgb-mid">
              <p class="film-listings__item-text">Director: {$items[$i]['director']}</p>
            </div>
            <div class="film-listings__item-text-block mgb-mid">
              <p class="film-listings__item-text">Rating: {$items[$i]['rating']}</p>
            </div>
            <div class="film-listings__item-times mgb-mid">
              <p class="film-listings__item-text mgb-mid">Times Available</p>
              <div class="film-times__container">
                <ul class="film-times flex">
                  <li class="individual-film-time">14:00</li>
                  <li class="individual-film-time">16:00</li>
                  <li class="individual-film-time">18:00</li>
                  <li class="individual-film-time">20:00</li>
                  <li class="individual-film-time">22:00</li>
                </ul>
              </div>
            </div>
      FILMITEM;
      // Different buttons depending on the session data
      if($sessionData) {
        $container .= <<<BUTTONS
        <div class="buttons-container flex">
          <div class="btn">
            <a href="individualFilmListing.php?id={$items[$i]['movieID']}">Find Out More</a>
          </div>
          <div class="btn bg-strong-orange">
            <a href="bookingForm.php?id={$items[$i]['movieID']}">Book Now</a>
          </div>
        </div>
        BUTTONS;
      } else {
        $container .= <<<BUTTONS
        <div class="buttons-container flex">
          <div class="btn">
            <a href="individualFilmListing.php?id={$items[$i]['movieID']}">Find Out More</a>
          </div>
          <div class="btn bg-strong-orange">
            <a href="loginForm.php">Login to Book</a>
          </div>
        </div>
        BUTTONS;
      }
      $container .= "</div></div>";
    }


    return $container;
  }
  // For the individualFilmListing.php - display the information about an individual film
  function createIndividualFilmListing($movie) {
    $targetFilmListing = <<<TARGET
    <section id="individual-film-listing" class="bg-light-grey page-section">
      <div class="inner-container flex">
        <div class="film-listings__item-container flex mgb-large">
          <div class="film-listings__item-img flex mgb-mid">
            <img src="../assets/images/{$movie['img_path']}" alt="">
          </div>
          <div class="film-listings__item-content flex">
            <div class="film-listings__item-heading mgb-mid">
              <h3 class="sub-heading pastel-accent-clr text-upper">{$movie['movie_name']}</h3>
            </div>
            <div class="film-listings__item-text-block mgb-mid">
              <p class="film-listings__item-text mgb-small"><span class="bold">Director</span>: {$movie['director']}</p>
              <p class="film-listings__item-text mgb-small"><span class="bold">Duration</span>: {$movie['duration']}</p>
              <p class="film-listings__item-text"><span class="bold">Film Synopsis:</span></p>
              <p class="film-listings__item-text mgb-mid">{$movie['description']}</p>
            </div>
            <div class="film-listings__item-times mgb-mid">
              <p class="film-listings__item-text mgb-mid">Times Available</p>
              <div class="film-times__container">
                <ul class="film-times flex">
                  <li class="individual-film-time">14:00</li>
                  <li class="individual-film-time">16:00</li>
                  <li class="individual-film-time">18:00</li>
                  <li class="individual-film-time">20:00</li>
                  <li class="individual-film-time">22:00</li>
                </ul>
              </div>
            </div>
            <div class="buttons-container flex">
              <div class="btn bg-strong-orange">
                <a href="bookingForm.php?id={$movie['movieID']}">Book Now</a>
              </div>
              <div class="btn">
                <a href="filmListings.php">Back to all Films</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    TARGET;

    return $targetFilmListing;
  };


  // Create the booking form for bookingForm.php
  function filmBookingForm($film) {
    // get todays date and max booking date for the html source code 
    $todaysDate = date('Y-m-d');
    $maxBookingDate = date('Y-m-d', strtotime($todaysDate . ' +14 days'));
    $formItem = <<<FORMITEM
    <form action="../assets/src/validateForm.php" method="post" class="booking-form">
        <div class="form-field-container flex mgb-mid">
          <label class="input-label pastel-accent-clr">Film Chosen:</label>
          <p>{$film['movie_name']}</p>
          <input type="hidden" name="movieID" value="{$film['movieID']}">
          <input type="hidden" name="movie-name" value="{$film['movie_name']}">
        </div>
        <div class="form-field-container flex mgb-mid">
          <label for="booking-date" class="input-label pastel-accent-clr">Date:</label>
          <div class="input-container">
            <input type="date" name="booking-date" id="booking-date" min="$todaysDate" max="$maxBookingDate" value="$todaysDate" aria-label="Booking date">
          </div>
        </div>
        <div class="form-field-container flex mgb-mid">
          <label for="booking-time" class="input-label pastel-accent-clr">Time:</label>
          <div class="select-container">
            <select name="booking-time" id="booking-time" aria-label="Booking Time">
              <option value="14:00">14:00</option>
              <option value="16:00">16:00</option>
              <option value="18:00">18:00</option>
              <option value="20:00">20:00</option>
              <option value="22:00">22:00</option>
            </select>
          </div>
        </div>
        <div class="form-field-container flex mgb-mid">
          <label for="number-attending" class="input-label pastel-accent-clr">Attending:</label>
          <div class="select-container">
            <select name="number-attending" id="number-attending" aria-label="number-attending">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
        </div>
        <div class="buttons-container flex">
            <button class="btn bg-strong-orange" type="submit" id="submit">Book Now</button>
          <div class="btn">
            <a href="filmListings.php">Back to All Films</a>
          </div>
        </div>
        <input type="hidden" name="form-path" value="bookingForm.php?id={$film['movieID']}">
        <input type="hidden" name="form-name" value="booking-form">
      </form>
      </div>
      <div class="page-right flex">
      <div class="film-listings__item-img flex">
        <img src="../assets/images/{$film['img_path']}" alt="{$film['movie_name']}" class='poster-img' aria-hidden="true">
      </div>
    </div>
    FORMITEM;
    return $formItem;
  }

?>