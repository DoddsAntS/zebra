<?php
namespace cms\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * User open ids
 * @author adodds
 * @ORM\Entity
 * @ORM\Table(name="user_openids")
 * @ORM\HasLifecycleCallbacks
 * @package User
 */

class OpenId extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",inversedBy="openIds")
     */
    private $user;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    private $url;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $handle;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=20,nullable=false);
     */
    private $provider;
    
    /**
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
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
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
        $keys = array('id','url','handle','provider','active');
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