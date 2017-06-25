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
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Texte", cascade={"persist", "remove"} )
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"})
     */
    private $couleurFond;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Lien", cascade={"persist", "remove"} )
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Image", cascade={"persist"} )
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;









    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __clone()
    {
        if ($this->id) {
            $this->setId(null);
            if ($this->texte!=null)
                $this->texte = clone $this->texte;
            if ($this->titre!=null)
                $this->titre = clone $this->titre;
        }
    }

    /**
     * Set id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set titre
     *
     * @param \MH\MailBundle\Entity\Tool\Lien $titre
     *
     * @return BlocTexteImage
     */
    public function setTitre(\MH\MailBundle\Entity\Tool\Lien $titre = null)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return \MH\MailBundle\Entity\Tool\Lien
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set image
     *
     * @param \MH\MailBundle\Entity\Tool\Image $image
     *
     * @return BlocTexteImage
     */
    public function setImage(\MH\MailBundle\Entity\Tool\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MH\MailBundle\Entity\Tool\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return BlocTexteImage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
