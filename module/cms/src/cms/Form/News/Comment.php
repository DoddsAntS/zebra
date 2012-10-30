<?php
namespace cms\Form;

use cms\Entity\News\Comment;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ArraySerializable as Serialize;

class CommentForm extends Form {
    
    public function __construct($name = null) {
        parent::__construct($name);
        $this->setHydrator(new Serialize())
             ->setObject(new Comment())
             ->setInputFilter(new InputFilter());
        $this->setAttribute('method', 'post');
        $this->addFields();
    }

    public function addFields() {
        $this->add(array(
                    'type' => 'Zend\Form\Element\Hidden',
                    'name' => 'id',
                    'attributes' => array(
                        'id' => 'id'
                    )
            ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\Text',
            'name' => 'title',
            'attributes'=>array(
                'id' => 'title',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Title:'
            )
        ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\TextArea',
            'name' => 'body',
            'attributes'=>array(
                'id' => 'body',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Comment:'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));
        
        $this->add(array(
            'name' => 'submitBtn',
            'attributes' => array(
                'type' => 'submit',
                'id' => 'submitBtn',
                'value' => 'Save'
            )
        )); 
    }
    
    public function getInputFilterSpecification() {
        return array(
            'id'=>array(
                'required'=>false,
                'filters'=>array(
                    array('name'=>'Int')
                )
            ),
            'title' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                )
            ),
            'body' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                )
            ),
        );
    } 
    
}