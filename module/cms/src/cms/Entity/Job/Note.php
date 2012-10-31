<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Job Notes
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_notes")
 * @package Job
 */
class Note extends Entity {
    
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
     * @var text Note Body
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
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    /**
     *
     * @var Job
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job",inversedBy="notes",cascade={"persist","remove"})
     */
    private $job;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
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