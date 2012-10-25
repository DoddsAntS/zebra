<?php
namespace cms\Form\Fieldsets\User;

use cms\Entity\User\Phone;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PhoneFieldset extends Fieldset implements InputFilterProviderInterface {
    public function __construct() {
        parent::__construct('phone');
        $this->setObject(new Phone);

        $this->add(array(
            'name' => 'id',
            'type'=>'Zend\Form\Element\Hidden',
            'options' => array(
                'type'=>'hidden',
            ),
            'attributes' => array(
            )
        ));

        $this->add(array(
            'name' => 'phone',
            'options' => array(
                'label' => 'Phone Number:',
            ),
            'attributes' => array(
                'required' => 'required',
            )
        ));

        $this->add(array(
            'name' => 'type',
            'options' => array(
                'label' => 'Phone type:'
            ),
            'attributes' => array(
                'required' => 'required',
            )
        ));

        $this->add(array(
            'name' => 'primaryNumber',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Primary Phone Number:',
            ),
            'attributes' => array(
            )
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     \*/
    public function getInputFilterSpecification() {
        return array(
            'id' => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'phone' => array(
                'required' => true,
            ),
            'type' => array(
                'required' => true,
                'validators' => array(
                ),
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'primaryNumber' => array(
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