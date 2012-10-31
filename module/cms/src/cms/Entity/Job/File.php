<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Job Files
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_files")
 * @package Job
 */
class File extends Entity {
    
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
     * @var string File Name
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var File\Type
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\File\Type",cascade={"persist","remove"})
     */
    private $type;
    
    /**
     *
     * @var string
     * @ORM\Column(type="text",nullable=false)
     */
    private $location;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     *
     * @var type 
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     *
     * @var type 
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    /**
     *
     * @var Job
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job",inversedBy="files",cascade={"persist","remove"})
     */
    private $job;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist 
     */
    public function preUpdate() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
    
}