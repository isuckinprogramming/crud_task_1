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
  

  private function setError( $name ) {
    if($name === 'email'){  
      $this->errorMessage .= "The Email is blank. Blank string is invalid\n";
    }
    elseif($name === 'LName'){
      $this->errorMessage .= "The LName is blank. Blank string is invalid\n";
    }
    elseif($name === 'FName'){
      $this->errorMessage .= "The FName is blank. Blank string is invalid\n";
    }
  }
};
