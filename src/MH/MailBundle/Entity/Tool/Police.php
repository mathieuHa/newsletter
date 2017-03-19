<?php

namespace MH\MailBundle\Entity\Tool;

use Doctrine\ORM\Mapping as ORM;

/**
 * Police
 *
 * @ORM\Table(name="tool_police")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Tool\PoliceRepository")
 */
class Police
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
     * @ORM\Column(name="taille", type="integer", unique=true)
     */
    private $taille;


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
     * Set taille
     *
     * @param integer $taille
     *
     * @return Police
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }
}
