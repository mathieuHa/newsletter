<?php

namespace MH\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostType
 *
 * @ORM\Table(name="post_type")
 * @ORM\Entity(repositoryClass="MH\MailBundle\Repository\PostTypeRepository")
 */
class PostType
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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="imgsrc", type="string", length=255)
     */
    private $imgsrc;

    /**
     * @var string
     *
     * @ORM\Column(name="imgalt", type="string", length=255)
     */
    private $imgalt;


    /**
     * PostType constructor.
     * @param string $name
     * @param string $imgsrc
     * @param string $imgalt
     */
    public function __construct($name, $imgsrc, $imgalt)
    {
        $this->name = $name;
        $this->imgsrc = $imgsrc;
        $this->imgalt = $imgalt;
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
     * Set name
     *
     * @param string $name
     *
     * @return PostType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set imgsrc
     *
     * @param string $imgsrc
     *
     * @return PostType
     */
    public function setImgsrc($imgsrc)
    {
        $this->imgsrc = $imgsrc;

        return $this;
    }

    /**
     * Get imgsrc
     *
     * @return string
     */
    public function getImgsrc()
    {
        return $this->imgsrc;
    }

    /**
     * Set imgalt
     *
     * @param string $imgalt
     *
     * @return PostType
     */
    public function setImgalt($imgalt)
    {
        $this->imgalt = $imgalt;

        return $this;
    }

    /**
     * Get imgalt
     *
     * @return string
     */
    public function getImgalt()
    {
        return $this->imgalt;
    }

    /**
     * Set imghelpsrc
     *
     * @param string $imghelpsrc
     *
     * @return PostType
     */
    public function setImghelpsrc($imghelpsrc)
    {
        $this->imghelpsrc = $imghelpsrc;

        return $this;
    }

    /**
     * Get imghelpsrc
     *
     * @return string
     */
    public function getImghelpsrc()
    {
        return $this->imghelpsrc;
    }

    /**
     * Set imghelpalt
     *
     * @param string $imghelpalt
     *
     * @return PostType
     */
    public function setImghelpalt($imghelpalt)
    {
        $this->imghelpalt = $imghelpalt;

        return $this;
    }

    /**
     * Get imghelpalt
     *
     * @return string
     */
    public function getImghelpalt()
    {
        return $this->imghelpalt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return PostType
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
