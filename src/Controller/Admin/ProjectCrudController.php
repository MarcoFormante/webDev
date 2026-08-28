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
use Symfony\Contracts\Cache\CacheInterface;

class ProjectCrudController extends AbstractCrudController

{
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache){
        $this->cache = $cache;
    }
   

    public static function getEntityFqcn(): string
    {

        return Project::class;
    }

    #[Override]
    public function createEntity(string $entityFqcn): object
    {
        $this->cache->delete("projects");
        return parent::createEntity($entityFqcn);
    }

    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }

   
}
