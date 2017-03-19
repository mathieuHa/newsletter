<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocTexte
 *
 * @ORM\Table(name="post_bloc_texte")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\BlocTexteRepository")
 */
class BlocTexte
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
     * @var int
     *
     * @ORM\Column(name="largeur", type="integer")
     */
    private $largeur;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=6)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="bgcolor", type="string", length=6)
     */
    private $bgcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="alignement", type="string", length=255)
     */
    private $alignement;

    /**
     * @var string
     *
     * @ORM\Column(name="taillepolice", type="string", length=255)
     */
    private $taillepolice;


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
     * Set largeur
     *
     * @param integer $largeur
     *
     * @return BlocTexte
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur
     *
     * @return int
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return BlocTexte
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
     * Set color
     *
     * @param string $color
     *
     * @return BlocTexte
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set bgcolor
     *
     * @param string $bgcolor
     *
     * @return BlocTexte
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;

        return $this;
    }

    /**
     * Get bgcolor
     *
     * @return string
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Set alignement
     *
     * @param string $alignement
     *
     * @return BlocTexte
     */
    public function setAlignement($alignement)
    {
        $this->alignement = $alignement;

        return $this;
    }

    /**
     * Get alignement
     *
     * @return string
     */
    public function getAlignement()
    {
        return $this->alignement;
    }

    /**
     * Set taillepolice
     *
     * @param string $taillepolice
     *
     * @return BlocTexte
     */
    public function setTaillepolice($taillepolice)
    {
        $this->taillepolice = $taillepolice;

        return $this;
    }

    /**
     * Get taillepolice
     *
     * @return string
     */
    public function getTaillepolice()
    {
        return $this->taillepolice;
    }
}
