<?php

declare(strict_types=1);

namespace App\StudentManagement\Presentation\Web\Form\Types;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;

final class EmailType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', TextType::class, [
            'label' => "email",
            'attr' => [
                'placeholder' => 'flo@test.fr'
            ]
        ])->setDataMapper($this);
    }

    /**
     * @see https://github.com/symfony/symfony/issues/59950
     */
    public function getBlockPrefix(): string
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver): OptionsResolver
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => Email::class,
            'empty_data' => null
        ]);

        return $resolver;
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['email']->setData((string) $viewData);
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        $forms = iterator_to_array($forms);
        try {
            $viewData = new Email($forms['email']->getData());
        } catch (\InvalidArgumentException $e) {
            $forms['email']->addError(new FormError($e->getMessage()));
        }
    }
}