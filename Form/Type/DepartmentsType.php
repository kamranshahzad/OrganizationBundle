<?php

namespace Kamran\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class DepartmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','text',array(
            'label'=>false,
            'required'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Title'
            ),
        ));

        $builder->add('description','textarea',array(
            'required'=>false,
            'attr' => array(
                'class' => 'codetext form-control',
                'placeholder'=>'Description'
            ),
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\OrganizationBundle\Entity\Department',
        ));
    }


    public function getName()
    {
        return 'department_form';
    }

    public function getParent()
    {
        return 'form';
    }
}
