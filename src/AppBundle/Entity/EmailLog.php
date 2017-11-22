<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailLog
 *
 * @ORM\Table(name="email_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmailLogRepository")
 */
class EmailLog
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="setto", type="string", length=255)
     */
    private $setto;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set setto
     *
     * @param string $setto
     *
     * @return EmailLog
     */
    public function setSetto($setto)
    {
        $this->setto = $setto;

        return $this;
    }

    /**
     * Get setto
     *
     * @return string
     */
    public function getSetto()
    {
        return $this->setto;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return EmailLog
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return EmailLog
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return EmailLog
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->time = new \DateTime("now");
    }

}

