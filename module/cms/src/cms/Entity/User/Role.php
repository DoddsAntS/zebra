<?php
namespace cms\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Assigned User Roles
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user_roles")
 * @package User
 * @author adodds
 */
class Role extends Entity {
    
    /**
     *
     * @var integer $id autogenerated id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     *
     * @var datetime date phone number was modified
     * @ORM\Column(type="datetime",nullable=false) 
     */
    private $modifiedDate;
    
    /**
     *
     * @var datetime date phone number was modified
     * @ORM\Column(type="datetime",nullable=false) 
     */
    private $addDate;
    
    /**
     *
     * @var Role
     * @ORM\ManyToOne(targetEntity="cms\Entity\Role",cascade={"persist","remove"})
     */
    private $role;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",inversedBy="roles")
     */
    private $user;
    
    /**
     * Set object property
     * @param string $property
     * @param mixed $value 
     */
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    /**
     * Return object property
     * @param string $property
     */
    public function __get($property) {
        return $this->{$property};
    }
    
    /**
     * PrePersist Function
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
}