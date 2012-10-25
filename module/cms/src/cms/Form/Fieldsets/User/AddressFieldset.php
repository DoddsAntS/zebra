<?php
namespace cms\Form\Fieldsets\User;

use cms\Entity\User\Address;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class AddressFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('address');
        $this->setObject(new Address);

        $this->add(array(
            'name' => 'id',
            'type'=>'Zend\Form\Element\Hidden',
            'options' => array(
                'type'=>'hidden',
            ),
            'attributes'=>array(
            )
        ));

        $this->add(array(
            'name' => 'address',
            'options' => array(
                'label' => 'Address:'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'address1',
            'options' => array(
                'label' => 'Address Line 1:'
            ),
            'attributes' => array(
            )
        ));

        $this->add(array(
            'name' => 'town',
            'options' => array(
                'label' => 'Town:'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'county',
            'options' => array(
                'label' => 'County:'
            ),
            'attributes' => array(
            )
        ));

        $this->add(array(
            'name' => 'country',
            'options' => array(
                'label' => 'Country:'
            ),
            'attributes' => array(
            )
        ));

        $this->add(array(
            'name' => 'postCode',
            'options' => array(
                'label' => 'Postcode:'
            ),
            'attributes' => array(
                'required'=>'required',
            )
        ));

        $this->add(array(
            'name' => 'type',
            'options' => array(
                'label' => 'Address type'
            ),
            'attributes' => array(
                'required' => 'required',
            )
        ));

        $this->add(array(
            'name' => 'primaryAddress',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Primary Address:'
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
    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'address' => array(
                'required' => true,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'address1' => array(
                'required' => false,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'town' => array(
                'required' => true,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'county' => array(
                'required' => false,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'country' => array(
                'required' => false,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
            ),
            'postCode' => array(
                'required' => true,
                'filters'=>array(
                    array('name'=>'StringTrim'),
                    array('name'=>'StripTags'),
                )
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
            'primaryAddress' => array(
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