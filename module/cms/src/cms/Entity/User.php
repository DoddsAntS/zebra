<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package User
 */

class User extends Entity {
    
    /**
     *
     * @var integer $id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string",length=10,nullable=true)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string",length=60,nullable=true)
     * @var string
     */
    private $firstName;
    
    /**
     * @ORM\Column(type="string",length=60,nullable=true)
     * @var string
     */
    private $lastName;
    
    /**
     * @ORM\Column(type="string",length=150,nullable=true)
     * @var string 
     */
    private $password;
    
    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var datetime
     */
    private $lastLoginDate;
    
    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var datetime
     */
    private $modifiedDate;
    
    /**
     * @ORM\Column(type="datetime",nullable=false)
     * @var datetime 
     */
    private $registerDate;
    
    /**
     * @ORM\Column(type="boolean",nullable=false)
     * @var bool
     */
    private $active;
    
    /**
     * @param \Doctrine\Common\Collections\Collection 
     * @ORM\OneToMany(targetEntity="cms\Entity\User\Email",mappedBy="user",cascade={"persist","remove"})
     */
    private $emails;
    
    /**
     * @param \Doctrine\Common\Collections\Collection 
     * @ORM\OneToMany(targetEntity="cms\Entity\User\Phone",mappedBy="user",cascade={"persist","remove"}) 
     */
    private $phones;
    
    /**
     *
     * @param \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="cms\Entity\User\Address",mappedBy="user",cascade={"persist","remove"})
     */
    private $addresses;
    
    /**
     *
     * @param \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="cms\Entity\User\Role",mappedBy="user",cascade={"persist","remove"})
     */
    private $roles;
    
    /**
     *
     * @param \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="cms\Entity\User\OpenId",mappedBy="user",cascade={"persist","remove"})
     */
    private $openIds;
    
    /**
     * @var array Array for auto generated admin list
     */
    protected $listFields = array(
                            'Select'=>'id',
                            'First Name'=>'firstName',
                            'Surname'=>'lastName',
                            'Register Date'=>'registerDate'
                            );
    
    /**
     * User object constructor 
     */
    public function __construct() {
        parent::__construct();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->openIds = new \Doctrine\Common\Collections\ArrayCollection();
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
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * Automated function to set required fields if not set before persist
     */
    public function beforePersist() {
        //add check to see if user exists
        if(!($this->registerDate instanceOf \DateTime)) {
            $this->registerDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
        if(array_key_exists('password', $this->changeVars)) {
            $this->password = md5($this->password);
        }
    }
    
    /**
     * Check Password matches entity password
     * @param string $password
     * @return boolean
     */
    public function passwordCheck($password) {
        return $password == $this->password ? TRUE : FALSE;
    }
    
    /**
     * Login function sets last logintime on success
     * @return boolean
     */
    public function doLogin($password = null) {
        if($password === null) {
            $correctPass = FALSE;
        }
        else {
            $correctPass = $this->passwordCheck($password);
        }
        return $correctPass;
    }

    public function getArrayCopy() {
        $keys = array('id','title','firstName','lastName','active','lastLoginDate','modifiedDate','registerDate','emails','phones','addresses','password');
        $return = array();
        foreach($keys as $key=>$field) {
            if(is_object($this->$field)) {
                if(($this->$field instanceof \DateTime)) {
                    $return[$field] = $this->$field->format('r');
                }
                else {
                    if(count($this->{$field}) > 0) {
                        if(is_object($this->{$field}[0])) {
                            for($i=0;$i<count($this->{$field});$i++) {
                                $return[$field][$i] = $this->{$field}[$i]->getArrayCopy();
                            }
                        }
                    }
                    else {
                    }
                    //$return[$field] = $this->$field->getArrayCopy();
                }
            }
            elseif(is_array($this->$field)) {
                if(count($this->$field) > 0) {
                    if(is_object($this->$field[0])) {
                        for($i=0;$i<count($this->$field);$i++) {
                            $return[$field][$i] = $this->$field[$i]->getArrayCopy();
                        }
                    }
                    else {
                        $return[$field] = $this->$field;
                    }
                } 
            }
            else {
                $return[$field] = $this->{$field};
            }
        }
        return $return;
    }
    
    public function addItem($key, $values = array()) {
        $objects = array(
            'emails' => array(
                '\cms\Entity\User\Email',
                'email'
            ),
            'phones' => array(
                '\cms\Entity\User\Phone',
                'phone'
            ),
            'addresses' => array(
                '\cms\Entity\User\Address',
                'postCode'
            )
        );
        $add = TRUE;
        if(count($this->{$key}) > 0) {
            for($i=0;$i<count($this->{$key});$i++) {
                $testObject = $this->{$key}[$i];
                $add = $testObject->{$objects[$key][1]} == $values->{$objects[$key][1]} ? FALSE : $add;
            }
        }
        if($add === TRUE) {
            $this->{$key}[] = $values;
        }
    }
    
    public function populate($data = array()) {
        if(count($data) == 0) {
            throw new \Exception('No data passed');
        }
        else {
            $childRelations = array('emails','phones','addresses','openIds','roles');
            foreach($data as $key=>$details) {
                if(in_array($key, $childRelations)) {
                    if(count($details) > 0) {
                        for($i=0;$i<count($details);$i++) {
                            $values = $details[$i];
                            $values->user = $values->user === null ? $this : $values->user;
                            if($values->id != '' && $values->id != NULL) { 
                                for($j=0;$j<count($this->{$key});$j++) {
                                    if($this->{$key}[$j]->id == $values->id) {
                                        $this->{$key}[$j]->populate($values->getArrayCopy());
                                    }
                                }
                            }
                            else {
                                $this->addItem($key, $values);
                            }
                        }
                    }
                }
                else {
                    if(property_exists($this, $key)) {
                        if($this->{$key} != $details) {
                            $this->changeVars[$key] = $this->{$key};
                            $this->{$key} = $details;
                        }
                    }
                }
            }
        }
    }
}