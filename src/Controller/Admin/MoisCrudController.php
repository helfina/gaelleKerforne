<?php

namespace App\Controller\Admin;

use App\Entity\Mois;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MoisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mois::class;
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
        ];
    }

}
