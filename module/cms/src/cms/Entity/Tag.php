<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Tag
 *
 * @author adodds
 * date 26-May-2011 16:38:00
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tags")
 * @package Searchable
 */
class Tag extends Entity {
    
    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $name;
    
    /**
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
    /**
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $modifiedDate;
    
    /**
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->modifiedDate = new \DateTime();
    }
    
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
}