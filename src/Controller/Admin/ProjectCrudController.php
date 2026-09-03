<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
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

    public function configureCrud(Crud $crud): Crud
{
    return $crud
    ->setSearchFields(['title'])
    ->setTimezone('Europe/Rome')
    ->setHideFormFields(['updatedAt','createdAt'])
    ;
}

    #[Override]
    public function createEntity(string $entityFqcn): object
    {
        $this->cache->delete("projects_it");
        $this->cache->delete("projects_fr");
        $this->cache->delete("projects_en");

        $entity = parent::createEntity($entityFqcn);
        $timezone = new \DateTimeZone('Europe/Rome');
        $entity->setCreatedAt(new DateTimeImmutable('now',$timezone));
        $entity->setUpdatedAt(new DateTimeImmutable('now',$timezone));
        return $entity;
    }

    #[Override]
    public function deleteEntity(EntityManagerInterface $entityManager, object $entityInstance): void
    {
        $this->cache->delete("projects_it");
        $this->cache->delete("projects_fr");
        $this->cache->delete("projects_en");
        parent::deleteEntity($entityManager, $entityInstance);
    }

    #[Override]
    public function updateEntity(EntityManagerInterface $entityManager, object $entityInstance): void
    {
        $this->cache->delete("projects_it");
        $this->cache->delete("projects_fr");
        $this->cache->delete("projects_en");
        $timezone = new \DateTimeZone('Europe/Rome');
        $entityInstance->setUpdatedAt(new DateTimeImmutable('now',$timezone));
        parent::updateEntity($entityManager, $entityInstance);
        
        
    }


    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }

   
}
