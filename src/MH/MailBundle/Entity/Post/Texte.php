<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * Texte
 *
 * @ORM\Table(name="post_texte")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\TexteRepository")
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
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Texte", cascade={"persist", "remove"} )
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"})
     */
    private $couleurFond;

    /**
     * @var integer
     *
     * @ORM\Column(name="hauteur", type="integer")
     */
    private $hauteur;




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
     * Set hauteur
     *
     * @param integer $hauteur
     *
     * @return Texte
     */
    public function setHauteur($hauteur)
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    /**
     * Get hauteur
     *
     * @return integer
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    

    /**
     * Set texte
     *
     * @param \MH\MailBundle\Entity\Tool\Texte $texte
     *
     * @return Texte
     */
    public function setTexte(\MH\MailBundle\Entity\Tool\Texte $texte = null)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return \MH\MailBundle\Entity\Tool\Texte
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set couleurFond
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleurFond
     *
     * @return Texte
     */
    public function setCouleurFond(\MH\MailBundle\Entity\Tool\Couleur $couleurFond = null)
    {
        $this->couleurFond = $couleurFond;

        return $this;
    }

    /**
     * Get couleurFond
     *
     * @return \MH\MailBundle\Entity\Tool\Couleur
     */
    public function getCouleurFond()
    {
        return $this->couleurFond;
    }
}
