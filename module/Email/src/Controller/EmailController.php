<?php

namespace Email\Controller;

use Email\Form\ProfileForm;
use Email\Service\ProfileService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class EmailController extends AbstractActionController
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function indexAction()
    {
        $form = new ProfileForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData(($request->getPost()));

            if ($form->isValid()) {
                $data = $form->getData();

                $this->profileService->saveProfile($data);
                // Send

                $this->flashMessenger()->addSuccessMessage('Email sent and information stored successfully.');

                return $this->redirect()->toRoute('email');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }
}