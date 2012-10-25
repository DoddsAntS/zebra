<?php
namespace cms\Entity\Menu;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * 
 * @ORM\Table(name="menu_items")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package Menu
 */

class Item extends Entity {
    
    /**
     *
     * @var integer
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string",nullable=false)
     */
    protected $linkText;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    protected $public;
    
    /**
     *
     * @var object
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Menu",inversedBy="items",cascade={"persist","remove"})
     */
    protected $menu;
    
    /**
     * 
     * @var object route
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Route",cascade={"persist","remove"})
     */
    protected $route;
    
    /**
     *
     * @var object \cms\Entity\Menu\Item\Value
     * @ORM\OneToMany(targetEntity="\cms\Entity\Menu\Item\Value",mappedBy="item",cascade={"persist","remove"})
     */
    protected $values;
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     */
    protected $position;
    
    /**
     *
     * @var object \cms\Entity\Menu\Item
     * @ORM\OneToMany(targetEntity="\cms\Entity\Menu\Item",mappedBy="children",cascade={"persist","remove"})
     */
    protected $parent;
    
    /**
     *
     * @var object \cms\Entity\Menu\Item
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Menu\Item",inversedBy="parent",cascade={"persist","remove"})
     */
    protected $children;
    
    protected $listFields = array();
    
    protected $requiredFields = array(
        'linkText',
        'public',
        'menu',
        'route'
    );
    
    public function __construct() {
        parent::__construct();
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __get($what = '') {
        return $this->{$what};
    }
    
    public function __set($what, $value) {
        $this->{$what} = $value;
    }
    
    public function getRouteDetails() {
        $return = array();
        for($i=0;$i<count($this->values);$i++) {
            $return[$this->values[$i]->keyName] = $this->values[$i]->value;
        }
        return $return;
    }
}