<?php

namespace Email\Service;

use Doctrine\ORM\EntityManager;
use Email\Entity\Profile;

class ProfileService
{
    private $profileRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->profileRepository = $entityManager->getRepository(Profile::class);
    }

    public function saveProfile(array $data): void
    {
        $this->profileRepository->saveProfile($data);
    }
}