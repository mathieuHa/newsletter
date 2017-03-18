<?php

namespace MH\MailBundle\Entity\Post;

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
     * @ORM\Column(name="lien1", type="string", length=255)
     */
    private $lien1;

    /**
     * @var string
     *
     * @ORM\Column(name="textlien1", type="string", length=255)
     */
    private $textlien1;

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
     * @var string
     *
     * @ORM\Column(name="textlien2", type="string", length=255)
     */
    private $textlien2;

    /**
     * @var string
     *
     * @ORM\Column(name="textlien3", type="string", length=255)
     */
    private $textlien3;

    /**
     * @var string
     *
     * @ORM\Column(name="textlien4", type="string", length=255)
     */
    private $textlien4;

    /**
     * @var string
     *
     * @ORM\Column(name="lien2", type="string", length=255)
     */
    private $lien2;

    /**
     * @var string
     *
     * @ORM\Column(name="lien3", type="string", length=255)
     */
    private $lien3;

    /**
     * @var string
     *
     * @ORM\Column(name="lien4", type="string", length=255)
     */
    private $lien4;


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
     * Set lien1
     *
     * @param string $lien1
     *
     * @return Agenda
     */
    public function setLien1($lien1)
    {
        $this->lien1 = $lien1;

        return $this;
    }

    /**
     * Get lien1
     *
     * @return string
     */
    public function getLien1()
    {
        return $this->lien1;
    }

    /**
     * Set textelien1
     *
     * @param string $textelien1
     *
     * @return Agenda
     */
    public function setTextelien1($textelien1)
    {
        $this->textelien1 = $textelien1;

        return $this;
    }

    /**
     * Get textelien1
     *
     * @return string
     */
    public function getTextelien1()
    {
        return $this->textelien1;
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
     * Set textlien2
     *
     * @param string $textlien2
     *
     * @return Agenda
     */
    public function setTextlien2($textlien2)
    {
        $this->textlien2 = $textlien2;

        return $this;
    }

    /**
     * Get textlien2
     *
     * @return string
     */
    public function getTextlien2()
    {
        return $this->textlien2;
    }

    /**
     * Set textlien3
     *
     * @param string $textlien3
     *
     * @return Agenda
     */
    public function setTextlien3($textlien3)
    {
        $this->textlien3 = $textlien3;

        return $this;
    }

    /**
     * Get textlien3
     *
     * @return string
     */
    public function getTextlien3()
    {
        return $this->textlien3;
    }

    /**
     * Set textlien4
     *
     * @param string $textlien4
     *
     * @return Agenda
     */
    public function setTextlien4($textlien4)
    {
        $this->textlien4 = $textlien4;

        return $this;
    }

    /**
     * Get textlien4
     *
     * @return string
     */
    public function getTextlien4()
    {
        return $this->textlien4;
    }

    /**
     * Set lien2
     *
     * @param string $lien2
     *
     * @return Agenda
     */
    public function setLien2($lien2)
    {
        $this->lien2 = $lien2;

        return $this;
    }

    /**
     * Get lien2
     *
     * @return string
     */
    public function getLien2()
    {
        return $this->lien2;
    }

    /**
     * Set lien3
     *
     * @param string $lien3
     *
     * @return Agenda
     */
    public function setLien3($lien3)
    {
        $this->lien3 = $lien3;

        return $this;
    }

    /**
     * Get lien3
     *
     * @return string
     */
    public function getLien3()
    {
        return $this->lien3;
    }

    /**
     * Set lien4
     *
     * @param string $lien4
     *
     * @return Agenda
     */
    public function setLien4($lien4)
    {
        $this->lien4 = $lien4;

        return $this;
    }

    /**
     * Get lien4
     *
     * @return string
     */
    public function getLien4()
    {
        return $this->lien4;
    }

    /**
     * Set textlien1
     *
     * @param string $textlien1
     *
     * @return Agenda
     */
    public function setTextlien1($textlien1)
    {
        $this->textlien1 = $textlien1;

        return $this;
    }

    /**
     * Get textlien1
     *
     * @return string
     */
    public function getTextlien1()
    {
        return $this->textlien1;
    }
}
