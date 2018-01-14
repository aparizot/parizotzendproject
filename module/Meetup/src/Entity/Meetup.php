<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetup")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
     private $startAt;

     /**
      * @ORM\Column(type="string", nullable=false)
      */
      private $endAt;

    public function __construct($title, $description, $startAt, $endAt)
    {
        $this->id = Uuid::uuid4()->toString();

        $this->title = $title;
        $this->description = $description;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    /**
     * @return string
     */
    public function getID() : String
    { 
            return $this->id;
    }
    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }


    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getStartAt() : string
    {
        return $this->startAt;
    }


    public function setStartAt(string $startAt) : String
    {
            return $this->startAt = $startAt;
    }

    /**
     * @return string
     */
    public function getEndAt() : string
    {
        return $this->endAt;
    }

    public function setEndAt(string $getEndAt) : String
    {
            return $this->getEndAt = $getEndAt;
    }
}
