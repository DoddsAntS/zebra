<?php
namespace cms\Entity\Menu\Item;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * 
 * @ORM\Table(name="menu_item_values")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package Menu
 */

class Value extends Entity {
    
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
    protected $keyName;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="string",nullable=false)
     */
    protected $value;
    
    /**
     *
     * @var object
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Menu\Item",inversedBy="values",cascade={"persist","remove"})
     */
    protected $item;
    
    protected $listFields = array();
    
    protected $requiredFields = array(
        'keyName',
        'value',
        'item'
    );
    
    public function __construct() {
        parent::__construct();
    }
    
    public function __get($what = '') {
        return $this->{$what};
    }
    
    public function __set($what, $value) {
        $this->{$what} = $value;
    }
}