<?php
namespace UserEmail;

class EmailMessageData{
	/**
		* NOTE:
		*
		* @param type
		* @return Array
		*/

	public function __construct($session)
  {
		/**
			* NOTE:
			*
			* @param type
			* @return Array
			*/

    $this -> dataArray = $dataArray = [];
    $this -> userName = $session -> userName;
    $this -> userEmailAddress = $session -> userEmail;
  }
}
