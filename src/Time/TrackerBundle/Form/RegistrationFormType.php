<?php

namespace Time\TrackerBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;




class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        parent::buildForm($builder, $options);
        $builder
            ->remove('email')
            ->remove('username')
            ->remove('plainPassword')
            ->remove('last_name')
            ->remove('first_name')
            ->remove('roles');
        $builder
            ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'User name', 'translation_domain' => 'FOSUserBundle'))
            ->add('first_name', null, array('label' => 'First name', 'translation_domain' => 'FOSUserBundle'))
            ->add('last_name', null, array('label' => 'Last name', 'translation_domain' => 'FOSUserBundle'))
            ->add('roles', null, array('label' => 'Roles', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ));

    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Time\TrackerBundle\Entity\User'
        ));
    }
    public function getName()
    {
        return 'time_tracker_registration';
    }
}