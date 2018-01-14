<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;

final class IndexController extends AbstractActionController
{

    private $meetupRepository;

    private $formMeetUp;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $formMeetUp)
    {
        $this->meetupRepository = $meetupRepository;
        $this->formMeetUp = $formMeetUp;
    }

    public function indexAction()
    {
        return new ViewModel([

            'meetupAll' => $this->meetupRepository->findAll(),

        ]);
    }


    public function meetupAction()
    {
            return new ViewModel([
                    $id = $this->params()->fromRoute( 'id' ),
                    'meetupSelected' => $this->meetupRepository->find($id),
            ]);
    }


    public function addAction()
    {
        $formAdd = $this->formMeetUp;

        $request = $this->getRequest();

        if ($request->isPost()) {

            $formAdd->setData($request->getPost());

            if ($formAdd->isValid()) {

                $meetup = $this->meetupRepository->createMeetup(
                    
                    $formAdd->getData()['title'],
                    $formAdd->getData()['description'],
                    $formAdd->getData()['startAt'],
                    $formAdd->getData()['endAt']

                );

                $this->meetupRepository->addMeetUp($meetup);

                return $this->redirect()->toRoute('meetup');
            }
        }

        $formAdd->prepare();

        return new ViewModel([
            'form' => $formAdd,
        ]);
    }


    public function updateAction()
    {

        $formUpdate = $this->formMeetUp;

        $id = $this->params()->fromRoute( 'id' );

        $meetupSelected = $this->meetupRepository ->find($id);

        $formUpdate->bind($meetupSelected);

        $request = $this->getRequest();

        if($request->isPost())
        {
            $formUpdate->setData($request->getPost());

            if($formUpdate->isValid())
            {
                $meetupSelected = $formUpdate->getData();

                $this->meetupRepository->updateMeetUp($meetupSelected);

                return $this->redirect()->toRoute('meetup');

            }

        }

        $formUpdate->prepare();

        return new ViewModel([
        'form' => $formUpdate,
        'meetup' =>$meetupSelected,
        ]);
        
    }


    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $this->meetupRepository->deleteMeetUp($id);
        return $this->redirect()->toRoute('meetup');
    }
}
