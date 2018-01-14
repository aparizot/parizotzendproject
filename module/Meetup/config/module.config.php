<?php

declare(strict_types=1);

use Meetup\Form\MeetupForm;
use Meetup\Form\MeetupFormFactory;
use Zend\Router\Http\Literal;
use Meetup\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'meetup' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetup',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'update' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/update[/:id]',
                            'constraints' =>[
                                    'id' => '[a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                'action'     => 'update',
                            ],
                        ],
                    ],
                    'view' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/meetup[/:id]',
                            'constraints' =>[
                                    'id' => '[a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                'action'     => 'meetup',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete[/:id]',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => MeetupFormFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'meetup/index/index' => __DIR__ . '/../view/meetup/index/index.phtml',
            'meetup/index/add' => __DIR__ . '/../view/meetup/index/add.phtml',
            'meetup/index/update' => __DIR__ . '/../view/meetup/index/update.phtml',
            'meetup/index/delete' => __DIR__ . '/../view/meetup/index.delete.phtml',
            'meetup/index/meetup' => __DIR__ . '/../view/meetup/index/meetup.phtml',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'meetup_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Meetup\Entity' => 'meetup_driver',
                ],
            ],
        ],
    ],
];
