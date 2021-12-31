<?php
  // Connect to the database
  define('DB_NAME', 'assignment');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_HOST', 'localhost');
  function connectToDatabase() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
                  die('Database Connection Not Established');
    return $connection;
}
?>