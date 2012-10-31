<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Trees
 *
 * @author adodds
 */
class Trees extends Entity {
    
    private $id;
    
    private $name;
    
    private $description;
    
    private $job;
    
    private $owner;
    
    private $tpo;
    
    private $ca;
    
    private $addDate;
    
    private $modifiedDate;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
    public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
        $this->modifiedDate = new \DateTime();
    }
}

?>
