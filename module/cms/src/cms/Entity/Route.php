<?php
namespace cms\Entity;

use \Doctrine\ORM\Mapping as ORM;
/**
 * Route definitions for cms control paths
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="routes")
 * @author adodds
 * @package Core
 */
class Route extends Entity {
    
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
     * @var string $name
     * @ORM\Column(type="string",length=75,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=150,nullable=false)
     */
    private $routePath;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
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
     * @var User user who added this route
     * @ORM\ManyToOne(targetEntity="cms\Entity\User")
     */
    private $user;
    
    /**
     * @param \Doctrine\Common\Collections\Collection 
     * @ORM\OneToMany(targetEntity="cms\Entity\Route\Detail",mappedBy="route",cascade={"persist","remove"}) 
     */
    private $pathDetails;
    
    protected $listFields = array(
                                'Select'=>'id',
                                'Name'=>'name',
                                'Path'=>'routePath'
                            );
    
    protected $requiredFields = array(
                                'name',
                                'routePath',
                                'active'
                                );
    
    /**
     * Function Called before persist opertation
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
     * Retrive object property
     * @param string $property
     * @return mixed 
     */
    public function __get($property) {
        return $this->{$property};
    }
    
    /**
     * Get Route part details
     * @return array
     */
    public function getPathDetails() {
        $return = array();
        if(count($this->pathDetails) > 0) {
            foreach($this->pathDetails as $key=>$details) {
                $return[$details->keyName] = $details->defaultValue;
            }
        }
        return $return;
    }
    
    /**
     * Get active routes
     * @return array
     */
    public function getActive() {
        $routes = $this->entityManager->createQuery("select i FROM ". get_class($this) ." i WHERE i.active=TRUE")->execute();
        return $routes;
    }
    
}