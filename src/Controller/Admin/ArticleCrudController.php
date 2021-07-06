<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextareaField::new('body')->setMaxLength(20);
        yield DateTimeField::new('createdAt')->formatValue(fn($value, $entity)
        => $entity->getCreatedAt()->format('d-m-Y \ T H:i:s'));
        yield DateTimeField::new('updatedAt')->formatValue(fn($value, $entity)
        => $value ? $entity->getUpdatedAt()->format('d-m-Y \ T H:i:s') : 'Unchanged');
        yield ImageField::new('photoFilename')
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->onlyOnIndex()
        ;
    }
}
