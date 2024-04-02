<?php 

class Response { 
  public $status = 'pending';
  public $errorMessage;
  public $isFNameValid = false;
  public $isLNameValid = false;
  public $isEmailValid = false;

  function isAnyFieldInvalid  ()  {
    return !$this->isEmailValid || !$this->isFNameValid || !$this->isLNameValid;
  }

  public function setValidity($name,$value){
    
    if(!$value){
      $this->setError($name);
      return;
    }
    elseif($name === 'email'){  
      $this->isEmailValid = true;
    }
    elseif($name === 'lName'){
      $this->isLNameValid = true;
    }
    elseif($name === 'fName'){
      $this->isFNameValid = true;
    }
  }
  

  private function setError( $name, $errorMsgTemplate = "The %s is blank. Blank string is invalid\n" ) {

    if($name === 'email'){  
      $this->errorMessage .= sprintf($errorMsgTemplate, "email");
    }
    elseif($name === 'LName'){
      $this->errorMessage .=  sprintf($errorMsgTemplate, "LName");
    }
    elseif($name === 'FName'){
      $this->errorMessage .= sprintf($errorMsgTemplate, "FName");
    }
  }

};
