<?php

namespace Main\Service;

use Zend\Authentication\Storage;

// Proxy for saving data in $_SESSION.
// 
// This is not the database where user information would be stored.

class UserSessionStorage extends Storage\Session
{
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
         if ($rememberMe == 1) {
             $this->session->getManager()->rememberMe($time);
         }
    }

    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
}