<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
      {
       return $crud
               ->setEntityLabelInSingular('User')
               ->setEntityLabelInPlural('Users')
               ->setSearchFields(['email'])
        ;
       }

       public function configureFilters(Filters $filters): Filters
         {
             return $filters
            // ->add(EntityFilter::new('user'::class));
            ->add(EntityFilter::new('user')->setFormType(EntityType::class)->setFormTypeOptions([
                'class' => User::class,
                'choice_label' => 'email', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre
            ])); 
       }

    
   
    public function configureFields(string $pageName): iterable
    {
      
      yield TextField::new('email');
      yield TextField::new('password');
      yield ArrayField::new('roles');
       
   
    }
   



}
