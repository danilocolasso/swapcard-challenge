<?php

namespace Email\Service;

use Doctrine\ORM\EntityManager;
use Email\Entity\Profile;
use Service\MailService;

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

        MailService::sendMail(
            to: $data['email'],
            subject: 'Profile Information',
            body: "Name: {$data['name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\nContent: {$data['content']}"
        );
    }

    public function getAllProfiles(): array
    {
        return $this->profileRepository->getAllProfiles();
    }
}