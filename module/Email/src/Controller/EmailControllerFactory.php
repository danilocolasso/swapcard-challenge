<?php

namespace Email\Controller;

use Doctrine\ORM\EntityManager;
use Email\Entity\Profile;
use Email\Service\ProfileService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class EmailControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        $entityManager->getRepository(Profile::class);
        $profileService = new ProfileService(($entityManager));

        return new EmailController($profileService);
    }
}