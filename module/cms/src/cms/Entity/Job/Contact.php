<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Job Contact
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_contacts")
 * @package Job
 */
class Contact extends Entity {
    
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
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var Contact\Phone
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Contact\Phone",mappedBy="contact",cascade={"persist","remove"})
     */
    private $phones;
    
    /**
     *
     * @var Contact\Email
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Contact\Email",mappedBy="contact",cascade={"persist","remove"})
     */
    private $emails;
    
    /**
     *
     * @var Contact\Address
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\Contact\Address",mappedBy="contact",cascade={"persist","remove"})
     */
    private $addresses;
    
    /**
     *
     * @var Contact\Type
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\Contact\Type",cascade={"persist","remove"})
     */
    private $type;
    
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
    private $addDate;
    
    /**
     *
     * @var datetime
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
     * @var Job\SelectedContact
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\SelectedContact",mappedBy="contact",cascade={"persist","remove"})
     */
    private $jobs;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$propery} = $value;
    }
    
    public function __construct() {
        parent::__construct();
        $this->phones = new Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new Doctrine\Common\Collections\ArrayCollection();
        $this->addresses = new Doctrine\Common\Collections\ArrayCollection();
        $this->jobs = new Doctrine\Common\Collections\ArrayCollection();
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