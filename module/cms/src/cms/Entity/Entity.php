<?php

namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;

class Entity {

    protected $changeVars = array();

    public function __construct() {
        
    }

    public function populate($data = array()) {
        if(count($data) > 0) {
            foreach($data as $key=>$value) {
                if(property_exists($this, $key)) {
                    if($this->{$key} != $value) {
                        $this->changeVars[$key] = $this->{$key};
                        $this->{$key} = $value;
                    }
                }
            }
        }
        else {
            throw new \Exception('No data passed');
        }
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
