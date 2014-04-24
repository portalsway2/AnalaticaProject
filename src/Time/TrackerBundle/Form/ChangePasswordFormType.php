<?php

namespace Time\TrackerBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ChangePasswordFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword as OldUserPassword;


/**
 * Class ChangePasswordFormType
 * @package Time\TrackerBundle\Form
 */
class ChangePasswordFormType extends BaseType
{


    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class
            $constraint = new OldUserPassword();
        }

        parent::buildForm($builder, $options);
        $builder
            ->remove('currentd_password')
            ->remove('plainPassword');


        $builder->add('currentd_password', 'password', array(
            'label' => 'form.curren_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => $constraint,
        ));
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.new_password'),
            'second_options' => array('label' => 'form.new_password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention' => 'change_password',
        ));
    }

    public function getName()
    {
        return 'fos_user_change_password';
    }

}
