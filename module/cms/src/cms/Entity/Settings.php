<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Description of settings
 *
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="settings")
 * @package Site
 */

class Settings extends Entity {
    
    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @param \Doctrine\Common\Collection\ArrayCollection
     * @ORM\OneToMany(targetEntity="cms\Entity\Settings\Key",mappedBy="setting",cascade={"persist","remove"})
     */
     private $keys;
    
    /**
     * @var string
     * @ORM\Column(type="string",length=200,nullable=false)
     */
    private $site;
    
    /**
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $modifiedDate;
    
    protected $listFields = array(
                                'Select'=>'id',
                                'Name'=>'site',
                            );
    
    public function __construct() {
        parent::__construct();
        $this->keys = new \Doctrine\Common\Collections\ArrayCollection();
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