<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lien
 *
 * @ORM\Table(name="tool_lien")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\LienRepository")
 */
class Lien
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
     * @ORM\Column(name="href", type="string", length=255)
     */
    private $href;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\MiniTexte", cascade={"persist", "remove"})
     */
    private $texte;

    /**
     * @var bool
     *
     * @ORM\Column(name="target", type="boolean")
     */
    private $target;

    public function __toString()
    {
        return $this->getTexte()->getTexte();
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
     * Set href
     *
     * @param string $href
     *
     * @return Lien
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Lien
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set target
     *
     * @param boolean $target
     *
     * @return Lien
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return boolean
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set texte
     *
     * @param \MH\MailBundle\Entity\Tool\MiniTexte $texte
     *
     * @return Lien
     */
    public function setTexte(\MH\MailBundle\Entity\Tool\MiniTexte $texte = null)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return \MH\MailBundle\Entity\Tool\MiniTexte
     */
    public function getTexte()
    {
        return $this->texte;
    }
}
