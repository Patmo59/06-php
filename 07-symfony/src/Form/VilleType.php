<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use App\Repository\DepartementRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('population')
            // ->add('createdAt')
            // ->add('editedAt')
            // ->add('ChefLieu')
            ->add('departement',EntityType::class , [
                "class"=>Departement::class,
                "expanded"=>false,
                "multiple"=>false,
                "query_builder"=> function (DepartementRepository $repo)
                {
                    return $repo ->createQueryBuilder("d") ->orderBy("d.nom", "ASC");
                },
                "label" =>"Département de votre ville:"
            ])
            ->add("photoFile", FileType::class,[
                "label"=>"Photo de cette magnifique ville:",
                "mapped"=>false,
                "required"=>false,
                "constraints"=>[
                    new File([
                        "maxSize"=>"1024k",
                        "mimeTypes"=>[
                            "image/png",
                            "image/jpeg",
                            "image/gif"
                        ],
                        "mimeTypesMessage"=>"Seules les images jpg, png, gif sont acceptées"
                    ])
                ]
            ])
            ->add("Enregistrer",SubmitType::class) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
