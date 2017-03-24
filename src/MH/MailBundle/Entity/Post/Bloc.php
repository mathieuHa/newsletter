<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bloc
 *
 * @ORM\Table(name="post_bloc")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\BlocRepository")
 */
class Bloc
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
     * @ORM\Column(name="hauteur", type="integer")
     */
    private $hauteur;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"})
     */
    private $couleur;




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
     * @return Bloc
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
     * Set couleur
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleur
     *
     * @return Bloc
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
