<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressListForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('addressList', EntityType::class, [
                'class' => 'AppBundle\Entity\Address',
                'choice_label' => function(Address $address) {
                    return $address->getName() . ' - ' . $address->getCountry() . ' ' . $address->getPostCode() . ' ' . $address->getCity() . ' ' . $address->getAddress();
                },
                'label' => 'Számlázási cím',
                'placeholder' => 'Új számlázási címet adok meg',
                'required' => false
            ])
            ->add('newAddress', AddressForm::class, [
                'label' => ''
            ])
            ->add('aszf', CheckboxType::class, [
                'label' => 'Kijelentem, hogy elolvastam és elfogadom az általános szerződési feltételeket.'
            ])
            ->add('order', SubmitType::class);
    }
}