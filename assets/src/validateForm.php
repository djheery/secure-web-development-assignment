<?php
  require_once 'databaseActions.php';
  // require_once 'errorHandling.php';
  
  if($_REQUEST) {
    list($inputs, $errors) = validationSetup($_REQUEST);
    if(count($errors) > 0) {
      print_r($errors);
      // findTargetErrorHandler($form, $errors);
    } else {
      print_r($inputs);
      // findTargetDatabaseQuery($form, $inputs);
    }
  } else {
    header('location: /swd-final-assignment/content/loginForm.php');
  }

  function validationSetup($request) {
    $validated = [];
    $errors = [];
    foreach($request as $key=>$value) {
      $inputCheck = sanitizeValidateUserInput($key, $value);
      substr($inputCheck, 0, 6) == 'Error:' ?
        $errors[$key] = $inputCheck :
        $validated[$key] = $inputCheck; 
    }
    if($validated['confirm-password'] || $validated['confirm-email']) {
      list($validated, $errors) = furtherValidationChecks($validated, $errors);
    }

    return array($validated, $errors);   
  }


  function sanitizeValidateUserInput($key, $value) {
    if($value == null || $value == '') return "Error: You must fill out input: $key";
    switch($key) {
      case 'first-name' :
      case 'last-name' :
        return sanitizeValidateString($value);
        break;
      case 'email' :
      case 'confirm-email' :
        $email = strtolower($value);
        return sanitizeValidateEmail($email);
        break;
      case 'password' :
        $pswd = sanitizeValidateString($value);
        $pswd = checkPasswordLength($pswd);
        return $pswd;
        break;
      case 'date-of-booking' :
        echo "$key <br>";
        $statement = $value ? 'YO' : 'UNDEFINED';
        echo $statement;
        break;
      case 'confirm-password' :
        $pswd = sanitizeValidateString($value);
        return $pswd;
        break;
      case 'hidden' :
      case 'movieID' :
      case 'customerID' : 
        return $value;
      default :
        'Error: User Input is not Defined';
    }
  }

  function furtherValidationChecks($validated, $errors) {
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
      return 'Error: Email is not Valid';
    }
  }

  function checkInputsAreEqual($key, $input1, $input2) {
    $equalityCheck = $input1 === $input2 ?
                      array($key=>true) :
                      array($key=>"Error: Your {$key}s do not Match");


    return $equalityCheck;
  }

  function checkPasswordLength($password) {
    $lengthCheck = strlen($password) < 8 ?
                   'Error: Your password is to short, please enter a password of 8 characters or over.' : $password;
    return $lengthCheck;
  }
?>