<?php
namespace UserEmail;
use \UserEmail\Session;


class RecipientDAO{

	static function getRecipientData($connectToDb) {

		$allUsers = array();

		$query = "SELECT id, CONCAT(firstname, ' ', lastname) AS username, email
							FROM core_users limit 1";
		$result = $connectToDb->prepare($query);
		if(!$result){
			throw new \Exception('Querry failed');
		}

  	$result -> execute();
  	$result -> bind_result($id, $username, $email);

		//Create an array of each user as objects
		while($result -> fetch()){
			$obj = new Session($id, $username, $email);
			$allRecipientData[] = $obj;
		}
		return $allRecipientData;
 	}

}
