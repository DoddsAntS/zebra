<?php
namespace cms\Entity\Country;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of County
 *
 * @author adodds
 * @ORM\Entity
 * @ORM\Table(name="counties")
 * @package Locations
 */
class County extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(name="id",type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var Country
     * @ORM\ManyToOne(targetEntity="cms\Entity\Country",inversedBy="counties",cascade={"persist","remove"})
     */
    private $country;
    
    protected $requiredFields = array(
                                    'name',
                                );
    
    /**
     * Return Object Property
     * @param string $property
     * @return mixed 
     */
    public function __get($property) {
        return $this->$property;
    }
    
    /**
     * Set Object Property to Value
     * @param string $property
     * @param mixed $value 
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }
}