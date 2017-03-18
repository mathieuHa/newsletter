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
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=6)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="bgcouleur", type="string", length=6)
     */
    private $bgcouleur;

    /**
     * @var integer
     *
     * @ORM\Column(name="hauteur", type="integer")
     */
    private $hauteur;


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
     * Set texte
     *
     * @param string $texte
     *
     * @return Texte
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
     * @param string $couleur
     *
     * @return Texte
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set bgcouleur
     *
     * @param string $bgcouleur
     *
     * @return Texte
     */
    public function setBgcouleur($bgcouleur)
    {
        $this->bgcouleur = $bgcouleur;

        return $this;
    }

    /**
     * Get bgcouleur
     *
     * @return string
     */
    public function getBgcouleur()
    {
        return $this->bgcouleur;
    }

    /**
     * Set hauteur
     *
     * @param string $hauteur
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
     * @return string
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }


}
