<?php

namespace Kamran\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class OrganizationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Title'
            ),
        ));

        $builder->add('description','textarea',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Description'
            ),
        ));

        $builder->add('departments','collection',array(
            'type'=> new DepartmentsType(),
            'label' => false,
            'allow_add' => true,
            'allow_delete' => true,
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\OrganizationBundle\Entity\Organization',
        ));
    }

    public function getName()
    {
        return 'organization_form';
    }


}
