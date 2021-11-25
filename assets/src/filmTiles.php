<?php
  function buildFilmTiles($title) {
    $filmTiles = <<<FILMTILES
      <section id="film-tiles" class="page-section bg-off-black">
      <div class="inner-container flex">
        <div class="section-heading mgb-large">
          <h2 class="heading-secondary text-upper">$title</h2>
        </div>
        <div class="film-tiles-block flex mgb-large">
          <div class="film-tile__container">
            <img src="/swd-final-assignment/assets/images/avengers.jpg" alt="Avengers Infinity War">
          </div>
          <div class="film-tile__container">
            <img src="/swd-final-assignment/assets/images/jb-film-poster.jpg" alt="">
          </div>
          <div class="film-tile__container">
            <img src="/swd-final-assignment/assets/images/pulp-fiction.jpg" alt="">
          </div>
          <div class="film-tile__container">
            <img src="/swd-final-assignment/assets/images/the-prestige.jpg" alt="">
          </div>
        </div>
        <div class="buttons-container flex">
          <div class="btn bg-strong-orange">
            <a href="#">View all Films</a>
          </div>
        </div>
      </div>
    </section>
    FILMTILES;
    return $filmTiles;
  }
?>