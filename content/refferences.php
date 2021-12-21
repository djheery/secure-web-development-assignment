<?php
  require_once "../assets/scripts/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";
  // Session Information
  generateSession();
  $sessionData = getSessionData();
  // Page name for title
  $pageName = getPageName($_SERVER['PHP_SELF']);
  // Navigation 
  $navigationLinks = checkPageType($sessionData, $pageName);

  // Build Page (buildPage.php)
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($navigationLinks);
  echo startMainSection();
?>
<div class="bg-light-grey page-section">
  <div class="inner-container ">
    <h1 class="pastel-accent-clr text-upper">References</h2>
    <h2 class="pastel-accent-clr text-upper">Images</h2>
    <ol>
    <li>Space toursits Movie poster :
      Christian Frei, CC BY-SA 2.0 <https://creativecommons.org/licenses/by-sa/2.0>, via    Wikimedia Commons https://upload.wikimedia.org/wikipedia/commons/7/70/Tos-poster.png
    </li>
  <li>Unkown Movie Poster :
      freesvg.org. (n.d.). Fictional movie poster | Free SVG. [online] Available at: https://freesvg.org/fictional-movie-poster [Accessed 17 Dec. 2021].
  </li>
  <li>
    Tears of Steel Movie Poster 
  (CC) Blender Foundation | Project Mango, CC BY 3.0 <https://creativecommons.org/licenses/by/3.0>, via Wikimedia Commons https://upload.wikimedia.org/wikipedia/commons/7/70/Tos-poster.png
  </li>
  <li>
  Endless Summer
  Eugenio Hansen, OFS, CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons https://upload.wikimedia.org/wikipedia/commons/a/a4/The_Endless_Summer_%281966_limited_release_poster%29.svg
  </li>
  <li>Hidden Universe Movie Poster
  December Media/Film Victoria/Swinburne University of Technology/MacGillivray Freeman Films/ESO, CC BY 4.0 <https://creativecommons.org/licenses/by/4.0>, via Wikimedia Commons https://upload.wikimedia.org/wikipedia/commons/7/78/Poster_for_the_IMAX_3D_movie_Hidden_Universe.jpg
</li>
<li>
Momento Movie Poster
  Lis2020, CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons https://commons.wikimedia.org/wiki/File:Poster_de_Momento.jpg
</li>
<li>Huston We Have a Proble Movie Poster
  Studio Virc, CC BY-SA 3.0 <https://creativecommons.org/licenses/by-sa/3.0>, via Wikimedia Commons https://commons.wikimedia.org/wiki/File:Houston,_We_Have_a_Problem!_official_movie_poster.jpg
</li>
<li>Abducted Movie Poster 
  SharleneMillang, CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons https://commons.wikimedia.org/wiki/File:Abducted_movie_poster.jpg</li>
<li>Nocturne in Black 
  Myriam Melki, CC0, via Wikimedia Commons https://commons.wikimedia.org/wiki/File:Nocturne_in_Black_-_Poster.jpg</li>
<li>Masking Threshold 
  Johannes Grenzfurthner (user:grenz), CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons https://upload.wikimedia.org/wikipedia/commons/e/e3/Masking_Threshold_%282021%29%2C_movie_poster.png</li>
<li>Amsel
  Cinemalad, CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons https://commons.wikimedia.org/wiki/File:AmselTheMoviePosterMockup_v2_thumb.jpg </li>
  <li>Image of Car on home page: https://unsplash.com/photos/qK6lCZ46w0U</li>
  <li>Image Newcastle upon tyne on listings page: https://unsplash.com/photos/HWpXC49BLlw </li>
<li>Camera man image sourced from a free png site </li>
    </ol>
  <h2>Descriptions</h2>
  <ol>
    <li>Memento Description: Nolan, C., Nolan, C., Nolan, J., Pearce, G., Moss, C.-A. and Pantoliano, J. (2001). Memento. [online] IMDb. Available at: https://www.imdb.com/title/tt0209144/?ref_=nv_sr_srsg_9 [Accessed 19 Dec. 2021].</li>
    <li>Space Tourists Description: Frei, C., Ansari, A., Bendiksen, J. and Popescu, D. (2010). Space Tourists. [online] IMDb. Available at: https://www.imdb.com/title/tt1496460/?ref_=nv_sr_srsg_0 [Accessed 19 Dec. 2021].</li>
    <li>Tears of Steel Description: Potocný, T. (n.d.). Ocelové slzy aneb Cesta Vladimíra Stehlíka za Lubomírem Krystlíkem. [online] IMDb. Available at: https://www.imdb.com/title/tt5129250/?ref_=nv_sr_srsg_0.</li>
    <li>Hidden Universe: Potocný, T. (Scott, R., Scott, R., Watt, A., Whitmore, J., Poole, G. and Richardson, M. (2013). Hidden Universe 3D. [online] IMDb. Available at: https://www.imdb.com/title/tt3041334/?ref_=fn_al_tt_1 [Accessed 19 Dec. 2021].‌</li>
    <li>Nocturne In Black Description: Keyrouz, J., Keyrouz, J., Zein, K., Farhat, J. and Yaacoub, T. (2016). Nocturne in Black. [online] IMDb. Available at: https://www.imdb.com/title/tt4536608/?ref_=fn_al_tt_1 [Accessed 19 Dec. 2021].‌</li>
    <li>Nocturne In Black Description: Keyrouz, J., Keyrouz, J., Zein, K., Farhat, J. and Yaacoub, T. (2016). Nocturne in Black. [online] IMDb. Available at: https://www.imdb.com/title/tt4536608/?ref_=fn_al_tt_1 [Accessed 19 Dec. 2021].‌</li>
    <li>Houston we have a problem description: Virc, Z., Virc, B., Virc, Z., Zizek, S., Tito, J.B. and Kennedy, J.F. (2017). Houston, We Have a Problem. [online] IMDb. Available at: https://www.imdb.com/title/tt5518022/?ref_=nv_sr_srsg_3 [Accessed 19 Dec. 2021].</li>
    <li>The Endless Summer description: Brown, B., Brown, B., August, R., Hynson, M. and Blears, L.J. (1965). The Endless Summer. [online] IMDb. Available at: https://www.imdb.com/title/tt0060371/?ref_=fn_al_tt_1 [Accessed 19 Dec. 2021].</li>
    <li>The rest of the descriptions were written by Daniel Heery the author of this work.</li>
  </ol>
  <h2>Quotes</h2>
  <ol>
    <li>Confirmation Quote for Account deletion: Sound of Music</li>
    <li>Account Deletion prompt on settings page: Mariah Carey - Without You</li>
  </ol>
  </div>
</div>
<?php 
  echo endMainSection();
  echo buildFooter($navigationLinks);
  echo buildHamburgerBtn();
  echo "<script src='../assets/scripts/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>