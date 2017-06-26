<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 12.11.2014
 * Time: 15:51
 */

namespace Webron\MailBundle\Classes;


class WebronMailer {

    private $mailer;

    public function __construct($mailer){
        $this->mailer = $mailer;
    }

    public function sendEmail($from='domport@domport.sk', $to='michal.chylik@gmail.com', $subject='Skuska1', $body='Skusobny text', $pathToAttachment=''){
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $body
//                $this->renderView(
//                    'HelloBundle:Hello:email.txt.twig',
//                    array('name' => $name)
//                )
            )
            ->setContentType("text/html");

        if (!empty($pathToAttachment)) $message->attach(\Swift_Attachment::fromPath($pathToAttachment));

        $this->mailer->send($message);
    }
}
