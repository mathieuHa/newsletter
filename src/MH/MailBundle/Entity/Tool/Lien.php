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
     * @var bool
     *
     * @ORM\Column(name="target", type="boolean")
     */
    private $target;


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
     * @return bool
     */
    public function getTarget()
    {
        return $this->target;
    }
}
