<?php
namespace UserEmail;

class EmailSender
{
  static function mailmsg($emailDataObject, $configEmail)
  {
    $totalEmails = 0;
    $failures = [];

    $loader = new \Twig_Loader_Filesystem('Templates');
    $twig = new \Twig_Environment($loader);



    // Create the Transport
    $transport = (new \Swift_SmtpTransport('outgoing.ccny.cuny.edu', 587, 'tls'))
      -> setUsername($configEmail->userName)
      -> setPassword($configEmail->userPassword);
    $mailer = new \Swift_Mailer($transport);

    // create and register logger
    $sentEmaillogger = new \Swift_Plugins_Loggers_ArrayLogger();
    $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($sentEmaillogger));

    // Create a message
    $message = new \Swift_Message('Department of Science Newsletter');
    $data['image_src'] = $message->embed(\Swift_Image::fromPath('documents/newimg.jpg'));

    $msg = $twig -> render('newsletterTemplate.html.twig', $data);
    $message -> setFrom($configEmail->fromName);
      //-> setTo($emailDataObject->userEmailAddress) // users email addresses
    $message -> setTo($configEmail->sentTo);
    $message ->setContentType("text/html");
    $message -> setBody($msg);

  //  echo $message->toString();

    // Send the message
    $mailer->send($message, $failures);

    // output log
    file_put_contents(__DIR__ .'/../log/sentEmails.log', $sentEmaillogger->dump());
  }
}
