<?php

namespace AppBundle\Service;


use AppBundle\Entity\EmailLog;
use Doctrine\ORM\EntityManagerInterface;

class Emailing
{
    private $em;
    private $mailer;
    public function __construct(\Swift_Mailer $mailer, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->mailer= $mailer;
    }

    public function sendMessage($setto,$name,$message){
        $newMessage = (new \Swift_Message($name))
            ->setFrom('zawert23879@gmail.com')
            ->setTo($setto)
            ->setBody($message);
        $this->mailer->send($newMessage);
        $emailLog = new EmailLog();

        $emailLog->setSetto($setto);
        $emailLog->setName($name);
        $emailLog->setMessage($message);
        $emailLog->setTime(new \DateTime("now"));
        $this->em->persist($emailLog);
        $this->em->flush();
    }

}