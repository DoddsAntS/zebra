<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Table(name="pages")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package Page
 */

class Page extends Entity {
    
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string",length=60,nullable=true)
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\Column(type="boolean",nullable=false)
     * @var bool
     */
    protected $active;
    
    /**
     * @ORM\Column(type="boolean",nullable=false)
     * @var bool
     */
    protected $publicPage;
    
    /**
     * @ORM\ManyToOne(targetEntity="cms\Entity\User",cascade={"persist","remove"})
     */
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="cms\Entity\Page\Content",mappedBy="page",cascade={"persist","remove"})
     * @ORM\OrderBy({"revision"="DESC"})
     */
    protected $content;
    
    
    /**
     * @ORM\OneToMany(targetEntity="cms\Entity\Page\Meta",mappedBy="page",cascade={"persist","remove"})
     */
    protected $meta;
    
    /**
     * @ORM\Column(type="datetime",nullable=false)
     * @var datetime 
     */
    protected $addDate;
    
    /**
     * @ORM\Column(type="datetime",nullable=false)
     * @var datetime 
     */
    protected $modifiedDate;
    
    protected $listFields = array(
                                'Select'=>'id',
                                'Name'=>'name',
                            );
    
    protected $requiredFields = array();
    
    public function __get($what = '') {
        return $this->{$what};
    }
    
    public function __set($what, $value) {
        $this->{$what} = $value;
    }
    
    public function __construct() {
        parent::__construct();
        $this->content = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param integer $revision
     * @return object \cms\Entity\Page\Content 
     */
    public function getContent($revision = null) {
        if(count($this->content) == 0) {
            return null;
        }
        if($revision === null) {
            return $this->content[0];
        }
        else {
            $return = $this->content[0];
            for($i=0;$i<count($this->content);$i++) {
                $return = $this->content[$i]->revision == $revision ? $this->content[$i] : $return;
            }
            return $return;
        }
    }
}