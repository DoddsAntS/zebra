<?php
namespace cms\Entity\Settings;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Key
 *
 * @author adodds
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="setting_keys")
 * @package Site
 */
class Key extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=75,nullable=false)
     */
    private $name;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",length=200,nullable=false)
     */
    private $value;
    
    /**
     *
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
     * @param \cms\Entity\Settings
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Settings",inversedBy="keys")
     */
    private $setting;
    
    protected $requiredFields = array(
                                    'name',
                                    'value',
                                    );
    
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