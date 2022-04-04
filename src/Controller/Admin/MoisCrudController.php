<?php

namespace App\Controller\Admin;

use App\Entity\Mois;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MoisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mois::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
