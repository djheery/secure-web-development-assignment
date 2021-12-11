<?php
  require_once 'databaseActions.php';
  require_once 'sessionFunctions.php';

  function findTargetDatabaseQuery($form, $data) {
    switch ($form) {
      case 'signUpForm.php' :
        unset($data['confirm-email']);
        unset($data['confirm-password']);
        return signUpForm($form, $data);
        break;
      case 'loginForm.php' :
        return loginForm($form, $data);                            
        break;
      case 'deleteUser' :
        break;
      case 'changePassword' :
        break;
      case 'bookingForm.php' :
        return bookingForm($form, $data);
        break;
      case 'addMovies.php':
        break;

      default :
        break;
    }
  }

  function signUpForm($form, $data) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 
    $userCheck = checkUserExists($form, $data) ?  
              array('user-exists') : 
              insertNewCustomer($data);
    if($userCheck == 1) setSessionData($data['first-name'], $data['email'], array());
    return $userCheck;
  }

  function loginForm($form, $data) {
    $userCheck = checkUserExists($form, $data);
    if($userCheck) {
      $validatePassword = password_verify($data['password'], $userCheck['password_hash']);
      if($validatePassword) {
        setSessionData($userCheck['customer_forename'], 
                       $userCheck['username'], 
                       getCustomerBookings($userCheck['customerID']));
        print_r(getCustomerBookings($userCheck['customerID']));
        return $validatePassword;
      } else {
        return array('user-error');
      }
    } else {
      return array('user-error');
    }                           
  }

  function bookingForm($form, $data) {
    generateSession();
    $sessionData = getSessionData();
    $data['email'] = $sessionData['username'];
    $screeningDateTime = "{$data['booking-date']} {$data['booking-time']}";
    $userCheck = checkUserExists($form, $data);
    return $userCheck ? 
              insertNewBooking($data, $userCheck['customerID'], $screeningDateTime) :
              array('unknown');
  }
?>
