<?php
namespace cms\Form\Account;

use cms\Entity\User;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form {
    
    public function __construct($name = null) {
        parent::__construct($name);
        $this->setInputFilter(new InputFilter());
        $this->setAttribute('method', 'post');
        $this->addFields();
    }

    public function addFields() {
        
        $this->add(array(
            'name' => 'email',
            'type'=>'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Email Address:'
            ),
            'attributes' => array(
                'id' => 'email',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'type'=>'Zend\Form\Element\Password',
            'name' => 'password',
            'attributes'=>array(
                'id' => 'password',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Password:'
            ),
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
                'value' => 'Login'
            )
        )); 
    }
    
    public function getInputFilterSpecification() {
        return array(
            'email' => array(
                'required' => true,
                'validators'=>array(
                    array('name'=>'EmailAddress')
                ),
                'filters'=>array(
                    array('name'=>'StringTrim'),
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
        );
    } 
}