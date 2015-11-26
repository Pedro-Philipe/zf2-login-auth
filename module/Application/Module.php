<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\Cliente;
use Application\Model\ClienteTable;
use Application\Model\Edital;
use Application\Model\EditalTable;
use Application\Model\Proposta;
use Application\Model\PropostaTable;

class Module{
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

    public function getServiceConfig(){
              return [
                      'factories' => [
                        'Application\Model\ClienteTable' => function($sm){
                              $tableGateway = $sm->get('ClienteTableGateway');
                              $table = new ClienteTable($tableGateway);
                              return $table;
                         },
                        'Application\Model\EditalTable' => function($sm){
                                $tableGateway = $sm->get('EditalTableGateway');
                                $table = new EditalTable($tableGateway);
                                return $table;
                        },
                        'Application\Model\PropostaTable' => function($sm){
                                $tableGateway = $sm->get('PropostaTableGateway');
                                $table = new PropostaTable($tableGateway);
                                return $table;
                        },



                        'ClienteTableGateway' => function($sm){
                            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                            $resultSetPrototype = new ResultSet();
                            $resultSetPrototype->setArrayObjectPrototype(new Cliente());
                            return new TableGateway('clientes',$dbAdapter,
                                null,$resultSetPrototype);
                        },
                        'EditalTableGateway' => function($sm){
                              $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                              $resultSetPrototype = new ResultSet();
                              $resultSetPrototype->setArrayObjectPrototype(new Edital());
                              return new TableGateway('editais',$dbAdapter,
                                  null,$resultSetPrototype);
                          },

                          'PropostaTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new Proposta());
                                return new TableGateway('propostas',$dbAdapter,
                                    null,$resultSetPrototype);
                            }


                   ]
           ];
    }
}
