<?php
namespace cms\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * User addresses
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user_addresses")
 * @package User
 */
class Address extends Entity {
    
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
     * @ORM\Column(type="string",length=20,nullable=false) 
     */
    private $type;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $address;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=true)
     */
    private $address1;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=true)
     */
    private $address2;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $town;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=15,nullable=false)
     */
    private $postCode;
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
    private $modifyDate;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false) 
     */
    private $addDate;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",inversedBy="addresses",cascade={"persist","remove"})
     */
    private $user;
    
    /**
     *
     * @var County
     * @ORM\ManyToOne(targetEntity="cms\Entity\Country\County",cascade={"persist","remove"})
     */
    private $county;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\Country",cascade={"persist","remove"})
     */
    private $country;
    
    protected $requiredFields = array(
                                    'address',
                                    'town',
                                    'postCode',
                                    'type',
                                    'county',
                                    'country',
                                );
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifyDate = new \DateTime();
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
        $keys = array('id','type','address','address1','town','county','country','postCode','primaryAddress');
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