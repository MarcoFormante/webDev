<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use DateTimeImmutable;
use DateTimeZone;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Override;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {

        return Project::class;
    }

    // #[Override]
    // public function createEntity(string $entityFqcn): object
    // {
    //     $project = new Project();
    //     $project->setUpdatedAt(new DateTimeImmutable("now"));
    //     $project->setCreatedAt(new DateTimeImmutable("now"));
        
    //     return $project;
    // }

    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }

   
}
