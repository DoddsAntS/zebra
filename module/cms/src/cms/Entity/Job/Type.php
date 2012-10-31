<?php
namespace cms\Entity\Job;

use cms\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Description of Type
 *
 * @author adodds
 */
class Type {
    
    private $id;
    
    private $name;
    
    private $active;
    
    private $addDate;
    
    private $modifiedDate;
    
    private $user;
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
}