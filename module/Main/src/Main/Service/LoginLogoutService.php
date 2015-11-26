<?php

namespace Main\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Form\Annotation\AnnotationBuilder;
use Main\Model\User;
use Main\Service\AuthenticationAdaptor;

// Handles user requests to /authentication and /logout routes
//
// REM: In this application there is no /login route
//      since we use a LoginWidget.

class LoginLogoutService
{
    private static $failedLoginAttempt;

    static function init()
    {
        self::$failedLoginAttempt = new Result(Result::FAILURE, "", array());
    }

    private $lastAttemptResult;

    private $authservice;
    private $form;

    public function __construct()
    {
        $this->lastAttemptResult = LoginLogoutService::$failedLoginAttempt;

        $this->authservice = new AuthenticationService();
        $this->authservice->setStorage(new \Main\Service\UserSessionStorage());

        $user       = new User();
        $builder    = new AnnotationBuilder();
        $this->form = $builder->createForm($user);
    }

    public function getForm() {
        return $this->form;
    }

    public function authenticate($request) {

        // Do we have a valid request?
        if (!$request) {
            $this->lastAttemptResult = LoginLogoutService::failedLoginAttempt;
        }

        // Logging out any logged in user
        $this->logout();

        // Preparing authentication
        $authAdapt = new AuthenticationAdaptor(
            $request->getPost('username'),
            $request->getPost('password'));

        // Performing authentication
        $this->authservice->setAdapter($authAdapt);
        $lastAttemptResult = $this->authservice->authenticate();

        if ($lastAttemptResult->isValid()) {

            // The identity is registered in the session service

            // Setting remember me
            if ($request->getPost('rememberme') === 1 ) {
                $this->authservice->getStorage()->setRememberMe(1);
            }

        } else {
            $this->authservice->clearIdentity();
        }

    }

    public function logout() {
        $this->authservice->getStorage()->forgetMe();
        $this->authservice->clearIdentity();
    }

    public function getLoggedIdentity() {
        return $this->authservice->getIdentity();
    }

    public function getLastLoginAttemptMessages() {
        if ( $this->lastAttemptResult ) {
            return $this->lastAttemptResult->getMessages();
        } else {
            return array();
        }
    }
}
