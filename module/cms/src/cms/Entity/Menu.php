<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Table(name="menus")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package Menu
 */

class Menu extends Entity {
    
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
    protected $name;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    protected $public;
    
    /**
     *
     * @var object
     * @ORM\OneToMany(targetEntity="\cms\Entity\Menu\Item",mappedBy="menu",cascade={"persist","remove"})
     */
    protected $items;
    
    protected $listFields = array();
    
    protected $requiredFields = array();
    
    public function __construct() {
        parent::__construct();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __get($what = '') {
        return $this->{$what};
    }
    
    public function __set($what, $value) {
        $this->{$what} = $value;
    }
}