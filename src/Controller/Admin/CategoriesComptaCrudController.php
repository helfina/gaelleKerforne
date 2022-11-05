<?php

namespace App\Controller\Admin;

use App\Entity\CategoriesCompta;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesComptaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoriesCompta::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
        ];
    }

}
