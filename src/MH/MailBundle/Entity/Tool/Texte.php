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
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Paragraphe", cascade={"persist","remove"})
     */
    private $paragraphes;


    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist", "remove"} )
     */
    private $couleur;


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
     * Set paragraphes
     *
     * @param \MH\MailBundle\Entity\Tool\Paragraphe $paragraphes
     *
     * @return Texte
     */
    public function setParagraphes(\MH\MailBundle\Entity\Tool\Paragraphe $paragraphes = null)
    {
        $this->paragraphes = $paragraphes;

        return $this;
    }

    /**
     * Get paragraphes
     *
     * @return \MH\MailBundle\Entity\Tool\Paragraphe
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
}
