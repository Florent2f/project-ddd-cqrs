<?php

namespace App\StudentManagement\Presentation\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\StudentManagement\Presentation\Web\Form\Types\EmailType;
use App\StudentManagement\Presentation\Web\Form\Types\AddressType;
use App\StudentManagement\Presentation\Web\Form\Model\StudentModel;
use App\StudentManagement\Presentation\Web\Form\Types\UsernameType;

class StudentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username', UsernameType::class)
            ->add('address', AddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentModel::class,
        ]);
    }
}
