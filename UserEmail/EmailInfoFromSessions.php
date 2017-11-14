<?php
namespace UserEmail;

use UserSessionsEmailMessageData;

class EmailInfoFromSessions
{
  /**
    * NOTE:
    *
    * @param
    * @return 
    */

  static function getEmailInfo($validSessions){
    /**
      * NOTE:
      *
      * @param type
      * @return Array
      */

    $emailMsgArray = [];

    foreach ($validSessions as $session) {
      $userId = $session -> userId;
      $emailData = new EmailMessageData($session); // create a new object

      if (!array_key_exists($userId, $emailMsgArray)){
        $emailMsgArray[$userId] = $emailData;
        array_push($emailMsgArray[$userId] -> dataArray, $emailData -> sessionData);
      } else {
        array_push($emailMsgArray[$userId] -> dataArray, $emailData -> sessionData);
      }
    }
    return $emailMsgArray;
  }

}
