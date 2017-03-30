<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="post_contact")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __clone()
    {
        if ($this->id) {
            $this->setId(null);
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
