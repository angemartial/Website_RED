<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AnnonceType extends ApplicationType
{   
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 
                TextType::class, $this->getConfiguration("Titre","Entrez un titre"))

            ->add('slug', 
                TextType::class, $this->getConfiguration("Adresse web","tapez l'adresse web (automatique)", [
                    'required' => false
                ]))

            ->add('filename',
                FileType::class, $this->getConfiguration("Ajouter Image","Télécharger une image"),
                [
                    'required' => false
                ])

            ->add('introduction',
                TextType::class, $this->getConfiguration("Introduction","Donnez une description globale de l'appartement"))

            ->add('content', CKEditorType::class, $this->getConfiguration("Zone de texte", ""));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
