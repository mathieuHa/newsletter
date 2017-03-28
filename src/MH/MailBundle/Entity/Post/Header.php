<?php

namespace MH\MailBundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * Header
 *
 * @ORM\Table(name="post_header")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\Post\HeaderRepository")
 */
class Header
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @ORM\ManyToOne(targetEntity="MH\MailBundle\Entity\Tool\Image", cascade={"persist"} )
     */
    private $image;


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
     * Set image
     *
     * @param \MH\MailBundle\Entity\Tool\Image $image
     *
     * @return Header
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
}
