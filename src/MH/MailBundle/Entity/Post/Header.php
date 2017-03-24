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
     * Header constructor.
     */
    public function __construct()
    {
        $this->image = new Image();
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
     * @ORM\OneToOne(targetEntity="MH\MailBundle\Entity\Tool\Image", cascade={"persist", "remove"} )
     */
    private $image;

    



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
