<?php

namespace Cogilent\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfficeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Name'
            ),
        ));
        $builder->add('address','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Address'
            ),
        ));
        $builder->add('phone','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Phone'
            ),
        ));
        $builder->add('fax','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Fax'
            ),
        ));
        $builder->add('website','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Website'
            ),
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cogilent\OrganizationBundle\Entity\Office'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'office_form';
    }
}
