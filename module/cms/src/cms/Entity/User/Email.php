<?php
namespace cms\Entity\User;
use Doctrine\ORM\Mapping as ORM;

use cms\Entity\Entity;

/**
 * User email addresses
 * @ORM\Table(name="user_emails")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package User
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
     * @var string
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
     * @var Boolean
     * @ORM\Column(type="boolean") 
     */
    private $primaryAddress;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false) 
     */
    private $modifiedDate;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false) 
     */
    private $addDate;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",inversedBy="emails")
     */
    private $user;
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
    
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
     * @return mixed 
     */
    public function __get($property) {
        return $this->{$property};
    }

    public function getArrayCopy() {
        $keys = array('id','type','email','primaryAddress');
        $return = array();
        foreach($keys as $key=>$field) {
            if(is_object($this->$field)) {
                if(($this->$field instanceof \DateTime)) {
                    $return[$field] = $this->$field->format('r');
                }
                elseif(property_exists(get_class($this->$field), 'id')) {
                    $return[$field] = $this->$field->id;
                }
                else {
                    for($i=0;$i<count($this->$field);$i++) {
                        $return[$field][$i] = $this->{$field}[$i]->getArrayCopy();
                    }
                }
            }
            else {
                $return[$field] = $this->{$field};
            }
        }
        return $return;
    }
}