<?php
namespace UserEmail;

use UserEmail\EmailMessageData;
use UserEmail\ConfigEmail;

class EmailMessage
{
  /**
    * NOTE:
    *
    * @param type
    * @return Array
    */

  static function createAndSendEmail(array $recipientData){
    /**
      * NOTE:
      *
      * @param type
      * @return Array
      */

    $email_params = parse_ini_file("emailParams.ini");
    foreach ($recipientData as $emailDataObject) {
      $configEmail = new ConfigEmail($email_params['userName'], $email_params['userPassword'],$email_params['fromName'], $email_params['sentTo']);
      EmailSender::mailmsg($emailDataObject, $configEmail);
    }
  }
}
