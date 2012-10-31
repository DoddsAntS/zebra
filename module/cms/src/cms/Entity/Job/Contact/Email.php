<?php
namespace cms\Entity\Job\Contact;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact Emails
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_contact_emails")
 * @package Job
 */
class Email extends Entity {
    
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
     * @var Text
     * @ORM\Column(type="text",nullable=false) 
     */
    private $email;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=20,nullable=false) 
     */
    private $type;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false);
     */
    private $primary;
    
    /**
     *
     * @var job\Contact
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\Contact",inversedBy="emails",cascade={"persist","remove"})
     */
    private $contact;
    
    /**
     *
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     *
     * @var DateTime
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
        $this->modifieddate = new \DateTime();
    }
}

?>
