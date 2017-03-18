<?php

namespace MH\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="mailpost")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="bgcolor", type="string", length=6)
     */
    private $bgcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="textcolor", type="string", length=6)
     */
    private $textcolor;

    /**
     * @var integer
     *
     * @ORM\Column(name="hauteur", type="integer")
     */
    private $hauteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Mail",inversedBy="posts", cascade={"persist"})
     */
    private $mail;



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
     * Set texte
     *
     * @param string $texte
     *
     * @return Post
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set bgcolor
     *
     * @param string $bgcolor
     *
     * @return Post
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;

        return $this;
    }

    /**
     * Get bgcolor
     *
     * @return string
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Set textcolor
     *
     * @param string $textcolor
     *
     * @return Post
     */
    public function setTextcolor($textcolor)
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    /**
     * Get textcolor
     *
     * @return string
     */
    public function getTextcolor()
    {
        return $this->textcolor;
    }

    /**
     * Set hauteur
     *
     * @param integer $hauteur
     *
     * @return Post
     */
    public function setHauteur($hauteur)
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    /**
     * Get hauteur
     *
     * @return integer
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Post
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set mail
     *
     * @param \MH\MailBundle\Entity\Mail $mail
     *
     * @return Post
     */
    public function setMail(\MH\MailBundle\Entity\Mail $mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return \MH\MailBundle\Entity\Mail
     */
    public function getMail()
    {
        return $this->mail;
    }
}
