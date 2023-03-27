<?php

namespace Email\Controller;

use Email\Form\ProfileForm;
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class EmailController extends AbstractActionController
{
    private $dbAdapter;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction()
    {
        $form = new ProfileForm();

        $request = $this->getRequest();
        $form->setAttribute('action', $this->url('email', ['action' => 'index']));
        $form->prepare();

        if ($request->isPost()) {
            $form->setData(($request->getPost()));

            if ($form->isValid()) {
                $data = $form->getData();

                // Store
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