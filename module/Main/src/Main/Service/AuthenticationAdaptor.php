<?php

namespace Main\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Main\Controller\AccessController;
use Main\Model\User;
use Main\Model\UserTable;

// Authentication services delegate the actual authentication
// to one (or more) authentication adaptors.
//
// In reality, this adaptor would probably load the username
// and encrypted password from a database

class AuthenticationAdaptor implements AdapterInterface
{
    CONST USERNAME = "username";
    CONST GRANTED_ROLES = "grantedRoles";

    private $storedUsername = "";
    private $storedPassword = "";



    private static $knownUsers = array("user1","user2","admin");

    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username = "", $password = "")
    {
        if ( is_string($username) ) {
            $this->storedUsername = $username;
        }
        if ( is_string($password) ) {
            $this->storedPassword = $password;
        }
    }
    public function authenticate()
    {
        $authenticationCode = Result::FAILURE;
        $msgs = array();
        $grantedRoles = array();

        if ( $this->storedUsername === "" ) {
            $authenticationCode = Result::FAILURE_IDENTITY_AMBIGUOUS;
            $msgs[] = "No username provided";
        } else if ( $this->storedPassword === "" ) {
            $authenticationCode = Result::FAILURE_CREDENTIAL_INVALID;
            $msgs[] = "No password provided";
        } else if (!in_array($this->storedUsername, AuthenticationAdaptor::$knownUsers)) {
            $authenticationCode = Result::FAILURE_IDENTITY_NOT_FOUND;
            $msgs[] = "Unknown user '".$this->storedUsername."'";
        } else if ( $this->storedUsername === $this->storedPassword ) {
            $authenticationCode = Result::SUCCESS;
            $grantedRoles[] = AccessController::ROLE_AUTHENTICATED;
        if ( $this->storedUsername === "admin" ) {
            $grantedRoles[] = AccessController::ROLE_ADMINISTRATOR;
        }
        } else {
            $authenticationCode = Result::FAILURE_CREDENTIAL_INVALID;
            $msgs[] = "Wrong password";
        }

        $loggedInIdentity = array();
        $loggedInIdentity[AuthenticationAdaptor::USERNAME] = $this->storedUsername;
        $loggedInIdentity[AuthenticationAdaptor::GRANTED_ROLES] = $grantedRoles;

        return new Result($authenticationCode, $loggedInIdentity, $msgs);
    }
}
