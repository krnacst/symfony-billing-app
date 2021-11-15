<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Magánszemély' => 'Magánszemély',
                    'Céges' => 'Céges'
                ],
                'label' => 'Típus',
                'required' => true
            ])
            ->add('name', TextType::class, [
                'label' => 'Név / Cégnév',
                'required' => true
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefonszám',
                'required' => false
            ])
            ->add('taxNumber', TextType::class, [
                'label' => 'Adószám',
                'required' => false,
                'attr' => [
                    'pattern' => '/^\d{11}$/', 
                    'maxlength' => 11
                ]
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Magyarország' => 'Magyarország',
                    'Ukrajna' => 'Ukrajna',
                    'Németország' => 'Németország'
                ], 
                'label' => 'Ország',
                'required' => true
            ])
            ->add('postCode', TextType::class, [
                'label' => 'Irányítószám',
                'required' => true,
                'attr' => [
                    'pattern' => '/^\d{4}$/',
                    'maxlength' => 4
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Város',
                'required' => true
            ])
            ->add('address', TextType::class, [
                'label' => 'Utca, házszám',
                'required' => true
            ])
            ->add('submit', SubmitType::class)
            ->add('cancel', ButtonType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}