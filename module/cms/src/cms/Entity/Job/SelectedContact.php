<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Job Selected Contact
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_selected_contacts")
 * @package Job
 */
class SelectedContact extends Entity {
    
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
     * @var Job
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job",inversedBy="contacts",cascade={"persist","remove"})
     */
    private $job;
    
    /**
     *
     * @var Job\Contact
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\Contact",inversedBy="jobs",cascade={"persist","remove"})
     */
    private $contact;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
}