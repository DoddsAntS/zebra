<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Blog
 *
 * @author adodds
 * @ORM\Entity
 * @ORM\Table(name="blogs")
 * @package Blog
 */
class Blog extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */    
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     *
     * @param \Doctrine\Common\Collection\ArrayCollection
     * @ORM\OneToMany(targetEntity="cms\Entity\Blog\Tag",mappedBy="blog",cascade={"persist","remove"})
     */
    private $tags;
    
    /**
     * @param \Doctrine\Common\Collection\ArrayCollection
     * @ORM\OneToMany(targetEntity="cms\Entity\Blog\Post",mappedBy="blog",cascade={"persist","remove"})
     * @ORM\OrderBy({"addDate"="DESC"}) 
     */
    private $posts;
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->modifiedDate = new \DateTime();
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
    
    /**
     * Set object property
     * @param string $property
     * @param mixed $value 
     */
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    /**
     * Return object property
     * @param string $property
     * @return mixed 
     */
    public function __get($property) {
        return $this->{$property};
    }
}