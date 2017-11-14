<?php
namespace UserEmail;

class ConfigEmail
{
  /**
    * NOTE:
    *
    * @param type
    * @return Array
    */

  public $userName;
  public $userPassword;
  public $fromName;
  public $sentTo;
  public function __construct($userName, $userPassword,$fromName, $sentTo)
  {
    /**
      * NOTE:
      *
      * @param type
      * @return Array
      */

    $this->userName = $userName;
    $this->userPassword = $userPassword;
    $this->fromName = $fromName;
    $this->sentTo = $sentTo;
  }
}
