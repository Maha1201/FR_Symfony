<?php

namespace App\Form;

use App\Entity\Adresse;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommandeAdressesType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresseLivraison', EntityType::class, [
                "class" => Adresse::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->where('a.client=:client')
                        ->setParameter('client', $this->security->getUser()->getClient());
                },
                //'choice_label' => 'intitule',
                'choice_value' => 'id',
                'label' => 'Adresse de livraison :',
                'label_attr' => [
                    'class' => 'flex text-rose-700 pb-4'
                ],
                'attr' => ['class' => 'form-control rounded border-rose-300 border-2 mb-2']
            ])

            ->add('adresseFacturation', EntityType::class, [
                "class" => Adresse::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->where('a.client=:client')
                        ->setParameter('client', $this->security->getUser()->getClient());
                },
                'choice_value' => 'id',
                'label' => 'Adresse de facturation',
                'label_attr' => [
                    'class' => 'flex text-rose-700 pb-4'
                ],
                'attr' => ['class' => 'form-control rounded border-rose-300 border-2 mb-2']
            ])

            ->add("Valider", SubmitType::class, [
                'attr' => ['class' => 'block text-rose-800 inline-block mt-0 hover:text-rose-600 bg-rose-300 hover:bg-rose-200 px-5 py-2 rounded-lg']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
