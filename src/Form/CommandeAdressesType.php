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
                'label' => 'Adresse de livraison',
                'attr' => ['class' => 'form-control']
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
                'attr' => ['class' => 'form-control']
            ])

            ->add("Valider", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
