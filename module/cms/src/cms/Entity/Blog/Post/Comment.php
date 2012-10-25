<?php
namespace cms\Entity\Blog\Post;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Comment
 *
 * @author adodds
 * date 27-May-2011 15:55:52
 * @ORM\Entity
 * @ORM\Table(name="blog_post_comments")
 * @ORM\HasLifecycleCallbacks
 * @package Blog Post
 */
class Comment extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false);
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */    
    private $title;
    
    /**
     *
     * @var text
     * @ORM\Column(type="text",nullable=false) 
     */
    private $comment;
    
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
     * @var cms\Entity\Blog\Post
     * @ORM\ManyToOne(targetEntity="cms\Entity\Blog\Post",inversedBy="comments",cascade={"persist","remove"})
     */
    private $post;
    
    /**
     *
     * @var cms\Entity\User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
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
     * Pre Persist
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
    
    /**
     * Pre Update
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->modifiedDate = new \DateTime();
    }
    
}