<?php
namespace cms\Entity\News;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * 
 * @ORM\Table(name="news_comments")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package News
 */

class Comment extends Entity {
    
    /**
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
    private $addDate;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     *
     * @var cms\Entity\User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    /**
     *
     * @var cms\Entity\News
     * @ORM\ManyToOne(targetEntity="cms\Entity\News",inversedBy="comments",cascade={"persist","remove"})
     */
    private $story;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    /**
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