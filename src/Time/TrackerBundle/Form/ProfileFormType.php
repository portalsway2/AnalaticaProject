<?php

namespace Time\TrackerBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ProfileFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        parent::buildForm($builder, $options);
        $builder
            ->remove('username')
            ->remove('usernamecanonical')
            ->remove('email')
            ->remove('emailcanonical')
            ->remove('firstname')
            ->remove('lastname');


        $builder
            ->add('username', null, array('label' => 'Name', 'translation_domain' => 'FOSUserBundle'))
            ->add('usernamecanonical', null, array('label' => 'Name Canonical', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('emailcanonical', 'email', array('label' => 'Email Canonical', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstname', null, array('label' => 'First Name', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastname', null, array('label' => 'Last Name', 'translation_domain' => 'FOSUserBundle'));


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Time\TrackerBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'time_tracker_profile';
    }
}