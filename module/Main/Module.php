<?php

namespace Main;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Main\View\Helper\LoginWidget;
use Main\Service\LoginLogoutService;
use Main\Service\PersistenceService;
use Main\Controller\AuthenticationController;
use Main\Controller\AccessController;
use Main\Controller\PersistenceController;

class Module{
    // Must be included in one module only (it is enough)

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'LoginLogoutService' => function() {
                    return new LoginLogoutService();
                },
            ),
        );
    }

    public function getControllerConfig() {
        return array(
            'factories' => array(
                'Main\Controller\Authentication' => function($cm) {
                    $sm   = $cm->getServiceLocator();
                    $depA = $sm->get('LoginLogoutService');
                    $controller = new AuthenticationController($depA);
                    return $controller;
                },
                'Main\Controller\Access' => function($cm) {
                    $sm   = $cm->getServiceLocator();
                    $depA = $sm->get('LoginLogoutService');
                    $controller = new AccessController($depA);
                    return $controller;
                }
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'loginWidget' => function ($helperPluginManager) {
                    $loginOutSrv = $helperPluginManager
                        ->getServiceLocator()
                        ->get('LoginLogoutService');
                    return new LoginWidget($loginOutSrv);
                }
            )
        );
    }

}
