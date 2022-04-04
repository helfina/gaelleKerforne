<?php

namespace App\Controller\Admin;

use App\Entity\Revenues;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RevenuesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Revenues::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            NumberField::new('Credit'),
            NumberField::new('Debit'),
            //DateField::new('date_debut'),
            AssociationField::new('id_mois') //equivaut a un select
        ];
    }

}
