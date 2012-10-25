<?php
namespace cms\Form\Fieldsets\User;

use cms\Entity\User\Email;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EmailFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('email');
        $this->setObject(new Email);

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
            'name' => 'email',
            'type'=>'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Email Address:'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'type',
            'options' => array(
                'label' => 'Email type'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'primaryAddress',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Primary Email:'
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
     */
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
            'email' => array(
                'required' => true,
                'validators'=>array(
                    array('name'=>'EmailAddress')
                ),
                'filters'=>array(
                    array('name'=>'StringTrim'),
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