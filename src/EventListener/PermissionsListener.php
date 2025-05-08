<?php

namespace App\EventListener;

use App\Entity\Permissions;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class PermissionsListener
{
    public function __construct(private SluggerInterface $slugger) {}

    public function prePersist(Permissions $permission, PrePersistEventArgs $event): void
    {
        $this->handleSlug($permission);
    }

    public function preUpdate(Permissions $permission, PreUpdateEventArgs $event): void
    {
        $this->handleSlug($permission);
    }

    private function handleSlug(Permissions $permission): void
    {
        if (!$permission->getSlug() && $permission->getLibelle()) {
            $slug = strtolower($this->slugger->slug($permission->getLibelle()));
            $permission->setSlug($slug);
        }
    }
}