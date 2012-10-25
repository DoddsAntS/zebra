<?php

namespace cms\Form;

use Zend\Form\Form;

class CmsForm extends Form {

    public function __construct($name = null, $fieldData = array()) {
        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->addFields($fieldData);
    }

    public function addFields($fieldData = array()) {
        if (count($fieldData) > 0) {
            for ($i = 0; $i < count($fieldData); $i++) {
                $this->add($fieldData[$i]);
            }
            $this->add(
                    array(
                        'name' => 'submitBtn',
                        'attributes' => array(
                                'type' => 'submit',
                                'value' => 'Go',
                                'id' => 'submitbutton',
                            ),
                        )
            );
        }
    }
    
}
