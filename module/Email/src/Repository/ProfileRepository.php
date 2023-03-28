<?php

namespace Email\Repository;

use Doctrine\ORM\EntityRepository;
use Email\Entity\Profile;

class ProfileRepository extends EntityRepository
{
    public function saveProfile(array $data): void
    {
        $profile = new Profile();
        $profile
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setContent($data['content']);

        $this->_em->persist($profile);
        $this->_em->flush();
    }
}