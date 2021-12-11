<?php
  require_once 'databaseActions.php';
  require_once 'redirects.php';
  // require_once 'errorHandling.php';
  if($_REQUEST) {
    $form = $_REQUEST['form-name'];
    list($inputs, $errors) = validationSetup($_REQUEST);
    if(count($errors) > 0) {
      inputError($form, $errors);
    } else {
      $databaseAction = findTargetDatabaseQuery($form, $inputs);
      print_r($databaseAction);
      $databaseAction != 1 ?
        inputError($form, $databaseAction) :
        confirmationPage($form, $databaseAction);
    }
  } else {
    header('location: /swd-final-assignment/content/index.php');
  }

  function validationSetup($request) {
    $validated = [];
    $errors = [];
    $errorIndex = 0;
    foreach($request as $key=>$value) {
      $inputCheck = sanitizeValidateUserInput($key, trim($value));
      if(substr($inputCheck, 0, 6) == 'Error:') {
        $errors[$errorIndex] = substr($inputCheck, 7, strlen($inputCheck) - 1);
        $errorIndex++;
      } else {
        $validated[$key] = $inputCheck; 
      }              
    }
    if(array_key_exists('confirm-password', $validated) || array_key_exists('confirm-password', $validated)) {
      list($validated, $errors) = confirmInputChecks($validated, $errors);
    }

    return array($validated, $errors);   
  }


  function sanitizeValidateUserInput($key, $value) {
    if($value == null || $value == '') return "Error: input-empty";
    switch($key) {
      case 'first-name' :
      case 'last-name' :
      case 'booking-date' :
      case 'booking-time' :
      case 'number-attending' :
        return sanitizeValidateString($value);
        break;
      case 'email' :
      case 'confirm-email' :
        $email = strtolower($value);
        return sanitizeValidateEmail($email);
        break;
      case 'password' :
      case 'confirm-password' :
        $pswd = sanitizeValidateString($value);
        $pswd = checkPasswordLength($pswd);
        return $pswd;
        break;
      case 'form-name' :
      case 'movieID' :
      case 'customerID' : 
        return $value;
      default :
        'Error: unknown';
    }
  }

  // FIX THIS FUNCTION

  function confirmInputChecks($validated, $errors) {
    $passwords = array_key_exists('confirm-password', $validated) ?
    checkInputsAreEqual('password',$validated['password'], $validated['confirm-password']) : 
    array('password'=>true);

    $emails = array_key_exists('confirm-email', $validated) ?
      checkInputsAreEqual('email', $validated['email'], $validated['confirm-email']) : 
      array('email'=>true);

    $reusableCheck = array($passwords, $emails);
    for($i = 0; $i < count($reusableCheck); $i++) {
      foreach($reusableCheck[$i] as $key=>$value) {
       $value == 1 ? null : $errors[$key] = $value;
      }
    }
    return array($validated, $errors);
  }

  function sanitizeValidateString($str) {
    $str = filter_var($str, FILTER_SANITIZE_STRING);
    return $str;
  }

  function sanitizeValidateEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $email;
    } else {
      return 'Error: email-invalid';
    }
  }

  function checkInputsAreEqual($key, $input1, $input2) {
    $equalityCheck = $input1 === $input2 ?
                      array($key=>true) :
                      array($key=> $key == 'password' ? 'password-match' : 'email-match');
    return $equalityCheck;
  }

  function checkPasswordLength($password) {
    $lengthCheck = strlen($password) < 8 ?
                   'Error: password-length' : $password;
    return $lengthCheck;
  }
?>