<?php
namespace cms\Entity\Route;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * Definition of route key variable pairs
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="route_details")
 * @package Core
 * @author adodds
 */

class Detail extends Entity {
    
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
     * @var string $keyName
     * @ORM\Column(type="string",length=75,nullable=false)
     */
    private $keyName;
    
    /**
     *
     * @var string $defaultKeyValue
     * @ORM\Column(type="string",length=75,nullable=true)
     */
    private $defaultValue;
    
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
     * @var Route which this item belongs to
     * @ORM\ManyToOne(targetEntity="cms\Entity\Route",inversedBy="pathDetails")
     */
    private $route;
    
    /**
     *
     * @var User user who this phone number belongs to
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    private $user;
    
    protected $requiredFields = array(
                                'keyName',
                                'defaultValue'
                                );
    
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
     * Function called before persist
     * @ORM\PrePersist
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
}