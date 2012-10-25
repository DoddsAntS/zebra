<?php
namespace cms\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;
/**
 * Page meta relationships
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="page_metas")
 * @package Page
 * @author adodds
 */
class Meta extends Entity {
    
    /**
     *
     * @var integer $id autogenerated id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     *
     * @var object page
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Page",inversedBy="meta",cascade={"persist","remove"})
     */
    protected $page;
    
    /**
     * @var object meta
     * @ORM\ManyToOne(targetEntity="\cms\Entity\Meta",cascade={"persist","remove"})
     */
    protected $meta;
    
    /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    protected $addDate;
    
    public function __get($what = '') {
        return $this->{$what};
    }
    
    public function __set($what, $value) {
        $this->{$what} = $value;
    }
    
    /**
     * @ORM\PrePersist 
     */
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
    }
}