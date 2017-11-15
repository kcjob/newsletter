<?php
namespace UserEmail;

class EmailSenderv2
{
  static function mailmsg($emailDataObject, $configEmail)
  {
    $totalEmails = 0;
    $failures = [];

    $loader = new \Twig_Loader_Filesystem('Templates');
    $twig = new \Twig_Environment($loader);

    // Create the Transport
    $transport = (new \Swift_SmtpTransport('outgoing.ccny.cuny.edu', 587, 'tls'))
      -> setUsername('email name goes here') //$configEmail->userName)
      -> setPassword('email password goes here'); //$configEmail->userPassword);
    $mailer = new \Swift_Mailer($transport);

    // Create and register logger
    $sentEmaillogger = new \Swift_Plugins_Loggers_ArrayLogger();
    $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($sentEmaillogger));

    // Create a message
    $message = new \Swift_Message('Department of Science Newsletter');
    $message -> setFrom($configEmail->fromName);
      //-> setTo($emailDataObject->userEmailAddress) // users email addresses
    $message -> setTo($configEmail->sentTo);
    $message ->setContentType("text/html");
    $message->setBody(
    '<html>' .
    ' <body>' .
    '  <table class="main" bgcolor="purple">
        <tr>
          <td>
            <table class="lside" bgcolor="white">
              <tr><td><div style="background-color:black;color:white;padding:20px;">
                LEFT COLUMN &nbsp;
              </div></td></tr>
            </table>
          </td>
          <td>
            <table class="middle" bgcolor="white">
              <tr><td><div style="padding:20px;">'.
              '<img src="' . // Embed the file
                   $message->embed(\Swift_Image::fromPath('documents/newimg.jpg')) .
                 '" alt="Image" />' .
              '</div></td></tr>
            </table>
          </td>
          <td>
            <table class="rside" bgcolor="white">
              <tr><td><div style="background-color:black;color:white;padding:20px;">
                RIGHT COLUMN&nbsp;
              </div></td></tr>
            </table>
          </td>
        </tr>
      </table>'.
    ' </body>' .
    '</html>',
      'text/html' // Mark the content-type as HTML
    );

    // Send the message
    $mailer->send($message, $failures);

    // output log
    file_put_contents(__DIR__ .'/../log/sentEmails.log', $sentEmaillogger->dump());
  }
}
