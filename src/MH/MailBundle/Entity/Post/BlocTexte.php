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
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Couleur", cascade={"persist"})
     */
    private $couleurFond;

    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Texte", cascade={"persist", "remove"} )
     */
    private $texte;


    /**
     * Get id
     *
     * @return int
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
     * Set couleurFond
     *
     * @param \MH\MailBundle\Entity\Tool\Couleur $couleurFond
     *
     * @return BlocTexte
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
     * Set texte
     *
     * @param \MH\MailBundle\Entity\Tool\Texte $texte
     *
     * @return BlocTexte
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
}
