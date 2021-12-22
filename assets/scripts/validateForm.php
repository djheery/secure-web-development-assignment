<?php
  require_once 'preDatabaseInteraction.php';
  require_once 'redirects.php';

  // A list of the know inputs on the website to check against - log errors if the input is not found 
  function getKnownInputs() {
    // Placeholder value in $knownInputs[0] as when first-name was in array[0] the valid input check was always firing
    $knownInputs = array(
      'PLACEHOLDER_VALUE_FOR_CHECK_LINE_52',
      'first-name',
      'last-name',
      'email',
      'confirm-email',
      'old-password',
      'password',
      'confirm-password',
      'movie-name',
      'director',
      'description',
      'rating',
      'movieID',
      'number-attending',
      'booking-time',
      'booking-date',
      'form-path',
      'form-name',
    );

    return $knownInputs;
  }
  
  if($_REQUEST) {
    $formPath = $_REQUEST['form-path'];
    $formName = $_REQUEST['form-name'];
    // Start of form Validation
    list($inputs, $errors) = validationSetup($_REQUEST, $formName);
    // If there are errors
    if(count($errors) > 0) {
      // Go to redirectFilm.php for this function
      inputError($formPath, $errors, $_REQUEST);
    } else {  
      // go to preDatabaseInteraction.php for this function
      $databaseAction = findTargetDatabaseQuery($formName, $inputs);
      // if the result is not true - log errors - if not confirm
      $databaseAction != 1 ?
        // redirectFilm.php
        inputError($formPath, $databaseAction) :
        // redirects.php
        confirmationPage($formName, $databaseAction);
      }
  } else {
    // If there is no request - redirect to a different page
    header('location: /swd-final-assignment/content/index.php');
  }


  function validationSetup($request, $formName) {
    // Set up arrays to log errors or store validated inputs
    $validated = [];
    $errors = [];
    // so errors are correctly indexed in the errors array
    $errorIndex = 0;
    // Begin the loop through the inputs
    foreach($request as $key=>$value) {
      // If the $request input key is not found return immediatley and display an error 
      if(array_search($key, getKnownInputs()) == false) {
        $errors[$errorIndex] = 'unknown';
        return array($validated, $errors);
      }
      // Check the input - more furtherDown
      $inputCheck = sanitizeValidateUserInput($key, trim($value), $formName);
      // If the input check returns an error
      if(substr($inputCheck, 0, 6) == 'Error:') {
        // If the error is NOT already in the errors add to errors array (This is to prevent the duplication of error messages)
        if(in_array(substr($inputCheck, 7, strlen($inputCheck) - 1), $errors) == false) {
          $errors[$errorIndex] = substr($inputCheck, 7, strlen($inputCheck) - 1);
          $errorIndex++;
        }
      } else {
        // If input passes add to validated array
        $validated[$key] = $inputCheck; 
      }              
    }

    // If confirm password or confirm-email test that the inputs are equal
    if(array_key_exists('confirm-email', $validated) || array_key_exists('confirm-password', $validated)) {
      list($validated, $errors) = confirmInputChecks($validated, $errors, $errorIndex);
    }


    // Return the array
    return array($validated, $errors);   
  }


  function sanitizeValidateUserInput($key, $value, $formName) {
    // If the value is empty return an error to be added to the errors array
    if($value == null || $value == '') return "Error: input-empty";
    // Sanitize every input
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    // Checks for specific inputs more about the functions where they are written
    switch($key) {
      case 'first-name' :
      case 'last-name' :
        $value = strtolower($value);
        return checkNamesAreValid($value);
        break;
      case 'email' :
      case 'confirm-email' :
        $email = strtolower($value);
        return sanitizeValidateEmail($email);
        break;
      case 'booking-date' : 
        return checkBookingDate($value);
        break;
      case 'price' :
        $number =  number_format(sanitizeValidateNumbers($value), 2);
        return $number;
        break;
      case 'password' :
      case 'old-password' :
        $lengthCheckNeeded = checkFormForLengthError($formName);
        return $lengthCheckNeeded == false ?
                  $value : checkPasswordLength($value);
        break;
        case 'movieID' :
          return sanitizeValidateNumbers($value);
        break;
      default :
        return $value;
    }
  }

  // Forms that should not display a length error
  function checkFormForLengthError($currentForm) {
    $formsWithoutLengthCheck = array(
      'login-form',
      'delete-user',
    );

    $checkNeeded = true;
    foreach($formsWithoutLengthCheck as $flc) {
      if($flc == $currentForm) $checkNeeded = false;
    }

    return $checkNeeded;
  }

  // Confirm inputs are equal - Not reusable
  function confirmInputChecks($validated, $errors, $errorIndex) {
    // The below variables check if the array key exiss for confirm password or confirm email if they do then send them to a function that checks their equality - if not the value is null for the purpose of the loop that follows
    $passwords = array_key_exists('confirm-password', $validated) ?
    checkInputsAreEqual('password',$validated['password'], $validated['confirm-password']) : 
    array('password'=>true);
    $emails = array_key_exists('confirm-email', $validated) ?
      checkInputsAreEqual('email', $validated['email'], $validated['confirm-email']) : 
      array('email'=>true);
      // put the above values into an array 
      $inputEqualityCheck = array($passwords, $emails);
      for($i = 0; $i < count($inputEqualityCheck); $i++) {
        foreach($inputEqualityCheck[$i] as $key=>$value) {
          // If the value is not true push the error and the statement to the errors array 
          if($value != 1) {
            $errors[$errorIndex] = $value;
            $errorIndex++;
          }
      }
    }
    return array($validated, $errors);
  } 

  // Check that the booking date is inside the given range
  function checkBookingDate($date) {
    if(strtotime($date) > strtotime(date('y-m-d') . ' +14 days') || strtotime($date) < strtotime(date('y-m-d'))) {
      $date = 'Error: invalid-date'; 
    }
    
    return $date;
  }

  // Check if there is a space within peoples name or a name is too long
  function checkNamesAreValid($name) {
    if(strpos($name, ' ') != 0) {
      return 'Error: whitespace-in-name';
    } elseif(strlen($name) > 24) {
      return 'Error: name-length';
    } else {
      return $name;
    }
  }

  // Sanitize and validate emails
  function sanitizeValidateEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $email;
    } else {
      return 'Error: email-invalid';
    }
  }

  // Check inputs are equal
  function checkInputsAreEqual($key, $input1, $input2) {
    // This is not reusable and only works for this usecase
    $equalityCheck = $input1 === $input2 ?
                      array($key=>true) :
                      array($key == 'password' ? 
                        'password-match' : 
                        'email-match');
    return $equalityCheck;
  }

  // Check the password Length is greater than 8
  function checkPasswordLength($password) {
    $lengthCheck = strlen($password) < 8 ?
                   'Error: password-length' : $password;
    return $lengthCheck;
  }

  // validate any numbers passed in 
  function sanitizeValidateNumbers($number) {
    $validatedNumber = filter_var($number, FILTER_VALIDATE_INT);
    
    return $validatedNumber ? $validatedNumber : 'Error: unknown';
  }


?>