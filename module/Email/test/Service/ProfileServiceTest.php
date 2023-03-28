<?php

namespace Email\Test;

use Doctrine\ORM\EntityManagerInterface;
use Email\Entity\Profile;
use Email\Repository\ProfileRepository;
use Email\Service\ProfileService;
use PHPUnit\Framework\TestCase;

class ProfileServiceTest extends TestCase
{
    private $entityManager;
    private $profileRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this
            ->getMockBuilder(EntityManagerInterface::class)
            ->getMockForAbstractClass();

        $this->profileRepository = $this
            ->getMockBuilder(ProfileRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testSaveProfile(): void
    {
        $data = [
            'name' => 'Danilo Colasso',
            'email' => 'danilo.colasso@example.com',
            'phone' => '123456789',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ];

        $profile = new Profile();
        $profile->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setContent($data['content']);

        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->with(Profile::class)
            ->willReturn($this->profileRepository);

        $this->profileRepository->expects($this->once())
            ->method('saveProfile')
            ->with($data);

        $service = new ProfileService($this->entityManager);
        $service->saveProfile($data);
    }

    public function testGetAllProfiles(): void
    {
        $profiles = [
            new Profile(),
            new Profile(),
            new Profile()
        ];

        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->with(Profile::class)
            ->willReturn($this->profileRepository);

        $this->profileRepository->expects($this->once())
            ->method('getAllProfiles')
            ->willReturn($profiles);

        $service = new ProfileService($this->entityManager);
        $result = $service->getAllProfiles();

        $this->assertSame($profiles, $result);
    }
}