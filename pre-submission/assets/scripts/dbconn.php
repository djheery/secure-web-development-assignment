<?php
  // Connect to the database
  define('DB_NAME', 'unn_w21045778');
  define('DB_USER', 'unn_w21045778');
  define('DB_PASSWORD', 'Heery123');
  define('DB_HOST', 'localhost');
  function connectToDatabase() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
                  die('Database Connection Not Established');
    return $connection;
}
?>