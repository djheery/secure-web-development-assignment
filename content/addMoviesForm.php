<?php

?>

<form action="../assets/src/validateForm.php" method="post">
    <div>
      <label for="movie-name">Movie Name</label>
      <input type="text" name="movie-name" id="movie-name">
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description">
    </div>
    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price">
    </div>
    <div>
      <label for="rating">Rating</label>
      <input type="number" name="rating" id="rating">
    </div>
    <button type="submit" name="submit" id="submit">Add Movie</button>
  </form>