<?php
namespace UserEmail;

class EmailSender
{
  static function mailmsg()
  {
    $totalEmails = 0;
    $failures = [];

    $loader = new \Twig_Loader_Filesystem('Templates');
    $twig = new \Twig_Environment($loader,array('debug'=> true));
    $twig->addExtension(new \Twig_extension_debug());


    // Create the Transport
    $transport = (new \Swift_SmtpTransport('outgoing.ccny.cuny.edu', 587, 'tls'))
      -> setUsername('Your email name')
      -> setPassword('Your Password');
    $mailer = new \Swift_Mailer($transport);

    // create and register logger
    $sentEmaillogger = new \Swift_Plugins_Loggers_ArrayLogger();
    $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($sentEmaillogger));

    // Create a message
    $message = new \Swift_Message('Department of Science Newsletter');
    $data['image_src'] = $message->embed(\Swift_Image::fromPath('documents/newimg.jpg'));

    $msg = $twig -> render('newsletterTemplate.html.twig', $data);
    $message -> setFrom('your email address'); //$configEmail->fromName);
    $message -> setTo('recipient email address'); //($configEmail->sentTo);
    $message -> setBody($msg,"text/html");

    //echo $message->toString();

    // Send the message
    $mailer->send($message, $failures);

    // output log
    file_put_contents(__DIR__ .'/../log/sentEmails.log', $sentEmaillogger->dump());
  }
}
