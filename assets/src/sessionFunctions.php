<?php
  function generateSession() {
    ini_set("session.save_path", "C:/xampp/htdocs/swd-final-assignment/assets/session-data");
    session_start(); 
  }

  function getSessionData() {
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
      return $_SESSION;
    } else {
      return false;
    }
  }

  function setSessionData($usrData) {
    $_SESSION['logged-in'] = 1;
    $_SESSION['username'] = $usrData['username'];
    $_SESSION['bookings'] = $usrData['bookings'];

    return $_SESSION
  };

  function unsetDestroySession() {

  };
?>