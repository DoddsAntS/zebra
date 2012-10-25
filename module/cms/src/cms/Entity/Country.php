<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Country
 *
 * @author adodds
 * @ORM\Entity
 * @ORM\Table(name="countries")
 * @package Locations
 */
class Country extends Entity {

    /**
     *
     * @var integer
     * @ORM\Column(name="id",type="integer",nullable=false);
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY") 
     */
    private $id;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false);
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="cms\Entity\Country\County",mappedBy="country",cascade={"persist","remove"}) 
     */
    private $counties;
    
    protected $listFields = array(
                                'Select'=>'id',
                                'Name'=>'name',
                            );
    
    public function __construct() {
        parent::__construct();
        $this->counties = new \Doctrine\Common\Collections\ArrayCollection();
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
    
}