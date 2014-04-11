<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 3/31/14
 * Time: 6:34 PM
 */

namespace Time\TrackerBundle\Form;


use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;


class EditFormType  extends BaseType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('email')
            ->remove('username')
            ->remove('plainPassword')
            ->remove('token');
        $builder
            ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('token', 'token', array('label' => 'dnbhj', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'User name', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ));

    }


    public function getName()
    {
        return 'time_tracker_registration';
    }
}