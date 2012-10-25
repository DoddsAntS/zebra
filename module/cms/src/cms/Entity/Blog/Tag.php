<?php
namespace cms\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Tag
 *
 * @author adodds
 * date 27-May-2011 11:14:03
 * @ORM\Entity
 * @ORM\Table(name="blog_tags")
 * @ORM\HasLifecycleCallbacks
 * @package Blog
 */
class Tag extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
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
     * @param \cms\Entity\Blog
     * @ORM\ManyToOne(targetEntity="cms\Entity\Blog",inversedBy="tags",cascade={"persist","remove"})
     */
    private $blog;
    
    /**
     * @var type 
     * @ORM\ManyToOne(targetEntity="cms\Entity\Tag",cascade={"persist","remove"})
     */
    private $tag;
    
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
     * Pre Update Function
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->modifiedDate = new \DateTime();
    }
    
    /**
     * Pre Persist Function
     * @ORM\PrePersist
     */
    public function prePersist() {
         if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
}