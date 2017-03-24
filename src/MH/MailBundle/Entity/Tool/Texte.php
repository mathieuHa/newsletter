<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Texte
 *
 * @ORM\Table(name="tool_texte")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\TexteRepository")
 */
class Texte
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
     * @ORM\ManyToMany(targetEntity="MH\MailBundle\Entity\Tool\Paragraphe", cascade={"persist","remove"})
     */
    private $paragraphes;


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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paragraphes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add paragraphe
     *
     * @param \MH\MailBundle\Entity\Tool\Paragraphe $paragraphe
     *
     * @return Texte
     */
    public function addParagraphe(\MH\MailBundle\Entity\Tool\Paragraphe $paragraphe)
    {
        $this->paragraphes[] = $paragraphe;

        return $this;
    }

    /**
     * Remove paragraphe
     *
     * @param \MH\MailBundle\Entity\Tool\Paragraphe $paragraphe
     */
    public function removeParagraphe(\MH\MailBundle\Entity\Tool\Paragraphe $paragraphe)
    {
        $this->paragraphes->removeElement($paragraphe);
    }

    /**
     * Get paragraphes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParagraphes()
    {
        return $this->paragraphes;
    }

    /**
     * Set couleur
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleur
     *
     * @return Texte
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
     * @return Texte
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
