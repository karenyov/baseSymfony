<?php

namespace SysadminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SysadminBundle\Enum\TypeYesNo;

/**
 * Description of UserEdit
 *
 * @author Karen
 */
class UserEdit extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', null, ['attr' => ['class' => 'form-control']])
                ->add('email', null, ['attr' => ['class' => 'form-control col-md-4']])
                ->add('password', 'password', ['attr' => ['class' => 'form-control']])
                ->add('active', 'choice', [
                    'attr' => ['class' => 'form-control'],
                    'choices' => TypeYesNo::getChoices()]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'SysadminBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'sysadminbundle_user';
    }

}
