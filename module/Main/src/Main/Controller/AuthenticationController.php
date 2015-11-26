<?php

namespace Main\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Main\Model\User;

// Handles user requests to /authentication and /logout routes
//
// REM: In this application there is no /login route
//      since we use a LoginWidget.

class AuthenticationController extends AbstractActionController
{
    private $loginLogoutService;

    public function __construct($lls)
    {
        $this->loginLogoutService = $lls;
    }

    public function authenticateAction()
    {
        $form = $this->loginLogoutService->getForm();
        $request = $this->getRequest();

        if ($request->isPost()){
            // Setting user entered data in the form object
            $form->setData($request->getPost());
            // Is the retrieved data valid?
            if ($form->isValid()){
                $this->loginLogoutService->authenticate($request);
            }
        }

        return $this->redirect()->toRoute('home');

    }

    public function logoutAction()
    {
        $this->loginLogoutService->logout();

        return $this->redirect()->toRoute('home');
    }
}
