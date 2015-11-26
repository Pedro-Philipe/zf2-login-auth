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
use Application\Model\Proposta;



class PropostaController extends AbstractActionController{




      public function indexAction()
      {
        $propostas = $this->getServiceLocator()
        ->get('Application\Model\PropostaTable')->findAll();
          return new ViewModel([
            'propostas' => $propostas
          ]);
      }

      public function createAction(){
        if($this->getRequest()->isPost()){
          $data = $this->params()->fromPost();
          $proposta = new Proposta();
          $proposta->exchangeArray($data);
          $table = $this->getServiceLocator()
          ->get('Application\Model\PropostaTable');
          $table->insert($proposta);
          return $this->redirect()->toUrl('/application/proposta/index');
        }
        $editais = $this->getServiceLocator()
        ->get('Application\Model\EditalTable')->findAll();
        return new ViewModel([
            'editais' => $editais
          ]);
      }

      public function editAction(){
        $table = $this->getServiceLocator()
          ->get('Application\Model\PropostaTable');
        if($this->getRequest()->isPost()){
          $data = $this->params()->fromPost();
          $proposta = new Proposta();
          $proposta->exchangeArray($data);
          $table->update($proposta);
          return $this->redirect()->toUrl('/application/proposta/index');
        }
        $proposta = $table->find($this->params()->fromRoute('id'));
        return new ViewModel();
      }

      public function deleteAction(){
        $table = $this->getServiceLocator()
          ->get('Application\Model\PropostaTable');

        $proposta = $table->delete($this->params()->fromRoute('id'));
        return $this->redirect()->toUrl('/application/proposta/index');
      }
}
