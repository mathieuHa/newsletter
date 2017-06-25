<?php

namespace MH\MailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MH\MailBundle\Entity\Post\Texte;

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
     * @ORM\Column(name="slug", type="text")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;



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
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\Agenda", cascade={"persist", "remove"})
     */
    private $agenda;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\Header", cascade={"persist", "remove"})
     */
    private $header;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\Texte", cascade={"persist", "remove"})
     */
    private $texte;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\Bloc", cascade={"persist", "remove"})
     */
    private $bloc;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\ButtonRed", cascade={"persist", "remove"})
     */
    private $buttonred;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\BlocTexteImage", cascade={"persist", "remove"})
     */
    private $blocphototexte;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\BlocTexte", cascade={"persist", "remove"})
     */
    private $bloctexte;

    public function __clone() {
        if ($this->id) {
            $this->setId(null);
            if ($this->bloc!=null)
                $this->bloc = clone $this->bloc;
            if ($this->blocphototexte!=null)
                $this->blocphototexte = clone $this->blocphototexte;
            if ($this->texte!=null)
                $this->texte = clone $this->texte;
            if ($this->bloctexte!=null)
                $this->bloctexte = clone $this->bloctexte;
            if ($this->agenda!=null)
                $this->agenda = clone $this->agenda;
            if ($this->header!=null)
                $this->header = clone $this->header;
            if ($this->buttonred!=null)
                $this->buttonred = clone $this->buttonred;
        }
    }

    public function __construct($slug, $name, $description)
    {
        $this->setSlug($slug);
        $this->setName($name);
        $this->setDescription($description);
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
     * Set agenda
     *
     * @param \MH\MailBundle\Entity\Post\Agenda $agenda
     *
     * @return Post
     */
    public function setAgenda(\MH\MailBundle\Entity\Post\Agenda $agenda = null)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return \MH\MailBundle\Entity\Post\Agenda
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set id
     *
     */
    public function setId($id)
    {
        $this->id = $id;
    }
   

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Get mail
     *
     * @return \MH\MailBundle\Entity\Mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set header
     *
     * @param \MH\MailBundle\Entity\Post\Header $header
     *
     * @return Post
     */
    public function setHeader(\MH\MailBundle\Entity\Post\Header $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \MH\MailBundle\Entity\Post\Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set texte
     *
     * @param \MH\MailBundle\Entity\Post\Texte $texte
     *
     * @return Post
     */
    public function setTexte(\MH\MailBundle\Entity\Post\Texte $texte = null)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return \MH\MailBundle\Entity\Post\Texte
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set buttonred
     *
     * @param \MH\MailBundle\Entity\Post\ButtonRed $buttonred
     *
     * @return Post
     */
    public function setButtonRed(\MH\MailBundle\Entity\Post\ButtonRed $buttonred = null)
    {
        $this->buttonred = $buttonred;

        return $this;
    }

    /**
     * Get buttonred
     *
     * @return \MH\MailBundle\Entity\Post\ButtonRed
     */
    public function getButtonRed()
    {
        return $this->buttonred;
    }

    /**
     * Set bloc
     *
     * @param \MH\MailBundle\Entity\Post\Bloc $bloc
     *
     * @return Post
     */
    public function setBloc(\MH\MailBundle\Entity\Post\Bloc $bloc = null)
    {
        $this->bloc = $bloc;

        return $this;
    }
    

    /**
     * Get bloc
     *
     * @return \MH\MailBundle\Entity\Post\Bloc
     */
    public function getBloc()
    {
        return $this->bloc;
    }
    

    /**
     * Set blocphototexte
     *
     * @param \MH\MailBundle\Entity\Post\BlocTexteImage $blocphototexte
     *
     * @return Post
     */
    public function setBlocphototexte(\MH\MailBundle\Entity\Post\BlocTexteImage $blocphototexte = null)
    {
        $this->blocphototexte = $blocphototexte;

        return $this;
    }

    /**
     * Get blocphototexte
     *
     * @return \MH\MailBundle\Entity\Post\BlocTexteImage
     */
    public function getBlocphototexte()
    {
        return $this->blocphototexte;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Post
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
     * Set bloctexte
     *
     * @param \MH\MailBundle\Entity\Post\BlocTexte $bloctexte
     *
     * @return Post
     */
    public function setBloctexte(\MH\MailBundle\Entity\Post\BlocTexte $bloctexte = null)
    {
        $this->bloctexte = $bloctexte;

        return $this;
    }

    /**
     * Get bloctexte
     *
     * @return \MH\MailBundle\Entity\Post\BlocTexte
     */
    public function getBloctexte()
    {
        return $this->bloctexte;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
