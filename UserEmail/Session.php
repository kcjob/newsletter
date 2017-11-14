<?php
namespace UserEmail;

class Session{
  /**
    * NOTE:
    *
    * @param type
    * @return Array
    */

  public $userId;
  public $userName;
  public $userEmailAddress;

	public function __construct($userId, $userName, $userEmailAddress)
  {
    /**
      * NOTE:
      *
      * @param type
      * @return Array
      */

    $this -> userId = $userId;
    $this -> userName = $userName;
    $this -> userEmailAddress = $userEmailAddress;
  }

}
