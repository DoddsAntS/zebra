<?php
namespace cms\Entity\Forum;

use Doctrine\ORM\Mapping as ORM;

use cms\Entity\Entity;


/**
 * Description of Category
 *
 * @author tallen
 * @ORM\Entity
 * @ORM\Table(name="forum_categories")
 * @package Category
 */
class Category extends Entity {
          
       /**
     *
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
     * @var text
     * @ORM\Column(type="text",nullable=false)
     */
    private $description;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
     /**
     *
     * @var cms\Entity\Forum
     * @ORM\ManyToOne(targetEntity="cms\Entity\Forum",inversedBy="categories",cascade={"persist","remove"})
     */
    private $forum;
    
        /**
     *
     * @var type
     * @ORM\OneToMany(targetEntity="cms\Entity\Forum\Category\Topic",mappedBy="category",cascade={"persist","remove"})
     */
    private $topics;    
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
}

?>
