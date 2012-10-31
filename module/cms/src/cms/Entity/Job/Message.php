<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Job Messages
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_messages")
 * @package Job
 */
class Message extends Entity {
    
    /**
     *
     * @var integer $id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string Subject
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $subject;
    
    /**
     *
     * @var text
     * @ORM\Column(type="text",nullable=false)
     */
    private $body;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
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
     * @var Job
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job",inversedBy="messages",cascade={"persist","remove"})
     */
    private $job;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $emailed;
    
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