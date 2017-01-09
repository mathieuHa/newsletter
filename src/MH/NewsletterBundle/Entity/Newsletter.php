<?php

namespace MH\NewsletterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MH\NewsletterBundle\Form\NewsletterType;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="MH\NewsletterBundle\Repository\NewsletterRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Newsletter
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="week", type="string", length=255)
     */
    private $week;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="MH\NewsletterBundle\Entity\Rubrique",mappedBy="newsletter" , cascade={"persist","remove"})
     */
    private $rubriques;

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
     * Set name
     *
     * @param string $name
     *
     * @return Newsletter
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Newsletter
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->updateAt = $this->getDate();
        $this->rubriques = new ArrayCollection();
        $this->name = "L'e-bdo du Groupe ESIEA";
        $this->week = "Semaine X";
        $this->auteur = "communication";
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate ()
    {
        $this->setUpdateAt(new \DateTime());
    }

    /**
     * Set week
     *
     * @param string $week
     *
     * @return Newsletter
     */
    public function setWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return string
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Add rubrique
     *
     * @param \MH\NewsletterBundle\Entity\Rubrique $rubrique
     *
     * @return Newsletter
     */
    public function addRubrique(\MH\NewsletterBundle\Entity\Rubrique $rubrique)
    {
        $this->rubriques[] = $rubrique;

        $rubrique->setNewsletter($this);

        return $this;
    }

    /**
     * Remove rubrique
     *
     * @param \MH\NewsletterBundle\Entity\Rubrique $rubrique
     */
    public function removeRubrique(\MH\NewsletterBundle\Entity\Rubrique $rubrique)
    {
        $this->rubriques->removeElement($rubrique);
    }

    /**
     * Get rubriques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRubriques()
    {
        return $this->rubriques;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Newsletter
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Newsletter
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

}
