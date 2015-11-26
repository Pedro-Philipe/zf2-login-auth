<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Edital;


class EditalController extends AbstractActionController{




      public function indexAction()
      {
        $editais = $this->getServiceLocator()
        ->get('Application\Model\EditalTable')->findAll();
          return new ViewModel([
            'editais' => $editais
          ]);
      }
      public function indexuserAction()
      {
        $editais = $this->getServiceLocator()
        ->get('Application\Model\EditalTable')->findAll();
          return new ViewModel([
            'editais' => $editais
          ]);
      }

      public function createAction(){
        if($this->getRequest()->isPost()){
          $data = $this->params()->fromPost();
          $edital = new Edital();
          $edital->exchangeArray($data);
          $table = $this->getServiceLocator()
          ->get('Application\Model\EditalTable');
          $table->insert($edital);
          return $this->redirect()->toUrl('/application/edital/index');
        }
        return new ViewModel();
      }

      public function editAction(){
        $table = $this->getServiceLocator()
          ->get('Application\Model\EditalTable');
        if($this->getRequest()->isPost()){
          $data = $this->params()->fromPost();
          $edital = new Edital();
          $edital->exchangeArray($data);
          $table->update($edital);
          return $this->redirect()->toUrl('/application/edital/index');
        }
        $edital = $table->find($this->params()->fromRoute('id'));
        return new ViewModel([
          'edital' => $edital
        ]);
      }

      public function deleteAction(){
        $table = $this->getServiceLocator()
          ->get('Application\Model\EditalTable');

        $edital = $table->delete($this->params()->fromRoute('id'));
        return $this->redirect()->toUrl('/application/edital/index');
      }
}
