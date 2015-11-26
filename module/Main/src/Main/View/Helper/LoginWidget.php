<?php

namespace Main\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Main\Service\LoginLogoutService;

// The instance of this class is created in
// getViewHelperConfig() in Module.php

class LoginWidget extends AbstractHelper
{

    protected $loginLogoutService;

    public function __construct(LoginLogoutService $loginLogoutService)
    {
    	$this->loginLogoutService = $loginLogoutService;
    }

    public function __invoke()
    {
        $params = array();
        $userLoggedIn = $this->loginLogoutService->getLoggedIdentity();

        if ( $userLoggedIn ) {
            $params['userLoggedIn'] = true;
            $params['username'] = $userLoggedIn['username'];
        } else {
            $params['userLoggedIn'] = false;
            $params['username'] = "";
            $params['form'] = $this->loginLogoutService->getForm();
            $params['messages'] = $this->loginLogoutService->getLastLoginAttemptMessages();
        }

        return $this->getView()->render('main/login/widget', $params);
    }

}
