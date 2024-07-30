<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
     return $crud
             ->setEntityLabelInSingular('product')
             ->setEntityLabelInPlural('products')
             ->setSearchFields(['ref'])
             ->setSearchFields(["short_description"])
             ->setSearchFields(["long_description"])
             ->setSearchFields(["price"])
             ->setDefaultSort(['id' => 'DESC']);
      ;
     }


     public function configureFilters(Filters $filters): Filters
     {
         return $filters
        // ->add(EntityFilter::new('product',Product::class));
      
        ->add(EntityFilter::new('ref')->setFormType(EntityType::class)->setFormTypeOptions([
            'class' => Product::class,
            'choice_label' => 'ref', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre                  
        ]))
        
        ->add(EntityFilter::new('short_description')->setFormType(EntityType::class)->setFormTypeOptions([
            'class' => Product::class,
            'choice_label' => 'short_description', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre     
        ]))

        ->add(EntityFilter::new('long_description')->setFormType(EntityType::class)->setFormTypeOptions([
            'class' => Product::class,
            'choice_label' => 'long_description', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre  
        ]))

        ->add(EntityFilter::new('price')->setFormType(EntityType::class)->setFormTypeOptions([
            'class' => Product::class,
            'choice_label' => 'price', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre       
        ]));

   }



    public function configureFields(string $pageName): iterable
    {
      
        yield TextField::new('ref');
        yield TextField::new('short_description');
        yield TextField::new('long_description');
        yield ImageField::new('photo')
            ->setUploadDir('public/uploads/photos')  // Set the directory where files will be uploaded
            ->setBasePath('/uploads/photos')  // Set the base path for the files
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);
        yield NumberField::new('price');


    }
   
}
