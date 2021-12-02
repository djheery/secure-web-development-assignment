<?php 
  function getFormFields($form) {
    $signUpForm = array(
      array(
        'name'=>'first-name',
        'label'=>'First Name',
        'type'=>'text',
        'error'=>False,
      ),
      array(
        'name'=>'last-name',
        'label'=>'Last Name',
        'type'=>'text',
        'error'=>False,
      ),
      'email'=>array(
        'name'=>'email',
        'label'=>'Email',
        'type'=>'email',
        'error'=>False,
      ),
     array(
        'name'=>'confirm-email',
        'label'=>'Confirm Email',
        'type'=>'email',
        'error'=>False,
      ),
      array(
        'name'=>'password',
        'label'=>'Password',
        'type'=>'password',
        'error'=>False,
      ),
      array(
        'name'=>'confirm-password',
        'label'=>'Confirm Password',
        'type'=>'password',
        'error'=>False,
      ),
    );
    $loginForm = array(
      array(
        'name'=>'email',
        'label'=>'Email',
        'type'=>'email',
        'error'=>False,
      ),
      'password'=>array(
        'name'=>'password',
        'label'=>'Password',
        'type'=>'password',
        'error'=>False,
      ),
    $deleteAccount = array(
      'password'=>array(
        'name'=>'password',
        'label'=>'Password',
        'type'=>'password',
        'error'=>False,
      ),
      'confirm-password'=>array(
        'name'=>'password',
        'label'=>'Confirm Password',
        'type'=>'password',
        'error'=>False,
      ),
    )
    );
    
    switch($form) {
      case 'signUpForm.php' :
        return $signUpForm;
        break;
      case 'loginForm.php' :
        return $signUpForm;
        break;
      case 'deleteAccount' :
        return $signUpForm;
        break;
    }
  }
  function openForm($method) {
    $formHeader = "<form src='../assets/src/validateForm.php' method='$method'>";
    return $formHeader;
  }

  function generateForm($formFields) {
    $formBody = '';
    for($i = 0; $i < count($formFields) - 1; $i++) {
      $formBody .= <<<FORMITEM
      <div class="form-field-container">
        <div class="mgb-small">
          <label for="{$formFields[$i]['name']}" class="input-label">{$formFields[$i]['label']}</label>
        </div>
        <div class="input-container">
          <input type="{$formFields[$i]['type']}" id="{$formFields[$i]['name']}" name="{$formFields[$i]['name']}">
        </div>
      </div>
      FORMITEM;
    }

    return $formBody;
  }
  
  function closeForm() {
    return "</form>";
  }
?>