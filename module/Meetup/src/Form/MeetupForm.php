<?php

declare(strict_types=1);

namespace Meetup\Form;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class MeetupForm extends Form implements InputFilterProviderInterface
{

        public function __construct(EntityManager $entityManager)
    {
        parent::__construct('meetup');

        $hydrator = new DoctrineHydrator($entityManager, Meetup::class);

        $this->setHydrator($hydrator);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                    'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                    'class' => 'form-control',
            ],
        ]);

        $this->add([
                'type' => Element\Text::class,
                'name' => 'startAt',
                'options' => [
                        'label' => 'Starting At',
                ],
                'attributes' => [
                        'class' => 'form-control',
                        'id' => 'datetime1',
                ],
        ]);

        $this->add([
                'type' => Element\Text::class,
                'name' => 'endAt',
                'options' => [
                        'label' => 'Ending At',
                ],
                'attributes' => [
                        'class' => 'form-control',
                        'id' => 'datetime2',
                ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [

        ];
    }
}
