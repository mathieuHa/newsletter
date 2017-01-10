<?php

namespace MH\NewsletterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique")
 * @ORM\Entity(repositoryClass="MH\NewsletterBundle\Repository\RubriqueRepository")
 */
class Rubrique
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
     * @ORM\Column(name="Icone", type="string", length=255)
     */
    private $Icone;

    /**
     * @var string
     *
     * @ORM\Column(name="Image", type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\ManyToOne(targetEntity="MH\NewsletterBundle\Entity\Newsletter",inversedBy="rubriques", cascade={"persist"})
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity="MH\NewsletterBundle\Entity\Post",mappedBy="rubrique", cascade={"persist", "remove"})
     */
    private $posts;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="soustitre", type="text", nullable=true)
     */
    private $soustitre;

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
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __clone() {
        if ($this->id) {
            $posts = $this->getPosts();
            $this->posts = new ArrayCollection();
            foreach ($posts as $post)
            {
                $clonepost = clone $post;
                $this->addPost($clonepost);
            }
        }
    }

    /**
     * Set icone
     *
     * @param string $icone
     *
     * @return Rubrique
     */
    public function setIcone($icone)
    {
        $this->Icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->Icone;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Rubrique
     */
    public function setImage($image)
    {
        $this->Image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * Set newsletter
     *
     * @param \MH\NewsletterBundle\Entity\Newsletter $newsletter
     *
     * @return Rubrique
     */
    public function setNewsletter(\MH\NewsletterBundle\Entity\Newsletter $newsletter = null)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return \MH\NewsletterBundle\Entity\Newsletter
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Add post
     *
     * @param \MH\NewsletterBundle\Entity\Post $post
     *
     * @return Rubrique
     */
    public function addPost(\MH\NewsletterBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        $post->setRubrique($this);

        return $this;
    }

    /**
     * Remove post
     *
     * @param \MH\NewsletterBundle\Entity\Post $post
     */
    public function removePost(\MH\NewsletterBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Rubrique
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rubrique
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
     * Set soustitre
     *
     * @param string $soustitre
     *
     * @return Rubrique
     */
    public function setSoustitre($soustitre)
    {
        $this->soustitre = $soustitre;

        return $this;
    }

    /**
     * @ORM\PostUpdate
     * @ORM\PostRemove
     * @ORM\PostPersist
     */
    public function updateDate ()
    {
        $this->getNewsletter()->updateDate();
    }

    /**
     * Get soustitre
     *
     * @return string
     */
    public function getSoustitre()
    {
        return $this->soustitre;
    }
}
