<?php
namespace cms\Entity\Job\File;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Contact Types
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job_file_types")
 * @package Job
 */
class Type extends Entity {
    
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
     * @var string Type Name
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var boolean type active
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     *
     * @var integer Positional Order
     * @ORM\Column(type="integer",length=3,nullable=true)
     */
    private $position;
    
    /**
     *
     * @var Job\File\Type
     * @ORM\OneToMany(targetEntity="cms\Entity\Job\File\Type",mappedBy="children",cascade={"persist","remove"})
     */
    private $parent;
    
    /**
     *
     * @var Job\File\Type
     * @ORM\ManyToOne(targetEntity="cms\Entity\Job\File\Type",inversedBy="parent",cascade={"persist","remove"})
     */
    private $children;
    
    /**
     *
     * @var datetime Date Added
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     *
     * @var datetime last modified
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
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
    
    public function __construct() {
        parent::__construct();
        $this->children = new Doctrine\Common\Collections\ArrayCollection();
    }
}