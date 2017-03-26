<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Texte
 *
 * @ORM\Table(name="tool_minitexte")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\TexteRepository")
 */
class MiniTexte
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
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"} )
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Police", cascade={"persist"} )
     */
    private $police;


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
     * Set texte
     *
     * @param string $texte
     *
     * @return MiniTexte
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
     * Set couleur
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleur
     *
     * @return MiniTexte
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
     * Set police
     *
     * @param \MH\MailBundle\Entity\Tool\Police $police
     *
     * @return MiniTexte
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
}
