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


?>