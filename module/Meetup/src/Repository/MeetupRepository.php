<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{

    public function addMeetUp($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function createMeetUp($name, $description, $startAt, $endAt)
    {
        return new Meetup($name, $description, $startAt, $endAt);
    }

    public function updateMeetUp(Meetup $meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function deleteMeetUp($id)
    {
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }
}
