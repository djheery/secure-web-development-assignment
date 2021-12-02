<?php
  require_once '../assets/src/databaseActions.php';
  function createFilmListingsSection() {
    $filmListingsContainer = <<<FILMLISTINGS
    <section id="film-listings" class="bg-off-black page-section">
      <div class="inner-container flex">
    FILMLISTINGS;
    $filmItems = getTableData('movies');
    $filmListingsContainer = createFilmItems($filmListingsContainer, $filmItems);
    $filmListingsContainer .= "</section></div>";
    return $filmListingsContainer;
  }

  function createFilmItems($container, $items) {

    for($i = 0; $i < count($items); $i++) {
      $container .= <<<FILMITEM
        <div class="film-listings__item-container flex mgb-large">
          <div class="film-listings__item-img flex mgb-mid">
            <img src="../assets/images/{$items[$i]['img_path']}" alt="">
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
            <div class="buttons-container flex">
              <div class="btn">
                <a href="individualFilmListing.php?id={$items[$i]['movieID']}">Find Out More</a>
              </div>
              <div class="btn bg-strong-orange">
                <a href="">Book Now</a>
              </div>
            </div>
          </div>
        </div>
      FILMITEM;
    }

    return $container;
  }

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

  function filmBookingItem($movieID, $customerID) {
    $film = getIndividualMovie($movieID);
    $formItem = <<<FORMITEM
    <form action="../assets/src/validateForm.php" method="post" class="booking-form">
        <div class="form-field-container flex mgb-mid">
          <label for="movieID" class="input-label pastel-accent-clr">Film Chosen:</label>
          <p>{$film['movie_name']}</p>
          <input type="hidden" name="movieID" value="{$movieID}">
        </div>
        <div class="form-field-container flex mgb-mid">
          <label for="date" class="input-label pastel-accent-clr">Date:</label>
          <div class="input-container">
            <input type="date" name="date-of-booking" id="date-of-booking">
          </div>
        </div>
        <div class="form-field-container flex mgb-mid">
          <label for="date" class="input-label pastel-accent-clr">Time:</label>
          <div class="select-container">
            <select name="choose-a-time" id="choose-a-time">
              <option value="14:00">14:00</option>
              <option value="16:00">16:00</option>
              <option value="18:00">18:00</option>
              <option value="20:00">20:00</option>
              <option value="22:00">22:00</option>
            </select>
          </div>
        </div>
        <div class="buttons-container flex">
          <div class="btn bg-strong-orange">
            <button type="submit" id="submit">Book Now</button>
          </div>
          <div class="btn">
            <a href="filmListings.php">Back to All Films</a>
          </div>
        </div>
        <input type="hidden" name="customerID" value="{$customerID}">
        <input type="hidden" name="hidden" value="bookingForm.php">
      </form>
      </div>
      <div class="page-right flex">
      <img src="../assets/images/{$film['img_path']}" alt="{$film['movie_name']}" class='poster-img'>
    </div>

    FORMITEM;
    return $formItem;
  }

?>