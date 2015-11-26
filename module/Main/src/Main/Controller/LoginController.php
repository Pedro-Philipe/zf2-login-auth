<?php
namespace Main\Controller;

use Zend\Mvc\Controller\AbstractActionController; // isso é essencial
use Zend\Session\Container; // isso você vai usar em seguida...
use Zend\View\Model\ViewModel; // isso é essencial

    class LoginController extends AbstractActionController
    {
            public function indexAction()
            {
                $view =  new ViewModel();
                return $view->setTerminal(true);
            }
  }
