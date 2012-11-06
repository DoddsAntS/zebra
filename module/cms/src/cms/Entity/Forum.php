<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Forum
 *
 * @author tallen
 * @ORM\Entity
 * @ORM\Table(name="forum")
 * @package Forum
 */

class Forum extends Entity {
    
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
     * @var cms\Entity\Forum\Category 
     * @ORM\OneToMany(targetEntity="cms\Entity\Forum\Category",mappedBy="forum",cascade={"persist","remove"})
     */
    private $categories;


    
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
    
    
}

?>
