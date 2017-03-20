<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocTexteImage
 *
 * @ORM\Table(name="post_bloc_texte_image")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\BlocTexteImageRepository")
 */
class BlocTexteImage
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur_titre", type="string", length=6, nullable=true)
     */
    private $couleurTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur_texte", type="string", length=6)
     */
    private $couleurTexte;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur_fond", type="string", length=6)
     */
    private $couleurFond;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Post\Image", cascade={"persist", "remove"} )
     */
    private $image;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return BlocTexteImage
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set couleurTitre
     *
     * @param string $couleurTitre
     *
     * @return BlocTexteImage
     */
    public function setCouleurTitre($couleurTitre)
    {
        $this->couleurTitre = $couleurTitre;

        return $this;
    }

    /**
     * Get couleurTitre
     *
     * @return string
     */
    public function getCouleurTitre()
    {
        return $this->couleurTitre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return BlocTexteImage
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
     * Set couleurTexte
     *
     * @param string $couleurTexte
     *
     * @return BlocTexteImage
     */
    public function setCouleurTexte($couleurTexte)
    {
        $this->couleurTexte = $couleurTexte;

        return $this;
    }

    /**
     * Get couleurTexte
     *
     * @return string
     */
    public function getCouleurTexte()
    {
        return $this->couleurTexte;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return BlocTexteImage
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set altLien
     *
     * @param string $altLien
     *
     * @return BlocTexteImage
     */
    public function setAltLien($altLien)
    {
        $this->altLien = $altLien;

        return $this;
    }

    /**
     * Get altLien
     *
     * @return string
     */
    public function getAltLien()
    {
        return $this->altLien;
    }

    /**
     * Set image
     *
     * @param \MH\MailBundle\Entity\Post\Image $image
     *
     * @return BlocTexteImage
     */
    public function setImage(\MH\MailBundle\Entity\Post\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MH\MailBundle\Entity\Post\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set couleurFond
     *
     * @param string $couleurFond
     *
     * @return BlocTexteImage
     */
    public function setCouleurFond($couleurFond)
    {
        $this->couleurFond = $couleurFond;

        return $this;
    }

    /**
     * Get couleurFond
     *
     * @return string
     */
    public function getCouleurFond()
    {
        return $this->couleurFond;
    }
}
