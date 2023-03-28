<?php

namespace Email\Controller;

use Email\Form\ProfileForm;
use Email\Service\ProfileService;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class EmailController extends AbstractActionController
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'form' => new ProfileForm(),
        ]);
    }

    public function listAction(): ViewModel
    {
        $proifiles = $this->profileService->getAllProfiles();

        return new ViewModel([
            'profiles' => $proifiles,
        ]);
    }

    public function createAction(): Response
    {
        $form = new ProfileForm();
        $request = $this->getRequest();

        $form->setData(($request->getPost()));

        if (!$request->isPost()) {
            throw new \Exception('Method not allowed.', 405);
        }

        if (!$form->isValid()) {
            $this->flashMessenger()->addErrorMessage('Invalid Form.');
            return $this->redirect()->toRoute('email');
        }

        $data = $form->getData();
        $this->profileService->saveProfile($data);
        $this->flashMessenger()->addSuccessMessage('Email sent and information stored successfully.');

        return $this->redirect()->toRoute('email');
    }
}