<?php

declare(strict_types=1);

namespace App\StudentManagement\Presentation\Web\Form\Types;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;

final class UsernameType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('username', TextType::class, [
            'label' => "nom d'utilisateur",
            'attr' => [
                'placeholder' => 'Florent'
            ]
        ])->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): OptionsResolver
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => Username::class,
            'empty_data' => null
        ]);

        return $resolver;
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['username']->setData((string) $viewData);
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        $forms = iterator_to_array($forms);
        try {
            $viewData = new Username($forms['username']->getData());
        } catch (\InvalidArgumentException $e) {
            $forms['username']->addError(new FormError($e->getMessage()));
        }
    }
}