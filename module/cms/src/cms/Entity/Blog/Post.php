<?php
namespace cms\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Post
 *
 * @author adodds
 * date 26-May-2011 16:35:45
 * @ORM\Entity
 * @ORM\Table(name="blog_posts")
 * @ORM\HasLifecycleCallbacks
 * @package Blog
 */
class Post extends Entity {
    
    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=false);
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $title;
    
    /**
     * @var text
     * @ORM\Column(type="text",nullable=false)
     */
    private $body;
    
    /**
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */    
    private $public;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */    
    private $addDate;
    
    /**
     *
     * @var cms\Entity\Blog
     * @ORM\ManyToOne(targetEntity="cms\Entity\Blog",inversedBy="posts",cascade={"persist","remove"})
     */
    private $blog;
    
    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="cms\Entity\Blog\Post\Tag",mappedBy="post",cascade={"persist","remove"})
     */
    private $tags;
    
    /**
     *
     * @var cms\Entity\User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    /**
     * @var cms\Entity\Blog\Post\Comment
     * @ORM\OneToMany(targetEntity="cms\Entity\Blog\Post\Comment",mappedBy="post",cascade={"persist","remove"})
     */
    private $comments;
    
    /**
     * Return Object Property
     * @param string $property
     * @return mixed 
     */
    public function __get($property) {
        return $this->$property;
    }
    
    /**
     * Set Object Property to Value
     * @param string $property
     * @param mixed $value 
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }
    
    /**
     * Constructor Define base values
     */
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }
    
    /**
     * @ORM\PreUpdate
     * Pre Update Function
     */
    public function preUpdate() {
        $this->modifiedDate = new \DateTime();
    }
    
    /**
     * @ORM\PrePersist
     * Pre Persist function
     */
    public function prePersist() {
         if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
}