<?php

namespace App\Controller\Admin;

use App\Entity\Debit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DebitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Debit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            MoneyField::new('montant')->setCurrency('EUR'),
            AssociationField::new('id_category', 'Categorie'),
            AssociationField::new('id_mois', 'mois'),
        ];
    }

}
