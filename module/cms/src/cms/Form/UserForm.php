<?php
namespace cms\Form;

use cms\Entity\User;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ArraySerializable as Serialize;
class UserForm extends Form {
    
    public $entityManager = null;

    public function __construct($entityManager, $name = null) {
        parent::__construct($name);
        $this->entityManager = $entityManager;
        $this->setHydrator(new Serialize())
             ->setObject(new User())
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
            'name' => 'firstName',
            'attributes'=>array(
                'id' => 'firstName',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'First Name:'
            )
        ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\Text',
            'name' => 'lastName',
            'attributes'=>array(
                'id' => 'lastName',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Last Name:'
            )
        ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\Password',
            'name' => 'password',
            'attributes'=>array(
                'id' => 'password',
            ),
            'options' => array(
                'label' => 'Password:'
            ),
        ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\Checkbox',
            'name' => 'active',
            'attributes'=>array(
                'id' => 'active',
            ),
            'options' => array(
                'label' => 'Active:'
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'emails',
            'options' => array(
                'label' => 'User email addresses',
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'cms\Form\Fieldsets\User\EmailFieldset'
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'addresses',
            'options' => array(
                'label' => 'User addresses',
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'cms\Form\Fieldsets\User\AddressFieldset'
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'phones',
            'options' => array(
                'label' => 'User phone numbers',
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'cms\Form\Fieldsets\User\PhoneFieldset'
                )
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
            'firstName' => array(
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
            'lastName' => array(
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
            'password' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            'active'=>array(
                'required'=> true,
                'filter'=>array(
                    array('name'=>'Int')
                ),
                'validator' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array(0, 1),
                        )
                    )
                )
            )
        );
    } 
    
}