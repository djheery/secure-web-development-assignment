<?php
  //Generate session data and dictate save path 
  function generateSession() {
    // ini_set("session.save_path", "/home/unn_w21045778/sessionData");
    ini_set("session.save_path", "/swd-final-assignment./assets/sessionData");
    session_start(); 
  }

  // return session data if logged in
  function getSessionData() {
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
      return $_SESSION;
    } else {
      return false;
    }
  }

  // Regenerate session id after a database interaction
  function preventSessionFixation() {
    session_regenerate_id(true);
  }

  // Set Session Data
  function setSessionData($name, $email, $bookings) {
    generateSession();
    $_SESSION['logged-in'] = 1;
    $_SESSION['name'] = ucfirst($name);
    $_SESSION['username'] = $email;
    $_SESSION['bookings'] = $bookings;
  };

  // Add Booking to session
  function addBookingToSession($booking) {
    array_push($_SESSION['bookings'], $booking);
  }

  // Unset and destroy a session
  function unsetDestroySession() {
    unset($_SESSION);
    session_destroy();
  };

?>