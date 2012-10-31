<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jobs
 * @ORM\Table(name="job")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package Job
 */

class Job extends Entity {
    
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
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $handler;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=30,nullable=false) 
     */
    private $jobNumber;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=30,nullable=false) 
     */
    private $clientReference;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=30,nullable=false) 
     */
    private $clientName;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=true) 
     */
    private $instructionDate;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=true) 
     */
    private $ackDate;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=15,nullable=true)
     */
    private $status;
    
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
    private $addUser;
    
    /**
     *
     * @var job\SelectedContact
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\SelectedContact",mappedBy="job",cascade={"persist","remove"})
     */
    private $contacts;
    
    /**
     *
     * @var Job\File
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\File",mappedBy="job",cascade={"persist","remove"})
     */
    private $files;
    
    /**
     *
     * @var Job\Message
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Message",mappedBy="job",cascade={"persist","remove"})
     */
    private $messages;
    
    /**
     *
     * @var Job\Note
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Note",mappedBy="job",cascade={"persist","remove"})
     */
    private $notes;
    
    /**
     *
     * @var Job\Position
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Position",mappedBy="job",cascade={"persist","remove"})
     */
    private $positions;
    
    //Todo: Add job links
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
        return $this->{$property};
    }
    
    public function __construct() {
        parent::__construct();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
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