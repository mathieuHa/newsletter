<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paragraphe
 *
 * @ORM\Table(name="tool_paragraphe")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\ParagrapheRepository")
 */
class Paragraphe
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
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Texte",inversedBy="paragraphes", cascade={"persist"})
     */
    private $text;


    

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
     * @return Paragraphe
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
     * Set text
     *
     * @param \MH\MailBundle\Entity\Tool\Texte $text
     *
     * @return Paragraphe
     */
    public function setText(\MH\MailBundle\Entity\Tool\Texte $text = null)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return \MH\MailBundle\Entity\Tool\Texte
     */
    public function getText()
    {
        return $this->text;
    }
}
