<?php
namespace cms\Entity\Job\Contact;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact Phones
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_contact_phones")
 * @package Job
 */
class Phone extends Entity {
    
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
     * @var string phone number
     * @ORM\Column(type="string",length=20,nullable=false)
     */
    private $number;
    
    /**
     *
     * @var string Phone Number Type
     * @ORM\Column(type="string",length=20,nullable=false)
     */
    private $type;
    
    /**
     *
     * @var boolean Primary number
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $primary;
    
    /**
     *
     * @var Job\Contact
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\Contact",inversedBy="phones",cascade={"persist","remove"})
     */
    private $contact;
    
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