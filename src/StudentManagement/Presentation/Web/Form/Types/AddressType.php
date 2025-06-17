<?php

declare(strict_types=1);

namespace App\StudentManagement\Presentation\Web\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;


final class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class)
            ->add('country', CountryType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): OptionsResolver
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => Address::class,
            'empty_data' => null
        ]);

        return $resolver;
    }
}



