<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Table(name="news")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package News
 */

class News extends Entity {
    
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
    private $title;
    
    /**
     * @var text
     * @ORM\Column(type="text",nullable=false)
     */
    private $body;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addTime;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedTime;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $expireTime;
    
    /**
     * @var cms\Entity\News\Tag
     * @ORM\OneToMany(targetEntity="cms\Entity\News\Tag",mappedBy="story",cascade={"persist","remove"})
     */
    private $tags;
    
    /**
     * @var cms\Entity\News\Comment
     * @ORM\OneToMany(targetEntity="cms\Entity\News\Comment",mappedBy="story",cascade={"persist","remove"})
     */
    private $comments;
    
    /**
     *
     * @var cms\Entity\User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }
    
    /**
     * Pre update/persist function to update modified time automagically
     * @ORM\PrePersist
     * @ORM\PreUpdate 
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
    
}