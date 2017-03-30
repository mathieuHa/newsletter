<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="post_agenda")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\AgendaRepository")
 */
class Agenda
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
     * @ORM\Column(name="mois1", type="string", length=255)
     */
    private $mois1;

    /**
     * @var string
     *
     * @ORM\Column(name="jour1", type="string", length=255)
     */
    private $jour1;

    /**
     * @var string
     *
     * @ORM\Column(name="texte1", type="string", length=255)
     */
    private $texte1;

    /**
     * @var string
     *
     * @ORM\Column(name="mois2", type="string", length=255)
     */
    private $mois2;

    /**
     * @var string
     *
     * @ORM\Column(name="jour2", type="string", length=255)
     */
    private $jour2;

    /**
     * @var string
     *
     * @ORM\Column(name="mois3", type="string", length=255)
     */
    private $mois3;

    /**
     * @var string
     *
     * @ORM\Column(name="mois4", type="string", length=255)
     */
    private $mois4;

    /**
     * @var string
     *
     * @ORM\Column(name="jour3", type="string", length=255)
     */
    private $jour3;

    /**
     * @var string
     *
     * @ORM\Column(name="jour4", type="string", length=255)
     */
    private $jour4;

    /**
     * @var string
     *
     * @ORM\Column(name="texte2", type="string", length=255)
     */
    private $texte2;

    /**
     * @var string
     *
     * @ORM\Column(name="texte3", type="string", length=255)
     */
    private $texte3;

    /**
     * @var string
     *
     * @ORM\Column(name="texte4", type="string", length=255)
     */
    private $texte4;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Police", cascade={"persist"} )
     */
    private $police;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"} )
     */
    private $couleur;

    /**
     * @ORM\ManyToMany(targetEntity="MH\MailBundle\Entity\Tool\Lien", cascade={"persist", "remove"} )
     */
    private $liens;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->liens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __clone()
    {
        if ($this->id) {
            $this->setId(null);
            $liens = $this->getLiens();
            $this->liens = new ArrayCollection();
            foreach ($liens as $lien)
            {
                $clonelien = clone $lien;
                $this->addLien($clonelien);
            }
        }
    }

    public function __toString()
    {
        return "Agenda";
    }

    /**
     * Set id
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
     * Set mois1
     *
     * @param string $mois1
     *
     * @return Agenda
     */
    public function setMois1($mois1)
    {
        $this->mois1 = $mois1;

        return $this;
    }

    /**
     * Get mois1
     *
     * @return string
     */
    public function getMois1()
    {
        return $this->mois1;
    }

    /**
     * Set jour1
     *
     * @param string $jour1
     *
     * @return Agenda
     */
    public function setJour1($jour1)
    {
        $this->jour1 = $jour1;

        return $this;
    }

    /**
     * Get jour1
     *
     * @return string
     */
    public function getJour1()
    {
        return $this->jour1;
    }

    /**
     * Set texte1
     *
     * @param string $texte1
     *
     * @return Agenda
     */
    public function setTexte1($texte1)
    {
        $this->texte1 = $texte1;

        return $this;
    }

    /**
     * Get texte1
     *
     * @return string
     */
    public function getTexte1()
    {
        return $this->texte1;
    }

    /**
     * Set mois2
     *
     * @param string $mois2
     *
     * @return Agenda
     */
    public function setMois2($mois2)
    {
        $this->mois2 = $mois2;

        return $this;
    }

    /**
     * Get mois2
     *
     * @return string
     */
    public function getMois2()
    {
        return $this->mois2;
    }

    /**
     * Set jour2
     *
     * @param string $jour2
     *
     * @return Agenda
     */
    public function setJour2($jour2)
    {
        $this->jour2 = $jour2;

        return $this;
    }

    /**
     * Get jour2
     *
     * @return string
     */
    public function getJour2()
    {
        return $this->jour2;
    }

    /**
     * Set mois3
     *
     * @param string $mois3
     *
     * @return Agenda
     */
    public function setMois3($mois3)
    {
        $this->mois3 = $mois3;

        return $this;
    }

    /**
     * Get mois3
     *
     * @return string
     */
    public function getMois3()
    {
        return $this->mois3;
    }

    /**
     * Set mois4
     *
     * @param string $mois4
     *
     * @return Agenda
     */
    public function setMois4($mois4)
    {
        $this->mois4 = $mois4;

        return $this;
    }

    /**
     * Get mois4
     *
     * @return string
     */
    public function getMois4()
    {
        return $this->mois4;
    }

    /**
     * Set jour3
     *
     * @param string $jour3
     *
     * @return Agenda
     */
    public function setJour3($jour3)
    {
        $this->jour3 = $jour3;

        return $this;
    }

    /**
     * Get jour3
     *
     * @return string
     */
    public function getJour3()
    {
        return $this->jour3;
    }

    /**
     * Set jour4
     *
     * @param string $jour4
     *
     * @return Agenda
     */
    public function setJour4($jour4)
    {
        $this->jour4 = $jour4;

        return $this;
    }

    /**
     * Get jour4
     *
     * @return string
     */
    public function getJour4()
    {
        return $this->jour4;
    }

    /**
     * Set texte2
     *
     * @param string $texte2
     *
     * @return Agenda
     */
    public function setTexte2($texte2)
    {
        $this->texte2 = $texte2;

        return $this;
    }

    /**
     * Get texte2
     *
     * @return string
     */
    public function getTexte2()
    {
        return $this->texte2;
    }

    /**
     * Set texte3
     *
     * @param string $texte3
     *
     * @return Agenda
     */
    public function setTexte3($texte3)
    {
        $this->texte3 = $texte3;

        return $this;
    }

    /**
     * Get texte3
     *
     * @return string
     */
    public function getTexte3()
    {
        return $this->texte3;
    }

    /**
     * Set texte4
     *
     * @param string $texte4
     *
     * @return Agenda
     */
    public function setTexte4($texte4)
    {
        $this->texte4 = $texte4;

        return $this;
    }

    /**
     * Get texte4
     *
     * @return string
     */
    public function getTexte4()
    {
        return $this->texte4;
    }

    /**
     * Set police
     *
     * @param \MH\MailBundle\Entity\Tool\Police $police
     *
     * @return Agenda
     */
    public function setPolice(\MH\MailBundle\Entity\Tool\Police $police = null)
    {
        $this->police = $police;

        return $this;
    }

    /**
     * Get police
     *
     * @return \MH\MailBundle\Entity\Tool\Police
     */
    public function getPolice()
    {
        return $this->police;
    }

    /**
     * Set couleur
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleur
     *
     * @return Agenda
     */
    public function setCouleur(\MH\MailBundle\Entity\Tool\Couleur $couleur = null)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return \MH\MailBundle\Entity\Tool\Couleur
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Add lien
     *
     * @param \MH\MailBundle\Entity\Tool\Lien $lien
     *
     * @return Agenda
     */
    public function addLien(\MH\MailBundle\Entity\Tool\Lien $lien)
    {
        $this->liens[] = $lien;

        return $this;
    }

    /**
     * Remove lien
     *
     * @param \MH\MailBundle\Entity\Tool\Lien $lien
     */
    public function removeLien(\MH\MailBundle\Entity\Tool\Lien $lien)
    {
        $this->liens->removeElement($lien);
    }

    /**
     * Get liens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiens()
    {
        return $this->liens;
    }
}
