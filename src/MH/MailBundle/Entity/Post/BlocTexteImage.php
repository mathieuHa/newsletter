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
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist", "remove"} )
     */
    private $couleurTitre;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Texte", cascade={"persist", "remove"} )
     */
    private $texte;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist", "remove"} )
     */
    private $couleurFond;

    /**
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Lien", cascade={"persist", "remove"} )
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
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleurTitre
     *
     * @return BlocTexteImage
     */
    public function setCouleurTitre(\MH\MailBundle\Entity\Tool\Couleur $couleurTitre = null)
    {
        $this->couleurTitre = $couleurTitre;

        return $this;
    }

    /**
     * Get couleurTitre
     *
     * @return \MH\MailBundle\Entity\Tool\Couleur
     */
    public function getCouleurTitre()
    {
        return $this->couleurTitre;
    }

    /**
     * Set texte
     *
     * @param \MH\MailBundle\Entity\Tool\Texte $texte
     *
     * @return BlocTexteImage
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
     * @return BlocTexteImage
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
     * Set lien
     *
     * @param \MH\MailBundle\Entity\Tool\Lien $lien
     *
     * @return BlocTexteImage
     */
    public function setLien(\MH\MailBundle\Entity\Tool\Lien $lien = null)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return \MH\MailBundle\Entity\Tool\Lien
     */
    public function getLien()
    {
        return $this->lien;
    }
}
