<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couleur
 *
 * @ORM\Table(name="tool_couleur")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\CouleurRepository")
 */
class Couleur
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
     * @ORM\Column(name="valeur", type="string", length=6, unique=true)
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=32)
     */
    private $nom;

    public function __toString()
    {
        return (string)$this->getValeur();
    }

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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Couleur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Couleur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
