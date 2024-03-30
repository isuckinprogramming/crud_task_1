<?php 

class Response { 
  public $status = 'pending';
  public $errorMessage;
  public $isFNameValid = false;
  public $isLNameValid = false;
  public $isEmailValid = false;

  function isAnyFieldInvalid()
  {
    return !($this->isEmailValid || $this->isFNameValid || $this->isLNameValid);
  }
};
